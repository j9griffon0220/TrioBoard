@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-500.svg') }}" alt="500エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    500 – サーバーエラー
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    サーバーエラーが発生しました。ご不便をおかけして申し訳ありません。
    <br />
    復旧までしばらくお待ちいただければ幸いです。
  </p>

  {{-- トップページへ戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-center">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a href="{{ route('home') }}" class="font-title text-base">トップページへ戻る</a>
    </div>
  </div>
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Server Error'))
  @section('code', '500')
  @section('message', __('Server Error'))
--}}
