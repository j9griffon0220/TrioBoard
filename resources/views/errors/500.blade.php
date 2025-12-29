@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
        <img
            src="{{ asset('images/board-500.svg') }}"
            alt="500エラー表示"
            class="h-auto w-full"
            />
  </div>

  <h1 class="text-double-blue font-title text-center mb-[var(--s6)] font-medium text-xl">
    500 – サーバーエラー
  </h1>
  <p class="mb-[var(--s5)] text-center font-body text-board-black font-normal text-base">
    サーバーエラーが発生しました。ご不便をおかけして申し訳ありません。
    <br />
    復旧までしばらくお待ちいただければ幸いです。
  </p>

    {{-- トップページへ戻るボタン --}}
    <div class="flex justify-center mb-[var(--s4)]">
        <div class="min-w-[15ch] block  text-center btn btn-secondary">
            <a href="{{ route('home') }}" class="font-title text-base">トップページへ戻る</a>
        </div>
    </div>
@endsection


{{-- @extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error')) --}}
