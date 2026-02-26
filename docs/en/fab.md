# Fab Component Guide

## Name and Description

**Component:** `daisylw4.actions.fab`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.actions.fab />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `label` | `string` | `''` | Public `label` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.actions.fab
    label="label-demo"
    :disabled="true"
    id="id-demo"
    class="class-demo"
    :extraAttributes="[]"
/>
```

Detected public methods:
- `mount(): void`
- `handleClick(): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `fixed {{ $position }} p-6 z-40`
- `tooltip tooltip-left`
- `w-6 h-6`
- `ml-2`
