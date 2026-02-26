# Steps Component Guide

## Name and Description

**Component:** `daisylw4.navigation.steps`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.steps />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `steps` | `array` | `[]` | Public `steps` property of the component. |
| `currentStep` | `int` | `1` | Public `currentStep` property of the component. |
| `showDescriptions` | `bool` | `true` | Public `showDescriptions` property of the component. |
| `clickable` | `bool` | `false` | Public `clickable` property of the component. |
| `vertical` | `bool` | `false` | Public `vertical` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `step-changed`

## Advanced Example

```blade
<livewire:daisylw4.navigation.steps
    :steps="[]"
    :currentStep="0"
    :showDescriptions="true"
    :clickable="true"
    :vertical="true"
/>
```

Detected public methods:
- `mount(): void`
- `isCompleted(int $step): bool`
- `isActive(int $step): bool`
- `getStepClass(int $step): string`
- `goToStep(int $step): void`
- `nextStep(): void`
- `previousStep(): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `steps {{ $vertical ? 'steps-vertical' : '' }} w-full {{ $class }}`
- `step {{ $stepClass }} {{ $this->clickable ? 'cursor-pointer' : '' }}`
- `flex flex-col gap-1`
