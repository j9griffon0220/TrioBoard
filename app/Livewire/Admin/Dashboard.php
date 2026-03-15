<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
// PostモデルとAuthを忘れずにインポート！！！

class Dashboard extends Component
{
    public function render()
    {
        // 1.livewireでデータ取得・描画
        $posts = Post::where('user_id', Auth::id())
        ->with('thread')
        ->latest()
        ->paginate(10);

        // 2.データをビューに渡す
        return view('livewire.admin.dashboard',[
            'posts' => $posts
        ])
        ->layout('components.layouts.admin-layout');

        // return view('livewire.admin.dashboard',[
        //     'posts' => Post::whrere('user_id', Auth::id()->get)
        // ]);

        // return view('livewire.admin.dashboard')
        // ->layout('components.layouts.admin-layout');
    }
}
