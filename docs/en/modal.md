# Modal Component Guide

## Name and Description

**Component:** `daisylw4.actions.modal`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.actions.modal />
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
| `open` | `bool` | `false` | Public `open` property of the component. |
| `title` | `string` | `''` | Public `title` property of the component. |
| `content` | `string` | `''` | Public `content` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `backdropClose` | `bool` | `true` | Public `backdropClose` property of the component. |
| `showClose` | `bool` | `true` | Public `showClose` property of the component. |
| `showActions` | `bool` | `true` | Public `showActions` property of the component. |
| `confirmText` | `string` | `''` | Public `confirmText` property of the component. |
| `cancelText` | `string` | `''` | Public `cancelText` property of the component. |
| `confirmVariant` | `string` | `'btn-primary'` | Public `confirmVariant` property of the component. |
| `cancelVariant` | `string` | `'btn-ghost'` | Public `cancelVariant` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `modal-confirmed`

## Advanced Example

```blade
<livewire:daisylw4.actions.modal
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `openModal(): void`
- `closeModal(): void`
- `confirm(): void`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `btn {{ $class }}`
- `modal-toggle`
- `modal`
