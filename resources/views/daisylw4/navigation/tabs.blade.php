<?php
/**
 * Component: navigation.tabs
 * A tabbed interface component for organizing content
 * Perfect for switching between different content sections
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Tab items
     * Structure: [
     *     ['id' => 'tab1', 'label' => 'Tab 1', 'icon' => 'heroicon-o-home', 'badge' => 5],
     *     ['id' => 'tab2', 'label' => 'Tab 2', 'badge' => null],
     *     ['id' => 'tab3', 'label' => 'Tab 3', 'disabled' => true],
     * ]
     */
    public array $tabs = [];

    /**
     * Content for each tab
     * Structure: ['tab1' => 'content here', 'tab2' => 'more content']
     * Or use $slot within component tags and specify tab names
     */
    public array $content = [];

    /**
     * Active tab ID
     */
    public string $activeTab = '';

    /**
     * Tab style: tabs (underline), boxed, bordered, lifted
     */
    public string $style = 'tabs'; // 'tabs', 'boxed', 'bordered', 'lifted'

    /**
     * Tab size: sm, md, lg
     */
    public string $size = 'md'; // 'sm', 'md', 'lg'

    /**
     * Color variant
     */
    public string $color = 'primary';

    /**
     * Show icons in tabs
     */
    public bool $showIcons = true;

    /**
     * Full width tabs
     */
    public bool $fullWidth = false;

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public string $contentClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        // Set first tab as active if not specified
        if (empty($this->activeTab) && !empty($this->tabs)) {
            $this->activeTab = $this->tabs[0]['id'] ?? '';
        }
    }

    /**
     * Activate a tab
     */
    public function activateTab(string $tabId): void
    {
        $this->activeTab = $tabId;
        $this->dispatch('tab-changed', tab: $tabId);
    }

    /**
     * Get tab style classes
     */
    public function getTabsClass(): string
    {
        $baseClass = "tabs {$this->style}";
        
        if ($this->fullWidth) {
            $baseClass .= " tabs-full";
        }

        return match($this->size) {
            'sm' => $baseClass . ' tabs-sm',
            'lg' => $baseClass . ' tabs-lg',
            default => $baseClass . ' tabs-md',
        };
    }

    /**
     * Check if tab is disabled
     */
    public function isTabDisabled(array $tab): bool
    {
        return $tab['disabled'] ?? false;
    }

    /**
     * Get tab content
     */
    public function getTabContent(string $tabId): string
    {
        return $this->content[$tabId] ?? '';
    }
}; ?>

<div class="{{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <!-- Tabs Header -->
    <div class="{{ $this->getTabsClass() }} {{ $class }}">
        @foreach($tabs as $tab)
            @php
                $tabId = $tab['id'] ?? '';
                $isActive = $tabId === $this->activeTab;
                $isDisabled = $this->isTabDisabled($tab);
            @endphp

            <button
                type="button"
                wire:click="activateTab('{{ $tabId }}')"
                @disabled($isDisabled)
                class="tab gap-2 {{ $isActive ? 'tab-active' : '' }} {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            >
                @if($showIcons && ($tab['icon'] ?? false))
                    <x-dynamic-component :component="$tab['icon']" class="w-4 h-4" />
                @endif

                <span>{{ __($tab['label'] ?? '') }}</span>

                @if(($tab['badge'] ?? 0) > 0)
                    <span class="badge badge-sm badge-{{ $color }}">
                        {{ $tab['badge'] }}
                    </span>
                @endif
            </button>
        @endforeach
    </div>

    <!-- Tabs Content -->
    <div class="mt-4 p-4 bg-base-100 rounded-lg border border-base-300 {{ $contentClass }}">
        @foreach($tabs as $tab)
            @php
                $tabId = $tab['id'] ?? '';
                $isActive = $tabId === $this->activeTab;
            @endphp

            <div 
                class="tab-content {{ $isActive ? '' : 'hidden' }}"
                id="content-{{ $tabId }}"
            >
                @if(!empty($this->content[$tabId]))
                    {{ $this->content[$tabId] }}
                @else
                    <!-- Slot content can be added here -->
                    {{ $slot }}
                @endif
            </div>
        @endforeach
    </div>
</div>
