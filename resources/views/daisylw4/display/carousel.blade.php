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
     * Carousel specific props
     */
    public array $items = [];
    public int $activeIndex = 0;
    public bool $autoplay = true;
    public int $interval = 5000;
    public bool $showControls = true;
    public bool $showIndicators = true;

    /**
     * Navigate to next slide
     */
    public function nextSlide(): void
    {
        $this->activeIndex = ($this->activeIndex + 1) % count($this->items);
    }

    /**
     * Navigate to previous slide
     */
    public function prevSlide(): void
    {
        $this->activeIndex = ($this->activeIndex - 1 + count($this->items)) % count($this->items);
    }

    /**
     * Go to specific slide
     */
    public function goToSlide(int $index): void
    {
        if ($index >= 0 && $index < count($this->items)) {
            $this->activeIndex = $index;
        }
    }
}; ?>

<div
    class="carousel carousel-center max-w-4xl mx-auto rounded-box bg-neutral p-4 {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    @forelse ($items as $index => $item)
        <div
            class="carousel-item {{ $activeIndex === $index ? 'block' : 'hidden' }} w-full transition-opacity duration-500 relative {{ $class }}"
            role="tabpanel"
            aria-selected="{{ $activeIndex === $index }}"
        >
            @if (isset($item['image']))
                <img
                    src="{{ $item['image'] }}"
                    alt="{{ $item['alt'] ?? 'Slide ' . ($index + 1) }}"
                    class="w-full h-96 object-cover rounded-lg"
                />
            @elseif (isset($item['content']))
                <div class="w-full h-96 flex items-center justify-center bg-base-200 rounded-lg">
                    <div class="text-center">
                        {!! $item['content'] !!}
                    </div>
                </div>
            @endif

            @if (isset($item['title']))
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4 rounded-b-lg">
                    <h3 class="text-white font-bold">{{ $item['title'] }}</h3>
                    @if (isset($item['description']))
                        <p class="text-white/80 text-sm">{{ $item['description'] }}</p>
                    @endif
                </div>
            @endif
        </div>
    @empty
        <div class="w-full h-96 flex items-center justify-center bg-base-200 rounded-lg">
            <span class="text-base-content/50">{{ $label ?: trans('daisylw4::no_items') }}</span>
        </div>
    @endforelse
</div>

@if ($showControls && !empty($items))
    <div class="flex justify-center gap-2 mt-4">
        <button
            wire:click="prevSlide"
            class="btn btn-circle btn-sm btn-outline"
            aria-label="Previous slide"
        >
            ❮
        </button>

        @if ($showIndicators)
            @foreach ($items as $index => $item)
                <button
                    wire:click="goToSlide({{ $index }})"
                    class="btn btn-xs {{ $activeIndex === $index ? 'btn-primary' : 'btn-outline' }}"
                    aria-label="Go to slide {{ $index + 1 }}"
                    aria-current="{{ $activeIndex === $index ? 'page' : 'false' }}"
                >
                    {{ $index + 1 }}
                </button>
            @endforeach
        @endif

        <button
            wire:click="nextSlide"
            class="btn btn-circle btn-sm btn-outline"
            aria-label="Next slide"
        >
            ❯
        </button>
    </div>
@endif

@if ($model)
    @error($model)
        <span class="text-error text-sm block mt-2">{{ $message }}</span>
    @enderror
@endif
