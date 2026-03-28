<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Trio Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  {{-- 開発環境だけでデバッグ用クラスを出すようbodyタグで調整 --}}
  <body @class(['debug-outline' => app()->environment('local')])>
    <div class="flex min-h-screen items-center justify-center bg-board-grey">
      <div class="max-w-[90vw]">
        <h1 class="mx-auto mb-[var(--s6)] max-w-[60ch]">
          <img
            src="{{ asset('images/trio-board-logo.svg') }}"
            alt="Trio Board Logo"
            class="h-auto w-full"
          />
        </h1>

        <p class="font-body mb-[var(--s5)] text-center text-base font-normal text-board-black">
          アクセス制限のあるメンバー専用掲示板です。ログインしてお入りください。
          <br />
          ご利用ありがとうございます。
        </p>

        <div class="mx-auto mb-[var(--s4)] flex justify-center">
          <a
            href="{{ route('login') }}"
            {{-- wire:navigate="false" --}}
            class="inline-flex max-w-[15ch] btn-outline items-center btn"
          >
            <img
              src="{{ asset('images/board-login.svg') }}"
              alt="loginボタン"
              class="h-auto w-full"
            />
          </a>
        </div>

        {{-- フッター --}}
        @include('layouts.board_footer')
      </div>
    </div>
  </body>
</html>
