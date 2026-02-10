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
     * Table specific props
     */
    public array $columns = [];
    public array $rows = [];
    public array $data = [];
    public bool $striped = true;
    public bool $hoverable = true;
    public bool $compact = false;
    public bool $responsive = true;
    public bool $showHeader = true;
    public string $size = 'md';
    public array $actions = [];
    public bool $selectable = false;
    public array $selected = [];
    public string $sortColumn = '';
    public string $sortDirection = 'asc';

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
     * Toggle all rows selection
     */
    public function toggleAllRows(): void
    {
        if ($this->selectable) {
            if (count($this->selected) === count($this->rows)) {
                $this->selected = [];
            } else {
                $this->selected = array_map(fn($row) => $row['id'] ?? array_key_first($row), $this->rows);
            }
        }
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
}; ?>

<div
    class="overflow-x-auto {{ $containerClass }}"
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($label)
        <div class="mb-4 pb-4 border-b border-base-300">
            <h3 class="text-lg font-bold">{{ $label }}</h3>
        </div>
    @endif

    <table
        class="table {{ $this->getSizeClass() }} {{ $striped ? 'table-striped' : '' }} {{ $hoverable ? 'table-hover' : '' }} w-full {{ $class }}"
        @if ($id) id="{{ $id }}" @endif
    >
        @if ($showHeader && !empty($columns))
            <thead class="bg-base-200/50">
                <tr>
                    @if ($selectable)
                        <th class="w-12">
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                {{ count($this->selected) === count($this->rows) && !empty($this->rows) ? 'checked' : '' }}
                                wire:click="toggleAllRows"
                            />
                        </th>
                    @endif

                    @foreach ($columns as $column)
                        <th
                            class="cursor-pointer hover:bg-base-300/50 transition-colors {{ isset($column['sortable']) && $column['sortable'] ? 'select-none' : '' }}"
                            @if (isset($column['sortable']) && $column['sortable']) wire:click="sortBy('{{ $column['key'] }}')" @endif
                        >
                            <div class="flex items-center gap-2">
                                {{ $column['label'] ?? $column['key'] }}

                                @if (isset($column['sortable']) && $column['sortable'])
                                    @if ($sortColumn === $column['key'])
                                        <span class="text-xs">
                                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                        </span>
                                    @else
                                        <span class="text-xs text-base-content/30">⇅</span>
                                    @endif
                                @endif
                            </div>
                        </th>
                    @endforeach

                    @if (!empty($actions))
                        <th class="text-center">{{ trans('daisylw4::actions') }}</th>
                    @endif
                </tr>
            </thead>
        @endif

        <tbody>
            @forelse ($rows as $rowIndex => $row)
                <tr class="{{ in_array($row['id'] ?? $rowIndex, $this->selected) ? 'bg-primary/10' : '' }}">
                    @if ($selectable)
                        <td class="w-12">
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                {{ in_array($row['id'] ?? $rowIndex, $this->selected) ? 'checked' : '' }}
                                wire:click="toggleRow('{{ $row['id'] ?? $rowIndex }}')"
                            />
                        </td>
                    @endif

                    @foreach ($columns as $column)
                        <td class="{{ $compact ? 'py-2' : '' }}">
                            @php
                                $value = $row[$column['key']] ?? '';
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
                                    <a href="{{ $value }}" class="link link-primary">
                                        {{ $column['text'] ?? $value }}
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
                                        {{ number_format($value, isset($column['decimals']) ? $column['decimals'] : 0) }}
                                    </span>
                                @break

                                @case('date')
                                    {{ \Carbon\Carbon::parse($value)->format($column['format'] ?? 'Y-m-d') }}
                                @break

                                @default
                                    {{ Str::limit($value, $column['limit'] ?? 255) }}
                            @endswitch
                        </td>
                    @endforeach

                    @if (!empty($actions))
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                @foreach ($actions as $action)
                                    <button
                                        class="btn btn-xs {{ $action['variant'] ?? 'btn-ghost' }}"
                                        @if (isset($action['wire'])) wire:click="{{ $action['wire'] }}('{{ $row['id'] ?? $rowIndex }}')" @endif
                                        title="{{ $action['label'] ?? 'Action' }}"
                                    >
                                        @if (isset($action['icon']))
                                            <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                                        @else
                                            {{ $action['label'] ?? 'Action' }}
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
                        colspan="{{ count($columns) + (count($actions) ? 1 : 0) + ($selectable ? 1 : 0) }}"
                        class="text-center py-8 text-base-content/50"
                    >
                        {{ trans('daisylw4::no_items') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($model)
    @error($model)
        <span class="text-error text-sm block mt-4">{{ $message }}</span>
    @enderror
@endif
