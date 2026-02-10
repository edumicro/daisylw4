<?php
/**
 * Component: navigation.menu
 * A comprehensive menu component with nested items, collapse, and customization
 * Perfect for sidebars, dropdowns, and navigation menus
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Menu items
     * Structure: [
     *     ['label' => 'Item 1', 'route' => 'home', 'icon' => 'heroicon-o-home', 'active' => true],
     *     ['type' => 'divider'], // Divider
     *     ['type' => 'title', 'label' => 'Section Title'],
     *     [
     *         'label' => 'Parent Item',
     *         'icon' => 'heroicon-o-cog',
     *         'collapsible' => true,
     *         'collapsed' => false,
     *         'children' => [
     *             ['label' => 'Child 1', 'route' => 'child1'],
     *             ['label' => 'Child 2', 'route' => 'child2'],
     *             [
     *                 'label' => 'Nested Parent',
     *                 'collapsible' => true,
     *                 'collapsed' => true,
     *                 'children' => [
     *                     ['label' => 'Nested Item', 'route' => 'nested'],
     *                 ]
     *             ]
     *         ]
     *     ],
     *     ['label' => 'Disabled Item', 'disabled' => true],
     *     ['label' => 'Item with Badge', 'route' => 'inbox', 'badge' => '99+', 'badgeColor' => 'error'],
     * ]
     */
    public array $items = [];

    /**
     * Size: xs, sm, md, lg, xl
     */
    public string $size = 'md'; // 'xs', 'sm', 'md', 'lg', 'xl'

    /**
     * Direction: vertical or horizontal
     */
    public string $direction = 'vertical'; // 'vertical', 'horizontal'

    /**
     * Show icons
     */
    public bool $showIcons = true;

    /**
     * Compact mode (no padding/border)
     */
    public bool $compact = false;

    /**
     * Full width
     */
    public bool $fullWidth = false;

    /**
     * Collapsed menu items (for collapsible items)
     */
    public array $collapsedItems = [];

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
     * Get menu size class
     */
    public function getSizeClass(): string
    {
        return match($this->size) {
            'xs' => 'menu-xs',
            'sm' => 'menu-sm',
            'lg' => 'menu-lg',
            'xl' => 'menu-xl',
            default => 'menu-md',
        };
    }

    /**
     * Get menu direction class
     */
    public function getDirectionClass(): string
    {
        return $this->direction === 'horizontal' ? 'menu-horizontal' : 'menu-vertical';
    }

    /**
     * Toggle collapsible item
     */
    public function toggleCollapsible(string $itemKey): void
    {
        if (in_array($itemKey, $this->collapsedItems)) {
            $this->collapsedItems = array_filter($this->collapsedItems, fn($k) => $k !== $itemKey);
        } else {
            $this->collapsedItems[] = $itemKey;
        }
        $this->dispatch('menu-toggle', item: $itemKey);
    }

    /**
     * Check if item is collapsed
     */
    public function isCollapsed(string $itemKey): bool
    {
        return in_array($itemKey, $this->collapsedItems);
    }

    /**
     * Check if item is collapsible
     */
    public function isCollapsible(array $item): bool
    {
        return ($item['collapsible'] ?? false) && !empty($item['children'] ?? []);
    }

    /**
     * Render menu item recursively
     */
    public function renderMenuItem(array $item, string $parentKey = ''): string
    {
        $itemType = $item['type'] ?? 'item';

        if ($itemType === 'divider') {
            return '<li class="menu-title"><hr></li>';
        }

        if ($itemType === 'title') {
            return '<li class="menu-title"><span>' . __($item['label'] ?? '') . '</span></li>';
        }

        return ''; // Items are rendered in template
    }
}; ?>

<ul class="menu {{ $this->getSizeClass() }} {{ $this->getDirectionClass() }} {{ $fullWidth ? 'w-full' : '' }} {{ $compact ? '' : 'bg-base-100 rounded-lg' }} {{ $class }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    @foreach($items as $index => $item)
        @php
            $itemType = $item['type'] ?? 'item';
            $itemKey = "{$index}";
            $isCollapsed = $this->isCollapsed($itemKey);
            $isCollapsible = $this->isCollapsible($item);
        @endphp

        @if($itemType === 'divider')
            <li class="menu-title"><hr></li>

        @elseif($itemType === 'title')
            <li class="menu-title"><span>{{ __($item['label'] ?? '') }}</span></li>

        @else
            <!-- Regular Item or Collapsible Item -->
            <li class="{{ $item['disabled'] ?? false ? 'disabled' : '' }}">
                @if($isCollapsible)
                    <!-- Collapsible Item -->
                    <details @if(!($item['collapsed'] ?? true)) open @endif>
                        <summary
                            wire:click="toggleCollapsible('{{ $itemKey }}')"
                            class="@if($item['active'] ?? false) menu-active @endif"
                        >
                            @if($showIcons && ($item['icon'] ?? false))
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4" />
                            @endif
                            <span>{{ __($item['label'] ?? '') }}</span>

                            @if(($item['badge'] ?? false))
                                <span class="badge badge-sm badge-{{ $item['badgeColor'] ?? 'primary' }}">
                                    {{ $item['badge'] }}
                                </span>
                            @endif

                            <svg class="transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </summary>

                        <ul class="ml-2">
                            @foreach($item['children'] ?? [] as $childIndex => $child)
                                @php
                                    $childKey = "{$itemKey}-{$childIndex}";
                                    $childIsCollapsed = $this->isCollapsed($childKey);
                                    $childIsCollapsible = $this->isCollapsible($child);
                                @endphp

                                <li class="{{ $child['disabled'] ?? false ? 'disabled' : '' }}">
                                    @if($childIsCollapsible)
                                        <!-- Nested Collapsible Item -->
                                        <details @if(!($child['collapsed'] ?? true)) open @endif>
                                            <summary
                                                wire:click="toggleCollapsible('{{ $childKey }}')"
                                                class="@if($child['active'] ?? false) menu-active @endif"
                                            >
                                                @if($showIcons && ($child['icon'] ?? false))
                                                    <x-dynamic-component :component="$child['icon']" class="w-4 h-4" />
                                                @endif
                                                <span>{{ __($child['label'] ?? '') }}</span>

                                                @if(($child['badge'] ?? false))
                                                    <span class="badge badge-sm badge-{{ $child['badgeColor'] ?? 'primary' }}">
                                                        {{ $child['badge'] }}
                                                    </span>
                                                @endif

                                                <svg class="transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </summary>

                                            <ul class="ml-2">
                                                @foreach($child['children'] ?? [] as $nestedChild)
                                                    <li class="{{ $nestedChild['disabled'] ?? false ? 'disabled' : '' }}">
                                                        @if(($nestedChild['route'] ?? false))
                                                            <a
                                                                href="{{ route($nestedChild['route']) }}"
                                                                class="@if($nestedChild['active'] ?? false) menu-active @endif"
                                                            >
                                                                @if($showIcons && ($nestedChild['icon'] ?? false))
                                                                    <x-dynamic-component :component="$nestedChild['icon']" class="w-4 h-4" />
                                                                @endif
                                                                <span>{{ __($nestedChild['label'] ?? '') }}</span>

                                                                @if(($nestedChild['badge'] ?? false))
                                                                    <span class="badge badge-sm badge-{{ $nestedChild['badgeColor'] ?? 'primary' }}">
                                                                        {{ $nestedChild['badge'] }}
                                                                    </span>
                                                                @endif
                                                            </a>
                                                        @else
                                                            <button type="button" wire:click="$dispatch('{{ $nestedChild['action'] ?? '' }}')">
                                                                @if($showIcons && ($nestedChild['icon'] ?? false))
                                                                    <x-dynamic-component :component="$nestedChild['icon']" class="w-4 h-4" />
                                                                @endif
                                                                <span>{{ __($nestedChild['label'] ?? '') }}</span>

                                                                @if(($nestedChild['badge'] ?? false))
                                                                    <span class="badge badge-sm badge-{{ $nestedChild['badgeColor'] ?? 'primary' }}">
                                                                        {{ $nestedChild['badge'] }}
                                                                    </span>
                                                                @endif
                                                            </button>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    @else
                                        <!-- Regular Child Item -->
                                        @if(($child['route'] ?? false))
                                            <a
                                                href="{{ route($child['route']) }}"
                                                class="@if($child['active'] ?? false) menu-active @endif"
                                            >
                                                @if($showIcons && ($child['icon'] ?? false))
                                                    <x-dynamic-component :component="$child['icon']" class="w-4 h-4" />
                                                @endif
                                                <span>{{ __($child['label'] ?? '') }}</span>

                                                @if(($child['badge'] ?? false))
                                                    <span class="badge badge-sm badge-{{ $child['badgeColor'] ?? 'primary' }}">
                                                        {{ $child['badge'] }}
                                                    </span>
                                                @endif
                                            </a>
                                        @else
                                            <button type="button" wire:click="$dispatch('{{ $child['action'] ?? '' }}')">
                                                @if($showIcons && ($child['icon'] ?? false))
                                                    <x-dynamic-component :component="$child['icon']" class="w-4 h-4" />
                                                @endif
                                                <span>{{ __($child['label'] ?? '') }}</span>

                                                @if(($child['badge'] ?? false))
                                                    <span class="badge badge-sm badge-{{ $child['badgeColor'] ?? 'primary' }}">
                                                        {{ $child['badge'] }}
                                                    </span>
                                                @endif
                                            </button>
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </details>
                @else
                    <!-- Regular Item -->
                    @if(($item['route'] ?? false))
                        <a
                            href="{{ route($item['route']) }}"
                            class="@if($item['active'] ?? false) menu-active @endif"
                        >
                            @if($showIcons && ($item['icon'] ?? false))
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4" />
                            @endif
                            <span>{{ __($item['label'] ?? '') }}</span>

                            @if(($item['badge'] ?? false))
                                <span class="badge badge-sm badge-{{ $item['badgeColor'] ?? 'primary' }}">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    @else
                        <button type="button" wire:click="$dispatch('{{ $item['action'] ?? '' }}')">
                            @if($showIcons && ($item['icon'] ?? false))
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4" />
                            @endif
                            <span>{{ __($item['label'] ?? '') }}</span>

                            @if(($item['badge'] ?? false))
                                <span class="badge badge-sm badge-{{ $item['badgeColor'] ?? 'primary' }}">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </button>
                    @endif
                @endif
            </li>
        @endif
    @endforeach
</ul>
