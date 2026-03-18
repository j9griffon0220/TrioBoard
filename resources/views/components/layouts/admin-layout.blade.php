{{-- admin・member管理画面レイアウト 2カラム構造 --}}
<x-layouts.app title="Boardメンバーメニュー">

    <div class="max-w-[90]">
    {{-- メニュー・操作エリア --}}
    <nav>
        <ul class="flex w-full flex-wrap mb-[var(--s3)] items-center ">
            <li class="max-w-[15ch] text-center p-(--s-5) max-w-8/10 text-[calc(0.85rem+0.2vw)] leading-[1.5] font-medium mr-[var(--s1)]">
                ・マイポスト表示
            </li>
            {{-- 移動ボタン --}}
            <li class="max-w-[15ch] btn btn-secondary inline-block list-none">
                <a href="{{ route('threads.index') }}">スレッド一覧へ</a>
            </li>
        </ul>
    </nav>

    {{-- 右側livewire画面 --}}
    {{-- <div class="min-h-0 flex-1 flex-shrink-0 flex-grow basis-[30ch]"> --}}
    <div>
        {{$slot}}
    </div>

    </div>

</x-layouts.app>
