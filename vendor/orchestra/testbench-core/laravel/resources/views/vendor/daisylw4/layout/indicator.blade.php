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
    public string $horizontal = 'end'; // start, center, end
    public string $vertical = 'top'; // top, middle, bottom
    public string $indicatorClass = ''; // Custom classes for the indicator item
    public string $contentClass = ''; // Custom classes for the content wrapper
};

?>

@php
    // Translation logic
    $indicatorLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Build indicator item classes
    $indicatorItemClasses = trim(implode(' ', array_filter([
        'indicator-item',
        'indicator-' . $horizontal,
        'indicator-' . $vertical,
        $indicatorClass
    ])));
@endphp

<div 
    @if($id) id="{{ $id }}" @endif
    class="{{ trim('indicator ' . $containerClass) }}"
    @foreach($extraAttributes as $attr => $value)
        {{ $attr }}="{{ $value }}"
    @endforeach
>
    <span class="{{ $indicatorItemClasses }}">
        @if($icon && $iconSide === 'left')
            <x-dynamic-component :component="$icon" class="h-4 w-4" />
        @endif

        @if($indicatorLabel)
            {{ $indicatorLabel }}
        @elseif(isset($indicator))
            {{ $indicator }}
        @endif

        @if($icon && $iconSide === 'right')
            <x-dynamic-component :component="$icon" class="h-4 w-4" />
        @endif
    </span>
    
    <div class="{{ trim($contentClass . ' ' . $class) }}">
        {{ $slot }}
    </div>

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
