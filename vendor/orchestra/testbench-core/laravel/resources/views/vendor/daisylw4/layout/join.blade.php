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
    public string $direction = 'horizontal'; // horizontal, vertical
    public string $responsive = ''; // e.g., 'join-vertical lg:join-horizontal'
};

?>

@php
    // Translation logic
    $joinLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Build join classes
    $joinClasses = trim(implode(' ', array_filter([
        'join',
        $responsive ?: ($direction === 'vertical' ? 'join-vertical' : 'join-horizontal'),
        $class
    ])));
@endphp

<div 
    class="{{ trim($containerClass) }}"
>
    @if($joinLabel || $icon)
        <div class="flex items-center gap-2 mb-2">
            @if($icon && $iconSide === 'left')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif

            @if($joinLabel)
                <span class="font-semibold">{{ $joinLabel }}</span>
            @endif

            @if($icon && $iconSide === 'right')
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            @endif
        </div>
    @endif

    <div 
        @if($id) id="{{ $id }}" @endif
        class="{{ $joinClasses }}"
        @foreach($extraAttributes as $attr => $value)
            {{ $attr }}="{{ $value }}"
        @endforeach
    >
        {{ $slot }}
    </div>

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
