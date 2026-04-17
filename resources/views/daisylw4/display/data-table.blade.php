<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

new class extends Component {
    use WithPagination;

    /**
     * Props Estándar de Flow
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Data Table Props (Recibidas del Driver)
     */
    public array $section = [];
    public array $columns = [];
    public array $filters = []; // <--- Recibida de renderSection()
    public array $searchableFields = [];

    /**
     * Estado del Componente
     */
    public string $search = '';
    public int $perPage = 10;
    public string $sortColumn = '';
    public string $sortDirection = 'asc';
    public bool $selectable = false;
    public array $selected = [];
    public array $activeScopes = []; // <--- Aquí se sincronizan los filtros

    public function mount($section, $filters = [])
    {
        $this->section = $section;
        $this->filters = $filters;

        // Mapeo de metadata de la sección a propiedades del componente
        $this->columns = $section['columns'] ?? [];
        $this->model = $section['metadata']['model'] ?? '';
        $this->searchableFields = $section['metadata']['searchable'] ?? [];
        $this->selectable = $section['metadata']['selectable'] ?? false;

        // Intentar adivinar columnas si vienen vacías
        if (empty($this->columns) && method_exists($this->model, 'getTableSchema')) {
            $this->columns = $this->model::getTableSchema();
        }
    }

    #[Computed]
    public function query(): Builder
    {
        if (empty($this->model) || !class_exists($this->model)) {
            throw new \Exception("Modelo no válido para Data-table");
        }

        $query = $this->model::query();

        // 1. Aplicar Filtros (activeScopes)
        foreach ($this->activeScopes as $scope => $value) {
            if ($value === '' || $value === null)
                continue;

            if (str_ends_with($scope, '_from')) {
                $query->where(str_replace('_from', '', $scope), '>=', $value);
            } elseif (str_ends_with($scope, '_to')) {
                $query->where(str_replace('_to', '', $scope), '<=', $value);
            } else {
                if (method_exists($this->model, 'scope' . ucfirst($scope))) {
                    $query->{$scope}($value);
                } else {
                    $query->where($scope, $value);
                }
            }
        }

        // 2. Búsqueda Global
        if (!empty($this->search) && !empty($this->searchableFields)) {
            $query->where(function ($q) {
                foreach ($this->searchableFields as $field) {
                    $q->orWhere($field, 'like', "%{$this->search}%");
                }
            });
        }

        // 3. Ordenación
        if (!empty($this->sortColumn)) {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return $query;
    }

    #[Computed]
    public function data(): LengthAwarePaginator
    {
        return $this->query->paginate($this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function updatedActiveScopes()
    {
        $this->resetPage();
    }

    public function sortBy(string $column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }
}; ?>

<div class="space-y-4 {{ $containerClass }}" @if($id) id="{{ $id }}" @endif>

    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div class="flex-1">
            @if (!empty($section['title']) || $label)
                <h3 class="text-lg font-bold mb-2">{{ $section['title'] ?? $label }}</h3>
            @endif

            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ trans('DaisyLw4::search') }}..."
                class="input input-bordered input-sm w-full md:max-w-xs" />
        </div>

        <div class="flex gap-2 items-center">
            {{-- FILTROS AGNOSTICOS --}}
            @if(!empty($filters))
                <livewire:flow::datatable-filters wire:model.live="activeScopes" :availableFilters="$filters" />
            @endif

            <select wire:model.live="perPage" class="select select-bordered select-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto relative min-h-[200px]">

        <table class="table table-zebra w-full">
            <thead class="bg-base-200">
                <tr>
                    @foreach ($columns as $column)
                        @php $key = is_array($column) ? $column['key'] : $column; @endphp
                        <th class="cursor-pointer hover:bg-base-300" wire:click="sortBy('{{ $key }}')">
                            <div class="flex items-center gap-2">
                                {{ is_array($column) ? ($column['label'] ?? $key) : ucfirst($key) }}
                                @if ($sortColumn === $key)
                                    <span class="text-primary">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="relative">
                {{-- Overlay de Carga --}}
                <tr wire:loading class="absolute inset-0 bg-base-100/50 z-10">
                    <td colspan="{{ count($columns) }}" class="text-center py-10">
                        <span class="loading loading-spinner loading-lg text-primary"></span>
                    </td>
                </tr>

                @forelse ($this->data as $row)
                    <tr wire:loading.remove>
                        @foreach ($columns as $column)
                            @php $key = is_array($column) ? $column['key'] : $column; @endphp
                            <td>{{ data_get($row, $key) }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr wire:loading.remove>
                        <td colspan="{{ count($columns) }}" class="text-center py-10 italic opacity-50">
                            {{ trans('DaisyLw4::no_results') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $this->data->links() }}
    </div>
</div>