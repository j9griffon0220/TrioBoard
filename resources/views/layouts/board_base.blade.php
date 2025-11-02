{{-- 掲示板全体のベースレイアウト --}}
<!DOCTYPE html>
<html lang="ja">
    {{-- headタグ --}}
    @include('layouts.board_head')

<body>
    <div>
    {{-- ヘッダー --}}
    @include('layouts.board_header')

    {{-- コンテンツ --}}
    @yield('board_content')

    {{-- フッター --}}
    @include('layouts.board_footer')
    </div>
    @livewireScripts
</body>
</html>
