# Range Component Guide

## Name and Description

**Component:** `daisylw4.form.range`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.range />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `minModel` | `string` | `''` | Public `minModel` property of the component. |
| `maxModel` | `string` | `''` | Public `maxModel` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `min` | `int|float` | `0` | Public `min` property of the component. |
| `max` | `int|float` | `100` | Public `max` property of the component. |
| `step` | `int|float` | `1` | Public `step` property of the component. |
| `unit` | `string` | `''` | Public `unit` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.range
    minModel="minModel-demo"
    maxModel="maxModel-demo"
    label="label-demo"
    description="description-demo"
    :min="0"
/>
```

Detected public methods:
- `mount(): void`
- `formatValue(int|float $value): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `text-sm text-base-content/70 mb-3`
