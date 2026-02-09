<?php
/**
 * Component: navigation.breadcrumb
 * A breadcrumb navigation component for showing hierarchy
 * Perfect for showing user location in site structure
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Breadcrumb items
     * Structure: [
     *     ['label' => 'Home', 'route' => 'home', 'icon' => 'heroicon-o-home'],
     *     ['label' => 'Products', 'route' => 'products'],
     *     ['label' => 'Current Page'], // Last item, no route = not clickable
     * ]
     */
    public array $items = [];

    /**
     * Separator between items
     */
    public string $separator = '/';

    /**
     * Show home icon for first item
     */
    public bool $showHomeIcon = true;

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Check if item is the last one
     */
    public function isLast(int $index): bool
    {
        return $index === count($this->items) - 1;
    }
}; ?>

<nav class="text-sm breadcrumbs {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <ul class="flex items-center gap-2 {{ $class }}">
        @foreach($items as $index => $item)
            <li>
                @if($isLast($index))
                    <!-- Active/Current Page -->
                    <span class="text-base-content font-medium">
                        @if($item['icon'] ?? false)
                            <x-dynamic-component :component="$item['icon']" class="w-4 h-4 inline-block mr-1" />
                        @endif
                        {{ __($item['label'] ?? '') }}
                    </span>
                @else
                    <!-- Clickable Item -->
                    @if($item['route'] ?? false)
                        <a href="{{ route($item['route']) }}" class="link link-hover text-base-content/70">
                            @if($showHomeIcon && $index === 0 && ($item['icon'] ?? false))
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4 inline-block mr-1" />
                            @endif
                            {{ __($item['label'] ?? '') }}
                        </a>
                    @else
                        <span class="text-base-content/70">
                            @if($showHomeIcon && $index === 0 && ($item['icon'] ?? false))
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4 inline-block mr-1" />
                            @endif
                            {{ __($item['label'] ?? '') }}
                        </span>
                    @endif
                @endif
            </li>

            @if(!$isLast($index))
                <li class="text-base-content/50">{{ $separator }}</li>
            @endif
        @endforeach
    </ul>
</nav>
