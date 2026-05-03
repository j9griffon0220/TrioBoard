<div>
  {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
  <h2 class="mb-[var(--s4)] text-center font-title text-2xl font-medium text-double-blue">
    投稿フォーム
  </h2>

  <div class="mb-[var(--s6)] max-w-[90vw] bg-board-blue/8 p-[var(--s2)]">
    <form wire:submit.prevent="store">
      <label class="font-body mb-[var(--s-4)] block text-base font-light text-board-charcoal">
        タイトル：
      </label>

      <input
        type="text"
        wire:model="title"
        placeholder="タイトルを入力してください"
        required
        maxlength="40"
        class="mb-[var(--s1)] w-full border-2 border-gray-300 p-[var(--s-4)] focus:border-double-blue focus:outline-none"
      />
      {{-- バリデーション表示 --}}
      @error('title')
        <p class="font-body mb-[var(--s-3)] text-base font-normal text-double-red">
          {{ $message }}
        </p>
      @enderror

      <label class="font-body mb-[var(--s-4)] block text-base font-light text-board-charcoal">
        本文：
      </label>
      <textarea
        wire:model="body"
        placeholder="投稿を入力してください"
        required
        maxlength="400"
        rows="5"
        class="mb-[var(--s1)] w-full resize-y border-2 border-gray-300 p-[var(--s-4)] focus:border-double-blue focus:outline-none"
      ></textarea>

      @error('body')
        <p class="font-body mb-[var(--s-3)] text-base font-normal text-double-red">
          {{ $message }}
        </p>
      @enderror

      <div class="flex justify-end">
        <div class="mb-[var(--s-4)] min-w-[15ch] btn-primary btn text-center">
          <button type="submit" class="font-title text-base">投稿を保存</button>
        </div>
      </div>
    </form>
  </div>
</div>
