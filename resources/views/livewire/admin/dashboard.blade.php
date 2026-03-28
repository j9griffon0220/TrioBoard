{{-- 管理者adminのdashboard --}}
<div class="">
  {{-- 右メインサイド --}}

  {{-- postごとにまとめる --}}
  @forelse ($posts as $post)
    <div class="mb-[var(--s2)] bg-board-blue/9 p-[var(--s-2)]">
      <div class="flex flex-wrap overflow-hidden">
        <p class="font-body name-label mr-[var(--s-4)] text-sm font-light text-board-charcoal">
          {{ $post->created_at->format('Y-m-d H:i') }}
        </p>
        <p class="font-body mb-[var(--s-4)] text-base font-medium text-double-blue">
          <a
            href="{{ route('threads.show', $post->thread_id) }}"
            class="underline underline-offset-6 transition-all hover:bg-double-blue/20"
          >
            「{{ $post->thread->title ?? 'スレッド不明' }}」
          </a>
        </p>
      </div>

      <p class="font-body text-base font-normal text-board-black">
        <span class="font-body text-sm font-light text-board-charcoal">投稿：</span>
        {{ $post->title }}
      </p>
    </div>
  @empty
    {{-- 投稿がない時の表示 --}}
    <p class="font-body mb-[var(--s-4)] font-normal text-board-black">投稿がまだありません</p>
  @endforelse
</div>
