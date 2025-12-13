    <div class="max-w-[60vw] mx-auto pt-[var(--s3)]">
        <picture>
            <source
            srcset="{{ asset('images/trio-board-logo@1x.webp') }} 1x,
            {{ asset('images/trio-board-logo@2x.webp') }} 2x"
            type="image/webp">
            {{-- フォールバック --}}
            <img src="{{ asset('trio-board-logo.png') }}" alt="Trio Board Logo" class="w-full h-auto">
        </picture>
    </div>
