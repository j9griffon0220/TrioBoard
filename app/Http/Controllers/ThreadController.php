<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

use function Avifinfo\read;

// Threadのリソースコントローラー
// Postの部分はlivewireが担当

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     * 一覧
     */
    public function index()
    {
        //Threadモデルから最新順に5件ずつ取り出して、threads.indexビューに渡す
        $threads =Thread::latest()->paginate(5);
        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     * 新規スレッド作成フォーム
     */
    public function create()
    {
        //
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     * スレッドを保存
     */
    public function store(Request $request)
    {
        //スレッドのバリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:30',
        ]);
        // Thread::create($validated);
        $thread = Thread::create([
            'title' => $validated['title'],
        ]);
        return redirect()->route('threads.index')->with('success','スレッドを作成しました');
    }

    /**
     * Display the specified resource.
     * 詳細
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 編集フォーム
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 更新
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * 削除
     * スレッドは管理者のみが削除できるようにする予定
     */
    public function destroy(string $id)
    {
        //
    }
}
