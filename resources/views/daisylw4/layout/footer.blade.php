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
    public bool $center = false;
    public string $direction = 'vertical'; // vertical, horizontal
    public string $bgClass = 'bg-base-200 text-base-content'; // Background and text color classes
};

?>

@php
    // Translation logic
    $footerLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Build footer classes
    $footerClasses = trim(implode(' ', array_filter([
        'footer',
        $bgClass,
        $center ? 'footer-center' : '',
        $direction === 'horizontal' ? 'footer-horizontal' : 'footer-vertical',
        'p-10',
        $class
    ])));
@endphp

<footer 
    @if($id) id="{{ $id }}" @endif
    class="{{ $footerClasses }}"
    @foreach($extraAttributes as $attr => $value)
        {{ $attr }}="{{ $value }}"
    @endforeach
>
    @if($footerLabel || $icon)
        <div class="flex items-center gap-2">
            @if($icon && $iconSide === 'left')
                <x-dynamic-component :component="$icon" class="h-6 w-6" />
            @endif

            @if($footerLabel)
                <span class="footer-title">{{ $footerLabel }}</span>
            @endif

            @if($icon && $iconSide === 'right')
                <x-dynamic-component :component="$icon" class="h-6 w-6" />
            @endif
        </div>
    @endif

    {{ $slot }}

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</footer>
