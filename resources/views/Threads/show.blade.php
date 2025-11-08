@extends('layouts.board_base')

{{-- livewireのpost-listをコンポーネントとして使う --}}
@section('board_content')

{{-- livewireコンポーネントに $threadを渡す --}}
<livewire:post-list :thread="$thread" />

{{-- 投稿用のlivewireコンポーネント --}}
<livewire:post-form :thread="$thread" />

{{-- スレッド一覧に戻るボタン --}}
<button>
    <a href="{{ route('threads.index') }}">スレッド一覧に戻る</a>
</button>

@endsection
