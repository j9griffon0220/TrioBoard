<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostForm extends Component
{
    // public $threadId = '';
    public $post;
    public $postId = '';
    public $title = '';
    public $body = '';
    public $isEditing = false;

    public function mount($threadId)
    {
        $this->threadId = $threadId;
    }

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
        $this->validate();

        Post::create([
            'thread_id' => $this->threadId,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        //フォームを初期化
        $this->reset(['title','body']);

        // 投稿イベントを親に知らせる
        // dispatch()とどちらが良いのか検討中
        $this->emitUp('postAdded', $post->id);
    }
}

