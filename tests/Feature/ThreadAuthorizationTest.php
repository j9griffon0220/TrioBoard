<?php
use App\Models\User;
use App\Models\Thread;
use App\Enums\Role;

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });


// テストごとにDBを毎回リセット（保険）
use Illuminate\Foundation\Testing\RefreshDatabase;
pest()->use(RefreshDatabase::class);


// ページが閲覧できなくても、悪意を持って実行された場合を考慮しよう
// スレッドを作れない・保存（store）できない権限のテスト
// 未使用を反省して、TestCase.php の設定を活用

it('viewerはスレッドを保存できない', function(){
    $user = $this->createRoleViewer();
    $this->assertPostForbidden($user, route('threads.store'),[
        'title' => 'viewerが書いたタイトル'
    ]);
});


it('非登録者はスレッドを保存できない', function(){
    // 非登録者のテストでは $this->actingAs() を使わず、ログインしない状態で進める

    // 直接URLにPOST（保存）を試みる
    $response = $this->post(route('threads.store'),[
        'title' => '非登録者が書いたタイトル'
    ]);

    // 非登録者ならログイン画面にリダイレクトされるのを確認
    $response->assertRedirect('/login');
});
