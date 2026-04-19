<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Actions\Fortify\LoginResponse;
use Illuminate\Support\Facades\URL;

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
        // 「これ使いますよ」と登録「だけ」
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 全ての準備が完了した後に実行される（実際に動かす）
        if(app()->environment('production')){
            URL::forceScheme('https');
        }
    }
}
