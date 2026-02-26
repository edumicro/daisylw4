# Carousel Component Guide

## Name and Description

**Component:** `daisylw4.display.carousel`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.carousel />
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
| `activeIndex` | `int` | `0` | Public `activeIndex` property of the component. |
| `autoplay` | `bool` | `true` | Public `autoplay` property of the component. |
| `interval` | `int` | `5000` | Public `interval` property of the component. |
| `showControls` | `bool` | `true` | Public `showControls` property of the component. |
| `showIndicators` | `bool` | `true` | Public `showIndicators` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.carousel
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `nextSlide(): void`
- `prevSlide(): void`
- `goToSlide(int $index): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `carousel carousel-center max-w-4xl mx-auto rounded-box bg-neutral p-4 {{ $containerClass }}`
- `w-full h-96 object-cover rounded-lg`
- `w-full h-96 flex items-center justify-center bg-base-200 rounded-lg`
- `text-center`
