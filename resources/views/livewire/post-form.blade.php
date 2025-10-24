<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <h1>投稿フォーム</h1>

    <input type="text" wire:model="title" placeholder="タイトル">
    <textarea wire:model="body" placeholder="投稿本文"></textarea>

    @if ($isEditing)
        <form wire:submit.prevent="destroy">
            <button type="submit">投稿を破棄</button>
        </form>
    @else
        <form wire:submit.prevent="store">
            <button type="submit">投稿を保存</button>
        </form>
    @endif
</div>
