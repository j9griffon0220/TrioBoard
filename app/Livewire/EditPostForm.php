<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

// 投稿されたpostを編集するためのコンポーネント

class EditPostForm extends Component
{
    public $post;
    public $postId = '';
    public $title = '';
    public $body = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.edit-post-form');
    }

    // 投稿者のみが投稿を破棄可能にする
    // 対象の Post を引数で受け取る
    public function destroy(Post $post){
        if(auth()->id() !== $post->post->user_id){
            abort(403, '許可されていません。投稿者本人のみ可能です');
        }
        $post->delete();
        session()->flash('success', '投稿を破棄しました');
    }
}
