<?php
/**
 * Component: actions.fab
 * A Floating Action Button (FAB) component with DaisyUI styling
 * Supports icons, labels, and action dispatch
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    public string $icon = 'heroicon-o-plus'; // Icon component name
    public string $label = '';
    public string $tooltip = ''; // Translatable tooltip text
    public string $action = ''; // Livewire action to dispatch
    public array $actionParams = []; // Parameters for the action
    public string $variant = 'btn-primary'; // DaisyUI button variant
    public string $size = 'btn-lg'; // btn-sm, btn-md, btn-lg
    public string $position = 'bottom-right'; // bottom-right, bottom-left, top-right, top-left
    public bool $disabled = false;
    public string $id = '';
    public string $class = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Handle FAB click action
     */
    public function handleClick(): void
    {
        if (!empty($this->action)) {
            $this->dispatch($this->action, ...$this->actionParams);
        }
    }
}; ?>

<div class="fixed {{ $position }} p-6 z-40">
    <div class="tooltip tooltip-left" @if($tooltip) data-tip="{{ __($tooltip) }}" @endif>
        <button
            id="{{ $id }}"
            wire:click="handleClick"
            @disabled($disabled)
            class="btn btn-circle {{ $variant }} {{ $size }} shadow-lg {{ $class }}
                   transition-all duration-200 hover:shadow-xl"
            @foreach($extraAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}"
            @endforeach
        >
            <x-dynamic-component :component="$icon" class="w-6 h-6" />
            
            @if($label)
                <span class="ml-2">{{ __($label) }}</span>
            @endif
        </button>
    </div>
</div>
