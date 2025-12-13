@extends('layouts.board_base')
@section('board_content')

<h1 class="text-double-blue font-title text-center mt-[var(--s4)]">スレッド一覧</h1>
@can('create',\App\Models\Thread::class)
<div class="flex justify-end">
    <div class="max-w-[20vw] border-2 p-[var(--s-3)] rounded-2xl border-double-blue text-center">
    <a href="{{ route('threads.create') }}"
    class="block text-double-blue font-title text-center">スレッド新規作成</a>
    </div>
</div>
@endcan

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

{{-- スレッド表示 --}}
<ul>
    @forelse ($threads as $thread)
        <li class="text-board-black font-body border-2 p-[var(--s-4)] border-board-blue mt-[var(--s1)] max-w-[80vw]">
            <a href="{{ route('threads.show', $thread->id )}}">
                {{ $thread->title }}
            <span class="font-body text-board-charcoal" title="{{ $thread->created_at->format('Y-m-d H:i')}}">
                {{ $thread->created_at->diffForHumans() }}
            </span>
            </a>
        </li>
    @empty
    <p class="text-board-black font-body">まだスレッドがありません</p>
    @endforelse
</ul>

<div class="flex justify-end">
    <div class="max-w-[20vw] mt-[var(--s4)] block border-2 p-[var(--s-3)] rounded-2xl border-double-blue shadow-md block">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            <picture>
            <source
            srcset="{{ asset('images/board-logout@1x.webp') }} 1x,{{ asset('images/board-logout@2x.webp') }} 2x"
            type="image/webp">
            {{-- フォールバック --}}
            <img src="{{ asset('images/board-logout.png') }}" alt="Logout" class="w-full h-auto">
            </picture>
        </button>
        </form>
    </div>
</div>

@endsection
