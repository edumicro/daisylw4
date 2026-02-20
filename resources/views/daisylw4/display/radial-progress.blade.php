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
     * Radial Progress specific props
     */
    public float $value = 0;
    public float $max = 100;
    public string $size = 'md';
    public string $color = 'primary';
    public bool $thick = false;
    public string $unit = '%';
    public string $icon = '';
    public bool $animated = true;

    /**
     * Size mapping for radial progress
     */
    protected array $sizeMap = [
        'xs' => 'w-12 h-12 text-xs',
        'sm' => 'w-16 h-16 text-sm',
        'md' => 'w-24 h-24 text-base',
        'lg' => 'w-32 h-32 text-lg',
        'xl' => 'w-40 h-40 text-xl',
    ];

    /**
     * Color mapping
     */
    protected array $colorMap = [
        'primary' => 'text-primary',
        'secondary' => 'text-secondary',
        'accent' => 'text-accent',
        'success' => 'text-success',
        'warning' => 'text-warning',
        'error' => 'text-error',
        'info' => 'text-info',
    ];

    /**
     * Calculate percentage
     */
    public function getPercentage(): float
    {
        return ($this->value / $this->max) * 100;
    }

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }

    /**
     * Get color class
     */
    public function getColorClass(): string
    {
        return $this->colorMap[$this->color] ?? $this->colorMap['primary'];
    }
}; ?>

<div class="flex flex-col items-center gap-4 {{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="text-center">
            <h3 class="font-semibold">{{ $label }}</h3>
        </div>
    @endif

    <div class="flex flex-col items-center">
        <div
            class="radial-progress {{ $this->getSizeClass() }} {{ $this->getColorClass() }} {{ $thick ? 'font-bold' : '' }} {{ $animated ? 'transition-all duration-500' : '' }} {{ $class }}"
            style="--value: {{ $this->getPercentage() }}; --size: auto;"
        >
            <div class="flex flex-col items-center justify-center">
                @if ($icon)
                    <x-dynamic-component :component="$icon" class="w-1/2 h-1/2 mb-1" />
                @endif
                <span>{{ number_format($this->value, 0) }}{{ $unit }}</span>
            </div>
        </div>

        @if (isset($label) || isset($description))
            <div class="text-center mt-4">
                @if (isset($description))
                    <p class="text-sm text-base-content/70">{{ $description }}</p>
                @endif
            </div>
        @endif
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-xs">{{ $message }}</span>
        @enderror
    @endif
</div>
