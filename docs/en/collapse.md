# Collapse Component Guide

## Name and Description

**Component:** `daisylw4.display.collapse`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.collapse />
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
| `content` | `string` | `''` | Public `content` property of the component. |
| `open` | `bool` | `false` | Public `open` property of the component. |
| `icon` | `string` | `'heroicon-o-chevron-right'` | Public `icon` property of the component. |
| `iconSide` | `string` | `'left'` | Public `iconSide` property of the component. |
| `variant` | `string` | `'default'` | Public `variant` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.collapse
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `toggle(): void`
- `getVariantClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `peer`
- `collapse-title flex items-center gap-2 font-medium {{ $class }}`
- `w-5 h-5 flex-shrink-0 transition-transform`
- `w-5 h-5 flex-shrink-0 ml-auto transition-transform`
