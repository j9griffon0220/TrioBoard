<?php
use App\Models\User;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

// 自作のThreadページのテスト

// pestの ->with() を使ったデータ駆動テスト
// スレッド一覧（'/threads'）についてのテスト
it('admin、member、viewerはスレッド一覧ページにアクセス可能', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);
    $response = $this->actingAs($user)->get('/threads');
    $response->assertStatus($expected);
})->with([
    [Role::Admin, 200],
    [Role::Member, 200],
    [Role::Viewer, 200],
]);

it('非登録者はスレッド一覧ページにアクセスできない', function(){
    $this->get('/threads')
    ->assertRedirect('/login');
});


// スレッド新規作成ページについてのテスト
it('admin、memberは新規スレッド作成ページにアクセス可能', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);
    $response = $this->actingAs($user)->get('/threads/create');
    $response->assertStatus($expected);
})->with([
    [Role::Admin, 200],
    [Role::Member, 200],
]);

it('viewerは新規スレッド作成ページにアクセスできない', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);
    $response = $this->actingAs($user)->get('/threads/create');
    $response->assertStatus($expected);
    // 403 Forbidden（アクセス禁止）
})->with([
    [Role::Viewer, 403]
]);


it('非登録者はスレッド新規作成ページにアクセスできない', function(){
    $response = $this->get('threads/create');
    $response->assertRedirect('/login');
});
