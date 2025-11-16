<?php
use App\Models\User;
use App\Enums\Role;

// it('has login page', function () {
//     $response = $this->get('/login');

//     $response->assertStatus(200);
// });

// 自作のDadhboradのログインテスト
// laravelでは actingAs を使うと簡単にログイン状態のテストができる
it('adminのみ管理画面にログイン可能', function () {
    // モデルファクトリーでユーザーを作成
    // admin（自分）を固定で作る
    $user = User::factory()->create([
        'name' => 'j9griffon',
        'email' => 'j9griffon0220@gmail.com',
        'role' => Role::Admin, //Enumをそのまま代入なので''不要
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
    ]);
    // ログイン状態にする
    $response = $this->actingAs($user)
    ->get('/admin/dashboard');
    $response->assertStatus(200);
});


it('memberのみmypage（管理画面）にログイン可能', function () {
    $member = User::factory()->create([
        'name' => 'member01',
        'email' => 'member01@gmail.com',
        'role' => Role::Member,
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
    ]);
    $response = $this->actingAs($member)
    ->get('/member/mypage');
    $response->assertStatus(200);
});


it('未ログインの方はmypage（管理画面）にアクセスできない', function () {
    $response = $this->get('/member/mypage');
    $response->assertRedirect('/login');
});
