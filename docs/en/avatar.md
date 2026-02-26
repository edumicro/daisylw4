# Avatar Component Guide

## Name and Description

**Component:** `daisylw4.display.avatar`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.avatar />
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
| `src` | `string` | `''` | Public `src` property of the component. |
| `alt` | `string` | `'Avatar'` | Public `alt` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `online` | `bool` | `false` | Public `online` property of the component. |
| `offline` | `bool` | `false` | Public `offline` property of the component. |
| `placeholder` | `bool` | `false` | Public `placeholder` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `initials` | `string` | `''` | Public `initials` property of the component. |
| `color` | `string` | `'neutral'` | Public `color` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.avatar
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `flex items-center gap-2 {{ $containerClass }}`
- `text-sm font-medium`
- `avatar {{ $online ? 'online' : '' }} {{ $offline ? 'offline' : '' }} {{ $class }}`
- `{{ $this->getSizeClass() }} rounded-full {{ $placeholder ? 'bg-' . $color . ' flex items-center justify-center' : '' }}`
