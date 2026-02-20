<?php
/**
 * Component: actions.button
 * A flexible button component with DaisyUI styling
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    public string $label = 'Click me';
    public string $type = 'button';
    public string $variant = 'btn-primary'; // btn-primary, btn-secondary, btn-error, btn-warning, btn-success, etc.
    public string $size = 'btn-md'; // btn-xs, btn-sm, btn-md, btn-lg
    public bool $loading = false;
    public bool $disabled = false;
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    // Icons
    public string $icon = '';
    public string $iconPosition = 'left'; // 'left' or 'right'
    public bool $iconOnly = false;

    public function mount(): void
    {
        //
    }
}; ?>

<div class="{{ $containerClass }}">
    <button
        id="{{ $id }}"
        type="{{ $type }}"
        @disabled($disabled || $loading)
        class="btn {{ $variant }} {{ $size }} {{ $class }}
               {{ $loading ? 'loading' : '' }}
               {{ $iconOnly ? 'btn-circle' : '' }}"

        wire:loading.class="btn-disabled" {{-- Optional: loading visual style --}}

        @foreach($extraAttributes as $attribute => $value)
            {{ $attribute }}="{{ $value }}"
        @endforeach
        
    >
        {{-- Automatic Spinner when Livewire is busy --}}
        <span wire:loading wire:target="{{ $type === 'submit' ? 'save' : '' }}" class="loading loading-spinner loading-xs"></span>

        {{-- Hide Icon while loading --}}
        <div wire:loading.remove wire:target="{{ $type === 'submit' ? 'save' : '' }}">

            {{-- Icon on the Left --}}
            @if($icon && $iconPosition === 'left' && !$iconOnly)
                <div class="flex items-center">
                    <x-dynamic-component :component="$icon" class="w-5 h-5 mr-2" />
                </div>
            @elseif($icon && $iconOnly)
                <x-dynamic-component :component="$icon" class="w-5 h-5" />
            @endif

            @if(!$iconOnly) <span>{{ $label }}</span> @endif

            {{-- Icon on the Right --}}
            @if($icon && $iconPosition === 'right' && !$iconOnly)
                <div class="flex items-center">
                    <x-dynamic-component :component="$icon" class="w-5 h-5 ml-2" />
                </div>
            @endif
        </div>

    </button>
</div>
