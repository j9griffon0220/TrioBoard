<?php
use App\Models\User;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

// スレッド新規作成におけるバリデーションのテスト

// datasetを定義してwith('名前')で使う
dataset('invalid_titles',[
    '必須項目エラー' => ['', 'title'],
    '型エラー' => [123, 'title'],
    '文字数エラー' => [str_repeat('a',31), 'title'],
]);

dataset('pass_titles',[
    '必須項目・型・文字数パス' => ['スレッドのテストタイトルです', 'title'],
]);

// バリデーションエラーのテスト
it('スレッドのタイトルのバリデーションエラー :dataset', function($input, $errorKey){
    $user = User::factory()->create(['role' => Role::Admin]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => $input,
    ]);
    $response->assertSessionHasErrors($errorKey);
})->with('invalid_titles');


it('スレッドタイトルのバリデーションエラー時にDBに保存されない :dataset', function($input, $errorKey){
    $user = User::factory()->create(['role' => Role::Member]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => $input,
    ]);
    // assertDatabaseMissing には「テーブル名」と「カラム => 値」の配列が必須
    $this->assertDatabaseMissing('threads', [
        'title' => $input,
    ]);
})->with('invalid_titles');


// バリデーションが通る場合のテスト
it('スレッドのタイトルがバリデーションを通る :dataset', function($input, $passKey){
    $user = User::factory()->create(['role' => Role::Member]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => $input,
    ]);
    // バリデーションエラーがない
    $response->assertSessionHasNoErrors($passKey);
})->with('pass_titles');

// バリデーションが通る場合の保存は別途投稿テストで行う
