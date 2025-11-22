<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Policies\ThreadPolicy;

use function Avifinfo\read;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Threadのリソースコントローラー
// Postの部分はlivewireが担当

class ThreadController extends Controller
{
    // これで authorize() が使えるようになる
    use AuthorizesRequests;

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
        // authorizeでThreadPolicyを適用する
        $this->authorize('create', Thread::class);
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

        $thread = Thread::create([
            'title' => $validated['title'],
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('threads.index')->with('success','スレッドを作成しました');
    }

    /**
     * Display the specified resource.
     * 個別のスレッド（1件）を表示
     */
    public function show(Thread $thread)
    {
        // スレッドIDに対応するThreadモデルを取得
        // $selectedthread = Thread::findOrFail($id);
        // dd($thread);
        return view('threads.show', compact('thread'));
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
