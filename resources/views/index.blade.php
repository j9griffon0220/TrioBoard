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
        <div class="mx-auto max-w-[70vw]">
          <picture>
            <source
              srcset="
                {{ asset('images/trio-board-logo@1x.webp') }} 1x,
                {{ asset('images/trio-board-logo@2x.webp') }} 2x
              "
              type="image/webp"
            />
            {{-- フォールバック --}}
            <img
              src="{{ asset('images/trio-board-logo.png') }}"
              alt="Trio Board Logo"
              class="h-auto w-full"
            />
          </picture>
        </div>
        <h1 class="mt-[var(--s4)] text-center font-body text-board-black">
          アクセス制限のあるメンバー専用掲示板です。ログインしてお入りください。
          <br />
          ご利用ありがとうございます。
        </h1>
        <div class="mx-auto mt-[var(--s4)] max-w-[25vw]">
          <a
            href="{{ route('login') }}"
            class="block rounded-2xl border-2 border-board-magenta p-[var(--s-1)] shadow-md"
          >
            <picture>
              <source
                srcset="
                  {{ asset('images/board-login@1x.webp') }} 1x,
                  {{ asset('images/board-login@2x.webp') }} 2x
                "
                type="image/webp"
              />
              {{-- フォールバック --}}
              <img src="{{ asset('images/board-login.png') }}" alt="Login" class="h-auto w-full" />
            </picture>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
