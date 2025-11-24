<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

// Post（投稿）ページのテスト
it('admin、member、viewerはポスト一覧ページにアクセス可能', function($role, $expected){
    $user = User::factory()->create(['role' => $role]);

    // テスト用データを生成
    $thread = Thread::factory()->create();
    $response = $this->actingAs($user)->get(route('threads.show', $thread->id));
    $response->assertStatus($expected);
})->with([
    [Role::Admin, 200],
    [Role::Member, 200],
    [Role::Viewer, 200],
]);

it('非登録者は投稿ページにアクセスできない', function(){
    // テスト用スレッドデータを生成
    $thread = Thread::factory()->create();
    $response = $this->get(route('threads.show', $thread->id));
    $response ->assertRedirect('/login');
});

// 投稿フォームの表示のテスト
it('権限のあるadmin、memberは投稿フォームが表示される', function($role){
    $user = User::factory()->create(['role' => $role]);
    $thread = Thread::factory()->create();

    $response = $this->actingAs($user)->get(route('threads.show', $thread->id));
    $response->assertSeeLivewire('post-form');
})->with([
    Role::Admin,
    Role::Member,
]);

it('viewerには投稿フォームが表示されない', function(){
    $thread = Thread::factory()->create();
    $response = $this->get(route('threads.show', $thread->id));
    // Livewireコンポーネントが出てこないことを確認
    $response->assertDontSee('livewire:post-form');
});
