<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // OAuth token requests are authenticated with the registered client secret.
        'oauth/token',
        // Userinfo is protected by a bearer token, not the browser's Laravel session.
        'oauth/userinfo',
    ];
}
