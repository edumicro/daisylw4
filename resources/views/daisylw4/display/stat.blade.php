<?php

use Livewire\Component;

new class extends Component {
    public string $title = '';
    public string $value = '';
    public string $description = '';
    public string $icon = '';
    public string $unit = '';
    public string $trend = '';
    public string $trendValue = '';
    public string $backgroundColor = '';
    public bool $shadow = true;

    public function mount(
        string $title = '',
        string $value = '0',
        string $description = '',
        string $icon = '',
        string $unit = '',
        string $trend = '',
        string $trendValue = '',
        string $backgroundColor = 'bg-base-100',
        bool $shadow = true
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->description = $description;
        $this->icon = $icon;
        $this->unit = $unit;
        $this->trend = $trend;
        $this->trendValue = $trendValue;
        $this->backgroundColor = $backgroundColor;
        $this->shadow = $shadow;
    }
};
?>

<div class="stat {{ $backgroundColor }} rounded-box {{ $shadow ? 'shadow-sm border border-base-200' : '' }}">
    @if($icon)
        <div class="stat-figure text-primary">
            <x-flow::icon :name="$icon" class="w-8 h-8" />
        </div>
    @endif

    <div class="stat-title">{{ $title }}</div>

    <div class="stat-value text-primary">
        {{ $value }}
        @if($unit)
            <span class="text-sm font-normal">{{ $unit }}</span>
        @endif
    </div>

    @if($description || ($trend && $trendValue))
        <div class="stat-desc mt-1">
            @if($trend && $trendValue)
                <span class="inline-flex items-center gap-1 {{ $trend === 'up' ? 'text-success' : 'text-error' }}">
                    <x-flow::icon :name="$trend === 'up' ? 'arrow-trending-up' : 'arrow-trending-down'" class="w-4 h-4" />
                    {{ $trendValue }}
                </span>
            @endif
            @if($description)
                <span class="ml-1">{{ $description }}</span>
            @endif
        </div>
    @endif
</div>