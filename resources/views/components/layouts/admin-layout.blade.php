{{-- admin・member管理画面レイアウト 2カラム構造 --}}
<x-layouts.app title="Boardメンバーメニュー">

    <div class="max-w-[90]">
    {{-- 左側リスト --}}
    <div class="flex min-h-0 w-full flex-wrap">
        <aside class="min-h-0 flex-1 flex-shrink-0 flex-grow basis-[30ch]">
            <ul class="list-inside list-disc">
                <li class="mb-[clamp(1.25rem,1.25rem+0.20vw,1.56rem)] max-w-8/10 px-4 py-2 text-[calc(0.85rem+0.2vw)] leading-[1.5] font-medium">
                    マイポスト表示</li>
                <li class="mb-[clamp(1.25rem,1.25rem+0.20vw,1.56rem)] max-w-8/10 px-4 py-2 text-[calc(0.85rem+0.2vw)] leading-[1.5] font-medium">
                <a href="{{ route('threads.index')}}">
                    スレッド一覧へ
                </a>
                </li>
            </ul>
        </aside>
    </div>

    {{-- 右側livewire画面 --}}
    <div class="min-h-0 flex-1 flex-shrink-0 flex-grow basis-[30ch]">
        {{$slot}}
    </div>

    </div>

</x-layouts.app>
