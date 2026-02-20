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
    public string $shape = 'squircle'; // squircle, heart, hexagon, hexagon-2, decagon, pentagon, diamond, square, circle, star, star-2, triangle, triangle-2, triangle-3, triangle-4
    public string $half = ''; // '', 'half-1', 'half-2'
    public string $src = ''; // Image source
    public string $alt = ''; // Image alt text
};

?>

@php
    // Translation logic
    $maskLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    $maskAlt = $alt ? (__('daisylw4::' . $alt) !== 'daisylw4::' . $alt ? __('daisylw4::' . $alt) : __($alt)) : '';
    
    // Build mask classes
    $maskClasses = trim(implode(' ', array_filter([
        'mask',
        'mask-' . $shape,
        $half ? 'mask-' . $half : '',
        $class
    ])));
@endphp

<div 
    class="{{ trim($containerClass) }}"
    @if($id && !$src) id="{{ $id }}" @endif
    @if(!$src)
        @foreach($extraAttributes as $attr => $value)
            {{ $attr }}="{{ $value }}"
        @endforeach
    @endif
>
    @if($maskLabel || $icon)
        <div class="flex items-center gap-2 mb-2">
            @if($icon && $iconSide === 'left')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif

            @if($maskLabel)
                <span class="font-semibold">{{ $maskLabel }}</span>
            @endif

            @if($icon && $iconSide === 'right')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif
        </div>
    @endif

    @if($src)
        <img 
            @if($id) id="{{ $id }}" @endif
            src="{{ $src }}" 
            @if($maskAlt) alt="{{ $maskAlt }}" @endif
            class="{{ $maskClasses }}"
            @foreach($extraAttributes as $attr => $value)
                {{ $attr }}="{{ $value }}"
            @endforeach
        />
    @else
        <div class="{{ $maskClasses }}">
            {{ $slot }}
        </div>
    @endif

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
