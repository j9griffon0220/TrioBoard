@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-401.svg') }}" alt="401エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    401 – ログイン認証が必要です
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    このページを表示するにはログインが必要です。
    <br />
    お手数ですが、ログインしてから再度お試しください。
  </p>

  {{-- ログイン画面へボタン --}}
  <div class="mb-[var(--s4)] flex justify-center">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a href="{{ route('login') }}">ログイン画面へ</a>
    </div>
  </div>
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Unauthorized'))
  @section('code', '401')
  @section('message', __('Unauthorized'))
--}}
