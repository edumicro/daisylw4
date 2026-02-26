# Dock Component Guide

## Name and Description

**Component:** `daisylw4.navigation.dock`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.dock />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `items` | `array` | `[]` | Public `items` property of the component. |
| `position` | `string` | `'bottom-center'` | Public `position` property of the component. |
| `direction` | `string` | `'horizontal'` | Public `direction` property of the component. |
| `showLabelsOnHover` | `bool` | `true` | Public `showLabelsOnHover` property of the component. |
| `iconSize` | `string` | `'w-6 h-6'` | Public `iconSize` property of the component. |
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
<livewire:daisylw4.navigation.dock
    :items="[]"
    position="position-demo"
    direction="direction-demo"
    :showLabelsOnHover="true"
    iconSize="iconSize-demo"
/>
```

Detected public methods:
- `mount(): void`
- `handleItemClick(array $item): void`
- `getPositionClass(): string`
- `getDirectionClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `fixed {{ $this->getPositionClass() }} p-4 z-40 {{ $containerClass }}`
- `relative group`
- `btn btn-ghost btn-sm btn-circle relative transition-all duration-200 hover:bg-primary hover:text-primary-content`
- `{{ $this->iconSize }}`
