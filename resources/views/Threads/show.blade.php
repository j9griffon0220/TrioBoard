@extends('layouts.board_base')

{{-- livewireのpost-listをコンポーネントとして使う --}}
@section('board_content')

{{-- livewireコンポーネントに $threadを渡す --}}
<livewire:post-list :thread="$thread" />

{{-- 投稿用のlivewireコンポーネント --}}
@can('create',\App\Models\Post::class)
<livewire:post-form :thread="$thread" />
@endcan

{{-- スレッド一覧に戻るボタン --}}
<button>
    <a href="{{ route('threads.index') }}">スレッド一覧に戻る</a>
</button>

@endsection
