<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Actions\Fortify\LoginResponse;

// use Filament\Http\Responses\Auth\Contracts\LoginResponse as FilamentLoginResponseContract;
// use App\Http\Responses\FilamentLoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // LoginResponseを登録（しないと適応されない）
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        // $this->app->bind(
        // FilamentLoginResponseContract::class,
        // FilamentLoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
