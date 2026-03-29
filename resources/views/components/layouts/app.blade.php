<x-layouts.app.header :title="$title ?? null">
  {{-- login後の管理画面共通台紙 --}}
  <flux:main {{ $attributes }}>

    {{-- admin・member共用管理画面レイアウトとしてadmin-layout.blade.phpが入る --}}
    {{ $slot }}
  </flux:main>
</x-layouts.app.header>
