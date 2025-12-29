@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
        <img
            src="{{ asset('images/board-419.svg') }}"
            alt="419エラー表示"
            class="h-auto w-full"
            />
  </div>

  <h1 class="text-double-blue font-title text-center mb-[var(--s6)] font-medium text-xl">
    419 – ページの有効期限が切れました（CSRF Token Mismatch）
  </h1>
  <p class="mb-[var(--s5)] text-center font-body text-board-black font-normal text-base">
    長時間操作をされなかったか、フォームの送信が正しく完了しなかった可能性があります。
    <br />
    お手数ですが、再度ログインをお願いいたします。
  </p>

    {{-- ログイン画面に戻るボタン --}}
    <div class="flex justify-center mb-[var(--s4)]">
        <div class="min-w-[15ch] block  text-center btn btn-secondary">
            <a href="{{ route('login') }}">ログイン画面へ</a>
        </div>
    </div>
@endsection


{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}
