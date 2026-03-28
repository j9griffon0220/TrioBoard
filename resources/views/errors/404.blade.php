@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-404.svg') }}" alt="404エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    404 – ページが見つかりません
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    URLが間違っているか、ページが移動した可能性があります。
    <br />
    お手数ですが、トップページから再度お探しください。
  </p>

  {{-- スレッド一覧に戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-center">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      @if ($isLoggedIn)
        <a href="{{ route('threads.index') }}" class="font-title text-base">スレッド一覧に戻る</a>
      @else
        <a href="{{ route('login') }}">ログイン画面へ</a>
      @endif
    </div>
  </div>
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Not Found'))
  @section('code', '404')
  @section('message', __('Not Found'))
--}}
