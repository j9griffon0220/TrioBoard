<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Thread;
use App\Policies\ThreadPolicy;
use App\Models\Post;
use App\Policies\PostPolicy;

// Threadのポリシーを登録
// Postのポリシーを登録
// viewerは閲覧のみ

class AuthServiceProvider extends ServiceProvider
{
    // policyを登録する
    protected $policies = [
    Thread::class => ThreadPolicy::class,
    Post::class => PostPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // これを呼ばないとポリシー登録が反映されない
        $this->registerPolicies();
    }
}
