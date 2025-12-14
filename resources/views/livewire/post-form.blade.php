<div>
  {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
  <h1>投稿フォーム</h1>

  <form wire:submit.prevent="store">
    <input type="text" wire:model="title" placeholder="タイトル" />
    {{-- バリデーション表示 --}}
    @error('title')
      <div>{{ $message }}</div>
    @enderror

    <textarea wire:model="body" placeholder="投稿本文"></textarea>
    @error('body')
      <div>{{ $message }}</div>
    @enderror

    <button type="submit">投稿を保存</button>
  </form>
</div>
