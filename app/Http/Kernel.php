<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RequirePassword;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\TrustProxies;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\ValidateSignature;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Handle proxies (if any)
        TrustProxies::class,
        // Handle CORS
        HandleCors::class,
        // Prevent maintenance mode responses
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Validate post size
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // Trim strings
        TrimStrings::class,
        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // Share errors from session to views
            ShareErrorsFromSession::class,
            // CSRF protection
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],
        'api' => [
            // 'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
