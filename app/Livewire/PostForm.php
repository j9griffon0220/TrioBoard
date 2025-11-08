<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Post;

class PostForm extends Component
{
    // public Thread $selectedthread;
    public Thread $thread;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    public $posts = [];
    public $postId = '';
    public $title = '';
    public $body = '';
    public $isEditing = false;

    public function render()
    {
        return view('livewire.post-form');
    }

    // コンポーネント単位でバリデーション
    protected $rules = [
        'title' => 'required|string|max:40',
        'body' => 'required|string|max:400',
    ];

    public function store()
    {
        // バリデーションを実行
        $this->validate();

        // 選択中スレッドに投稿を紐付ける（リレーション経由で子モデルを作成）
        $post = $this->thread->posts()->create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        // 投稿イベントを親に知らせる
        $this->dispatch('postAdded', post: $post);

        //フォームを初期化
        $this->reset(['title','body']);
    }
}

