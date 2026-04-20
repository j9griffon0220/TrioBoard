@extends('layouts.board_base')
@section('board_content')
  <h1 class="mb-[var(--s4)] text-center font-title text-xl font-medium text-double-blue">
    新規スレッド作成
  </h1>

  <div
    class="font-body mb-[var(--s4)] max-w-[80vw] border-1 border-l-5 border-board-border border-l-board-blue p-[var(--s-1)] text-board-black"
  >
    <form action="{{ route('threads.store') }}" method="POST">
      @csrf
      <label class="font-body mb-[var(--s-4)] block text-base font-light text-board-charcoal">
        タイトル：
      </label>

      <input
        type="text"
        name="title"
        value="{{ old('title') }}"
        required
        placeholder="スレッドのタイトルを入力してください"
        class="mb-[var(--s1)] w-full border-2 border-gray-300 p-[var(--s-4)] focus:border-double-blue focus:outline-none"
      />

      @error('title')
        <div>
          <p class="font-body mb-[var(--s-3)] text-base font-normal text-double-red">
            {{ $message }}
          </p>
        </div>
      @enderror

      <div class="flex justify-end">
        <div class="mb-[var(--s-4)] min-w-[15ch] btn-primary btn text-center">
          <button type="submit" class="font-title text-base">スレッド作成</button>
        </div>
      </div>
    </form>
  </div>

  {{-- スレッド一覧に戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-end">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a href="{{ route('threads.index') }}" class="font-title text-base">一覧に戻る</a>
    </div>
  </div>
@endsection

{{-- min-w-[20vw] --}}
