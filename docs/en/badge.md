# Badge Component Guide

## Name and Description

**Component:** `daisylw4.display.badge`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.badge />
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
| `text` | `string` | `''` | Public `text` property of the component. |
| `variant` | `string` | `'primary'` | Public `variant` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `iconSide` | `string` | `'left'` | Public `iconSide` property of the component. |
| `outline` | `bool` | `false` | Public `outline` property of the component. |
| `ghost` | `bool` | `false` | Public `ghost` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.badge
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
- `badge {{ $this->getVariantClass() }} {{ $this->getSizeClass() }} gap-2 {{ $class }}`
- `w-3 h-3`
- `w-3 h-3`
- `text-error text-xs block mt-1`
