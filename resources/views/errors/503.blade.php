@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-503.svg') }}" alt="503エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    503 – メンテナンス中（Service Unavailable）
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    サービスは現在、メンテナンスのため一時的にご利用いただけません。
    <br />
    ご不便をおかけして申し訳ありません。しばらく時間をおいてから、再度お試しください。
  </p>

  {{-- 503 は「全員アクセス不可」なので、戻り先ボタン自体を非表示 --}}
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Service Unavailable'))
  @section('code', '503')
  @section('message', __('Service Unavailable'))
--}}
