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
     * Badge specific props
     */
    public string $text = '';
    public string $variant = 'primary';
    public string $size = 'md';
    public string $icon = '';
    public string $iconSide = 'left';
    public bool $outline = false;
    public bool $ghost = false;

    /**
     * Variant mapping for DaisyUI badge
     */
    protected array $variantMap = [
        'primary' => 'badge-primary',
        'secondary' => 'badge-secondary',
        'accent' => 'badge-accent',
        'ghost' => 'badge-ghost',
        'info' => 'badge-info',
        'success' => 'badge-success',
        'warning' => 'badge-warning',
        'error' => 'badge-error',
        'neutral' => 'badge-neutral',
    ];

    /**
     * Size mapping for DaisyUI badge
     */
    protected array $sizeMap = [
        'xs' => 'badge-xs',
        'sm' => 'badge-sm',
        'md' => 'badge',
        'lg' => 'badge-lg',
    ];

    /**
     * Get variant class
     */
    public function getVariantClass(): string
    {
        if ($this->ghost) {
            return 'badge-ghost';
        }

        $base = $this->variantMap[$this->variant] ?? $this->variantMap['primary'];

        if ($this->outline) {
            return 'badge-outline ' . $base;
        }

        return $base;
    }

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

<span
    class="badge {{ $this->getVariantClass() }} {{ $this->getSizeClass() }} gap-2 {{ $class }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($icon && $iconSide === 'left')
        <x-dynamic-component :component="$icon" class="w-3 h-3" />
    @endif

    <span>{{ $text ?: $label }}</span>

    @if ($icon && $iconSide === 'right')
        <x-dynamic-component :component="$icon" class="w-3 h-3" />
    @endif
</span>

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-1">{{ $message }}</span>
    @enderror
@endif
