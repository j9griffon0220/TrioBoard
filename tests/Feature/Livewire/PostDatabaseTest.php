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

// livewireのPost投稿のDBをテスト

// テストごとにDBを毎回リセット
use Illuminate\Foundation\Testing\RefreshDatabase;
pest()->use(RefreshDatabase::class);


// dataset を「フィールド名＋入力値」の組み合わせで定義
dataset('posts_title_error',[
    '必須タイトルエラー' => ['title', ''],
    'タイトル型エラー' => ['title', 123],
    'タイトル文字数エラー' => ['title', str_repeat('a',41)], // max:40
]);

dataset('posts_body_error', [
    '必須本文エラー' => ['body', ''],
    '本文型エラー' => ['body', 123],
    '本文文字数エラー' => ['body', str_repeat('a',401)], // max:400
]);


// 新規postをDBに保存できるかのテスト（バリデーションは別ファイル）
it('AdminのPost投稿がDBに保存される', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $user = User::factory()->create(['role' => Role::Admin]);
    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    ->assertHasNoErrors();

    // Livewire専用のDBチェックアサーションはない
    $this->assertDatabaseHas('posts', [
        'title' => 'これはテストタイトルです',
        'body' => 'これはテスト本文です',
        'user_id' => $user->id,
        'thread_id' => $thread->id,
    ]);
});


it('MemerのPost投稿がバリデーションエラーでDBに保存されない', function(){
    $user = User::factory()->create(['role' => Role::Member]);
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class, ['thread' => $thread])
    ->set('title', '')
    ->set('body', '')
    // set()に$inputをそのまま渡すのはドキュメントにない使い方＝保証されないので避ける
    ->call('store')
    // assertHasErrorsは検証したいキーを必ず指定
    ->assertHasErrors(['title', 'body']);

    // assertDatabaseMissing には「テーブル名」と「カラム => 値」の配列が必須
    $this->assertDatabaseMissing('posts',[
        'title' => '',
        'body' => '',
        'user_id' => $user->id,
        'thread_id' => $thread->id,
    ]);
});


// 自動で入る値や必須値のテスト（'user_id'、自動で入るcreated_atとupdated_at）
it('post保存時にuser_idとthread_idが自動設定・保存される', function(){
    $user = User::factory()->create(['role' => Role::Member]);
    $thread = Thread::factory()->create();

    // actingAs($user)を使うとstore()で$request->user()->idが自動的に入る
    Livewire::actingAs($user)
    ->test(PostForm::class, ['thread' => $thread])
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    ->assertHasNoErrors();

    // 本当にその ID が入っているか確認
    $this->assertDatabaseHas('posts',[
        'user_id' => $user->id,
        'thread_id' => $thread->id,
    ]);
});

it('post保存時にtimestampsで自動設定される', function(){
    $user = User::factory()->create(['role' => Role::Admin]);
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class, ['thread' => $thread])
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    ->assertHasNoErrors();

    // DBから保存されたスレッドを1件取得
    $thread = Thread::first();
    // Eloquentは保存時に自動でタイムスタンプを付ける
    // タイムスタンプは固定値で比較できない。nullじゃない = 自動設定されている
    // 期待する値をexpectでチェックする・->not()をつけると「値がnullではないこと」を期待する
    expect($thread->created_at)->not()->toBeNull();
    expect($thread->updated_at)->not()->toBeNull();
});
