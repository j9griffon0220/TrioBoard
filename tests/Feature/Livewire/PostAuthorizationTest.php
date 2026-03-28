<?php
use App\Models\User;
use App\Models\Thread;
use App\Livewire\PostForm;
use Livewire\Livewire;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });


// テストごとにDBを毎回リセット（保険）
use Illuminate\Foundation\Testing\RefreshDatabase;
pest()->use(RefreshDatabase::class);


// ページが閲覧できなくても、悪意を持って実行された場合を考慮
// ポスト（投稿）を作れない・保存（store）できない権限のテスト
// 未使用を反省して、TestCase.php の設定を活用

it('viewerはポストを保存できない', function(){
    // まずユーザーをTestCaseで作る
    $user = $this->createRoleViewer();

    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    ->assertHasNoErrors();

    $this->assertPostForbidden($user, route('threads.store'),[
        'title' => 'これはテストタイトルです',
        'body' => 'これはテスト本文です',
        'user_id' => $user->id,
        'thread_id' => $thread->id,
    ]);
});


it('非登録者はポストを保存できない', function(){
    // 非登録者のテストでは $this->actingAs() を使わず、ログインしない状態で進める

    // スレッドの作者が必要なのでMemberでつくる
    $author = $this->createRoleMember();

    // スレッド作者確定で必ず作る・PostはThreadに紐づく
    $thread = Thread::factory()->create(['user_id' => $author->id]);

    // ログインできないので直接URLにPOST（保存）を試みる
    Livewire::test(PostForm::class, ['thread' => $thread])
    ->set('title', 'テスト')
    ->set('body', 'テスト')
    ->call('store')
    // PostFormでauthorize()しているので権限ナシ拒否を確認
    ->assertForbidden();
    // ->assertStatus(403);

    // DBに変化なし
    $this->assertDatabaseCount('posts', 0);
});
