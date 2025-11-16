<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

it('未ログインの方は新規投稿画面にアクセスできない', function(){
        // テスト用スレッドデータを生成
    $thread = Thread::factory()->create();
    $response = $this->get("/threads/{$thread->id}");
    $response = $this->get();
});
