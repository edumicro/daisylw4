# Timeline Component Guide

## Name and Description

**Component:** `daisylw4.display.timeline`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.timeline />
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
| `items` | `array` | `[]` | Public `items` property of the component. |
| `orientation` | `string` | `'vertical'` | Public `orientation` property of the component. |
| `variant` | `string` | `'default'` | Public `variant` property of the component. |
| `showConnector` | `bool` | `true` | Public `showConnector` property of the component. |
| `icon` | `string` | `'heroicon-o-circle'` | Public `icon` property of the component. |
| `compact` | `bool` | `false` | Public `compact` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.timeline
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getVariantColor(string $itemVariant = ''): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `timeline {{ $orientation === 'horizontal' ? 'timeline-horizontal' : 'timeline-vertical' }} {{ $containerClass }}`
- `mb-6 pb-4 border-b border-base-300`
- `text-lg font-bold`
- `timeline-item`
