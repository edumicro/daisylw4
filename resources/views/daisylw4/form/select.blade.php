<?php

use Livewire\Component;
use Livewire\Volt\Component as VoltComponent;

new class extends VoltComponent {
    /**
     * Mandatory standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Select specific props
     */
    public array $options = [];
    public bool $disabled = false;
    public string $placeholder = '';
    public bool $multiple = false;
    public bool $searchable = true;
    public bool $clearable = true;
    public bool $lazy = false;
    public string $searchQuery = '';
    public bool $isOpen = false;
    public array $filteredOptions = [];
    public int $debounceMs = 300;
    public string $size = 'md';
    public bool $showCount = true;
    public string $icon = 'heroicon-o-chevron-down';
    public int $maxResults = 10;
    public bool $loading = false;
    public string $noResultsText = '';
    public string $loadingText = '';

    /**
     * Lifecycle hook - mount
     */
    public function mount(): void
    {
        $this->filteredOptions = $this->options;
        $this->placeholder = $this->placeholder ?: trans('daisylw4::select_option');
        $this->noResultsText = $this->noResultsText ?: trans('daisylw4::no_results');
        $this->loadingText = $this->loadingText ?: trans('daisylw4::searching');
    }

    /**
     * Toggle dropdown open state
     */
    public function toggleOpen(): void
    {
        if (!$this->disabled) {
            $this->isOpen = !$this->isOpen;
            if ($this->isOpen && $this->searchable) {
                // Focus search input when opened
            }
        }
    }

    /**
     * Close dropdown
     */
    public function closeDropdown(): void
    {
        $this->isOpen = false;
    }

    /**
     * Handle search input with debounce
     */
    #[\Livewire\Attributes\On('search')]
    public function search(string $query): void
    {
        $this->searchQuery = $query;

        if ($this->lazy) {
            $this->loading = true;
            // Simulate lazy load - in real app, this would call an API
            $this->filterLazyOptions($query);
            $this->loading = false;
        } else {
            $this->filterOptions($query);
        }
    }

    /**
     * Filter options based on search query
     */
    protected function filterOptions(string $query): void
    {
        if (empty($query)) {
            $this->filteredOptions = $this->options;
            return;
        }

        $query = strtolower($query);
        $filtered = [];

        foreach ($this->options as $key => $value) {
            if (is_array($value)) {
                // Handle optgroups
                $groupFiltered = [];
                foreach ($value as $subKey => $subLabel) {
                    if (strpos(strtolower($subLabel), $query) !== false || strpos(strtolower($subKey), $query) !== false) {
                        $groupFiltered[$subKey] = $subLabel;
                    }
                }
                if (!empty($groupFiltered)) {
                    $filtered[$key] = $groupFiltered;
                }
            } else {
                // Handle regular options
                if (strpos(strtolower($value), $query) !== false || strpos(strtolower($key), $query) !== false) {
                    $filtered[$key] = $value;
                }
            }
        }

        $this->filteredOptions = $filtered;
    }

    /**
     * Filter options for lazy loading (server-side)
     * Override this method in child components for actual server-side search
     */
    protected function filterLazyOptions(string $query): void
    {
        // This method should be overridden in implementations
        // Example: call API endpoint, database query, etc.
        $this->filterOptions($query);
    }

    /**
     * Select an option
     */
    public function selectOption(string|int $value): void
    {
        
        $currentValue = data_get($this, $this->model);

        if ($this->multiple) {
            $values = is_string($currentValue) ? explode(',', $currentValue) : (array)$currentValue;
            $values = array_filter($values); // Limpiar vacíos

            if (in_array($value, $values)) {
                $values = array_filter($values, fn($v) => $v != $value);
            } else {
                $values[] = $value;
            }
            
            $newValue = implode(',', $values);
        } else {
            $newValue = $value;
            $this->closeDropdown();
        }

        
        // Update the model value
        $this->fill([$this->model => $newValue]);
        
        // Optional: trigger event for immediate validation
        $this->dispatch('input', $newValue); 

        $this->searchQuery = '';
        $this->filteredOptions = $this->options;
    }

    /**
     * Clear selection
     */
    public function clearSelection(): void
    {
        $this->$this->model = $this->multiple ? '' : '';
        $this->searchQuery = '';
        $this->filteredOptions = $this->options;
    }

    /**
     * Remove single item from multiple selection
     */
    public function removeItem(string|int $value): void
    {
        if ($this->multiple) {
            $currentValue = explode(',', $this->$this->model ?? '');
            $currentValue = array_filter($currentValue, fn($v) => $v !== $value);
            $this->$this->model = implode(',', $currentValue);
        }
    }

    /**
     * Get selected values for display
     */
    public function getSelectedLabels(): array
    {
        if (empty($this->$this->model)) {
            return [];
        }

        $values = $this->multiple ? explode(',', $this->$this->model) : [$this->$this->model];
        $labels = [];

        foreach ($this->options as $key => $option) {
            if (is_array($option)) {
                foreach ($option as $subKey => $subLabel) {
                    if (in_array($subKey, $values)) {
                        $labels[] = $subLabel;
                    }
                }
            } else {
                if (in_array($key, $values)) {
                    $labels[] = $option;
                }
            }
        }

        return $labels;
    }

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'input-xs',
        'sm' => 'input-sm',
        'md' => 'input',
        'lg' => 'input-lg',
    ];

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

<div
    class="form-control w-full {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
    x-data="{ open: @entangle('isOpen') }"
    @click.away="open = false"
>
    @if ($label)
        <label class="label">
            <span class="label-text font-medium">{{ $label }}</span>
        </label>
    @endif

    <div class="relative">
        <!-- Select button / Display -->
        <button
            type="button"
            wire:click="toggleOpen"
            @disabled($disabled)
            class="input input-bordered {{ $this->getSizeClass() }} w-full text-left flex items-center justify-between pr-3 {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:border-primary' }} {{ $this->getSelectedLabels() ? '' : 'text-base-content/50' }} {{ $class }} @error($model) input-error @enderror"
        >
            <!-- Selected values -->
            <span class="flex items-center gap-2 flex-1 min-w-0">
                @if ($multiple && !empty($this->$this->model))
                    <div class="flex flex-wrap gap-1 flex-1">
                        @foreach ($this->getSelectedLabels() as $label)
                            <span class="badge badge-primary gap-1 text-xs">
                                {{ $label }}
                                <button
                                    type="button"
                                    wire:click.stop="removeItem('{{ $label }}')"
                                    class="hover:opacity-70"
                                >
                                    ✕
                                </button>
                            </span>
                        @endforeach
                    </div>
                @elseif (!empty($this->$this->model))
                    <span class="truncate">{{ implode(', ', $this->getSelectedLabels()) }}</span>
                @else
                    <span class="text-base-content/50">{{ $placeholder }}</span>
                @endif
            </span>

            <!-- Icons -->
            <div class="flex items-center gap-1 flex-shrink-0">
                @if ($clearable && !empty($this->$this->model) && !$disabled)
                    <button
                        type="button"
                        wire:click.stop="clearSelection"
                        class="btn btn-ghost btn-xs"
                        title="{{ trans('daisylw4::clear_selection') }}"
                    >
                        ✕
                    </button>
                @endif

                <x-dynamic-component
                    :component="$icon"
                    class="w-4 h-4 transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
                />
            </div>
        </button>

        <!-- Dropdown menu -->
        @if ($isOpen && !$disabled)
            <div class="absolute top-full left-0 right-0 mt-1 z-50 bg-base-100 border border-base-300 rounded-lg shadow-lg max-h-64 overflow-hidden flex flex-col">
                <!-- Search input -->
                @if ($searchable)
                    <div class="p-2 border-b border-base-300 sticky top-0 bg-base-100">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="searchQuery"
                            placeholder="{{ trans('daisylw4::search') }}"
                            class="input input-bordered input-sm w-full"
                            @if ($isOpen) autofocus @endif
                        />
                    </div>
                @endif

                <!-- Loading state -->
                @if ($loading)
                    <div class="p-4 text-center text-sm text-base-content/60">
                        <span class="loading loading-spinner loading-sm"></span>
                        {{ $loadingText ?: trans('daisylw4::searching') }}
                    </div>
                @elseif (empty($filteredOptions))
                    <!-- No results -->
                    <div class="p-4 text-center text-sm text-base-content/50">
                        {{ $noResultsText ?: trans('daisylw4::no_results') }}
                    </div>
                @else
                    <!-- Options list -->
                    <div class="overflow-y-auto flex-1">
                        @foreach ($filteredOptions as $key => $value)
                            @if (is_array($value))
                                <!-- Optgroup -->
                                <div class="px-3 py-2 text-xs font-semibold text-base-content/60 bg-base-200/30">
                                    {{ $key }}
                                </div>
                                @foreach ($value as $subKey => $subLabel)
                                    @php
                                        $isSelected = $multiple
                                            ? in_array($subKey, explode(',', $this->$this->model ?? ''))
                                            : $this->$this->model == $subKey;
                                    @endphp
                                    <button
                                        type="button"
                                        wire:click.stop="selectOption('{{ $subKey }}')"
                                        class="w-full text-left px-3 py-2 hover:bg-primary/10 transition-colors flex items-center gap-2 {{ $isSelected ? 'bg-primary/20 text-primary' : '' }}"
                                    >
                                        @if ($multiple)
                                            <input
                                                type="checkbox"
                                                {{ $isSelected ? 'checked' : '' }}
                                                class="checkbox checkbox-sm"
                                                disabled
                                            />
                                        @endif
                                        <span class="flex-1">{{ $subLabel }}</span>
                                    </button>
                                @endforeach
                            @else
                                <!-- Regular option -->
                                @php
                                    $isSelected = $multiple
                                        ? in_array($key, explode(',', $this->$this->model ?? ''))
                                        : $this->$this->model == $key;
                                @endphp
                                <button
                                    type="button"
                                    wire:click.stop="selectOption('{{ $key }}')"
                                    class="w-full text-left px-3 py-2 hover:bg-primary/10 transition-colors flex items-center gap-2 {{ $isSelected ? 'bg-primary/20 text-primary' : '' }}"
                                >
                                    @if ($multiple)
                                        <input
                                            type="checkbox"
                                            {{ $isSelected ? 'checked' : '' }}
                                            class="checkbox checkbox-sm"
                                            disabled
                                        />
                                    @endif
                                    <span class="flex-1">{{ $value }}</span>
                                </button>
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- Footer with count -->
                @if ($showCount && !empty($filteredOptions) && !$loading)
                    <div class="px-3 py-2 text-xs text-base-content/60 border-t border-base-300 bg-base-200/30">
                        @php
                            $count = 0;
                            foreach ($filteredOptions as $item) {
                                $count += is_array($item) ? count($item) : 1;
                            }
                        @endphp
                        {{ trans_choice('daisylw4::options_available', $count, ['count' => $count]) }}
                    </div>
                @endif
            </div>
        @endif
    </div>

    @error($model)
        <label class="label">
            <span class="label-text-alt text-error font-medium">{{ $message }}</span>
        </label>
    @enderror
