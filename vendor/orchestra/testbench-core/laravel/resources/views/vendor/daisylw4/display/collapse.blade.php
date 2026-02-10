<?php

use Livewire\Component;
use Livewire\Volt\Component as VoltComponent;

new class extends VoltComponent {
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
     * Collapse specific props
     */
    public string $title = '';
    public string $content = '';
    public bool $open = false;
    public string $icon = 'heroicon-o-chevron-right';
    public string $iconSide = 'left';
    public string $variant = 'default';

    /**
     * Toggle collapse open/closed
     */
    public function toggle(): void
    {
        $this->open = !$this->open;
    }

    /**
     * Variant mapping for collapse
     */
    protected array $variantMap = [
        'default' => 'collapse-content bg-base-200/50',
        'primary' => 'collapse-content bg-primary/10',
        'secondary' => 'collapse-content bg-secondary/10',
        'accent' => 'collapse-content bg-accent/10',
        'info' => 'collapse-content bg-info/10',
        'success' => 'collapse-content bg-success/10',
        'warning' => 'collapse-content bg-warning/10',
        'error' => 'collapse-content bg-error/10',
    ];

    /**
     * Get variant class
     */
    public function getVariantClass(): string
    {
        return $this->variantMap[$this->variant] ?? $this->variantMap['default'];
    }
}; ?>

<div
    class="collapse collapse-arrow border border-base-300 bg-base-100 {{ $this->open ? 'collapse-open' : '' }} {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    <input
        type="checkbox"
        {{ $this->open ? 'checked' : '' }}
        wire:click="toggle"
        class="peer"
    />

    <div class="collapse-title flex items-center gap-2 font-medium {{ $class }}">
        @if ($icon && $iconSide === 'left')
            <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0 transition-transform" />
        @endif

        <span>{{ $title ?: $label }}</span>

        @if ($icon && $iconSide === 'right')
            <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0 ml-auto transition-transform" />
        @endif
    </div>

    <div class="{{ $this->getVariantClass() }}">
        <div class="p-4">
            {!! $content !!}
        </div>

        @if ($model)
            @error($model)
                <div class="alert alert-error mt-2">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        @endif
    </div>
</div>
