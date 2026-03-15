{{-- 管理者adminのdashboard --}}
<div class="">
    {{-- 右メインサイド --}}

    {{-- postごとにまとめる --}}
    @forelse($posts as $post)
        <div class="mb-[var(--s1)] p-[var(--s-2)] bg-board-blue/9 ">
            <p class="font-body text-board-black font-normal mb-[var(--s-4)]">
            <span class="font-body text-board-charcoal font-light text-sm name-label">
            {{ $post->created_at->format('Y-m-d H:i') }}</span>
            <span class="font-body text-board-charcoal font-light text-sm">
            スレッド：</span>
            {{ $post->thread->title ?? 'スレッド不明' }}
            </p>

            <p class="font-body text-board-black font-normal ">
                <span class="font-body text-board-charcoal font-light text-sm">
                投稿：</span>
            {{ $post->body }}
            </p>
        </div>
            @empty
            {{-- 投稿がない時の表示 --}}
            <p class="font-body text-board-black font-normal mb-[var(--s-4)]">
            投稿がまだありません
            </p>
     @endforelse

    {{-- @foreach($posts as $post)
        <div class="mb-[var(--s1)] p-[var(--s-2)] bg-board-blue/9">
        <p>
        <span
        class="font-body text-board-charcoal font-light text-sm ">
        {{ $post->created_at->format('Y-m-d H:i') }}
        </span>
        スレッド： {{ $post->thread->title }}
        <br>投稿：{{ $post->body }}
        </p>
        </div>
    @endforeach --}}

</div>
