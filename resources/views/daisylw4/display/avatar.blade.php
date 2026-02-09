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
     * Avatar specific props
     */
    public string $src = '';
    public string $alt = 'Avatar';
    public string $size = 'md';
    public bool $online = false;
    public bool $offline = false;
    public bool $placeholder = false;
    public string $icon = '';
    public string $initials = '';
    public string $color = 'neutral';

    /**
     * Size mapping for DaisyUI avatar
     */
    protected array $sizeMap = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-12 h-12',
        'xl' => 'w-16 h-16',
        '2xl' => 'w-20 h-20',
    ];

    /**
     * Get the appropriate size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

<div class="flex items-center gap-2 {{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <span class="text-sm font-medium">{{ $label }}</span>
    @endif

    <div class="avatar {{ $online ? 'online' : '' }} {{ $offline ? 'offline' : '' }} {{ $class }}">
        <div class="{{ $this->getSizeClass() }} rounded-full {{ $placeholder ? 'bg-' . $color . ' flex items-center justify-center' : '' }}">
            @if ($src)
                <img
                    src="{{ $src }}"
                    alt="{{ $alt }}"
                    class="rounded-full object-cover w-full h-full"
                />
            @elseif ($initials)
                <span class="text-white font-bold text-sm">{{ $initials }}</span>
            @elseif ($icon)
                <x-dynamic-component :component="$icon" class="w-1/2 h-1/2 text-white" />
            @else
                <span class="text-white font-bold text-sm">?</span>
            @endif
        </div>
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-xs">{{ $message }}</span>
        @enderror
    @endif
</div>
