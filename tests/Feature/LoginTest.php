<?php
use App\Models\User;
use App\Enums\Role;

// it('has login page', function () {
//     $response = $this->get('/login');

//     $response->assertStatus(200);
// });

// 自作のDadhboradのログインテスト

// laravelでは actingAs を使うと簡単にログイン状態のテストができる
// actingAs($user) を使うと「ログイン済みユーザー」になる

// adminダッシュボード('/admin/dashboard')についてのテスト
it('adminのみadminダッシュボードにログイン可能', function(){
    // 共通メソッドで admin（自分）作成
    $admin = $this->createRoleAdmin();
    // ログイン状態にする
    $response = $this->actingAs($admin)
    ->get('/admin/dashboard');
    $response->assertStatus(200);
});

it('member、viewerはadminダッシュボードにログイン不可', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);
    $response = $this->actingAs($user)->get('/admin/dashboard');
    $response->assertStatus($expected);
})->with([
    // 403 Forbidden（アクセス禁止）
    [Role::Member, 403],
    [Role::Viewer, 403],
]);

it('非登録者はadminダッシュボードにアクセスできない', function(){
    // 非登録者のテストでは $this->actingAs() を使わず、ログインしない状態で進める

    $response = $this->get('/admin/dashboard');
    $response ->assertRedirect('/login');
});


// memberのmypage・管理画面、('/member/mypage')のテスト
it('memberのみmypage（管理画面）にログイン可能', function(){
    $member = $this->createRoleMember();
    $response = $this->actingAs($member)
    ->get('/member/mypage');
    $response->assertStatus(200);
});

it('adminとviewerはmemberのmypage（管理画面）にログイン不可', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);
    $response = $this->actingAs($user)->get('/member/mypage');
    $response->assertStatus($expected);
})->with([
    [Role::Admin, 403],
    [Role::Viewer, 403],
]);


it('非登録者はmypage（管理画面）にアクセスできない', function(){
    $response = $this->get('/member/mypage');
    $response->assertRedirect('/login');
});
