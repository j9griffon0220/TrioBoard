<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <h1>これはlivewireのポスト一覧です</h1>
    @forelse($posts as $post)
    {{-- postごとにまとめる --}}
    <div>
        {{-- <p>{{ $post->user->name }}</p> --}}
        {{-- null 安全に表示する --}}
        <p>{{ optional($post->user)->name ?? '(投稿者不明)'}}</p>
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
    </div>
    @empty
    <p>まだ投稿がありません</p>
    @endforelse

    {{-- 投稿用のlivewireコンポーネント --}}
    <livewire:post-form :thread-id="$thread->id" />
</div>
