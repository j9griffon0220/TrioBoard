@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
        <img
            src="{{ asset('images/board-429.svg') }}"
            alt="429エラー表示"
            class="h-auto w-full"
            />
  </div>

  <h1 class="text-double-blue font-title text-center mb-[var(--s6)] font-medium text-xl">
    429 – アクセス過多（Too Many Requests）
  </h1>
  <p class="mb-[var(--s5)] text-center font-body text-board-black font-normal text-base">
    アクセスが集中しています。
    <br />
    しばらく時間をおいてから、再度お試しください。
  </p>

    {{-- トップページへ戻るボタン --}}
    <div class="flex justify-center mb-[var(--s4)]">
        <div class="min-w-[15ch] block  text-center btn btn-secondary">
            <a href="{{ route('home') }}" class="font-title text-base">トップページへ戻る</a>
        </div>
    </div>
@endsection

{{-- @extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests')) --}}
