# Filter Component Guide

## Name and Description

**Component:** `daisylw4.form.filter`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.filter />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `filters` | `array` | `[]` | Public `filters` property of the component. |
| `modelPrefix` | `string` | `'filters'` | Public `modelPrefix` property of the component. |
| `showButton` | `bool` | `true` | Public `showButton` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `filters-applied`
- `filters-reset`

## Advanced Example

```blade
<livewire:daisylw4.form.filter
    :filters="[]"
    modelPrefix="modelPrefix-demo"
    :showButton="true"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `mount(): void`
- `applyFilters(): void`
- `resetFilters(): void`
- `getLayoutClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `filter-container {{ $containerClass }}`
- `{{ $this->getLayoutClass() }} {{ $class }}`
- `flex-1 min-w-[200px]`
- `form-control w-full`
