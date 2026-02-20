<?php
/**
 * Component: actions.swap
 * A toggle swap component that alternates between two states with icons or labels
 * Useful for theme switchers, show/hide, expand/collapse
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * The model to bind the swap state (boolean)
     */
    public string $model = '';

    /**
     * Icon for the "off" state
     */
    public string $offIcon = 'heroicon-o-moon';

    /**
     * Icon for the "on" state
     */
    public string $onIcon = 'heroicon-o-sun';

    /**
     * Label for the "off" state (translatable)
     */
    public string $offLabel = '';

    /**
     * Label for the "on" state (translatable)
     */
    public string $onLabel = '';

    /**
     * Toggle animation (rotate, flip, bounce)
     */
    public string $animation = 'rotate'; // 'rotate', 'flip', 'bounce'

    /**
     * Button styling
     */
    public string $variant = 'btn-ghost'; // btn-primary, btn-ghost, btn-outline, etc.
    public string $size = 'btn-md'; // btn-xs, btn-sm, btn-md, btn-lg
    public bool $disabled = false;

    /**
     * Additional customization
     */
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get animation classes
     */
    public function getAnimationClass(): string
    {
        return match($this->animation) {
            'flip' => 'swap-flip',
            'bounce' => 'swap-bounce',
            default => 'swap-rotate',
        };
    }
}; ?>

<div class="swap swap-animate {{ $this->getAnimationClass() }} {{ $containerClass }}">
    <input
        type="checkbox"
        wire:model.live="{{ $model }}"
        @disabled($disabled)
    />

    <!-- Off State (Default) -->
    <div class="swap-off">
        <button
            type="button"
            @disabled($disabled)
            class="btn {{ $variant }} {{ $size }} {{ $class }}
                   @error($model) btn-error @enderror"
            @foreach($extraAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}"
            @endforeach
        >
            @if($offIcon)
                <x-dynamic-component :component="$offIcon" class="w-5 h-5" />
            @endif

            @if($offLabel)
                <span class="ml-2">{{ __($offLabel) }}</span>
            @endif
        </button>
    </div>

    <!-- On State -->
    <div class="swap-on">
        <button
            type="button"
            @disabled($disabled)
            class="btn {{ $variant }} {{ $size }} {{ $class }}
                   @error($model) btn-error @enderror"
            @foreach($extraAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}"
            @endforeach
        >
            @if($onIcon)
                <x-dynamic-component :component="$onIcon" class="w-5 h-5" />
            @endif

            @if($onLabel)
                <span class="ml-2">{{ __($onLabel) }}</span>
            @endif
        </button>
    </div>
</div>

@error($model)
    <label class="label p-0 mt-1">
        <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
    </label>
@enderror
