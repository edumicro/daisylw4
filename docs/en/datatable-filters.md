# Datatable Filters Component Guide

## Name and Description

**Component:** `daisylw4.display.datatable-filters`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.datatable-filters />
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
| `availableFilters` | `array` | `[]` | Public `availableFilters` property of the component. |
| `activeFilters` | `array` | `[]` | Public `activeFilters` property of the component. |
| `icon` | `string` | `'heroicon-o-funnel'` | Public `icon` property of the component. |
| `showBadge` | `bool` | `true` | Public `showBadge` property of the component. |
| `dropdownPosition` | `string` | `'dropdown-end'` | Public `dropdownPosition` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `filters-cleared`
- `filters-updated`

## Advanced Example

```blade
<livewire:daisylw4.display.datatable-filters
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `clearFilters(): void`
- `updateFilter(string $key, mixed $value): void`
- `getActiveFilterCount(): int`
- `isFilterActive(string $key): bool`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `dropdown {{ $dropdownPosition }} {{ $containerClass }}`
- `btn btn-sm btn-ghost gap-2 {{ $class }}`
- `w-4 h-4`
- `loading loading-spinner loading-xs`
