<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
// use Laravel\Fortify\Contracts\LogoutResponse;

// resources/views/livewire/auth/login.blade.php の方で制御するのでこちらは一旦見合わせ

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // LoginResponseを登録（しないと適応されない）
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        // $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        // dd('register called');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // デバッグで記述
        // dd('FortifyServiceProvider boot called!');
        Fortify::twoFactorChallengeView(fn () => view('livewire.auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('livewire.auth.confirm-password'));

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
