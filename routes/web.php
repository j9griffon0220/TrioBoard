<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Member\Mypage;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
use App\Http\Controllers\ThreadController;
use App\Livewire\PostList;
use App\Livewire\PostForm;
use App\Enums\Role;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
    // return view('welcome');
})->name('home');

// デバッグ
// dd(app(Laravel\Fortify\Contracts\LoginResponse::class));

// starter kitのdashboardルート
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';

// adminの管理画面
// Route::middleware(['auth'])->group(function(){
//     Route::get('/admin/dashboard', Dashboard::class)
//     ->middleware('is_admin')
//     ->name('admin.dashboard');
// });

// adminのルーティングまとめ
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        // adminの管理画面
        Route::get('/admin/dashboard', Dashboard::class)->name('dashboard');
        // 自分の投稿のみを表示
        Route::get('/dashboard/posts', [MyPostController::class, 'myPosts'])->name('dashboard.posts');
    });


// memberのルーティングまとめ
Route::middleware(['auth', 'is_member'])
    ->prefix('member')
    ->name('member.')
    ->group(function(){
        // memberのmypage（管理画面）
        Route::get('/member/mypage', Mypage::class)->name('mypage');
        // 自分の投稿のみを表示
        Route::get('/member/mypage/posts', [MyPostController::class, 'myPosts'])->name('mypage.posts');
    });

// memberのmypage（管理画面）
// Route::middleware(['auth'])->group(function(){
//     Route::get('/member/mypage', Mypage::class)
//     ->middleware('is_member')
//     ->name('member.mypage');
// });

// 自分の投稿のみを表示（admin用）
// Route::middleware(['auth','role:admin'])->group(function(){
//     Route::get('/admin/dashboard/posts', [MyPostController::class, 'myPosts'])
//     ->name('admin.dashboard.posts');
// });

// 自分の投稿のみを表示（member用）
// Route::middleware(['auth','role:member'])->group(function(){
//     Route::get('/member/mypage/posts', [MyPostController::class, 'myPosts'])
//     ->name('member.mypage.posts');
// });

// Threadのリソースルート
Route::middleware(['auth'])->group(function(){
    Route::resource('/threads', ThreadController::class);
});

// livewireはコンポーネントとして部品扱いするので、ルーティングで直接読み込まない

// 404ページの「戻る」ボタン調整用・@authではNGのため
Route::fallback(function(){
    return view('errors.404', [
        'isLoggedIn' => Auth::check(),
    ]);
});
