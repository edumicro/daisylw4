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
     * Hover Gallery specific props
     */
    public array $images = [];
    public int $columns = 3;
    public bool $showCaptions = true;
    public bool $showOverlay = true;
    public string $overlayEffect = 'slide';
    public string $icon = 'heroicon-o-photo';
    public bool $rounded = true;
    public bool $shadow = true;

    /**
     * Get grid column class
     */
    public function getGridClass(): string
    {
        return match ($this->columns) {
            1 => 'grid-cols-1',
            2 => 'grid-cols-2',
            3 => 'grid-cols-3',
            4 => 'grid-cols-4',
            default => 'grid-cols-3',
        };
    }

    /**
     * Get overlay animation class
     */
    public function getOverlayClass(): string
    {
        return match ($this->overlayEffect) {
            'fade' => 'opacity-0 group-hover:opacity-100',
            'slide' => 'translate-y-full group-hover:translate-y-0',
            'scale' => 'scale-0 group-hover:scale-100',
            default => 'opacity-0 group-hover:opacity-100',
        };
    }
}; ?>

<div
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($label)
        <div class="flex items-center gap-2 mb-6">
            @if ($icon)
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            @endif
            <h2 class="text-2xl font-bold">{{ $label }}</h2>
        </div>
    @endif

    <div class="grid {{ $this->getGridClass() }} gap-4 {{ $containerClass }}">
        @forelse ($images as $index => $image)
            <div
                class="group relative h-64 overflow-hidden {{ $rounded ? 'rounded-lg' : '' }} {{ $shadow ? 'shadow-md hover:shadow-xl' : '' }} transition-all duration-300 cursor-pointer {{ $class }}"
            >
                <!-- Main Image -->
                <img
                    src="{{ $image['src'] ?? '' }}"
                    alt="{{ $image['alt'] ?? 'Gallery Item ' . ($index + 1) }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                />

                @if ($showOverlay)
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black/60 transition-all duration-500 {{ $this->getOverlayClass() }}"
                    >
                        <!-- Overlay Content -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                            <div class="text-center">
                                @if (isset($image['title']))
                                    <h3 class="text-white font-bold text-lg mb-2 line-clamp-2">
                                        {{ $image['title'] }}
                                    </h3>
                                @endif

                                @if (isset($image['description']))
                                    <p class="text-white/80 text-sm mb-4 line-clamp-2">
                                        {{ $image['description'] }}
                                    </p>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex gap-2 justify-center">
                                    @if (isset($image['viewUrl']))
                                        <a
                                            href="{{ $image['viewUrl'] }}"
                                            class="btn btn-sm btn-outline btn-light"
                                        >
                                            {{ trans('daisylw4::view') }}
                                        </a>
                                    @endif

                                    @if (isset($image['wire']))
                                        <button
                                            wire:click="{{ $image['wire'] }}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            {{ trans('daisylw4::select') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Caption -->
                @if ($showCaptions && isset($image['caption']))
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-sm font-medium">{{ $image['caption'] }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="flex justify-center mb-4">
                    @if ($icon)
                        <x-dynamic-component :component="$icon" class="w-12 h-12 text-base-content/30" />
                    @endif
                </div>
                <p class="text-base-content/50">{{ trans('daisylw4::no_items') }}</p>
            </div>
        @endforelse
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-sm block mt-4">{{ $message }}</span>
        @enderror
    @endif
</div>
