<?php

use Livewire\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];
    public string $icon = '';
    public string $iconSide = 'left';
    public bool $vertical = false;
};

?>

@php
    // Try to translate in daisylw4, if it doesn't exist, Laravel returns the original key
    $dividerLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
@endphp

<div class="{{ trim('w-full ' . $containerClass) }}">
    <div
        @if($id) id="{{ $id }}" @endif
        class="{{ trim('divider ' . ($vertical ? 'divider-vertical ' : '') . $class) }}"
        {{ $attributes->merge($extraAttributes) }} 
    >
        @if($icon && $iconSide === 'left')
            <x-dynamic-component :component="$icon" class="h-4 w-4" />
        @endif

        @if($dividerLabel)
            <span>{{ $dividerLabel }}</span>
        @elseif(isset($slot) && trim($slot))
            <span>{{ $slot }}</span>
        @endif

        @if($icon && $iconSide === 'right')
            <x-dynamic-component :component="$icon" class="h-4 w-4" />
        @endif
    </div>

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
