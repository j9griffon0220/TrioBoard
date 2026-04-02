<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use App\Enums\Role;

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

            RedirectIfAuthenticated::redirectUsing(function () {
        $user = Auth::user();

        return match ($user->role) {
            \App\Enums\Role::Admin => route('admin.dashboard'),
            \App\Enums\Role::Member => route('member.mypage'),
            \App\Enums\Role::Viewer => route('threads.index'),
            default => route('login'),
        };
    });

    })
    // ->withProviders([
    // App\Providers\FortifyServiceProvider::class, // ←★ これを追加
    // ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
