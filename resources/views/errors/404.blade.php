@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
        <img
            src="{{ asset('images/board-404.svg') }}"
            alt="404エラー表示"
            class="h-auto w-full"
            />
  </div>

  <h1 class="text-double-blue font-title text-center mb-[var(--s6)] font-medium text-xl">
    404 – ページが見つかりません
  </h1>
  <p class="mb-[var(--s5)] text-center font-body text-board-black font-normal text-base">
    URLが間違っているか、ページが移動した可能性があります。
    <br />
    お手数ですが、トップページから再度お探しください。
  </p>

    {{-- スレッド一覧に戻るボタン --}}
    <div class="flex justify-center mb-[var(--s4)]">
        <div class="min-w-[15ch] block  text-center btn btn-secondary">
            @if($isLoggedIn)
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
