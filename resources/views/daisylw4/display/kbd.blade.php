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
     * KBD specific props
     */
    public string $key = '';
    public array $keys = [];
    public string $variant = 'default';
    public string $size = 'md';

    /**
     * Variant mapping for KBD
     */
    protected array $variantMap = [
        'default' => 'kbd',
        'primary' => 'kbd kbd-primary',
        'secondary' => 'kbd kbd-secondary',
        'accent' => 'kbd kbd-accent',
        'ghost' => 'kbd kbd-ghost',
        'outline' => 'kbd kbd-outline',
    ];

    /**
     * Size mapping for KBD
     */
    protected array $sizeMap = [
        'xs' => 'kbd-xs',
        'sm' => 'kbd-sm',
        'md' => 'kbd',
        'lg' => 'kbd-lg',
    ];

    /**
     * Get variant class
     */
    public function getVariantClass(): string
    {
        return $this->variantMap[$this->variant] ?? $this->variantMap['default'];
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
        <div class="mb-2">
            <span class="text-sm font-medium">{{ $label }}</span>
        </div>
    @endif

    <div class="flex flex-wrap gap-2 items-center">
        @if (!empty($keys))
            @foreach ($keys as $k)
                <span class="{{ $this->getVariantClass() }} {{ $this->getSizeClass() }} {{ $class }}">
                    {{ $k }}
                </span>
                @if (!$loop->last)
                    <span class="text-base-content/50">+</span>
                @endif
            @endforeach
        @elseif ($key)
            <span class="{{ $this->getVariantClass() }} {{ $this->getSizeClass() }} {{ $class }}" @if ($id) id="{{ $id }}" @endif>
                {{ $key }}
            </span>
        @endif
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-2">{{ $message }}</span>
        @enderror
    @endif
</div>
