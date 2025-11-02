{{-- 投稿されたpostを編集するためのコンポーネント --}}
<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if(auth()->id() === $post->user_id)
        <button wire:click="edit({{ $post->user_id }})">編集</button>
        <button wire:click="delate({{ $post->user_id }})">削除</button>
    @endif
</div>
