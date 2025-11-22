<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // admin専用ミドルウェアを追加
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'is_member' => \App\Http\middleware\IsMember::class,
        ]);
    })
    // ->withProviders([
    // App\Providers\FortifyServiceProvider::class, // ←★ これを追加
    // ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
