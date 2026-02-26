# Status Component Guide

## Name and Description

**Component:** `daisylw4.display.status`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.status />
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
| `status` | `string` | `'pending'` | Public `status` property of the component. |
| `text` | `string` | `''` | Public `text` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `pulse` | `bool` | `false` | Public `pulse` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `position` | `string` | `'inline'` | Public `position` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.status
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getStatusColor(): string`
- `getStatusIcon(): string`
- `getStatusLabel(): string`
- `getSizeClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `badge {{ $this->getStatusColor() }} {{ $this->getSizeClass() }} gap-2 {{ $pulse ? 'animate-pulse' : '' }} {{ $class }}`
- `w-3 h-3`
- `flex items-center gap-2 {{ $containerClass }}`
- `flex items-center justify-center`
