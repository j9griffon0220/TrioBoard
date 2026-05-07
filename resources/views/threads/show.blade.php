@extends('layouts.board_base')

{{-- livewireのpost-listをコンポーネントとして使う --}}
@section('board_content')
  <h1 class="mb-[var(--s4)] text-center font-title text-2xl font-medium text-double-blue">
    「{{ $thread->title }}」スレッド
  </h1>

  {{-- 投稿用のlivewireコンポーネント --}}
  @can('create', \App\Models\Post::class)
    <livewire:post-form :thread="$thread" />
  @endcan

  {{-- livewireコンポーネントに $threadを渡す --}}
  <livewire:post-list :thread="$thread" />

  {{-- スレッド一覧に戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-end">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a href="{{ route('threads.index') }}">スレッド一覧に戻る</a>
    </div>
  </div>
@endsection
