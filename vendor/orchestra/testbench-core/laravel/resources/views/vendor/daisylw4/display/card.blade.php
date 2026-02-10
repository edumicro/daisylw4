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
     * Card specific props
     */
    public string $title = '';
    public string $subtitle = '';
    public string $body = '';
    public string $image = '';
    public string $imageAlt = 'Card Image';
    public array $actions = [];
    public bool $shadow = true;
    public bool $compact = false;
    public string $background = 'base-100';
    public string $borderColor = '';
    public bool $hoverable = false;
    public bool $glass = false;

    /**
     * Background mapping for DaisyUI
     */
    protected array $backgroundMap = [
        'base-100' => 'bg-base-100',
        'base-200' => 'bg-base-200',
        'primary' => 'bg-primary',
        'secondary' => 'bg-secondary',
        'accent' => 'bg-accent',
        'success' => 'bg-success',
        'warning' => 'bg-warning',
        'error' => 'bg-error',
        'info' => 'bg-info',
    ];

    /**
     * Get background class
     */
    public function getBackgroundClass(): string
    {
        return $this->backgroundMap[$this->background] ?? $this->backgroundMap['base-100'];
    }
}; ?>

<div
    class="card {{ $this->getBackgroundClass() }} {{ $shadow ? 'shadow-md' : 'shadow-none' }} {{ $hoverable ? 'hover:shadow-lg transition-shadow cursor-pointer' : '' }} {{ $glass ? 'glass' : '' }} {{ $compact ? 'compact' : '' }} {{ $borderColor ? 'border border-' . $borderColor : '' }} {{ $containerClass }}"
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($image)
        <figure class="relative h-64 overflow-hidden">
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt }}"
                class="w-full h-full object-cover"
            />
        </figure>
    @endif

    <div class="card-body {{ $class }}">
        @if ($label)
            <div class="card-title text-lg font-bold">{{ $label }}</div>
        @endif

        @if ($title)
            <h2 class="card-title {{ !$label ? 'text-lg font-bold' : 'text-base' }}">{{ $title }}</h2>
        @endif

        @if ($subtitle)
            <p class="text-sm text-base-content/70">{{ $subtitle }}</p>
        @endif

        @if ($body)
            <div class="prose prose-sm max-w-none">
                {!! $body !!}
            </div>
        @endif

        @if ($model)
            @error($model)
                <div class="alert alert-error mt-4">
                    <span>{{ $message }}</span>
                </div>
            @enderror
        @endif

        @if (!empty($actions))
            <div class="card-actions justify-end gap-2 mt-4">
                @foreach ($actions as $action)
                    <button
                        class="btn {{ $action['variant'] ?? 'btn-primary' }} btn-sm"
                        @if (isset($action['wire'])) wire:click="{{ $action['wire'] }}" @endif
                    >
                        @if (isset($action['icon']))
                            <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                        @endif
                        {{ $action['label'] ?? 'Action' }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>
