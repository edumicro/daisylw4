<?php

use Livewire\Component;

new class extends Component {
    public array $section = [];
    public $rows;
    public array $columns = [];
    public array $filters = [];

    public function mount($section, $filters = [])
    {
        $this->section = $section;
        $this->rows = $section['data'] ?? [];
        $this->columns = $section['columns'] ?? [];
        $this->filters = $filters;

        // If no columns are provided but rows exist, try to guess from the first row natively
        $rows = collect($this->rows);
        if (empty($this->columns) && $rows->isNotEmpty()) {
            $first = $rows->first();
            if (is_object($first) && method_exists($first, 'getAttributes')) {
                $this->columns = array_keys($first->getAttributes());
            } elseif (is_array($first)) {
                $this->columns = array_keys($first);
            }
        }
    }
};
?>

<div class="overflow-x-auto w-full">
    @if(!empty($section['title']))
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-lg font-bold">{{ $section['title'] }}</h3>
                @if(!empty($section['description']))
                    <p class="text-sm text-base-content/70">{{ $section['description'] }}</p>
                @endif
            </div>

            <div class="flex items-center gap-2">
                @if(!empty($filters))
                    <livewire:flow::datatable-filters :availableFilters="$filters" />
                @endif

                @if(!empty($section['bulkActions']))
                    <div class="join">
                        @foreach($section['bulkActions'] as $action)
                            <button class="btn btn-sm join-item {{ $action['style'] === 'danger' ? 'btn-error' : 'btn-outline' }}"
                                wire:click="{{ $action['action'] }}">
                                @if($action['icon'])
                                    <x-flow::icon :name="$action['icon']" class="w-4 h-4 mr-1" />
                                @endif
                                {{ $action['label'] }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <table class="table table-zebra w-full">
        <thead>
            <tr>
                @foreach($columns as $col)
                    <th class="capitalize">{{ str_replace('_', ' ', $col) }}</th>
                @endforeach
                @if(isset($actions) && $actions->isNotEmpty())
                    <th class="text-right">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($columns as $col)
                        <td>
                            @if(is_object($row))
                                {{ $row->{$col} ?? '-' }}
                            @else
                                {{ $row[$col] ?? '-' }}
                            @endif
                        </td>
                    @endforeach

                    @if(isset($actions) && $actions->isNotEmpty())
                        <td class="text-right space-x-2">
                            {{ $actions }}
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + (isset($actions) ? 1 : 0) }}"
                        class="text-center py-8 text-base-content/50 italic">
                        No data available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if(method_exists($rows, 'links'))
        <div class="mt-4">
            {{ $rows->links() }}
        </div>
    @endif
</div>