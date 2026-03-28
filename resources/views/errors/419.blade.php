@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-419.svg') }}" alt="419エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    419 – ページの有効期限が切れました（CSRF Token Mismatch）
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    長時間操作をされなかったか、フォームの送信が正しく完了しなかった可能性があります。
    <br />
    お手数ですが、再度ログインをお願いいたします。
  </p>

  {{-- ログイン画面に戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-center">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a href="{{ route('login') }}">ログイン画面へ</a>
    </div>
  </div>
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Page Expired'))
  @section('code', '419')
  @section('message', __('Page Expired'))
--}}
