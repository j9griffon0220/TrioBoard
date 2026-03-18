{{-- 管理者adminのdashboard --}}
<div class="">
    {{-- 右メインサイド --}}

    {{-- postごとにまとめる --}}
    @forelse($posts as $post)
        <div class="mb-[var(--s2)] p-[var(--s-2)] bg-board-blue/9 ">

            <div class="flex flex-wrap overflow-hidden">
                <p class="font-body text-board-charcoal font-light text-sm name-label mr-[var(--s-4)]">
                    {{ $post->created_at->format('Y-m-d H:i') }}
                </p>
                <p class="font-body text-double-blue font-medium mb-[var(--s-4)] text-base">
                    <a href="{{ route('threads.show', $post->thread_id )}}"
                    class="underline underline-offset-6 hover:bg-double-blue/20 transition-all">
                        「{{ $post->thread->title ?? 'スレッド不明' }}」
                    </a>
                </p>
            </div>

            <p class="font-body text-board-black font-normal text-base">
                <span class="font-body text-board-charcoal font-light text-sm">
                投稿：</span>
            {{ $post->title }}
            </p>
        </div>
            @empty
            {{-- 投稿がない時の表示 --}}
            <p class="font-body text-board-black font-normal mb-[var(--s-4)]">
            投稿がまだありません
            </p>
     @endforelse

</div>
