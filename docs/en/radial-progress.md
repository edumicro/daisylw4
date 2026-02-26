# Radial Progress Component Guide

## Name and Description

**Component:** `daisylw4.display.radial-progress`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.radial-progress />
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
| `value` | `float` | `0` | Public `value` property of the component. |
| `max` | `float` | `100` | Public `max` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `thick` | `bool` | `false` | Public `thick` property of the component. |
| `unit` | `string` | `'%'` | Public `unit` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `animated` | `bool` | `true` | Public `animated` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.radial-progress
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getPercentage(): float`
- `getSizeClass(): string`
- `getColorClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `flex flex-col items-center gap-4 {{ $containerClass }}`
- `text-center`
- `font-semibold`
- `flex flex-col items-center`
