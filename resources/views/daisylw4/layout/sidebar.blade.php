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
    public string $position = 'left'; // left, right
    public bool $open = false;
    public string $backdrop = 'true'; // true, false, or 'visible'
    public string $responsive = ''; // '', 'sm:drawer-open', 'md:drawer-open', 'lg:drawer-open', 'xl:drawer-open'
    public string $sidebarClass = ''; // Custom classes for sidebar content
    public string $contentClass = ''; // Custom classes for content wrapper
};

?>

@php
    // Translation logic
    $sidebarLabel = $label ? (__('daisylw4::' . $label) !== 'daisylw4::' . $label ? __('daisylw4::' . $label) : __($label)) : '';
    
    // Determine drawer position class
    $positionClass = match($position) {
        'right' => 'drawer-end',
        default => '',
    };
    
    // Build drawer classes
    $drawerClasses = trim(implode(' ', array_filter([
        'drawer',
        $positionClass,
        $responsive, // lg:drawer-open, md:drawer-open, etc.
        $open ? 'drawer-open' : '',
        $containe && !$responsive) checked @endif
        @if($model) wire:model.live="{{ $model }}" @endif
    />

    <div class="{{ trim('drawer-content ' . $contentClass . ' ' . $class)
    <input 
        @if($id) id="{{ $id }}" @else id="sidebar-toggle" @endif
        type="checkbox" 
        class="drawer-toggle"
        @if($open) checked @endif
        wire:model.live="{{ $model }}"
    />

    <div class="drawer-content {{ $class }}">
        <!-- Main content area -->
        {{ $slot }}
    </div>

    <div class="drawer-side">
        @if($backdrop === 'true')
            <label 
                for="{{ $id ?: 'sidebar-toggle' }}" 
                aria-label="close sidebar" 
                class="drawer-overlay"
            ></label>
        @elseif($backdrop === 'visible')
            <label 
                for="{{ $id ?: 'sidebar-toggle' }}" 
                aria-label="close sidebar" 
                class="drawer-overlay bg-black/50"
            ></label>
        @endif

        <aside 
            class="{{ trim('menu bg-base-200 text-base-content min-h-full w-80 p-4 ' . $sidebarClass) }}"
            @foreach($extraAttributes as $attr => $value)
                {{ $attr }}="{{ $value }}"
            @endforeach
        >
            @if($sidebarLabel || $icon)
                <div class="flex items-center gap-2 mb-4 px-4 py-2">
                    @if($icon && $iconSide === 'left')
                        <x-dynamic-component :component="$icon" class="h-6 w-6" />
                    @endif

                    @if($sidebarLabel)
                        <h2 class="text-xl font-bold">{{ $sidebarLabel }}</h2>
                    @endif

                    @if($icon && $iconSide === 'right')
                        <x-dynamic-component :component="$icon" class="h-6 w-6" />
                    @endif
                </div>
            @endif

            <!-- Sidebar content -->
            @isset($sidebar)
                {{ $sidebar }}
            @endisset
        </aside>
    </div>

    @error($model)
        <p class="mt-1 text-sm text-error">{{ $message }}</p>
    @enderror
</div>
