<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'prefix/api',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => RoleMiddleware::class,
        ]);
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at:'*');
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();