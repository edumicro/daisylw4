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
     * Stat specific props
     */
    public string $title = '';
    public string $value = '';
    public string $description = '';
    public string $icon = '';
    public string $unit = '';
    public string $trend = '';
    public string $trendValue = '';
    public bool $shadow = true;
    public string $backgroundColor = 'bg-base-100';

    /**
     * Check if trend is positive
     */
    public function isTrendPositive(): bool
    {
        return strtolower($this->trend) === 'up';
    }

    /**
     * Get trend icon
     */
    public function getTrendIcon(): string
    {
        return $this->isTrendPositive() ? '↑' : '↓';
    }

    /**
     * Get trend color
     */
    public function getTrendColor(): string
    {
        return $this->isTrendPositive() ? 'text-success' : 'text-error';
    }
}; ?>

<div
    class="stat {{ $shadow ? 'shadow' : '' }} {{ $backgroundColor }} rounded-lg p-6 {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    <div class="flex items-start justify-between mb-4">
        <div class="flex-1">
            @if ($title)
                <div class="stat-title text-sm text-base-content/70 font-medium">{{ $title ?: $label }}</div>
            @endif

            <div class="stat-value {{ $class }} text-3xl font-bold mt-2">
                {{ $value }}
                @if ($unit)
                    <span class="text-lg font-normal text-base-content/60">{{ $unit }}</span>
                @endif
            </div>

            @if ($description)
                <div class="stat-desc text-xs text-base-content/60 mt-2">{{ $description }}</div>
            @endif
        </div>

        @if ($icon)
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-base-200/50">
                <x-dynamic-component :component="$icon" class="w-8 h-8 text-base-content/40" />
            </div>
        @endif
    </div>

    @if ($trend)
        <div class="flex items-center gap-1 mt-4">
            <span class="text-xs font-semibold {{ $this->getTrendColor() }}">
                {{ $this->getTrendIcon() }} {{ $trendValue }}
            </span>
            <span class="text-xs text-base-content/60">
                {{ strtolower($this->trend) === 'up' ? trans('daisylw4::increase') : trans('daisylw4::decrease') }}
            </span>
        </div>
    @endif
</div>

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-2">{{ $message }}</span>
    @enderror
@endif
