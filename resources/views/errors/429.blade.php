@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset('images/board-429.svg') }}" alt="429エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    429 – アクセス過多（Too Many Requests）
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    アクセスが集中しています。
    <br />
    しばらく時間をおいてから、再度お試しください。
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
  
  @section('title', __('Too Many Requests'))
  @section('code', '429')
  @section('message', __('Too Many Requests'))
--}}
