<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thread;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostForm extends Component
{
    // これで authorize() が使えるようになる
    use AuthorizesRequests;

    // public Thread $selectedthread;
    public Thread $thread;

    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }

    // public $posts = [];
    // public プロパティは UI の状態だけ
    public $postId = '';
    public $title = '';
    public $body = '';
    public $isEditing = false;

    public function render()
    {
        return view('livewire.post-form');
    }

    // コンポーネント単位のバリデーション設定
    protected $rules = [
        'title' => 'required|string|max:40',
        'body' => 'required|string|max:400',
    ];

    public function store()
    {
        // Policyで権限チェック（Threadを渡してコンテキストを与える）
        // 第2引数に配列で渡すと、最初の要素でポリシーが決定、残りが引数として渡される
        $this->authorize('create', Post::class);

        // バリデーションを実行
        $this->validate();

        // Postの投稿作成、選択中スレッドに投稿を紐付ける（リレーション経由で子モデルを作成）
        $post = $this->thread->posts()->create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        // 投稿イベントを親に知らせる
        $this->dispatch('postAdded', post: $post);

        // フォームを初期化
        $this->reset(['title','body']);
    }
}

