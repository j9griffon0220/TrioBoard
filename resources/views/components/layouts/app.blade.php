<x-layouts.app.header :title="$title ?? null">
    {{-- login後の管理画面共通台紙 --}}
    <flux:main {{ $attributes }}>
    <h1 class="text-red-500">Resources/vies/components/layouts/app.blade.phpが使われているか確認</h1>
    {{--  admin-layout または member-layout が入る --}}
    {{-- 現状2カラムレイアウトは共通なのでadmin-layoutのみ --}}
    {{ $slot }}
    </flux:main>
</x-layouts.app.header>
