<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trio Board</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- 開発環境だけでデバッグ用クラスを出すようbodyタグで調整 --}}
<body @class(['debug-outline' => app()->environment('local')])>
    <div class="bg-board-grey min-h-screen items-center justify-center flex">
        <div class="max-w-[90vw]">
            <div class="max-w-[70vw] mx-auto">
            <picture>
                <source
                srcset="{{ asset('images/trio-board-logo@1x.webp') }} 1x,
                {{ asset('images/trio-board-logo@2x.webp') }} 2x"
                type="image/webp">
                {{-- フォールバック --}}
                <img src="{{ asset('images/trio-board-logo.png') }}" alt="Trio Board Logo" class="w-full h-auto">
            </picture>
            </div>
            <h1 class="text-board-black font-body text-center mt-[var(--s4)]">
                アクセス制限のあるメンバー専用掲示板です。ログインしてお入りください。
                <br>ご利用ありがとうございます。
            </h1>
            <div class="max-w-[25vw] mx-auto mt-[var(--s4)]">
                <a href="{{ route('login') }}" class="block border-2 p-[var(--s-1)] rounded-2xl border-board-magenta shadow-md">
                    <picture>
                    <source
                    srcset="{{ asset('images/board-login@1x.webp') }} 1x,{{ asset('images/board-login@2x.webp') }} 2x"
                    type="image/webp">
                    {{-- フォールバック --}}
                    <img src="{{ asset('images/board-login.png') }}" alt="Login" class="w-full h-auto">
                    </picture>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
