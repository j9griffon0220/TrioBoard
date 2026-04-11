<?php

use App\Models\User;
use App\Models\Thread;
use App\Models\Post;
use App\Livewire\PostForm;
use Livewire\Livewire;
use App\Enums\Role;

// it('renders successfully', function () {
//     Livewire::test(PostForm::class)
//         ->assertStatus(200);
// });

// livewireの新規投稿のバリデーションをテスト
// テストごとにDBを毎回リセット
use Illuminate\Foundation\Testing\RefreshDatabase;
pest()->use(RefreshDatabase::class);


// バリデーションエラーのテスト
it('post新規投稿のタイトルバリデーションエラー', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $Admin = $this -> createRoleAdmin();
    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($Admin)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    ->set('title', '') // タイトルのNG値
    ->set('body', 'ポストのテスト本文です') //パスする値
    ->call('store') //store() メソッドを直接呼び出す
    ->assertHasErrors('title');

    // Livewireの世界とPHPUnitの世界は別、とのこと。DB系アサーションは必ず $this->
    $this->assertDatabaseCount('posts', 0);
});


it('post新規投稿の本文バリデーションエラー', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $Member = $this -> createRoleMember();
    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($Member)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    ->set('title', 'ポストのテストタイトルです') //パスする値
    ->set('body', '') //本文のNG値
    ->call('store') //store() メソッドを直接呼び出す
    ->assertHasErrors('body');

    // Livewireの世界とPHPUnitの世界は別、とのこと。DB系アサーションは必ず $this->
    $this->assertDatabaseCount('posts', 0);
});


it('post新規投稿のバリデーションエラー時にDBに保存されない', function(){
    $Admin = $this -> createRoleAdmin();
    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($Admin)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    ->set('title', '') // タイトルのNG値
    ->set('body', '') // 本文NG値
    ->call('store')
    ->assertHasErrors(['title','body']);

    $this->assertDatabaseCount('posts', 0);
});


// バリデーションが通る場合のテスト・datasetは使わない
it('新規投稿のバリデーションがパスする', function(){
    // PostFormはPolicyで権限チェックしているのでrole必須
    $Member = $this -> createRoleMember();
    // PostはThreadに紐づくので必ず作る
    $thread = Thread::factory()->create();

    Livewire::actingAs($Member)
    ->test(PostForm::class, ['thread' => $thread]) //threadを渡す
    // ->set() は基本的に 「プロパティ名」「値」 の2引数で使う
    ->set('title', 'これはテストタイトルです')
    ->set('body', 'これはテスト本文です')
    ->call('store')
    // バリデーションエラーがない
    // Livewire のアサーションは Livewire::test() のチェーン で使う
    ->assertHasNoErrors();

    // DBに１件だけ保存されていることを（念のため）確認
    $this -> assertDatabaseCount('posts', 1);
});

// バリデーションが通る場合の保存は別途投稿テストで行う
