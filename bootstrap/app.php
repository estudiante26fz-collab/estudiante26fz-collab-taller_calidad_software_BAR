<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // ¡Importación necesaria!

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registro del middleware de rutas (aliases)
        $middleware->alias([
            'role' => RoleMiddleware::class, // <-- ESTE ES EL REGISTRO CLAVE
            // Agrega otros aliases aquí si los tienes
        ]);

        // Middleware para el grupo web (sesiones, cookies, etc.)
        $middleware->web(append: [
            // \App\Http\Middleware\TrustProxies::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);

        // Middleware para el grupo api (si lo usas)
        // $middleware->api(append: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
        
        // Puedes agregar middleware global aquí si es necesario
        // $middleware->validateCsrfTokens(except: [
        //     'stripe/*',
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
