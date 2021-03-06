<?php

namespace nee_portal\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \nee_portal\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \nee_portal\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.admin' => \nee_portal\Http\Middleware\AuthenticateAdmin::class,
        'auth.candidate' => \nee_portal\Http\Middleware\AuthenticateCandidate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest.admin' => \nee_portal\Http\Middleware\RedirectAdminIfAuthenticated::class,
        'guest.candidate' => \nee_portal\Http\Middleware\RedirectCandidateIfAuthenticated::class,
        'acl' => \nee_portal\Http\Middleware\CheckPermission::class,
        'filter' => \nee_portal\Http\Middleware\Filter::class,
        'permission' => \nee_portal\Http\Middleware\Permission::class,
    ];
}
