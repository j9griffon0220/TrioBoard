@extends('layouts.board_base')

{{-- livewireのpost-listをコンポーネントとして使う --}}
@section('board_content')
  {{-- livewireコンポーネントに $threadを渡す --}}
  <livewire:post-list :thread="$thread" />

  {{-- 投稿用のlivewireコンポーネント --}}
  @can('create', \App\Models\Post::class)
    <livewire:post-form :thread="$thread" />
  @endcan

  {{-- スレッド一覧に戻るボタン --}}
  <div class="flex justify-end mb-[var(--s4)]">
    <div class="min-w-[15ch] block  text-center btn btn-secondary">
        <a href="{{ route('threads.index') }}">スレッド一覧に戻る</a>
    </div>
  </div>
@endsection
