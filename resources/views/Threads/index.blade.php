@extends('layouts.board_base')
@section('board_content')

<h1 class="text-3xl font-bold underline">スレッド一覧</h1>
@can('create',\App\Models\Thread::class)
<a href="{{ route('threads.create') }}">スレッド新規作成</a>
@endcan

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

{{-- スレッド表示 --}}
<ul>
    @forelse ($threads as $thread)
        <li>
            <a href="{{ route('threads.show', $thread->id )}}">
                {{$thread->title}}
            </a>
        </li>
    @empty
    <p>まだスレッドがありません</p>
    @endforelse
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">
        ログアウト
    </button>
</form>

@endsection
