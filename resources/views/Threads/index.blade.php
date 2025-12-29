@extends('layouts.board_base')
@section('board_content')

<h1 class="text-double-blue font-title text-center mb-[var(--s4)] font-medium text-xl">スレッド一覧</h1>
@can('create',\App\Models\Thread::class)
<div class="flex justify-end">
    <div class="min-w-[15ch] text-center mb-[var(--s4)]">
    <a href="{{ route('threads.create') }}"
    class="block font-title text-center text-base btn btn-primary">スレッド作成</a>
    </div>
</div>
@endcan

@if(session('success'))
    <div>
        <p class="text-double-red font-body font-normal">{{ session('success') }}</p>
    </div>
@endif

{{-- スレッド表示 --}}
<ul>
    @forelse ($threads as $thread)
        <li class="text-board-black font-body font-normal text-base border-1 p-[var(--s-3)] border-board-border mb-[var(--s4)] max-w-[80vw] border-l-5 border-l-board-blue
        hover:shadow-xl transition-shadow bg-gray-50">
            <a href="{{ route('threads.show', $thread->id )}}">
                {{ $thread->title }}
            <span class="font-body text-board-charcoal font-light text-sm" title="{{ $thread->created_at->format('Y-m-d H:i')}}">
                （{{ $thread->created_at->diffForHumans() }}）
            </span>
            </a>
        </li>
    @empty
    <p class="text-board-black font-body font-normal text-base">まだスレッドがありません</p>
    @endforelse
</ul>

<div class="flex justify-end mb-[var(--s4)]">
    <div class="max-w-[15ch]">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline">
            <img
              src="{{ asset('images/board-logout.svg') }}"
              alt="logout"
              class="h-auto w-full"
            />
        </button>
        </form>
    </div>
</div>

@endsection



