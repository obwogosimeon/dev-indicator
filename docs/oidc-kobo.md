# Laravel OIDC provider for KoboToolbox

This app can act as an OpenID Connect provider for one registered Kobo instance. It implements the authorization-code flow, displays a user consent screen, issues RS256-signed ID tokens, publishes discovery/JWKS metadata, and exposes userinfo.

## Deployment setup

1. Serve Laravel at a stable public HTTPS URL. Set `APP_URL` and `OIDC_ISSUER` to that exact origin, for example `https://login.example.org` (no trailing slash).
2. Set `OIDC_KOBO_CLIENT_ID` and `OIDC_KOBO_CLIENT_SECRET` in the production environment. Generate the client secret with a cryptographically secure secret generator. Do not commit either value.
3. Keep `OIDC_KOBO_REDIRECT_URI` equal to `https://kf.kobo.visystem.net/accounts/oidc/laravel/login/callback/`.
4. Set a random `OIDC_SUBJECT_KEY` and keep it unchanged. Changing it changes every user's stable OIDC subject.
5. Run `php artisan oidc:keys` on the server. Keep `storage/app/oidc/private.pem` private and backed up; serve only the public key through the JWKS endpoint.
6. Run `php artisan migrate --force` to create the short-lived authorization-code and access-token tables.
7. Verify the public metadata at `https://login.example.org/.well-known/openid-configuration` and JWKS at `https://login.example.org/.well-known/jwks.json`.

The authorization and consent routes use Laravel's normal authenticated web session. Kobo's token endpoint is exempted from CSRF verification because it is a server-to-server OAuth request and requires the registered client secret. The exact Kobo callback URL is checked before any code is issued.

## Kobo configuration

Configure a Django Social Application / OpenID Connect provider with:

- Provider ID: `laravel`
- Client ID and secret: values from `OIDC_KOBO_CLIENT_ID` and `OIDC_KOBO_CLIENT_SECRET`
- Issuer / server URL: the public Laravel `OIDC_ISSUER`
- Callback URL: `https://kf.kobo.visystem.net/accounts/oidc/laravel/login/callback/`

If the Kobo deployment is configured with environment variables instead of the admin interface, map its `SOCIALACCOUNT_PROVIDERS_openid_connect_SERVERS_0_*` settings to the same issuer, provider ID, and client credentials. Exact variable support depends on the installed Kobo release.

## Limitations

- This first provider supports one confidential client (Kobo), authorization code only, and scopes `openid`, `profile`, and `email`.
- `email_verified` is reported as `false`; the Laravel user table does not track verified email addresses.
- There is no OIDC single logout or refresh-token flow.
- Configure HTTPS, a stable issuer, secure client secret, database backups, and the signing-key backup before enabling this in production.
