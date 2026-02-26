<x-layouts.app.header :title="$title ?? null">
    {{-- login後の管理画面台紙 --}}
  <flux:main container>
    <h1>Resources/vies/components/layouts/app.blade.phpが使われているか確認</h1>
    {{ $slot }}
  </flux:main>
</x-layouts.app.header>
