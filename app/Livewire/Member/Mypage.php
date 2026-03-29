<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
// PostモデルとAuthを忘れずにインポート！！！

class Mypage extends Component
{
    public function render(){
        // 1.livewireでデータ取得・描画
        $posts = Post::where('user_id', Auth::id())
        ->with('thread')
        ->latest()
        ->paginate(10);

        // 2.データをビューに渡す
        return view('livewire.member.mypage',[
            'posts' => $posts
        ])
        // ->layoutでLivewire のレイアウト指定
        // adminと同じlayoutのbladeファイルを使用している
        ->layout('components.layouts.admin-layout');
    }
}
