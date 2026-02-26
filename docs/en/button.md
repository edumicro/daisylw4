# Button Component Guide

## Name and Description

**Component:** `daisylw4.actions.button`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.actions.button />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `label` | `string` | `'Click me'` | Public `label` property of the component. |
| `type` | `string` | `'button'` | Public `type` property of the component. |
| `loading` | `bool` | `false` | Public `loading` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `iconOnly` | `bool` | `false` | Public `iconOnly` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.actions.button
    label="label-demo"
    type="type-demo"
    :loading="true"
    :disabled="true"
    id="id-demo"
/>
```

Detected public methods:
- `mount(): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `btn-disabled`
- `loading loading-spinner loading-xs`
- `flex items-center`
