<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Post;
use App\Models\User;
use App\Enums\Role;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PostList extends Component
{
    // class直下の記述がルール・使うと宣言
    use WithPagination;

    public Thread $thread;

    public function mount(Thread $thread)
    {
        // blade から渡されるThread（目印）を受け取る
        $this->thread = $thread;
    }

    public function render()
    {
        // DB のデータは render() で毎回取得
        return view('livewire.post-list',[
            'posts' => Post::where('thread_id', $this->thread->id)
            ->oldest()
            ->paginate(10),
        ]);
    }

    // 子のpost-formから送られたイベントを受け取る
    #[On('postAdded')]
    public function refresh($post)
    {
        // 投稿後の更新
        $this->resetPage();
        // 上記loadPosts()メソッドを実行
        // $this->loadPosts();
    }

}
