<div class="mb-[var(--s7)]">
  {{-- The best athlete wants his opponent at his best. --}}
  <h1 class="mb-[var(--s4)] text-center font-title text-2xl font-medium text-double-blue">
    「{{ $thread->title }}」のポスト一覧
  </h1>

  @forelse ($posts as $post)
    {{-- postごとにまとめる --}}
    <div class="mb-[var(--s5)] max-w-[90vw] bg-board-blue/8 p-[var(--s-1)]">
      <div class="mb-[var(--s-6)] flex max-w-[50ch] items-baseline gap-2">
        <p class="font-body name-label text-sm font-normal text-board-black">
          {{ optional($post->user)->name ?? '(投稿者不明)' }}
        </p>
        <span
          class="font-body text-sm font-light text-board-charcoal"
          title="{{ $post->created_at->format('Y-m-d H:i') }}"
        >
          （{{ $post->created_at->diffForHumans() }}）
        </span>
      </div>
      <div class="max-w-[50ch]">
        <p class="font-body mb-[var(--s-6)] text-base font-normal text-double-blue">
          {{ $post->title }}
        </p>
        <p class="font-body text-base font-normal break-all whitespace-pre-line text-board-black">
          {{ $post->body }}
        </p>
      </div>
    </div>
  @empty
    <p class="font-body mb-[var(--s-6)] text-base font-normal text-board-black">
      投稿がまだありません
    </p>
  @endforelse

  {{-- ページネーションリンクの表示 --}}
  <div class="mb-[var(--s4)]">
    {{ $posts->links('vendor.pagination.tailwind') }}
  </div>
</div>
