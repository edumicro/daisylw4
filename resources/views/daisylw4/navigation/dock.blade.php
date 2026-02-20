<?php
/**
 * Component: navigation.dock
 * A floating dock navigation component
 * Perfect for quick access to primary actions
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Dock items
     * Structure: [
     *     [
     *         'label' => 'Home',
     *         'icon' => 'heroicon-o-home',
     *         'route' => 'home',
     *         'action' => null, // Or livewire action to dispatch
     *         'badge' => 5, // Optional notification badge
     *     ],
     *     ...
     * ]
     */
    public array $items = [];

    /**
     * Position: bottom-center (default), bottom-left, bottom-right, top-center, top-left, top-right
     */
    public string $position = 'bottom-center';

    /**
     * Direction: horizontal (default) or vertical
     */
    public string $direction = 'horizontal';

    /**
     * Show labels on hover
     */
    public bool $showLabelsOnHover = true;

    /**
     * Icon size
     */
    public string $iconSize = 'w-6 h-6';

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
     * Handle dock item click
     */
    public function handleItemClick(array $item): void
    {
        if (!empty($item['action'])) {
            $this->dispatch($item['action']);
        }
    }

    /**
     * Get position classes
     */
    public function getPositionClass(): string
    {
        return match($this->position) {
            'bottom-left' => 'bottom-0 left-0',
            'bottom-right' => 'bottom-0 right-0',
            'top-center' => 'top-0 left-1/2 -translate-x-1/2',
            'top-left' => 'top-0 left-0',
            'top-right' => 'top-0 right-0',
            default => 'bottom-0 left-1/2 -translate-x-1/2',
        };
    }

    /**
     * Get direction classes
     */
    public function getDirectionClass(): string
    {
        return $this->direction === 'vertical'
            ? 'flex-col'
            : 'flex-row';
    }
}; ?>

<div class="fixed {{ $this->getPositionClass() }} p-4 z-40 {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <div class="flex {{ $this->getDirectionClass() }} gap-2 bg-base-100 shadow-2xl rounded-full p-3 backdrop-blur-sm border border-base-300 {{ $class }}">
        @foreach($items as $item)
            <div class="relative group">
                @if($item['route'] ?? false)
                    <a
                        href="{{ route($item['route']) }}"
                        class="btn btn-ghost btn-sm btn-circle relative transition-all duration-200 hover:bg-primary hover:text-primary-content"
                        title="{{ __($item['label'] ?? '') }}"
                    >
                        <x-dynamic-component :component="$item['icon'] ?? 'heroicon-o-question-mark-circle'" class="{{ $this->iconSize }}" />
                        
                        @if(($item['badge'] ?? 0) > 0)
                            <span class="absolute -top-1 -right-1 bg-error text-error-content text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>
                @else
                    <button
                        type="button"
                        wire:click="handleItemClick({{ json_encode($item) }})"
                        class="btn btn-ghost btn-sm btn-circle relative transition-all duration-200 hover:bg-primary hover:text-primary-content"
                        title="{{ __($item['label'] ?? '') }}"
                    >
                        <x-dynamic-component :component="$item['icon'] ?? 'heroicon-o-question-mark-circle'" class="{{ $this->iconSize }}" />
                        
                        @if(($item['badge'] ?? 0) > 0)
                            <span class="absolute -top-1 -right-1 bg-error text-error-content text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </button>
                @endif

                @if($showLabelsOnHover)
                    <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                        <div class="bg-base-800 text-base-content-100 text-xs font-medium px-2 py-1 rounded whitespace-nowrap">
                            {{ __($item['label'] ?? '') }}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
