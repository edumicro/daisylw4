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
     * Status specific props
     */
    public string $status = 'pending';
    public string $text = '';
    public string $icon = '';
    public bool $pulse = false;
    public string $size = 'md';
    public string $position = 'inline';

    /**
     * Status mapping for colors and icons
     */
    protected array $statusMap = [
        'online' => [
            'color' => 'badge-success',
            'icon' => 'heroicon-o-check-circle',
            'label' => 'Online',
        ],
        'offline' => [
            'color' => 'badge-neutral',
            'icon' => 'heroicon-o-minus-circle',
            'label' => 'Offline',
        ],
        'pending' => [
            'color' => 'badge-warning',
            'icon' => 'heroicon-o-clock',
            'label' => 'Pending',
        ],
        'active' => [
            'color' => 'badge-success',
            'icon' => 'heroicon-o-check-circle',
            'label' => 'Active',
        ],
        'inactive' => [
            'color' => 'badge-base-300',
            'icon' => 'heroicon-o-minus-circle',
            'label' => 'Inactive',
        ],
        'processing' => [
            'color' => 'badge-info',
            'icon' => 'heroicon-o-arrow-path',
            'label' => 'Processing',
        ],
        'success' => [
            'color' => 'badge-success',
            'icon' => 'heroicon-o-check-circle',
            'label' => 'Success',
        ],
        'error' => [
            'color' => 'badge-error',
            'icon' => 'heroicon-o-x-circle',
            'label' => 'Error',
        ],
    ];

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'badge-xs',
        'sm' => 'badge-sm',
        'md' => 'badge',
        'lg' => 'badge-lg',
    ];

    /**
     * Get status color
     */
    public function getStatusColor(): string
    {
        return $this->statusMap[$this->status]['color'] ?? $this->statusMap['pending']['color'];
    }

    /**
     * Get status icon
     */
    public function getStatusIcon(): string
    {
        return $this->icon ?: ($this->statusMap[$this->status]['icon'] ?? 'heroicon-o-question-mark-circle');
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return $this->text ?: $this->label ?: ($this->statusMap[$this->status]['label'] ?? ucfirst($this->status));
    }

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

@if ($position === 'badge')
    <span
        class="badge {{ $this->getStatusColor() }} {{ $this->getSizeClass() }} gap-2 {{ $pulse ? 'animate-pulse' : '' }} {{ $class }}"
        @if ($id) id="{{ $id }}" @endif
        {{ $attributes->merge($extraAttributes) }}
    >
        @if (isset($statusMap[$this->status]['icon']) || $icon)
            <x-dynamic-component :component="$this->getStatusIcon()" class="w-3 h-3" />
        @endif
        {{ $this->getStatusLabel() }}
    </span>
@elseif ($position === 'dot')
    <div class="flex items-center gap-2 {{ $containerClass }}">
        <div class="flex items-center justify-center">
            <div class="w-3 h-3 rounded-full {{ $this->getStatusColor() }} {{ $pulse ? 'animate-pulse' : '' }}"></div>
        </div>
        <span class="text-sm {{ $class }}">{{ $this->getStatusLabel() }}</span>
    </div>
@else
    <!-- inline position (default) -->
    <div class="inline-flex items-center gap-2 {{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
        <span class="inline-block w-2.5 h-2.5 rounded-full {{ $this->getStatusColor() }} {{ $pulse ? 'animate-pulse' : '' }}"></span>
        <span class="text-sm font-medium {{ $class }}">{{ $this->getStatusLabel() }}</span>
    </div>
@endif

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-1">{{ $message }}</span>
    @enderror
@endif
