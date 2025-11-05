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
    public $posts = [];

    // blade から渡されるThread を受け取る
    public Thread $thread;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function render()
    {
        $this->posts = $this->thread->posts()->latest()->get();
        // デバッグ
        // dd($posts);
        // dd($this->selectedthread->posts()->count());
        return view('livewire.post-list');
    }

    // 子のpost-formから送られたイベントを受け取る
    #[On('postAdded')]
    public function refresh($post)
    {
        $this->loadPosts();
    }
    // protected $listeners = ['postAdded' => 'refresh'];

}
