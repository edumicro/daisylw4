<?php
/**
 * Component: feedback.tooltip
 * A tooltip component for providing contextual help text
 * Can be triggered on hover or click
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Tooltip text (translatable)
     */
    public string $text = '';

    /**
     * Position: top, bottom, left, right
     */
    public string $position = 'top'; // 'top', 'bottom', 'left', 'right'

    /**
     * Trigger type: hover, click
     */
    public string $trigger = 'hover'; // 'hover', 'click'

    /**
     * Color/variant: info, success, warning, error
     */
    public string $color = 'info';

    /**
     * Icon to display (optional)
     */
    public string $icon = 'heroicon-o-question-mark-circle';

    /**
     * Show as text or icon
     */
    public string $display = 'icon'; // 'icon', 'text', 'both'

    /**
     * Custom trigger content (for slot usage)
     */
    public bool $hasSlot = false;

    /**
     * Additional styling
     */
    public string $class = '';
    public string $tooltipClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get tooltip position class
     */
    public function getPositionClass(): string
    {
        return match($this->position) {
            'bottom' => 'tooltip-bottom',
            'left' => 'tooltip-left',
            'right' => 'tooltip-right',
            default => 'tooltip-top',
        };
    }

    /**
     * Get color class
     */
    public function getColorClass(): string
    {
        return match($this->color) {
            'success' => 'text-success',
            'warning' => 'text-warning',
            'error' => 'text-error',
            default => 'text-info',
        };
    }
}; ?>

<div class="tooltip {{ $this->getPositionClass() }} {{ $tooltipClass }}" data-tip="{{ __($text) }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    @if($hasSlot)
        {{ $slot }}
    @elseif($display === 'icon')
        <x-dynamic-component :component="$icon" class="w-5 h-5 cursor-help {{ $this->getColorClass() }} {{ $class }}" />
    
    @elseif($display === 'text')
        <span class="cursor-help underline underline-offset-2 {{ $this->getColorClass() }} {{ $class }}">
            {{ __($text) }}
        </span>
    
    @else
        <!-- both -->
        <div class="flex items-center gap-1 cursor-help {{ $class }}">
            <x-dynamic-component :component="$icon" class="w-4 h-4 {{ $this->getColorClass() }}" />
            <span class="text-sm underline underline-offset-2 {{ $this->getColorClass() }}">
                {{ __($text) }}
            </span>
        </div>
    @endif
</div>
