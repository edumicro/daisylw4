<?php

use Livewire\Component;
use Livewire\Attributes\Modelable;

new class extends Component {
    /**
     * Mandatory edumicro standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Datatable Filters specific props
     */
    public array $availableFilters = [];
    #[Modelable]
    public array $activeFilters = [];
    public string $icon = 'heroicon-o-funnel';
    public bool $showBadge = true;
    public string $dropdownPosition = 'dropdown-end';

    /**
     * Clear all filters
     */
    public function clearFilters(): void
    {
        $this->activeFilters = [];
        $this->dispatch('filters-cleared');
    }

    /**
     * Update filter value
     */
    public function updateFilter(string $key, mixed $value): void
    {
        if (empty($value) || $value === '' || $value === null) {
            unset($this->activeFilters[$key]);
        } else {
            $this->activeFilters[$key] = $value;
        }

        $this->dispatch('filters-updated', filters: $this->activeFilters);
    }

    /**
     * Get active filter count
     */
    public function getActiveFilterCount(): int
    {
        return count(array_filter($this->activeFilters, fn($v) => $v !== '' && $v !== null));
    }
    

    /**
     * Check if filter is active
     */
    public function isFilterActive(string $key): bool
    {
        return isset($this->activeFilters[$key]) && !empty($this->activeFilters[$key]);
    }
}; ?>

<div
    class="dropdown {{ $dropdownPosition }} {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    <!-- Trigger Button -->
    <label
        tabindex="0"
        class="btn btn-sm btn-ghost gap-2 {{ $class }}"
        title="{{ trans('daisylw4::filters') }}"
    >
    
        <x-dynamic-component :component="$icon" class="w-4 h-4" wire:loading.remove wire:target="activeFilters" />
    <span class="loading loading-spinner loading-xs" wire:loading wire:target="activeFilters"></span>
    
        @if ($label)
            <span>{{ $label }}</span>
        @else
            <span>{{ trans('daisylw4::filters') }}</span>
        @endif

        @if ($showBadge && $this->getActiveFilterCount() > 0)
            <span class="badge badge-primary badge-sm">
                {{ $this->getActiveFilterCount() }}
            </span>
        @endif
    </label>

    <!-- Dropdown Content -->
    <div
        tabindex="0"
        class="dropdown-content z-50 card card-compact w-80 p-4 shadow-lg bg-base-100 border border-base-300 mt-2"
    >
        <div class="space-y-4">
            <!-- Header -->
            <div class="flex items-center justify-between pb-3 border-b border-base-300">
                <h3 class="font-semibold text-sm">{{ trans('daisylw4::filter_options') }}</h3>
                
                @if ($this->getActiveFilterCount() > 0)
                    <button
                        type="button"
                        wire:click="clearFilters"
                        class="btn btn-ghost btn-xs"
                    >
                        {{ trans('daisylw4::clear_all') }}
                    </button>
                @endif
            </div>

            <!-- Filters -->
            @if (empty($availableFilters))
                <div class="text-center py-4 text-sm text-base-content/50">
                    {{ trans('daisylw4::no_filters') }}
                </div>
            @else
                @foreach ($availableFilters as $filter)
                    @php
                        $filterKey = $filter['key'] ?? '';
                        $filterType = $filter['type'] ?? 'text';
                        $filterLabel = $filter['label'] ?? ucfirst($filterKey);
                        $filterValue = $this->activeFilters[$filterKey] ?? '';
                    @endphp

                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text text-xs font-medium">{{ $filterLabel }}</span>
                        </label>

                        @switch($filterType)
                            @case('select')
                                <select
                                    wire:model.live="activeFilters.{{ $filterKey }}"
                                    class="select select-bordered select-sm w-full"
                                >
                                    <option value="">{{ trans('daisylw4::select_option') }}</option>
                                    @foreach ($filter['options'] ?? [] as $optionKey => $optionLabel)
                                        <option value="{{ $optionKey }}">{{ $optionLabel }}</option>
                                    @endforeach
                                </select>
                            @break

                            @case('date')
                                <input
                                    type="date"
                                    wire:model.live="activeFilters.{{ $filterKey }}"
                                    class="input input-bordered input-sm w-full"
                                    placeholder="{{ $filter['placeholder'] ?? '' }}"
                                />
                            @break

                            @case('daterange')
                                <div class="flex gap-2">
                                    <input
                                        type="date"
                                        wire:model.live="activeFilters.{{ $filterKey }}_from"
                                        class="input input-bordered input-sm flex-1"
                                        placeholder="{{ trans('daisylw4::from') }}"
                                    />
                                    <input
                                        type="date"
                                        wire:model.live="activeFilters.{{ $filterKey }}_to"
                                        class="input input-bordered input-sm flex-1"
                                        placeholder="{{ trans('daisylw4::to') }}"
                                    />
                                </div>
                            @break

                            @case('boolean')
                            @case('toggle')
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-base-content/70">
                                        {{ $filter['description'] ?? trans('daisylw4::enabled') }}
                                    </span>
                                    <input
                                        type="checkbox"
                                        wire:model.live="activeFilters.{{ $filterKey }}"
                                        class="toggle toggle-primary toggle-sm"
                                    />
                                </div>
                            @break

                            @case('number')
                                <input
                                    type="number"
                                    wire:model.live="activeFilters.{{ $filterKey }}"
                                    class="input input-bordered input-sm w-full"
                                    placeholder="{{ $filter['placeholder'] ?? '' }}"
                                    min="{{ $filter['min'] ?? '' }}"
                                    max="{{ $filter['max'] ?? '' }}"
                                />
                            @break

                            @case('text')
                                <input
                                    type="text"
                                    wire:model.live.debounce.300ms="activeFilters.{{ $filterKey }}"
                                    class="input input-bordered input-sm w-full"
                                    placeholder="{{ $filter['placeholder'] ?? '' }}"
                                />
                            @break

                            @default
                                <input
                                    type="text"
                                    wire:model.live.debounce.300ms="activeFilters.{{ $filterKey }}"
                                    class="input input-bordered input-sm w-full"
                                />
                        @endswitch

                        @if (isset($filter['help']))
                            <label class="label py-1">
                                <span class="label-text-alt text-xs text-base-content/60">{{ $filter['help'] }}</span>
                            </label>
                        @endif
                    </div>
                @endforeach
            @endif

            <!-- Footer Actions -->
            @if ($this->getActiveFilterCount() > 0)
                <div class="pt-3 border-t border-base-300 flex justify-between items-center text-xs text-base-content/60">
                    <span>
                        {{ trans_choice('daisylw4::filters_active', $this->getActiveFilterCount(), ['count' => $this->getActiveFilterCount()]) }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-2">{{ $message }}</span>
        @enderror
    @endif
</div>
