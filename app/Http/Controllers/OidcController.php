<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OidcController extends Controller
{
    public function discovery()
    {
        $issuer = $this->issuer();

        return response()->json([
            'issuer' => $issuer,
            'authorization_endpoint' => $issuer.'/oauth/authorize',
            'token_endpoint' => $issuer.'/oauth/token',
            'userinfo_endpoint' => $issuer.'/oauth/userinfo',
            'jwks_uri' => $issuer.'/.well-known/jwks.json',
            'response_types_supported' => ['code'],
            'subject_types_supported' => ['public'],
            'id_token_signing_alg_values_supported' => ['RS256'],
            'scopes_supported' => ['openid', 'profile', 'email'],
            'claims_supported' => ['iss', 'sub', 'aud', 'exp', 'iat', 'nonce', 'name', 'given_name', 'family_name', 'email', 'email_verified'],
            'token_endpoint_auth_methods_supported' => ['client_secret_basic', 'client_secret_post'],
            'grant_types_supported' => ['authorization_code'],
        ])->header('Cache-Control', 'public, max-age=300');
    }

    public function jwks()
    {
        $key = $this->publicKey();
        $details = openssl_pkey_get_details($key);

        if (!$details || empty($details['rsa'])) {
            abort(500, 'OIDC signing key must be RSA.');
        }

        return response()->json(['keys' => [[
            'kty' => 'RSA',
            'use' => 'sig',
            'alg' => 'RS256',
            'kid' => $this->keyId(),
            'n' => $this->base64Url($details['rsa']['n']),
            'e' => $this->base64Url($details['rsa']['e']),
        ]]])->header('Cache-Control', 'public, max-age=300');
    }

    public function authorizationRequest(Request $request)
    {
        $params = $request->only('response_type', 'client_id', 'redirect_uri', 'scope', 'state', 'nonce');
        $error = $this->validateAuthorization($params);
        if ($error) {
            return response()->view('oidc.error', ['message' => $error], 400);
        }

        $request->session()->put('oidc.authorization', $params);
        return view('oidc.consent', ['params' => $params]);
    }

    public function approve(Request $request)
    {
        $params = $request->session()->pull('oidc.authorization');
        if (!$params || $this->validateAuthorization($params)) {
            return response()->view('oidc.error', ['message' => 'The authorization request expired. Please try again.'], 400);
        }

        $code = $this->base64Url(random_bytes(32));
        $now = Carbon::now();
        DB::table('oidc_authorization_codes')->insert([
            'code_hash' => hash('sha256', $code),
            'user_id' => $request->user()->id,
            'client_id' => $params['client_id'],
            'redirect_uri' => $params['redirect_uri'],
            'scope' => $params['scope'],
            'nonce' => isset($params['nonce']) ? $params['nonce'] : null,
            'state' => isset($params['state']) ? $params['state'] : null,
            'expires_at' => $now->copy()->addSeconds(config('oidc.code_ttl')),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->to($this->appendQuery($params['redirect_uri'], array_filter([
            'code' => $code,
            'state' => isset($params['state']) ? $params['state'] : null,
        ], function ($value) { return $value !== null; })));
    }

    public function deny(Request $request)
    {
        $params = $request->session()->pull('oidc.authorization');
        if (!$params || $this->validateAuthorization($params)) {
            return response()->view('oidc.error', ['message' => 'The authorization request expired. Please try again.'], 400);
        }

        return redirect()->to($this->appendQuery($params['redirect_uri'], array_filter([
            'error' => 'access_denied',
            'state' => isset($params['state']) ? $params['state'] : null,
        ], function ($value) { return $value !== null; })));
    }

    public function token(Request $request)
    {
        if (!$this->authenticateClient($request)) {
            return $this->oauthError('invalid_client', 'Client authentication failed.', 401)
                ->header('WWW-Authenticate', 'Basic realm="oauth"');
        }
        if ($request->input('grant_type') !== 'authorization_code') {
            return $this->oauthError('unsupported_grant_type', 'Only authorization_code is supported.');
        }

        $rawCode = (string) $request->input('code');
        $now = Carbon::now();
        $result = DB::transaction(function () use ($rawCode, $request, $now) {
            $row = DB::table('oidc_authorization_codes')
                ->where('code_hash', hash('sha256', $rawCode))
                ->lockForUpdate()->first();

            if (!$row || $row->client_id !== config('oidc.client_id') ||
                $row->redirect_uri !== $request->input('redirect_uri') ||
                $row->consumed_at || Carbon::parse($row->expires_at)->lte($now)) {
                return null;
            }

            DB::table('oidc_authorization_codes')->where('id', $row->id)->update([
                'consumed_at' => $now, 'updated_at' => $now,
            ]);
            return $row;
        });

        if (!$result) {
            return $this->oauthError('invalid_grant', 'Authorization code is invalid, expired, or already used.');
        }

        $user = User::find($result->user_id);
        if (!$user || (isset($user->is_active) && !$user->is_active)) {
            return $this->oauthError('invalid_grant', 'The user account is unavailable.');
        }

        $scopes = preg_split('/\s+/', trim($result->scope));
        $accessToken = $this->base64Url(random_bytes(32));
        $expires = $now->copy()->addSeconds(config('oidc.access_token_ttl'));
        DB::table('oidc_access_tokens')->insert([
            'token_hash' => hash('sha256', $accessToken), 'user_id' => $user->id,
            'client_id' => config('oidc.client_id'), 'scope' => $result->scope,
            'expires_at' => $expires, 'created_at' => $now, 'updated_at' => $now,
        ]);

        $claims = [
            'iss' => $this->issuer(), 'sub' => $this->subject($user),
            'aud' => config('oidc.client_id'), 'iat' => $now->timestamp,
            'exp' => $now->copy()->addSeconds(config('oidc.id_token_ttl'))->timestamp,
        ];
        if (!empty($result->nonce)) $claims['nonce'] = $result->nonce;
        $profileName = trim($user->name.' '.(isset($user->last_name) ? $user->last_name : ''));
        if (in_array('profile', $scopes)) {
            $claims['name'] = $profileName;
            $claims['given_name'] = $user->name;
            if (!empty($user->last_name)) $claims['family_name'] = $user->last_name;
        }
        if (in_array('email', $scopes)) {
            $claims['email'] = $user->email;
            $claims['email_verified'] = false;
        }

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_in' => config('oidc.access_token_ttl'),
            'scope' => $result->scope,
            'id_token' => $this->signJwt($claims),
        ])->header('Cache-Control', 'no-store')->header('Pragma', 'no-cache');
    }

    public function userinfo(Request $request)
    {
        $authorization = $request->header('Authorization', '');
        if (!preg_match('/^Bearer\s+(\S+)$/i', $authorization, $matches)) {
            return response()->json(['error' => 'invalid_token'], 401);
        }
        $token = $matches[1];
        $record = DB::table('oidc_access_tokens')->where('token_hash', hash('sha256', $token))
            ->whereNull('revoked_at')->first();
        if (!$record || Carbon::parse($record->expires_at)->lte(Carbon::now())) {
            return response()->json(['error' => 'invalid_token'], 401);
        }
        $user = User::find($record->user_id);
        if (!$user) return response()->json(['error' => 'invalid_token'], 401);

        $claims = ['sub' => $this->subject($user)];
        $scopes = preg_split('/\s+/', trim($record->scope));
        if (in_array('profile', $scopes)) {
            $claims['name'] = trim($user->name.' '.(isset($user->last_name) ? $user->last_name : ''));
            $claims['given_name'] = $user->name;
            if (!empty($user->last_name)) $claims['family_name'] = $user->last_name;
        }
        if (in_array('email', $scopes)) {
            $claims['email'] = $user->email;
            $claims['email_verified'] = false;
        }
        return response()->json($claims)->header('Cache-Control', 'no-store');
    }

    private function validateAuthorization(array $params)
    {
        if (($params['response_type'] ?? null) !== 'code') return 'Only the authorization code response type is supported.';
        if (($params['client_id'] ?? null) !== config('oidc.client_id') || !$this->clientConfigured()) return 'Unknown or unconfigured client.';
        if (($params['redirect_uri'] ?? null) !== config('oidc.redirect_uri')) return 'The redirect URI does not match the registered Kobo callback.';
        $scopes = preg_split('/\s+/', trim($params['scope'] ?? ''));
        if (!in_array('openid', $scopes) || array_diff($scopes, ['openid', 'profile', 'email'])) return 'The requested scopes are not supported.';
        if (isset($params['state']) && strlen($params['state']) > 512) return 'Invalid state value.';
        if (isset($params['nonce']) && strlen($params['nonce']) > 255) return 'Invalid nonce value.';
        return null;
    }

    private function authenticateClient(Request $request)
    {
        if (!$this->clientConfigured()) return false;
        $id = $request->input('client_id');
        $secret = $request->input('client_secret');
        $header = $request->header('Authorization', '');
        if (preg_match('/^Basic\s+(.+)$/i', $header, $match)) {
            $decoded = base64_decode($match[1], true);
            if ($decoded !== false && strpos($decoded, ':') !== false) {
                list($id, $secret) = explode(':', $decoded, 2);
                $id = rawurldecode($id);
                $secret = rawurldecode($secret);
            }
        }
        return is_string($id) && is_string($secret) &&
            hash_equals((string) config('oidc.client_id'), $id) &&
            hash_equals((string) config('oidc.client_secret'), $secret);
    }

    private function clientConfigured()
    {
        return config('oidc.client_id') && config('oidc.client_secret') && config('oidc.redirect_uri');
    }

    private function signJwt(array $claims)
    {
        $header = ['typ' => 'JWT', 'alg' => 'RS256', 'kid' => $this->keyId()];
        $message = $this->base64Url(json_encode($header)).'.'.$this->base64Url(json_encode($claims));
        if (!openssl_sign($message, $signature, $this->privateKey(), OPENSSL_ALGO_SHA256)) {
            abort(500, 'Unable to sign OIDC token.');
        }
        return $message.'.'.$this->base64Url($signature);
    }

    private function privateKey()
    {
        $key = @file_get_contents(config('oidc.private_key'));
        $resource = $key ? openssl_pkey_get_private($key) : false;
        if (!$resource) abort(500, 'OIDC signing key is missing or invalid.');
        return $resource;
    }

    private function publicKey()
    {
        $key = @file_get_contents(config('oidc.public_key'));
        $resource = $key ? openssl_pkey_get_public($key) : false;
        if (!$resource) abort(500, 'OIDC public key is missing or invalid.');
        return $resource;
    }

    private function keyId()
    {
        return substr(hash('sha256', file_get_contents(config('oidc.public_key'))), 0, 24);
    }

    private function subject(User $user)
    {
        return $this->base64Url(hash_hmac('sha256', 'oidc-user:'.$user->getKey(), config('oidc.subject_key'), true));
    }

    private function issuer()
    {
        $issuer = rtrim((string) config('oidc.issuer'), '/');
        $scheme = parse_url($issuer, PHP_URL_SCHEME);
        if (!$issuer || ($scheme !== 'https' && app()->environment() !== 'local')) {
            abort(500, 'OIDC_ISSUER must be a public HTTPS URL outside local development.');
        }
        return $issuer;
    }

    private function appendQuery($url, array $params)
    {
        return $url.(strpos($url, '?') === false ? '?' : '&').http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    private function oauthError($error, $description, $status = 400)
    {
        return response()->json(['error' => $error, 'error_description' => $description], $status)
            ->header('Cache-Control', 'no-store')->header('Pragma', 'no-cache');
    }

    private function base64Url($value)
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }
}
