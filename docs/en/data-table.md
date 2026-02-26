# Data Table Component Guide

## Name and Description

**Component:** `daisylw4.display.data-table`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.data-table />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `model` | `string` | `''` | Public `model` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |
| `columns` | `array` | `[]` | Public `columns` property of the component. |
| `searchableFields` | `array` | `[]` | Public `searchableFields` property of the component. |
| `availableScopes` | `array` | `[]` | Public `availableScopes` property of the component. |
| `search` | `string` | `''` | Public `search` property of the component. |
| `perPage` | `int` | `10` | Public `perPage` property of the component. |
| `sortColumn` | `string` | `''` | Public `sortColumn` property of the component. |
| `sortDirection` | `string` | `'asc'` | Public `sortDirection` property of the component. |
| `selectable` | `bool` | `false` | Public `selectable` property of the component. |
| `selected` | `array` | `[]` | Public `selected` property of the component. |
| `bulkActions` | `array` | `[]` | Public `bulkActions` property of the component. |
| `showSearch` | `bool` | `true` | Public `showSearch` property of the component. |
| `showPerPage` | `bool` | `true` | Public `showPerPage` property of the component. |
| `striped` | `bool` | `true` | Public `striped` property of the component. |
| `hoverable` | `bool` | `true` | Public `hoverable` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `activeScopes` | `array` | `[]` | Public `activeScopes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `bulk-action-executed`

## Advanced Example

```blade
<livewire:daisylw4.display.data-table
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `query(): \Illuminate\Database\Eloquent\Builder`
- `data(): LengthAwarePaginator`
- `sortBy(string $column): void`
- `updatedSearch(): void`
- `updatedPerPage(): void`
- `updatedActiveScopes(): void`
- `toggleRow(string|int $rowId): void`
- `toggleAll(): void`
- `clearSelection(): void`
- `executeBulkAction(string $action): void`
- `toggleScope(string $scope, mixed $value = true): void`
- `getSizeClass(): string`
- `getColumnValue(mixed $row, array $column): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `space-y-4 {{ $containerClass }}`
- `flex flex-col md:flex-row justify-between gap-4`
- `flex-1`
- `text-lg font-bold mb-2`
