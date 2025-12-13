@extends('layouts.board_base')

@section('board_content')
<div class="max-w-[25vw] mx-auto mt-[var(--s4)]">
    <picture>
        <source
        srcset="{{ asset('images/error404@1x.webp') }} 1x,
        {{ asset('images/error404@2x.webp') }} 2x"
        type="image/webp">
        {{-- フォールバック --}}
        <img src="{{ asset('images/error404.png') }}" alt="Trio Board Logo" class="w-full h-auto">
    </picture>
</div>

<h1 class="text-double-blue font-title text-center mt-[var(--s4)]">404 – ページが見つかりません</h1>
<p class="text-board-black font-body text-center mt-[var(--s4)]">
    URLが間違っているか、ページが移動した可能性があります。
    <br>お手数ですが、トップページから再度お探しください。</p>

    <div class="text-center">
        <a href="{{ route('login') }}" class="underline">ログインページへ</a>
    </div>
@endsection

{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}
