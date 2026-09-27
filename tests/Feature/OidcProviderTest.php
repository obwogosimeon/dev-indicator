<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OidcProviderTest extends TestCase
{
    private $privateKey;
    private $publicKey;
    private $keyDirectory;

    protected function setUp()
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'oidc.issuer' => 'https://login.example.test',
            'oidc.client_id' => 'kobo-test',
            'oidc.client_secret' => 'a-test-secret-with-enough-entropy',
            'oidc.redirect_uri' => 'https://kf.kobo.example.test/accounts/oidc/laravel/login/callback/',
            'oidc.code_ttl' => 300,
            'oidc.access_token_ttl' => 3600,
            'oidc.id_token_ttl' => 300,
            'oidc.subject_key' => 'a-stable-test-subject-key',
        ]);
        DB::purge('sqlite');
        Schema::connection('sqlite')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->timestamps();
        });
        require_once database_path('migrations/2026_09_27_000000_create_oidc_authorization_tables.php');
        (new \CreateOidcAuthorizationTables())->up();

        $pair = openssl_pkey_new(['private_key_type' => OPENSSL_KEYTYPE_RSA, 'private_key_bits' => 2048]);
        openssl_pkey_export($pair, $this->privateKey);
        $details = openssl_pkey_get_details($pair);
        $this->keyDirectory = sys_get_temp_dir().'/laravel-oidc-tests-'.uniqid();
        mkdir($this->keyDirectory, 0700, true);
        file_put_contents($this->keyDirectory.'/private.pem', $this->privateKey);
        file_put_contents($this->keyDirectory.'/public.pem', $details['key']);
        config(['oidc.private_key' => $this->keyDirectory.'/private.pem', 'oidc.public_key' => $this->keyDirectory.'/public.pem']);
        $this->publicKey = openssl_pkey_get_public($details['key']);
    }

    protected function tearDown()
    {
        @unlink($this->keyDirectory.'/private.pem');
        @unlink($this->keyDirectory.'/public.pem');
        @rmdir($this->keyDirectory);
        parent::tearDown();
    }

    public function test_discovery_and_jwks_are_published()
    {
        $this->get('/.well-known/openid-configuration')->assertStatus(200)
            ->assertJsonFragment(['issuer' => 'https://login.example.test'])
            ->assertJsonFragment(['authorization_endpoint' => 'https://login.example.test/oauth/authorize'])
            ->assertJsonFragment(['token_endpoint_auth_methods_supported' => ['client_secret_basic', 'client_secret_post']]);

        $jwks = $this->get('/.well-known/jwks.json')->assertStatus(200)->json('keys.0');
        $this->assertEquals('RS256', $jwks['alg']);
        $this->assertNotEmpty($jwks['n']);
        $this->assertNotEmpty($jwks['e']);
    }

    public function test_authorization_code_exchange_issues_valid_id_token_and_single_use_code()
    {
        $user = User::create(['name' => 'Test', 'last_name' => 'User', 'email' => 'test@example.test']);
        $redirect = config('oidc.redirect_uri');
        $params = [
            'response_type' => 'code', 'client_id' => config('oidc.client_id'),
            'redirect_uri' => $redirect, 'scope' => 'openid profile email',
            'state' => 'csrf-state', 'nonce' => 'test-nonce',
        ];

        $response = $this->actingAs($user)->withSession(['oidc.authorization' => $params])
            ->post('/oauth/authorize/approve')->assertRedirect();
        $authorization = $response->getTargetUrl();
        parse_str(parse_url($authorization, PHP_URL_QUERY), $query);
        $this->assertSame('csrf-state', $query['state']);
        $this->assertNotEmpty($query['code']);

        $basic = base64_encode(config('oidc.client_id').':'.config('oidc.client_secret'));
        $tokenResponse = $this->postJson('/oauth/token', [
            'grant_type' => 'authorization_code', 'redirect_uri' => $redirect,
            'code' => $query['code'],
        ], ['Authorization' => 'Basic '.$basic])
            ->assertStatus(200)->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'id_token']);

        $token = $tokenResponse->json();
        list($header, $payload, $signature) = explode('.', $token['id_token']);
        $verified = openssl_verify($header.'.'.$payload, $this->decodeBase64Url($signature), $this->publicKey, OPENSSL_ALGO_SHA256);
        $this->assertSame(1, $verified);
        $claims = json_decode($this->decodeBase64Url($payload), true);
        $this->assertSame('https://login.example.test', $claims['iss']);
        $this->assertSame(config('oidc.client_id'), $claims['aud']);
        $this->assertSame('test-nonce', $claims['nonce']);
        $this->assertSame('Test User', $claims['name']);
        $this->assertFalse($claims['email_verified']);

        $this->withHeaders(['Authorization' => 'Bearer '.$token['access_token']])
            ->getJson('/oauth/userinfo')->assertStatus(200)
            ->assertJsonFragment(['email' => 'test@example.test']);

        $this->postJson('/oauth/token', [
            'grant_type' => 'authorization_code', 'client_id' => config('oidc.client_id'),
            'client_secret' => config('oidc.client_secret'), 'redirect_uri' => $redirect,
            'code' => $query['code'],
        ])->assertStatus(400)->assertJsonFragment(['error' => 'invalid_grant']);
    }

    public function test_authorization_rejects_unregistered_redirect_uri()
    {
        $user = User::create(['name' => 'Test', 'last_name' => 'User', 'email' => 'test@example.test']);
        $this->actingAs($user)->get('/oauth/authorize?'.http_build_query([
            'response_type' => 'code', 'client_id' => config('oidc.client_id'),
            'redirect_uri' => 'https://attacker.example/callback', 'scope' => 'openid email',
        ]))->assertStatus(400)->assertSee('redirect URI');
    }

    private function decodeBase64Url($value)
    {
        return base64_decode(strtr($value, '-_', '+/').str_repeat('=', (4 - strlen($value) % 4) % 4));
    }
}
