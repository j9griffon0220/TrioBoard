<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Post;
use App\Models\User;
use App\Enums\Role;
use Livewire\Attributes\On;

class PostList extends Component
{
    // Livewireでは publicプロパティはリアクティブ変数
    public $posts = [];

    // blade から渡されるThread を受け取る
    public Thread $thread;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function render()
    {
        $this->posts = $this->thread->posts()->oldest()->get();
        // デバッグ
        // dd($posts);
        // dd($this->selectedthread->posts()->count());
        return view('livewire.post-list');
    }

    // 子のpost-formで投稿があったときに投稿一覧をロードするメソッド
    public function loadPosts()
    {
        // whereで条件指定、thread_idが今のスレッドIDと一致する投稿だけを絞り込む
        $this->posts = post::where('thread_id', $this->thread->id)
        ->oldest() // 投稿日時の古い順に並べる
        ->get();   // 実行して投稿一覧を取得する
    }

    // 子のpost-formから送られたイベントを受け取る
    #[On('postAdded')]
    public function refresh($post)
    {
        // 上記loadPosts()メソッドを実行
        $this->loadPosts();
    }

}
