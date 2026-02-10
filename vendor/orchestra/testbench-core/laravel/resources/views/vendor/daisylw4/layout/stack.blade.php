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
    public string $align = 'bottom'; // top, bottom, start, end
};

?>

@php
    // Translation logic
    $stackLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Build stack classes
    $stackClasses = trim(implode(' ', array_filter([
        'stack',
        $align === 'top' ? 'stack-top' : '',
        $align === 'bottom' ? 'stack-bottom' : '',
        $align === 'start' ? 'stack-start' : '',
        $align === 'end' ? 'stack-end' : '',
        $class
    ])));
@endphp

<div 
    @if($id) id="{{ $id }}" @endif
    class="{{ trim($stackClasses . ' ' . $containerClass) }}"
    @foreach($extraAttributes as $attr => $value)
        {{ $attr }}="{{ $value }}"
    @endforeach
>
    @if($stackLabel || $icon)
        <div class="flex items-center gap-2 mb-2">
            @if($icon && $iconSide === 'left')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif

            @if($stackLabel)
                <span class="font-semibold">{{ $stackLabel }}</span>
            @endif

            @if($icon && $iconSide === 'right')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif
        </div>
    @endif

    {{ $slot }}

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
