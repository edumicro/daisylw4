<?php
/**
 * Component: form.filter
 * A filter component for searching/filtering with multiple criteria
 * Useful for data tables, product lists, or any filterable content
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Filter criteria array
     * Structure: [
     *     [
     *         'key' => 'status',
     *         'label' => 'Status',
     *         'type' => 'select', // select, checkbox, text, date, range
     *         'options' => ['active' => 'Active', 'inactive' => 'Inactive'],
     *         'value' => '',
     *     ],
     *     ...
     * ]
     */
    public array $filters = [];

    /**
     * Model prefix for wire:model binding
     */
    public string $modelPrefix = 'filters';

    /**
     * Show filter button or auto-trigger on change
     */
    public bool $showButton = true;

    /**
     * Button labels (translatable)
     */
    public string $applyLabel = 'form.filter.apply'; // i18n key
    public string $resetLabel = 'form.filter.reset'; // i18n key

    /**
     * Styling
     */
    public string $layout = 'horizontal'; // 'horizontal' or 'vertical'
    public string $class = '';
    public string $containerClass = '';

    public function mount(): void
    {
        //
    }

    /**
     * Apply filters - dispatch event
     */
    public function applyFilters(): void
    {
        $filterData = [];
        foreach ($this->filters as $filter) {
            if (!empty($filter['value'])) {
                $filterData[$filter['key']] = $filter['value'];
            }
        }
        $this->dispatch('filters-applied', filters: $filterData);
    }

    /**
     * Reset all filters
     */
    public function resetFilters(): void
    {
        foreach ($this->filters as &$filter) {
            $filter['value'] = '';
        }
        $this->dispatch('filters-reset');
    }

    /**
     * Get layout classes
     */
    public function getLayoutClass(): string
    {
        return $this->layout === 'vertical'
            ? 'space-y-3'
            : 'flex flex-wrap gap-3 items-end';
    }
}; ?>

<div class="filter-container {{ $containerClass }}">
    <div class="{{ $this->getLayoutClass() }} {{ $class }}">
        @foreach($filters as $index => $filter)
            @php
                $modelPath = "{$this->modelPrefix}.{$index}.value";
                $filterType = $filter['type'] ?? 'text';
            @endphp

            <div class="flex-1 min-w-[200px]">
                @if($filterType === 'select')
                    <div class="form-control w-full">
                        <label class="label p-0 pb-2">
                            <span class="label-text text-sm font-medium">{{ __($filter['label'] ?? '') }}</span>
                        </label>
                        <select
                            wire:model.live="{{ $modelPath }}"
                            class="select select-bordered select-sm w-full"
                        >
                            <option value="">{{ __('form.filter.all') }}</option>
                            @foreach($filter['options'] ?? [] as $key => $label)
                                <option value="{{ $key }}">{{ __($label) }}</option>
                            @endforeach
                        </select>
                    </div>

                @elseif($filterType === 'checkbox')
                    <div class="form-control">
                        <label class="label p-0 pb-2">
                            <span class="label-text text-sm font-medium">{{ __($filter['label'] ?? '') }}</span>
                        </label>
                        <div class="space-y-2">
                            @foreach($filter['options'] ?? [] as $key => $label)
                                <label class="label cursor-pointer gap-2 p-0">
                                    <input type="checkbox" wire:model.live="{{ $modelPath }}.{{ $key }}" class="checkbox checkbox-sm" />
                                    <span class="label-text text-sm">{{ __($label) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                @elseif($filterType === 'text')
                    <div class="form-control w-full">
                        <label class="label p-0 pb-2">
                            <span class="label-text text-sm font-medium">{{ __($filter['label'] ?? '') }}</span>
                        </label>
                        <input
                            type="text"
                            wire:model.live.debounce-500ms="{{ $modelPath }}"
                            placeholder="{{ __('form.filter.search') }}"
                            class="input input-bordered input-sm w-full"
                        />
                    </div>

                @elseif($filterType === 'date')
                    <div class="form-control w-full">
                        <label class="label p-0 pb-2">
                            <span class="label-text text-sm font-medium">{{ __($filter['label'] ?? '') }}</span>
                        </label>
                        <input
                            type="date"
                            wire:model.live="{{ $modelPath }}"
                            class="input input-bordered input-sm w-full"
                        />
                    </div>
                @endif
            </div>
        @endforeach

        @if($showButton)
            <div class="flex gap-2">
                <button
                    type="button"
                    wire:click="applyFilters"
                    class="btn btn-primary btn-sm"
                >
                    {{ __($applyLabel) }}
                </button>
                <button
                    type="button"
                    wire:click="resetFilters"
                    class="btn btn-ghost btn-sm"
                >
                    {{ __($resetLabel) }}
                </button>
            </div>
        @endif
    </div>
</div>
