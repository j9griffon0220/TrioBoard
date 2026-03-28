{{-- admin・member管理画面レイアウト 2カラム構造 --}}
<x-layouts.app title="Boardメンバーメニュー">
  <div class="max-w-[90]">
    {{-- メニュー・操作エリア --}}
    <nav>
      <ul class="mb-[var(--s3)] flex w-full flex-wrap items-center">
        <li
          class="mr-[var(--s1)] max-w-8/10 max-w-[15ch] p-(--s-5) text-center text-[calc(0.85rem+0.2vw)] leading-[1.5] font-medium"
        >
          ・マイポスト表示
        </li>
        {{-- 移動ボタン --}}
        <li class="inline-block max-w-[15ch] btn-secondary list-none btn">
          <a href="{{ route('threads.index') }}">スレッド一覧へ</a>
        </li>
      </ul>
    </nav>

    {{-- 右側livewire画面 --}}
    {{-- <div class="min-h-0 flex-1 flex-shrink-0 flex-grow basis-[30ch]"> --}}
    <div>
      {{ $slot }}
    </div>
  </div>
</x-layouts.app>
