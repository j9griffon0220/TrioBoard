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


// datasetの使用を見合わせ
// dataset を「フィールド名＋入力値」の組み合わせで定義
// dataset('posts_title_error',[
//     '必須タイトルエラー' => ['title', ''],
//     'タイトル型エラー' => ['title', 123],
//     'タイトル文字数エラー' => ['title', str_repeat('a',41)], // max:40
// ]);

// dataset('posts_body_error', [
//     '必須本文エラー' => ['body', ''],
//     '本文型エラー' => ['body', 123],
//     '本文文字数エラー' => ['body', str_repeat('a',401)], // max:400
// ]);


// 新規postをDBに保存できるかのテスト（バリデーションは別ファイル）
it('MemberのPost投稿がDBに保存される', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $Member = $this -> createRoleMember();

    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    // TestCaseから「テスト用基本データ」を取得
    // thread_id を今作った $thread の ID で上書きする
    $data = $this -> validPostData();

    // Livewireテストを実行
    Livewire::actingAs($Member)
    ->test(PostForm::class, ['thread' => $thread]) // コンポーネントにスレッドを渡す
    ->fill($data) // まとめてセット
    ->call('store') // 保存実行
    ->assertHasNoErrors();
});


it('AdminのPost投稿がバリデーションエラーでDBに保存されない', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $Admin = $this -> createRoleAdmin();

    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($Admin)
    ->test(PostForm::class, ['thread' => $thread])
    ->set('title', '')
    ->set('body', '')
    // set()に$inputをそのまま渡すのはドキュメントにない使い方＝保証されないので避ける
    ->call('store')
    ->assertDatabeseCount('posts', 0);
    // assertHasErrorsは検証したいキーを必ず指定
    // ->assertHasErrors(['title', 'body']);
});


// 自動で入る値や必須値のテスト（'user_id'、自動で入るcreated_atとupdated_at）
it('post保存時にuser_idとthread_idが自動設定・保存される', function(){
    $user = $this -> createRoleMember();
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
    $Admin = $this -> createRoleAdmin();
    $thread = Thread::factory()->create();

    Livewire::actingAs($Admin)
    ->test(PostForm::class, ['thread' => $thread])
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    ->assertHasNoErrors();

    // DBから保存されたスレッドを1件取得
    $post = Post::first();
    // Eloquentは保存時に自動でタイムスタンプを付ける
    // タイムスタンプは固定値で比較できない。nullじゃない = 自動設定されている
    // 期待する値をexpectでチェックする・->not()をつけると「値がnullではないこと」を期待する
    expect($post->created_at)->not()->toBeNull();
    expect($post->updated_at)->not()->toBeNull();
});
