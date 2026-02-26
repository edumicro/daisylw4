# Select Component Guide

## Name and Description

**Component:** `daisylw4.form.select`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.select />
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
| `options` | `array` | `[]` | Public `options` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `placeholder` | `string` | `''` | Public `placeholder` property of the component. |
| `multiple` | `bool` | `false` | Public `multiple` property of the component. |
| `searchable` | `bool` | `true` | Public `searchable` property of the component. |
| `clearable` | `bool` | `true` | Public `clearable` property of the component. |
| `lazy` | `bool` | `false` | Public `lazy` property of the component. |
| `searchQuery` | `string` | `''` | Public `searchQuery` property of the component. |
| `isOpen` | `bool` | `false` | Public `isOpen` property of the component. |
| `filteredOptions` | `array` | `[]` | Public `filteredOptions` property of the component. |
| `debounceMs` | `int` | `300` | Public `debounceMs` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `showCount` | `bool` | `true` | Public `showCount` property of the component. |
| `icon` | `string` | `'heroicon-o-chevron-down'` | Public `icon` property of the component. |
| `maxResults` | `int` | `10` | Public `maxResults` property of the component. |
| `loading` | `bool` | `false` | Public `loading` property of the component. |
| `noResultsText` | `string` | `''` | Public `noResultsText` property of the component. |
| `loadingText` | `string` | `''` | Public `loadingText` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `input`

## Advanced Example

```blade
<livewire:daisylw4.form.select
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `mount(): void`
- `toggleOpen(): void`
- `closeDropdown(): void`
- `search(string $query): void`
- `selectOption(string|int $value): void`
- `clearSelection(): void`
- `removeItem(string|int $value): void`
- `getSelectedLabels(): array`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `relative`
