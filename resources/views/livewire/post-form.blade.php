<div>
  {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
  <h1 class="text-double-blue font-title text-center mb-[var(--s4)] font-medium text-2xl">投稿フォーム</h1>

    <div class="max-w-[90vw] mb-[var(--s6)] p-[var(--s2)] bg-board-blue/9">
        <form wire:submit.prevent="store">
            <label class="block font-body text-board-charcoal font-light text-base mb-[var(--s-4)]">
                タイトル：
            </label>

            <input type="text" wire:model="title" placeholder="タイトルを入力してください" required maxlength="40"
            class="w-full border-2 border-gray-300 p-[var(--s-4)] mb-[var(--s1)] focus:outline-none focus:border-double-blue " />
            {{-- バリデーション表示 --}}
            @error('title')
            <p class="text-double-red font-body font-normal text-base mb-[var(--s-3)]">{{ $message }}</p>
            @enderror

            <label class="block font-body text-board-charcoal font-light text-base mb-[var(--s-4)]">
                本文：
            </label>
            <textarea wire:model="body" placeholder="投稿を入力してください" required maxlength="400" rows="5"
            class="w-full border-2 border-gray-300 p-[var(--s-4)] mb-[var(--s1)] resize-y focus:outline-none focus:border-double-blue ">
            </textarea>

            @error('body')
            <p class="text-double-red font-body font-normal text-base mb-[var(--s-3)]">{{ $message }}</p>
            @enderror

            <div class="flex justify-end">
                <div class="min-w-[15ch] mb-[var(--s-4)] btn btn-primary text-center">
                <button type="submit" class="font-title text-base">投稿を保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
