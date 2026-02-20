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
     * Skeleton specific props
     */
    public string $type = 'card';
    public int $lines = 3;
    public bool $animated = true;
    public string $size = 'md';
    public int $width = 100;
    public array $children = [];

    /**
     * Type mapping
     */
    protected array $typeMap = [
        'card' => 'skeleton rounded-lg w-full h-32',
        'text' => 'skeleton rounded w-full h-4',
        'avatar' => 'skeleton rounded-full w-12 h-12',
        'circle' => 'skeleton rounded-full w-24 h-24',
        'image' => 'skeleton rounded-lg w-full h-64',
        'line' => 'skeleton rounded w-full h-4',
    ];

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'h-2',
        'sm' => 'h-3',
        'md' => 'h-4',
        'lg' => 'h-5',
        'xl' => 'h-6',
    ];

    /**
     * Get type class
     */
    public function getTypeClass(): string
    {
        return $this->typeMap[$this->type] ?? $this->typeMap['card'];
    }

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

<div class="{{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="mb-4">
            <div class="skeleton rounded w-1/3 h-6 {{ $animated ? 'animate-pulse' : '' }}"></div>
        </div>
    @endif

    @switch($type)
        @case('card')
            <div class="space-y-4">
                <!-- Image skeleton -->
                <div class="skeleton rounded-lg w-full h-48 {{ $animated ? 'animate-pulse' : '' }} {{ $class }}"></div>

                <!-- Content skeleton -->
                <div class="space-y-3">
                    <div class="skeleton rounded w-3/4 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-full h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-full h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-1/2 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                </div>

                <!-- Action skeleton -->
                <div class="flex gap-2 pt-4">
                    <div class="skeleton rounded w-16 h-8 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-16 h-8 {{ $animated ? 'animate-pulse' : '' }}"></div>
                </div>
            </div>
        @break

        @case('avatar')
            <div class="flex items-center gap-4">
                <div class="skeleton rounded-full w-12 h-12 {{ $animated ? 'animate-pulse' : '' }} {{ $class }}"></div>
                <div class="space-y-2 flex-1">
                    <div class="skeleton rounded w-32 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-48 h-3 {{ $animated ? 'animate-pulse' : '' }}"></div>
                </div>
            </div>
        @break

        @case('text')
            <div class="space-y-{{ $size === 'md' ? '3' : ($size === 'sm' ? '2' : '4') }}">
                @for ($i = 0; $i < $lines; $i++)
                    <div class="skeleton rounded {{ $i === $lines - 1 ? 'w-3/4' : 'w-full' }} {{ $this->getSizeClass() }} {{ $animated ? 'animate-pulse' : '' }} {{ $class }}"></div>
                @endfor
            </div>
        @break

        @case('circle')
            <div class="flex items-center justify-center">
                <div class="skeleton rounded-full w-24 h-24 {{ $animated ? 'animate-pulse' : '' }} {{ $class }}"></div>
            </div>
        @break

        @case('image')
            <div class="skeleton rounded-lg w-full h-64 {{ $animated ? 'animate-pulse' : '' }} {{ $class }}"></div>
        @break

        @case('table')
            <div class="space-y-3">
                <!-- Header skeleton -->
                <div class="flex gap-4 pb-3 border-b border-base-300">
                    <div class="skeleton rounded w-12 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-24 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-full h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    <div class="skeleton rounded w-16 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                </div>

                <!-- Rows skeleton -->
                @for ($i = 0; $i < 3; $i++)
                    <div class="flex gap-4 py-3">
                        <div class="skeleton rounded w-12 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                        <div class="skeleton rounded w-24 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                        <div class="skeleton rounded w-full h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                        <div class="skeleton rounded w-16 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    </div>
                @endfor
            </div>
        @break

        @case('grid')
            <div class="grid grid-cols-{{ $width < 50 ? '2' : ($width < 75 ? '3' : '4') }} gap-4">
                @for ($i = 0; $i < $lines; $i++)
                    <div class="space-y-2">
                        <div class="skeleton rounded-lg w-full h-32 {{ $animated ? 'animate-pulse' : '' }}"></div>
                        <div class="skeleton rounded w-3/4 h-4 {{ $animated ? 'animate-pulse' : '' }}"></div>
                        <div class="skeleton rounded w-1/2 h-3 {{ $animated ? 'animate-pulse' : '' }}"></div>
                    </div>
                @endfor
            </div>
        @break

        @default
            <div class="{{ $this->getTypeClass() }} {{ $animated ? 'animate-pulse' : '' }} {{ $class }}" style="width: {{ $width }}%"></div>
    @endswitch
</div>

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-2">{{ $message }}</span>
    @enderror
@endif
