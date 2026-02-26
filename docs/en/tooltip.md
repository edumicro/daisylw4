# Tooltip Component Guide

## Name and Description

**Component:** `daisylw4.feedback.tooltip`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.tooltip />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `text` | `string` | `''` | Public `text` property of the component. |
| `color` | `string` | `'info'` | Public `color` property of the component. |
| `icon` | `string` | `'heroicon-o-question-mark-circle'` | Public `icon` property of the component. |
| `hasSlot` | `bool` | `false` | Public `hasSlot` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `tooltipClass` | `string` | `''` | Public `tooltipClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.feedback.tooltip
    text="text-demo"
    color="color-demo"
    icon="icon-demo"
    :hasSlot="true"
    class="class-demo"
/>
```

Detected public methods:
- `mount(): void`
- `getPositionClass(): string`
- `getColorClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `tooltip {{ $this->getPositionClass() }} {{ $tooltipClass }}`
- `w-5 h-5 cursor-help {{ $this->getColorClass() }} {{ $class }}`
- `cursor-help underline underline-offset-2 {{ $this->getColorClass() }} {{ $class }}`
- `flex items-center gap-1 cursor-help {{ $class }}`
