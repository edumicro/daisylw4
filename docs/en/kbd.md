# Kbd Component Guide

## Name and Description

**Component:** `daisylw4.display.kbd`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.kbd />
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
| `key` | `string` | `''` | Public `key` property of the component. |
| `keys` | `array` | `[]` | Public `keys` property of the component. |
| `variant` | `string` | `'default'` | Public `variant` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.kbd
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getVariantClass(): string`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-2`
- `text-sm font-medium`
- `flex flex-wrap gap-2 items-center`
