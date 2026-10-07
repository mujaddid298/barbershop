<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/booking/payment-callback',
            '/user/booking/payment-complete', // Let's also exempt this just in case, though it is usually inside web session
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
