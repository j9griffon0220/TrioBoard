@extends('layouts.board_base')
@section('board_content')
  <h1 class="mb-[var(--s4)] text-center font-title text-xl font-medium text-double-blue">
    スレッド一覧
  </h1>
  @can('create', \App\Models\Thread::class)
    <div class="flex justify-end">
      <div class="mb-[var(--s4)] min-w-[15ch] text-center">
        <a
          href="{{ route('threads.create') }}"
          class="block btn-primary btn text-center font-title text-base"
        >
          スレッド作成
        </a>
      </div>
    </div>
  @endcan

  @if (session('success'))
    <div>
      <p class="font-body font-normal text-double-red">{{ session('success') }}</p>
    </div>
  @endif

  {{-- スレッド表示 --}}
  <ul>
    @forelse ($threads as $thread)
      <li
        class="font-body mb-[var(--s4)] max-w-[80vw] border-1 border-l-5 border-board-border border-l-board-blue bg-gray-50 p-[var(--s-3)] text-base font-normal text-board-black transition-shadow hover:shadow-xl"
      >
        <a href="{{ route('threads.show', $thread->id) }}">
          {{ $thread->title }}
          <span
            class="font-body text-sm font-light text-board-charcoal"
            title="{{ $thread->created_at->format('Y-m-d H:i') }}"
          >
            （{{ $thread->created_at->diffForHumans() }}）
          </span>
        </a>
      </li>
    @empty
      <p class="font-body text-base font-normal text-board-black">まだスレッドがありません</p>
    @endforelse
  </ul>

  {{-- ページネーションリンクの表示 --}}
  <div class="mb-[var(--s4)]">
    {{ $threads->links() }}
  </div>

  <div class="mb-[var(--s4)] flex justify-end">
    <div class="max-w-[15ch]">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-outline btn">
          <img src="{{ asset('images/board-logout.svg') }}" alt="logout" class="h-auto w-full" />
        </button>
      </form>
    </div>
  </div>
@endsection
