<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Adiciona o middleware de CORS
        $middleware->append(\App\Http\Middleware\CorsMiddleware::class);  
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //Lança exceção quando houver erro de autenticação
        $exceptions->render(function (AuthenticationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Autenticação inválida',
            ], 401);
        });
    })->create();

