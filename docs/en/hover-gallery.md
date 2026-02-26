# Hover Gallery Component Guide

## Name and Description

**Component:** `daisylw4.display.hover-gallery`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.hover-gallery />
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
| `images` | `array` | `[]` | Public `images` property of the component. |
| `columns` | `int` | `3` | Public `columns` property of the component. |
| `showCaptions` | `bool` | `true` | Public `showCaptions` property of the component. |
| `showOverlay` | `bool` | `true` | Public `showOverlay` property of the component. |
| `overlayEffect` | `string` | `'slide'` | Public `overlayEffect` property of the component. |
| `icon` | `string` | `'heroicon-o-photo'` | Public `icon` property of the component. |
| `rounded` | `bool` | `true` | Public `rounded` property of the component. |
| `shadow` | `bool` | `true` | Public `shadow` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.hover-gallery
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getGridClass(): string`
- `getOverlayClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `flex items-center gap-2 mb-6`
- `w-6 h-6`
- `text-2xl font-bold`
- `grid {{ $this->getGridClass() }} gap-4 {{ $containerClass }}`
