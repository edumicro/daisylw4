<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

new class extends Component {
    use WithPagination;

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
     * Data Table specific props
     */
    public array $columns = [];
    public array $searchableFields = [];
    public array $availableScopes = [];
    public string $search = '';
    public int $perPage = 10;
    public string $sortColumn = '';
    public string $sortDirection = 'asc';
    public bool $selectable = false;
    public array $selected = [];
    public array $bulkActions = [];
    public bool $showSearch = true;
    public bool $showPerPage = true;
    public bool $striped = true;
    public bool $hoverable = true;
    public string $size = 'md';
    public array $activeScopes = [];

    /**
     * Per page options
     */
    protected array $perPageOptions = [10, 25, 50, 100];

  
    /**
     * Get the query builder for the model with advanced filtering
     */
    #[Computed]
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        if (empty($this->model) || !class_exists($this->model)) {
            throw new \Exception('Invalid model class provided.');
        }

        $query = $this->model::query();

        // 1. Advanced Filters & Scopes (Handles dates, ranges, and eloquent scopes)
        foreach ($this->activeScopes as $scope => $value) {
            // Skip empty values to avoid unnecessary filtering
            if ($value === '' || $value === null) continue;

            // Handle Date Ranges (from/to suffixes)
            if (str_ends_with($scope, '_from')) {
                $column = str_replace('_from', '', $scope);
                $query->where($column, '>=', $value);
            } 
            elseif (str_ends_with($scope, '_to')) {
                $column = str_replace('_to', '', $scope);
                $query->where($column, '<=', $value);
            } 
            else {
                // Check if it's a dedicated Eloquent Scope in the Model
                if (method_exists($this->model, 'scope' . ucfirst($scope))) {
                    $query->{$scope}($value);
                } else {
                    // If no scope exists, we assume it's a direct column match
                    $query->where($scope, $value);
                }
            }
        }

        // 2. Global Search (Grouped to prevent breaking the scopes)
        if (!empty($this->search) && !empty($this->searchableFields)) {
            $query->where(function ($q) {
                foreach ($this->searchableFields as $field) {
                    $q->orWhere($field, 'like', "%{$this->search}%");
                }
            });
        }

        // 3. Apply sorting
        if (!empty($this->sortColumn)) {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return $query;
    }

    /**
     * Get paginated data
     */
    #[Computed]
    public function data(): LengthAwarePaginator
    {
        return $this->query->paginate($this->perPage);
    }

    /**
     * Sort by column
     */
    public function sortBy(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    /**
     * Update search query
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Update per page
     */
    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

     /**
     * Update active scopes
     */
    public function updatedActiveScopes(): void
    {   
        $this->resetPage();
    }

    /**
     * Toggle row selection
     */
    public function toggleRow(string|int $rowId): void
    {
        if ($this->selectable) {
            if (in_array($rowId, $this->selected)) {
                $this->selected = array_filter($this->selected, fn($id) => $id !== $rowId);
            } else {
                $this->selected[] = $rowId;
            }
        }
    }

    /**
     * Toggle all rows on current page
     */
    public function toggleAll(): void
    {
        if ($this->selectable) {
            $currentPageIds = $this->data->pluck('id')->toArray();
            
            if (count(array_intersect($this->selected, $currentPageIds)) === count($currentPageIds)) {
                // Deselect all on current page
                $this->selected = array_filter($this->selected, fn($id) => !in_array($id, $currentPageIds));
            } else {
                // Select all on current page
                $this->selected = array_unique(array_merge($this->selected, $currentPageIds));
            }
        }
    }

    /**
     * Clear selection
     */
    public function clearSelection(): void
    {
        $this->selected = [];
    }

    /**
     * Execute bulk action
     */
    public function executeBulkAction(string $action): void
    {
        $this->dispatch('bulk-action-executed', action: $action, selected: $this->selected);
    }

    /**
     * Toggle scope
     */
    public function toggleScope(string $scope, mixed $value = true): void
    {
        if (isset($this->activeScopes[$scope])) {
            unset($this->activeScopes[$scope]);
        } else {
            $this->activeScopes[$scope] = $value;
        }

        $this->resetPage();
    }

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'table-xs',
        'sm' => 'table-sm',
        'md' => 'table',
        'lg' => 'table-lg',
    ];

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }

    /**
     * Get column value with type formatting
     */
    public function getColumnValue(mixed $row, array $column): string
    {
        $value = data_get($row, $column['key'], '');
        $type = $column['type'] ?? 'text';

        return match ($type) {
            'date' => $value ? \Carbon\Carbon::parse($value)->format($column['format'] ?? 'Y-m-d') : '',
            'number' => is_numeric($value) ? number_format($value, $column['decimals'] ?? 0) : $value,
            'email' => $value,
            'phone' => $value,
            'link' => $value,
            'avatar' => $value,
            default => \Illuminate\Support\Str::limit($value, $column['limit'] ?? 255),
        };
    }
}; ?>

<div
    class="space-y-4 {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    <!-- Header with search and filters -->
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div class="flex-1">
            @if ($label)
                <h3 class="text-lg font-bold mb-2">{{ $label }}</h3>
            @endif

            @if ($showSearch)
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ trans('daisylw4::search') }}"
                    class="input input-bordered input-sm w-full md:max-w-xs"
                />
            @endif
        </div>

        <div class="flex gap-2 items-center">
            <!-- Filter Component -->
                <livewire:display.datatable-filters 
                    wire:model.live="activeScopes" 
                    :available-filters="$availableFilters" 
                />

                <!-- Per page selector -->
                @if ($showPerPage)
                    <select wire:model.live="perPage" class="select select-bordered select-sm">
                        @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @endif
        </div>
    </div>

    <!-- Bulk actions bar -->
    @if ($selectable && !empty($selected))
        <div class="alert alert-info">
            <div class="flex items-center justify-between w-full">
                <span>{{ count($selected) }} {{ trans_choice('daisylw4::items_selected', count($selected)) }}</span>
                
                <div class="flex gap-2">
                    @foreach ($bulkActions as $action)
                        <button
                            type="button"
                            wire:click="executeBulkAction('{{ $action['key'] }}')"
                            class="btn btn-sm {{ $action['variant'] ?? 'btn-ghost' }}"
                        >
                            @if (isset($action['icon']))
                                <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                            @endif
                            {{ $action['label'] }}
                        </button>
                    @endforeach

                    <button
                        type="button"
                        wire:click="clearSelection"
                        class="btn btn-sm btn-ghost"
                    >
                        {{ trans('daisylw4::clear') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto relative">
        <!-- Loading overlay -->
        <div wire:loading class="absolute inset-0 bg-base-100/70 flex items-center justify-center z-10">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <table
            class="table {{ $this->getSizeClass() }} {{ $striped ? 'table-zebra' : '' }} {{ $hoverable ? 'table-hover' : '' }} w-full {{ $class }}"
        >
            <thead class="bg-base-200">
                <tr>
                    @if ($selectable)
                        <th class="w-12">
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                wire:click="toggleAll"
                            />
                        </th>
                    @endif

                    @foreach ($columns as $column)
                        <th
                            class="{{ isset($column['sortable']) && $column['sortable'] ? 'cursor-pointer hover:bg-base-300 select-none' : '' }}"
                            @if (isset($column['sortable']) && $column['sortable']) wire:click="sortBy('{{ $column['key'] }}')" @endif
                        >
                            <div class="flex items-center gap-2">
                                {{ $column['label'] ?? $column['key'] }}

                                @if (isset($column['sortable']) && $column['sortable'])
                                    @if ($sortColumn === $column['key'])
                                        <span class="text-primary">
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        </span>
                                    @else
                                        <span class="text-base-content/30">⇅</span>
                                    @endif
                                @endif
                            </div>
                        </th>
                    @endforeach

                    @if (!empty($column['actions'] ?? []))
                        <th class="text-center">{{ trans('daisylw4::actions') }}</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @php $totalCols = count($columns) + ($selectable ? 1 : 0) + (isset($column['actions']) ? 1 : 0); @endphp

                <tr wire:loading.table> 
                    <td colspan="{{ $totalCols }}" class="p-0"> 
                        <div class="p-4 space-y-3"> 
                            @for ($i = 0; $i < 5; $i++) 
                                <div class="flex items-center space-x-4 animate-pulse"> 
                                    <div class="h-4 bg-base-300 rounded w-full"></div> 
                                    <div class="h-4 bg-base-300 rounded w-24"></div> 
                                </div> 
                            @endfor 
                        </div> 
                    </td> 
                </tr>
                        <!--
                            ARCHITECTURAL NOTE: Table Nesting for UX

                            We use a nested table structure combined with wire:loading.

                            The outer table maintains the layout and headers.

                            The first row contains the Skeleton Loader (wire:loading).

                            The second row contains a nested table with the actual data (wire:loading.remove).

                            WHY? This prevents "layout shifting" and DOM diffing conflicts in Livewire 4

                            when transitioning between loading states and real data, ensuring a

                            smooth, flicker-free experience. 
                         -->

               <tr wire:loading.remove> 
                    <td colspan="{{ $totalCols }}" class="p-0"> 
                        <table class="table w-full border-none shadow-none bg-transparent">
                            <tbody> 

                                @forelse ($this->data as $row)
                                    <tr class="{{ in_array($row->id, $selected) ? 'bg-primary/10' : '' }}">
                                        @if ($selectable)
                                            <td class="w-12">
                                                <input
                                                    type="checkbox"
                                                    class="checkbox checkbox-sm"
                                                    {{ in_array($row->id, $selected) ? 'checked' : '' }}
                                                    wire:click="toggleRow('{{ $row->id }}')"
                                                />
                                            </td>
                                        @endif

                                        @foreach ($columns as $column)
                                            <td>
                                                @php
                                                    $value = data_get($row, $column['key'], '');
                                                    $type = $column['type'] ?? 'text';
                                                @endphp

                                                @switch($type)
                                                    @case('badge')
                                                        <span class="badge {{ $column['variant'] ?? 'badge-ghost' }}">
                                                            {{ $value }}
                                                        </span>
                                                    @break

                                                    @case('status')
                                                        <div class="inline-flex items-center gap-2">
                                                            <span class="w-2.5 h-2.5 rounded-full {{ match($value) {
                                                                'active' => 'bg-success',
                                                                'inactive' => 'bg-base-300',
                                                                'pending' => 'bg-warning',
                                                                'error' => 'bg-error',
                                                                default => 'bg-base-300',
                                                            } }}"></span>
                                                            {{ ucfirst($value) }}
                                                        </div>
                                                    @break

                                                    @case('icon')
                                                        @if ($value)
                                                            <x-dynamic-component :component="$value" class="w-5 h-5" />
                                                        @endif
                                                    @break

                                                    @case('link')
                                                        <a href="{{ $value }}" class="link link-primary" target="_blank">
                                                            {{ $column['text'] ?? trans('daisylw4::view') }}
                                                        </a>
                                                    @break

                                                    @case('email')
                                                        <a href="mailto:{{ $value }}" class="link link-primary text-sm">
                                                            {{ $value }}
                                                        </a>
                                                    @break

                                                    @case('phone')
                                                        <a href="tel:{{ $value }}" class="link link-primary text-sm">
                                                            {{ $value }}
                                                        </a>
                                                    @break

                                                    @case('avatar')
                                                        <div class="avatar">
                                                            <div class="w-8 h-8 rounded-full">
                                                                <img src="{{ $value }}" alt="Avatar" />
                                                            </div>
                                                        </div>
                                                    @break

                                                    @case('number')
                                                        <span class="font-mono">
                                                            {{ number_format($value, $column['decimals'] ?? 0) }}
                                                        </span>
                                                    @break

                                                    @case('date')
                                                        {{ \Carbon\Carbon::parse($value)->format($column['format'] ?? 'Y-m-d') }}
                                                    @break

                                                    @default
                                                        {{ \Illuminate\Support\Str::limit($value, $column['limit'] ?? 255) }}
                                                @endswitch
                                            </td>
                                        @endforeach

                                        @if (isset($column['actions']) && !empty($column['actions']))
                                            <td class="text-center">
                                                <div class="flex justify-center gap-2">
                                                    @foreach ($column['actions'] as $action)
                                                        <button
                                                            type="button"
                                                            wire:click="$dispatch('row-action', {action: '{{ $action['key'] }}', id: {{ $row->id }}})"
                                                            class="btn btn-xs {{ $action['variant'] ?? 'btn-ghost' }}"
                                                            title="{{ $action['label'] ?? '' }}"
                                                        >
                                                            @if (isset($action['icon']))
                                                                <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                                                            @else
                                                                {{ $action['label'] ?? '' }}
                                                            @endif
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="{{ count($columns) + ($selectable ? 1 : 0) + (isset($column['actions']) ? 1 : 0) }}"
                                            class="text-center py-8 text-base-content/50"
                                        >
                                            {{ trans('daisylw4::no_items') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </td>
                </tr>    
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($this->data->hasPages())
        <div class="flex justify-between items-center">
            <div class="text-sm text-base-content/60">
                {{ trans('daisylw4::showing') }}
                {{ $this->data->firstItem() }} - {{ $this->data->lastItem() }}
                {{ trans('daisylw4::of') }}
                {{ $this->data->total() }}
                {{ trans('daisylw4::results') }}
            </div>

            <div>
                {{ $this->data->links() }}
            </div>
        </div>
    @endif

    @if ($model)
        @error($model)
            <span class="text-error text-sm block mt-4">{{ $message }}</span>
        @enderror
    @endif
</div>
