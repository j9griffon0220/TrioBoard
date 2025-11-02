@extends('layouts.board_base')
@section('board_content')

<h1>スレッド一覧</h1>
<a href="{{ route('threads.create') }}">スレッド新規作成</a>

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

@endsection
