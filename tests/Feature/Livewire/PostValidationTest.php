<?php

use App\Models\User;
use App\Models\Thread;
use App\Livewire\PostForm;
use Livewire\Livewire;

// it('renders successfully', function () {
//     Livewire::test(PostForm::class)
//         ->assertStatus(200);
// });

// livewireの新規投稿のバリデーションをテスト

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

dataset('pass_posts',[
    'タイトルが必須項目・型・文字数パス' => ['title', 'ポストのテストタイトルです'],
    '本文が必須項目・型・文字数パス' => ['body', 'ポストのテスト本文です'],
]);


// バリデーションエラーのテスト
// dataset の配列の並び順と、テスト関数の引数の並び順は必ず一致させる必要がある
it('post新規投稿のタイトルバリデーションエラー :dataset', function($field, $input){
    $user = User::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class)
    ->set('body', 'ポストのテスト本文です') //パスする値
    ->set($field, $input) // datasetのNG値
    ->call('store') //store() メソッドを直接呼び出す
    ->assertHasErrors($field);
})->with('posts_title_error');


it('post新規投稿の本文バリデーションエラー :dataset', function($field, $input){
    $user = User::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class)
    ->set('title', 'ポストのテストタイトルです') //パスする値
    ->set($field, $input) // datasetのNG値
    ->call('store') //store() メソッドを直接呼び出す
    ->assertHasErrors($field);
})->with('posts_body_error');


it('post新規投稿のバリデーションエラー時にDBに保存されない : dataset', function($field, $input){
    $user = User::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class)
    ->set('body', 'ポストのテスト本文です') //パスする値
    ->set($field, $input)
    ->call('store')
    ->assertHasErrors($field);
    // assertDatabaseMissing には「テーブル名」と「カラム => 値」の配列が必須
    $this->assertDatabaseMissing('posts',[
        'title' => $input,
        'body' => $input,
    ]);
})->with('posts_title_error');


// バリデーションが通る場合のテスト
it('新規投稿のバリデーションパス :dataset', function($field, $passinput){
    $user = User::factory()->create();

    Livewire::actingAs($user)
    ->test(PostForm::class)
    ->set($field, $passinput)
    ->call('store')
    // バリデーションエラーがない
    // Livewire のアサーションは Livewire::test() のチェーン で使う
    ->assertHasNoErrors($field);
})->with('pass_posts');

// バリデーションが通る場合の保存は別途投稿テストで行う
