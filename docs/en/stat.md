# Stat Component Guide

## Name and Description

**Component:** `daisylw4.display.stat`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.stat />
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
| `value` | `string` | `''` | Public `value` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `unit` | `string` | `''` | Public `unit` property of the component. |
| `trend` | `string` | `''` | Public `trend` property of the component. |
| `trendValue` | `string` | `''` | Public `trendValue` property of the component. |
| `shadow` | `bool` | `true` | Public `shadow` property of the component. |
| `backgroundColor` | `string` | `'bg-base-100'` | Public `backgroundColor` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.stat
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `isTrendPositive(): bool`
- `getTrendIcon(): string`
- `getTrendColor(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `stat {{ $shadow ? 'shadow' : '' }} {{ $backgroundColor }} rounded-lg p-6 {{ $containerClass }}`
- `flex items-start justify-between mb-4`
- `flex-1`
- `stat-title text-sm text-base-content/70 font-medium`
