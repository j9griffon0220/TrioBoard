@extends('layouts.board_base')
@section('board_content')
  <h1 class="text-double-blue font-title text-center mb-[var(--s4)] font-medium text-xl">新規スレッド作成</h1>

  <div class="text-board-black font-body border-1 p-[var(--s-1)] border-board-border mb-[var(--s4)] max-w-[80vw] border-l-5 border-l-board-blue">
    <form action="{{ route('threads.store') }}" method="POST">
    @csrf
    <label class="block font-body text-board-charcoal font-light text-base mb-[var(--s-4)]">
        タイトル：
    </label>

    <input type="text" name="title" value="{{ old('title') }}"
    required placeholder="スレッドのタイトルを入力してください"
    class="w-full border-2 border-gray-300 p-[var(--s-4)] mb-[var(--s1)] focus:outline-none focus:border-double-blue "
    />

    @error('title')
    <div>
        <p class="text-double-red font-body font-normal text-base mb-[var(--s-3)]">{{ $message }}</p>
    </div>
    @enderror

    <div class="flex justify-end">
        <div class="min-w-[15ch] mb-[var(--s-4)] btn btn-primary text-center">
            <button type="submit" class="font-title text-base">スレッド作成</button>
        </div>
    </div>
    </form>
  </div>


  {{-- スレッド一覧に戻るボタン --}}
  <div class="flex justify-end mb-[var(--s4)]">
    <div class="min-w-[15ch] block  text-center btn btn-secondary">
        <a href="{{ route('threads.index') }}" class="font-title text-base">一覧に戻る</a>
    </div>
  </div>
@endsection

{{-- min-w-[20vw] --}}
