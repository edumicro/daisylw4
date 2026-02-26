# Progress Component Guide

## Name and Description

**Component:** `daisylw4.feedback.progress`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.progress />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `value` | `int|float` | `0` | Public `value` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `showPercent` | `bool` | `true` | Public `showPercent` property of the component. |
| `showValue` | `bool` | `false` | Public `showValue` property of the component. |
| `max` | `int|float` | `100` | Public `max` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `indeterminate` | `bool` | `false` | Public `indeterminate` property of the component. |
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
<livewire:daisylw4.feedback.progress
    :value="0"
    label="label-demo"
    :showPercent="true"
    :showValue="true"
    :max="0"
/>
```

Detected public methods:
- `mount(): void`
- `getSizeClass(): string`
- `getColorClass(): string`
- `getPercentage(): int`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `w-full {{ $containerClass }}`
- `flex justify-between items-center mb-2`
- `text-sm font-medium`
- `text-sm text-base-content/70`
