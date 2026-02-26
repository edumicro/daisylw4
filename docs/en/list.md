# List Component Guide

## Name and Description

**Component:** `daisylw4.display.list`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.list />
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
| `ordered` | `bool` | `false` | Public `ordered` property of the component. |
| `divided` | `bool` | `true` | Public `divided` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `hoverable` | `bool` | `false` | Public `hoverable` property of the component. |
| `selectable` | `bool` | `false` | Public `selectable` property of the component. |
| `selected` | `array` | `[]` | Public `selected` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.list
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `toggleSelect(int $index): void`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-4 pb-2 border-b border-base-300`
- `font-semibold`
- `list-decimal list-inside {{ $class }} {{ $this->getSizeClass() }} space-y-2`
