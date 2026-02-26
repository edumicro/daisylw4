# Text Rotate Component Guide

## Name and Description

**Component:** `daisylw4.display.text-rotate`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.text-rotate />
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
| `texts` | `array` | `[]` | Public `texts` property of the component. |
| `currentIndex` | `int` | `0` | Public `currentIndex` property of the component. |
| `duration` | `int` | `3000` | Public `duration` property of the component. |
| `autoRotate` | `bool` | `true` | Public `autoRotate` property of the component. |
| `animation` | `string` | `'fade'` | Public `animation` property of the component. |
| `size` | `string` | `'lg'` | Public `size` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `bold` | `bool` | `true` | Public `bold` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.text-rotate
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `rotateNext(): void`
- `rotatePrev(): void`
- `getAnimationClass(): string`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-4 text-center`
- `text-sm font-medium text-base-content/70`
- `flex items-center justify-center gap-4`
