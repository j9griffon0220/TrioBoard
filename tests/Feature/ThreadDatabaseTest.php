<?php
use App\Models\User;
use App\Models\Thread;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });


// テストごとにDBを毎回リセット
use Illuminate\Foundation\Testing\RefreshDatabase;
pest()->use(RefreshDatabase::class);

// datasetを定義してwith('名前')で使う
dataset('invalid_titles',[
    '必須項目エラー' => ['', 'title'],
    '型エラー' => [123, 'title'],
    '文字数エラー' => [str_repeat('a',31), 'title'],
]);

dataset('pass_titles',[
    '必須項目・型・文字数パス' => ['スレッドのテストタイトルです', 'title'],
]);


// 新規ThreadをDBに保存できるかのテスト（バリデーションは別ファイル）
it('スレッドの新規投稿がDBに保存される :dataset', function($input, $passKey){
    // ユーザーを作る
    $user = User::factory()->create(['role' => Role::Admin]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => $input,
    ]);
    // バリデーションエラーがない
    $response->assertSessionHasNoErrors($passKey);
    // 投稿が保存されているか確認・保存対象のテーブル名を直接指定
    $this->assertDatabaseHas('threads',[
        'title' => $input,
    ]);
})->with('pass_titles');


it('スレッドの新規投稿がエラー入力でDBに保存されない :dataset', function($input, $errorKey){
    $user = User::factory()->create(['role' => Role::Member]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => $input,
    ]);
    $response->assertSessionHasErrors($errorKey);
    $this->assertDatabaseMissing('threads',[
        'title' => $input,
    ]);
})->with('invalid_titles');


// 自動で入る値や必須値のテスト（'user_id'、自動で入るcreated_atとupdated_at）
it('スレッド保存時にuser_idが自動設定・保存される', function(){
    $user = User::factory()->create(['role' => Role::Admin]);
    // actingAs($user)を使うとstore()で$request->user()->idが自動的に入る
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => 'これはスレッドのテストタイトルです',
    ]);
    $response->assertSessionHasNoErrors();

    // 本当にその ID が入っているか確認
    $this->assertDatabaseHas('threads',[
        'user_id' => $user->id,
    ]);
});

it('スレッド保存時にtimestampsで自動設定される', function(){
    $user = User::factory()->create(['role' => Role::Member]);
    $response = $this->actingAs($user)->post(route('threads.store'),[
        'title' => 'これはスレッドのテストタイトルです',
    ]);
    $response->assertSessionHasNoErrors();

    // DBから保存されたスレッドを1件取得
    $thread = Thread::first();
    // Eloquentは保存時に自動でタイムスタンプを付ける・nullじゃない = 自動設定されている
    expect($thread->created_at)->not()->toBeNull();
    expect($thread->updated_at)->not()->toBeNull();
});
