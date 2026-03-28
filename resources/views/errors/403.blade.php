@extends("layouts.board_base")

@section("board_content")
  <div class="mx-auto mb-[var(--s4)] max-w-[15ch]">
    <img src="{{ asset("images/board-403.svg") }}" alt="403エラー表示" class="h-auto w-full" />
  </div>

  <h1 class="mb-[var(--s6)] text-center font-title text-xl font-medium text-double-blue">
    403 – このページへのアクセス権がありません
  </h1>
  <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
    現在のアカウントでは、このページを表示することができません。
    <br />
    お手数ですが、下のボタンからお戻りください。
  </p>

  {{-- userのroleによってボタンを出し分ける --}}
  {{-- ログイン画面に戻るボタン --}}
  <div class="mb-[var(--s4)] flex justify-center">
    <div class="block min-w-[15ch] btn-secondary btn text-center">
      <a
        href="@if (auth()->user()?->role === \App\Enums\Role::Admin)
            {{ route("admin.dashboard") }}
        @elseif (auth()->user()?->role === \App\Enums\Role::Member)
            {{ route("member.mypage") }}
        @else
            {{ route("threads.index") }}
        @endif"
      >
        戻る
      </a>
    </div>
  </div>
@endsection

{{--
    @extends('errors::minimal')
    
    @section('title', __('Forbidden'))
    @section('code', '403')
    @section('message', __($exception->getMessage() ?: 'Forbidden'))
--}}
