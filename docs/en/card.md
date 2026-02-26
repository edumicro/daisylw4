# Card Component Guide

## Name and Description

**Component:** `daisylw4.display.card`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.card />
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
| `title` | `string` | `''` | Public `title` property of the component. |
| `subtitle` | `string` | `''` | Public `subtitle` property of the component. |
| `body` | `string` | `''` | Public `body` property of the component. |
| `image` | `string` | `''` | Public `image` property of the component. |
| `imageAlt` | `string` | `'Card Image'` | Public `imageAlt` property of the component. |
| `actions` | `array` | `[]` | Public `actions` property of the component. |
| `shadow` | `bool` | `true` | Public `shadow` property of the component. |
| `compact` | `bool` | `false` | Public `compact` property of the component. |
| `background` | `string` | `'base-100'` | Public `background` property of the component. |
| `borderColor` | `string` | `''` | Public `borderColor` property of the component. |
| `hoverable` | `bool` | `false` | Public `hoverable` property of the component. |
| `glass` | `bool` | `false` | Public `glass` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.card
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getBackgroundClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `relative h-64 overflow-hidden`
- `w-full h-full object-cover`
- `card-body {{ $class }}`
- `card-title text-lg font-bold`
