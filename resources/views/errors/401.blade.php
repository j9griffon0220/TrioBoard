@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
        <img
            src="{{ asset('images/board-401.svg') }}"
            alt="401エラー表示"
            class="h-auto w-full"
            />
  </div>

  <h1 class="text-double-blue font-title text-center mb-[var(--s6)] font-medium text-xl">
    401 – ログイン認証が必要です
  </h1>
  <p class="mb-[var(--s5)] text-center font-body text-board-black font-normal text-base">
    このページを表示するにはログインが必要です。
    <br />
    お手数ですが、ログインしてから再度お試しください。
  </p>

    {{-- ログイン画面へボタン --}}
    <div class="flex justify-center mb-[var(--s4)]">
        <div class="min-w-[15ch] block  text-center btn btn-secondary">
            <a href="{{ route('login') }}">ログイン画面へ</a>
        </div>
    </div>
@endsection


{{-- @extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized')) --}}
