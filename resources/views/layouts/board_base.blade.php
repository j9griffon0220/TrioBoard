{{-- 掲示板全体のベースレイアウト --}}
<!DOCTYPE html>
<html lang="ja">
  {{-- headタグ --}}
  @include('layouts.board_head')

  {{-- 開発環境だけでデバッグ用クラスを出すようbodyタグで調整 --}}
  <body @class(['debug-outline' => app()->environment('local')])>
    <div class="min-h-screen bg-board-grey">
      <div class="mx-auto max-w-[90vw] pt-[var(--s3)] pb-[var(--s3)]">
        {{-- ヘッダー --}}
        @include('layouts.board_header')

        {{-- コンテンツ --}}
        @yield('board_content')

        {{-- フッター --}}
        @include('layouts.board_footer')
      </div>
    </div>
    @livewireScripts
  </body>
</html>
