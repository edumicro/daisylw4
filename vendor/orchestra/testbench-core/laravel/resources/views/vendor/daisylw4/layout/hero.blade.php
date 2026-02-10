<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];
    public string $icon = '';
    public string $iconSide = 'left';
    public string $bgImage = ''; // Background image URL
    public bool $overlay = false; // Show dark overlay
    public string $overlayClass = 'hero-overlay bg-opacity-60'; // Overlay customization
    public string $contentClass = ''; // Custom classes for hero-content
    public string $minHeight = 'min-h-screen'; // Minimum height
};

?>

@php
    // Translation logic
    $heroLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Build hero classes
    $heroClasses = trim(implode(' ', array_filter([
        'hero',
        $minHeight,
        $containerClass
    ])));
    
    // Build content classes
    $contentClasses = trim(implode(' ', array_filter([
        'hero-content',
        'text-center',
        $contentClass,
        $class
    ])));
@endphp

<div 
    @if($id) id="{{ $id }}" @endif
    class="{{ $heroClasses }}"
    @if($bgImage)
        style="background-image: url({{ $bgImage }});"
    @endif
    @foreach($extraAttributes as $attr => $value)
        {{ $attr }}="{{ $value }}"
    @endforeach
>
    @if($overlay && $bgImage)
        <div class="{{ $overlayClass }}"></div>
    @endif
    
    <div class="{{ $contentClasses }}">
        @if($heroLabel || $icon)
            <div class="flex items-center gap-2 justify-center mb-4">
                @if($icon && $iconSide === 'left')
                    <x-dynamic-component :component="$icon" class="h-8 w-8" />
                @endif

                @if($heroLabel)
                    <h1 class="text-5xl font-bold">{{ $heroLabel }}</h1>
                @endif

                @if($icon && $iconSide === 'right')
                    <x-dynamic-component :component="$icon" class="h-8 w-8" />
                @endif
            </div>
        @endif

        {{ $slot }}
    </div>

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
