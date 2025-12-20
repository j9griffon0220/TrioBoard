<div class="mx-auto max-w-[60vw] mb-[var(--s4)]">
  <picture>
    <source
      srcset="
        {{ asset('images/trio-board-logo@1x.webp') }} 1x,
        {{ asset('images/trio-board-logo@2x.webp') }} 2x
      "
      type="image/webp"
    />
    {{-- フォールバック --}}
    <img src="{{ asset('trio-board-logo.png') }}" alt="Trio Board Logo" class="h-auto w-full" />
  </picture>
</div>
