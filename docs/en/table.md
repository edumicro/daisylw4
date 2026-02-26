# Table Component Guide

## Name and Description

**Component:** `daisylw4.display.table`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.table />
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
| `rows` | `array` | `[]` | Public `rows` property of the component. |
| `data` | `array` | `[]` | Public `data` property of the component. |
| `striped` | `bool` | `true` | Public `striped` property of the component. |
| `hoverable` | `bool` | `true` | Public `hoverable` property of the component. |
| `compact` | `bool` | `false` | Public `compact` property of the component. |
| `responsive` | `bool` | `true` | Public `responsive` property of the component. |
| `showHeader` | `bool` | `true` | Public `showHeader` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `actions` | `array` | `[]` | Public `actions` property of the component. |
| `selectable` | `bool` | `false` | Public `selectable` property of the component. |
| `selected` | `array` | `[]` | Public `selected` property of the component. |
| `sortColumn` | `string` | `''` | Public `sortColumn` property of the component. |
| `sortDirection` | `string` | `'asc'` | Public `sortDirection` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.table
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `toggleRow(string|int $rowId): void`
- `toggleAllRows(): void`
- `sortBy(string $column): void`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `overflow-x-auto {{ $containerClass }}`
- `mb-4 pb-4 border-b border-base-300`
- `text-lg font-bold`
- `bg-base-200/50`
