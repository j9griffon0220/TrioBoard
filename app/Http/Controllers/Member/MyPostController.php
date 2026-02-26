<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPostController extends Controller
{
    //memberが自分の投稿だけを取得して表示させる
    public function myPosts(){
        $posts =Post::where('user_id', Auth::id())
        ->latest()
        ->get();

        return view('member.mypage', compact('posts'));
    }
}
