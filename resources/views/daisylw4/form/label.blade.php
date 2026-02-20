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
     * Label specific props
     */
    public string $text = '';
    public string $for = '';
    public string $variant = 'default';
    public string $size = 'md';
    public bool $required = false;
    public bool $optional = false;
    public string $icon = '';
    public string $description = '';
    public string $color = '';
    public bool $bold = false;

    /**
     * Variant mapping
     */
    protected array $variantMap = [
        'default' => 'label-text',
        'primary' => 'label-text text-primary',
        'secondary' => 'label-text text-secondary',
        'accent' => 'label-text text-accent',
        'success' => 'label-text text-success',
        'warning' => 'label-text text-warning',
        'error' => 'label-text text-error',
        'info' => 'label-text text-info',
    ];

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
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

    /**
     * Get label text
     */
    public function getLabelText(): string
    {
        return $this->text ?: $this->label;
    }
}; ?>

<label
    class="label {{ $containerClass }}"
    @if ($for) for="{{ $for }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    <span class="{{ $this->getVariantClass() }} {{ $this->getSizeClass() }} {{ $bold ? 'font-bold' : 'font-medium' }} {{ $color ? 'text-' . $color : '' }} {{ $class }}">
        <div class="flex items-center gap-2">
            @if ($icon)
                <x-dynamic-component :component="$icon" class="w-4 h-4 flex-shrink-0" />
            @endif

            <span>{{ $this->getLabelText() }}</span>

            @if ($required)
                <span class="text-error font-bold" title="Required field">*</span>
            @endif

            @if ($optional)
                <span class="text-base-content/50 text-xs font-normal">({{ trans('daisylw4::optional') }})</span>
            @endif
        </div>

        @if ($description)
            <div class="text-xs text-base-content/60 font-normal mt-1 leading-relaxed">
                {{ $description }}
            </div>
        @endif
    </span>
</label>

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-1">{{ $message }}</span>
    @enderror
@endif
