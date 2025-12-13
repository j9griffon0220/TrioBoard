<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <h1>これはlivewireのポスト一覧です</h1>
    @forelse($this->posts as $post)
    {{-- postごとにまとめる --}}
    <div>
        <p>{{ optional($post->user)->name ?? '(投稿者不明)'}}</p>
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
        <span class="font-body text-board-charcoal" title="{{ $thread->created_at->format('Y-m-d H:i')}}">
        {{ $thread->created_at->diffForHumans() }}
        </span>
    </div>
    @empty
    <p>投稿がまだありません</p>
    @endforelse

</div>
