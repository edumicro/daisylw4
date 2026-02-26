# Hover 3D Card Component Guide

## Name and Description

**Component:** `daisylw4.display.hover-3d-card`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.hover-3d-card />
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
| `image` | `string` | `''` | Public `image` property of the component. |
| `imageAlt` | `string` | `'Card Image'` | Public `imageAlt` property of the component. |
| `title` | `string` | `''` | Public `title` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `tags` | `array` | `[]` | Public `tags` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `shadow` | `bool` | `true` | Public `shadow` property of the component. |
| `backgroundColor` | `string` | `'bg-base-100'` | Public `backgroundColor` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.hover-3d-card
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `get3DStyles(): array`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `group relative {{ $containerClass }}`
- `relative w-full h-96 rounded-xl overflow-hidden {{ $shadow ? 'shadow-lg' : '' }} transition-all duration-500 ease-out`
- `w-full h-full object-cover transition-transform duration-500 group-hover:scale-110`
- `w-full h-full {{ $backgroundColor }} flex items-center justify-center`
