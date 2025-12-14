@extends('layouts.board_base')

@section('board_content')
  <div class="mx-auto mt-[var(--s4)] max-w-[25vw]">
    <picture>
      <source
        srcset="
          {{ asset('images/error404@1x.webp') }} 1x,
          {{ asset('images/error404@2x.webp') }} 2x
        "
        type="image/webp"
      />
      {{-- フォールバック --}}
      <img src="{{ asset('images/error404.png') }}" alt="Trio Board Logo" class="h-auto w-full" />
    </picture>
  </div>

  <h1 class="mt-[var(--s4)] text-center font-title text-double-blue">
    404 – ページが見つかりません
  </h1>
  <p class="mt-[var(--s4)] text-center font-body text-board-black">
    URLが間違っているか、ページが移動した可能性があります。
    <br />
    お手数ですが、トップページから再度お探しください。
  </p>

  <div class="text-center">
    <a href="{{ route('login') }}" class="underline">ログインページへ</a>
  </div>
@endsection

{{--
  @extends('errors::minimal')
  
  @section('title', __('Not Found'))
  @section('code', '404')
  @section('message', __('Not Found'))
--}}
