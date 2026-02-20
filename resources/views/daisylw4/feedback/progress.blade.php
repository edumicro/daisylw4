<?php
/**
 * Component: feedback.progress
 * A progress bar component for showing task completion
 * Perfect for file uploads, data processing, multi-step forms
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Current progress value (0-100)
     */
    public int|float $value = 0;

    /**
     * Label for the progress (translatable)
     */
    public string $label = '';

    /**
     * Show percentage text
     */
    public bool $showPercent = true;

    /**
     * Show value/max text (e.g., "50/100")
     */
    public bool $showValue = false;

    /**
     * Maximum value for progress
     */
    public int|float $max = 100;

    /**
     * Size: xs, sm, md, lg
     */
    public string $size = 'md'; // 'xs', 'sm', 'md', 'lg'

    /**
     * Color/variant: primary, secondary, accent, success, warning, error
     */
    public string $color = 'primary';

    /**
     * Animated/indeterminate progress
     */
    public bool $indeterminate = false;

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get progress bar size class
     */
    public function getSizeClass(): string
    {
        return match($this->size) {
            'xs' => 'progress-xs',
            'sm' => 'progress-sm',
            'lg' => 'progress-lg',
            default => 'progress-md',
        };
    }

    /**
     * Get color class
     */
    public function getColorClass(): string
    {
        return "progress-{$this->color}";
    }

    /**
     * Calculate percentage
     */
    public function getPercentage(): int
    {
        if ($this->indeterminate) {
            return 0;
        }
        return (int)(($this->value / $this->max) * 100);
    }
}; ?>

<div class="w-full {{ $containerClass }}">
    @if($label)
        <div class="flex justify-between items-center mb-2">
            <label class="text-sm font-medium">{{ __($label) }}</label>
            <div class="text-sm text-base-content/70">
                @if($showPercent)
                    <span class="font-semibold">{{ $this->getPercentage() }}%</span>
                @endif
                @if($showValue)
                    <span class="text-xs">{{ $this->value }}/{{ $this->max }}</span>
                @endif
            </div>
        </div>
    @endif

    <progress
        class="progress {{ $this->getSizeClass() }} {{ $this->getColorClass() }} w-full {{ $class }}
               {{ $this->indeterminate ? 'progress-indeterminate' : '' }}"
        value="{{ $this->indeterminate ? null : $this->value }}"
        max="{{ $this->max }}"
        @foreach($extraAttributes as $attribute => $attributeValue)
            {{ $attribute }}="{{ $attributeValue }}"
        @endforeach
    ></progress>
</div>
