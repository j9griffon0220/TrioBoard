<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostForm extends Component
{
    public $title = '';
    public $body = '';
    public $isEditing = false;

    // コンポーネント単位でバリデーション
    protected $rules = [
        'title' => 'required|string|max:40',
        'body' => 'required|string|max:400',
    ];

    public function store()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        //フォームを初期化
        $this->reset();
    }

    // 投稿者のみが投稿を破棄可能にする
    public function destroy(){
        if(auth()->id() !== $this->post->user_id){
            abort(403, '許可されていません。投稿者本人のみ可能です');
        }
        $this->post->delete();
        session()->flash('success', '投稿を破棄しました');
    }
}

    // public function render()
    // {
    //     return view('livewire.post-form');
    // }
