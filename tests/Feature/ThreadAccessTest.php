<?php
use App\Models\User;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

// 自作のThreadページのテスト
// pestの ->with() を使ったデータ駆動テスト
it('ユーザーroleごとのアクセス制御', function(){
    // ユーザー作成〜ログイン処理
    $response = $this->actingAs(User::factory()->create['role'=>$role])
    ->get('/threads');
    $response->
});

// it('adminはスレッド新規作成ページにアクセス可能', function(){
//     $admin = $this->createAdmin();
//     $response = $this->actingAs($admin)
//     ->get('');
// });

// it('adminはスレッド新規作成ページにアクセス可能', function(){
//     // admin（自分）を固定で作る
//     $admin = User::factory()->create([
//     'name' => 'j9griffon',
//     'email' => 'j9griffon0220@gmail.com',
//     'role' => Role::Admin, //Enumをそのまま代入なので''不要
//     'two_factor_secret' => null,
//     'two_factor_recovery_codes' => null,
//     ]);
//     $response = $this->actingAs($admin)
//     ->get('/threads/create');
//     $response->assertStatus(200);
// });

it('未ログインの方はスレッド新規作成ページにアクセスできない', function(){
    $response = $this->get('threads/create');
    $response->assertRedirect('/login');
});
