<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>掲示板トップページ</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div>
        <h1>ここがindex.blade.phpです</h1>
        <a href="{{ route('login')}}" class="underline">ログインページへ</a>
    </div>

</body>
</html>
