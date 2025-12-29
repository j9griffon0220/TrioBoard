<div class="mb-[var(--s7)]">
  {{-- The best athlete wants his opponent at his best. --}}
  <h1 class="text-double-blue font-title text-center mb-[var(--s4)] font-medium text-xl">「{{ $thread->title }}」のポスト一覧</h1>

  @forelse ($this->posts as $post)
    {{-- postごとにまとめる --}}
    <div class="max-w-[90vw] mb-[var(--s5)] p-[var(--s-2)] bg-board-blue/9">
        <div class="flex gap-2 items-baseline mb-[var(--s-4)] max-w-[50ch]">
            <p class="font-body text-board-black font-normal name-label ">
                {{ optional($post->user)->name ?? '(投稿者不明)' }}</p>
            <span
            class="font-body text-board-charcoal font-light text-sm "
            title="{{ $post->created_at->format('Y-m-d H:i') }}"
            >
            （{{ $post->created_at->diffForHumans() }}）
            </span>
        </div>
        <div class="max-w-[50ch]">
        <p class="font-body text-board-black font-normal mb-[var(--s-4)] ">
            {{ $post->title }}</p>
        <p class="font-body text-board-black font-normal">
            {{ $post->body }}</p>
        </div>
    </div>
  @empty
    <p class="font-body text-board-black font-normal mb-[var(--s-4)]">投稿がまだありません</p>
  @endforelse
</div>
