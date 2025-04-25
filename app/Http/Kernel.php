<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middleware global (jalan di semua route)
    protected $middleware = [
        // contoh middleware global
    ];

    // Middleware group (untuk 'web', 'api', dsb.)
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // 🟢 DI SINI tempat daftar route middleware (per route)
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,  // ← tambahkan ini!
    ];
}
