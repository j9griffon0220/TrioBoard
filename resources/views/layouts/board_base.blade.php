{{-- 掲示板全体のベースレイアウト --}}
<!DOCTYPE html>
<html lang="ja">
    {{-- headタグ --}}
    @include('layouts.board_head')

{{-- 開発環境だけでデバッグ用クラスを出すようbodyタグで調整 --}}
<body @class(['debug-outline' => app()->environment('local')])>
    <div class="bg-board-grey min-h-screen">
        <div class="max-w-[90vw] mx-auto">
        {{-- ヘッダー --}}
        @include('layouts.board_header')

        <div class="mt-[var(--s3)]">
        {{-- コンテンツ --}}
        @yield('board_content')
        </div>

        {{-- フッター --}}
        @include('layouts.board_footer')
        </div>
    </div>
    @livewireScripts
</body>
</html>
