# Swap Component Guide

## Name and Description

**Component:** `daisylw4.actions.swap`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.actions.swap />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `model` | `string` | `''` | Public `model` property of the component. |
| `offIcon` | `string` | `'heroicon-o-moon'` | Public `offIcon` property of the component. |
| `onIcon` | `string` | `'heroicon-o-sun'` | Public `onIcon` property of the component. |
| `offLabel` | `string` | `''` | Public `offLabel` property of the component. |
| `onLabel` | `string` | `''` | Public `onLabel` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.actions.swap
    model="model-demo"
    offIcon="offIcon-demo"
    onIcon="onIcon-demo"
    offLabel="offLabel-demo"
    onLabel="onLabel-demo"
/>
```

Detected public methods:
- `mount(): void`
- `getAnimationClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `swap swap-animate {{ $this->getAnimationClass() }} {{ $containerClass }}`
- `swap-off`
- `w-5 h-5`
- `ml-2`
