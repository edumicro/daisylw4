<?php

use Livewire\Component;

new class extends Component {
    /**
     * Mandatory standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Text Rotate specific props
     */
    public array $texts = [];
    public int $currentIndex = 0;
    public int $duration = 3000;
    public bool $autoRotate = true;
    public string $animation = 'fade';
    public string $size = 'lg';
    public string $color = 'primary';
    public bool $bold = true;

    /**
     * Animation mapping
     */
    protected array $animationMap = [
        'fade' => 'transition-opacity duration-500',
        'slide' => 'transition-all duration-500 transform',
        'scale' => 'transition-transform duration-500',
    ];

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'base' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
        '2xl' => 'text-2xl',
        '3xl' => 'text-3xl',
        '4xl' => 'text-4xl',
    ];

    /**
     * Rotate to next text
     */
    public function rotateNext(): void
    {
        if (!empty($this->texts)) {
            $this->currentIndex = ($this->currentIndex + 1) % count($this->texts);
        }
    }

    /**
     * Rotate to previous text
     */
    public function rotatePrev(): void
    {
        if (!empty($this->texts)) {
            $this->currentIndex = ($this->currentIndex - 1 + count($this->texts)) % count($this->texts);
        }
    }

    /**
     * Get animation class
     */
    public function getAnimationClass(): string
    {
        return $this->animationMap[$this->animation] ?? $this->animationMap['fade'];
    }

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['lg'];
    }
}; ?>

<div class="{{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="mb-4 text-center">
            <h3 class="text-sm font-medium text-base-content/70">{{ $label }}</h3>
        </div>
    @endif

    <div class="flex items-center justify-center gap-4">
        @if (count($texts) > 1)
            <button
                wire:click="rotatePrev"
                class="btn btn-circle btn-sm btn-ghost"
                aria-label="Previous"
            >
                ❮
            </button>
        @endif

        <div class="relative h-20 flex items-center justify-center min-w-full sm:min-w-96">
            @if (!empty($texts))
                @foreach ($texts as $index => $text)
                    <div
                        class="absolute inset-0 flex items-center justify-center {{ $this->getAnimationClass() }} {{ $index === $this->currentIndex ? 'opacity-100 visible' : 'opacity-0 invisible' }} {{ $animation === 'slide' && $index !== $this->currentIndex ? ($index > $this->currentIndex ? 'translate-x-full' : '-translate-x-full') : '' }} {{ $animation === 'scale' && $index !== $this->currentIndex ? 'scale-75' : '' }}"
                    >
                        <span
                            class="{{ $this->getSizeClass() }} {{ $bold ? 'font-bold' : 'font-normal' }} text-{{ $color }} text-center px-4 {{ $class }}"
                        >
                            {{ $text['text'] ?? $text }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>

        @if (count($texts) > 1)
            <button
                wire:click="rotateNext"
                class="btn btn-circle btn-sm btn-ghost"
                aria-label="Next"
            >
                ❯
            </button>
        @endif
    </div>

    @if (count($texts) > 1)
        <div class="flex justify-center gap-2 mt-4">
            @foreach ($texts as $index => $text)
                <button
                    wire:click="$set('currentIndex', {{ $index }})"
                    class="w-2 h-2 rounded-full transition-all {{ $index === $this->currentIndex ? 'bg-' . $color . ' w-8' : 'bg-base-300' }}"
                    aria-label="Go to slide {{ $index + 1 }}"
                    aria-current="{{ $index === $this->currentIndex ? 'page' : 'false' }}"
                ></button>
            @endforeach
        </div>
    @endif

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-4 text-center">{{ $message }}</span>
        @enderror
    @endif
</div>
