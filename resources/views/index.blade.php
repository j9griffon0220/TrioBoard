<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trio Board</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div>
        <picture>
            <source media="" srcset="{{ asset('images/trio-board-logo@1x.webp') }}" type="image/webp">
            <source srcset="{{ asset('images/trio-board-logo@2x.webp') }} 2x" type="image/webp">
            <img src="{{ asset('trio-board-logo.png')}}" alt="TrioBoardLogo">
        </picture>
        <h1>ここがindex.blade.phpです</h1>
        <a href="{{ route('login')}}" class="underline">ログインページへ</a>
    </div>

</body>
</html>
