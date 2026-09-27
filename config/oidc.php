<?php

return [
    // Public HTTPS URL of this Laravel application. This is the OIDC issuer.
    'issuer' => rtrim(env('OIDC_ISSUER', env('APP_URL', 'http://localhost')), '/'),
    'client_id' => env('OIDC_KOBO_CLIENT_ID'),
    'client_secret' => env('OIDC_KOBO_CLIENT_SECRET'),
    'redirect_uri' => env('OIDC_KOBO_REDIRECT_URI', 'https://kf.kobo.visystem.net/accounts/oidc/laravel/login/callback/'),
    // Keep this stable for the lifetime of the OIDC provider so user subjects do not change.
    'subject_key' => env('OIDC_SUBJECT_KEY', env('APP_KEY')),
    'private_key' => env('OIDC_PRIVATE_KEY', storage_path('app/oidc/private.pem')),
    'public_key' => env('OIDC_PUBLIC_KEY', storage_path('app/oidc/public.pem')),
    'code_ttl' => 300,
    'access_token_ttl' => 3600,
    'id_token_ttl' => 300,
];
