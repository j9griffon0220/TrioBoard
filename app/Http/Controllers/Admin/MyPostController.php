<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// コントローラーはページ遷移だけ、データ取得・描画はlivewire

// class MyPostController extends Controller
// {
//     //adminが自分の投稿だけを取得して表示させる
//     public function myPosts(){

//         $posts = Post::where('user_id', Auth::id())
//         ->latest()
//         ->get();

//         // return view('admin.dashboard.posts');
//         return view('admin.dashboard', compact('posts'));
//     }
// }
