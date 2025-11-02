<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Post;
use App\Models\User;
use App\Enums\Role;

class PostList extends Component
{
    public $posts = [];

    // blade から渡されるThread を受け取る
    public Thread $selectedthread;

    // public function mount($selectedthread)
    // {
    //     $this->selectedthread = $selectedthread;
    // }

    public function render()
    {
        $posts = $this->selectedthread->posts()->latest()->get();
        // デバッグ
        // dd($posts);
        // dd($this->selectedthread->posts()->count());
        return view('livewire.post-list', compact('posts'));
    }


    // 子のpost-formから送られたイベントを受け取る
    protected $listeners = ['postAdded' => 'refresh'];

}
