# Skeleton Component Guide

## Name and Description

**Component:** `daisylw4.feedback.skeleton`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.skeleton />
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
| `type` | `string` | `'card'` | Public `type` property of the component. |
| `lines` | `int` | `3` | Public `lines` property of the component. |
| `animated` | `bool` | `true` | Public `animated` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `width` | `int` | `100` | Public `width` property of the component. |
| `children` | `array` | `[]` | Public `children` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.feedback.skeleton
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getTypeClass(): string`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-4`
- `skeleton rounded w-1/3 h-6 {{ $animated ? 'animate-pulse' : '' }}`
- `space-y-4`
