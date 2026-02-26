# Menu Component Guide

## Name and Description

**Component:** `daisylw4.navigation.menu`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.menu />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `items` | `array` | `[]` | Public `items` property of the component. |
| `showIcons` | `bool` | `true` | Public `showIcons` property of the component. |
| `compact` | `bool` | `false` | Public `compact` property of the component. |
| `fullWidth` | `bool` | `false` | Public `fullWidth` property of the component. |
| `collapsedItems` | `array` | `[]` | Public `collapsedItems` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `menu-toggle`

## Advanced Example

```blade
<livewire:daisylw4.navigation.menu
    :items="[]"
    :showIcons="true"
    :compact="true"
    :fullWidth="true"
    :collapsedItems="[]"
/>
```

Detected public methods:
- `mount(): void`
- `getSizeClass(): string`
- `getDirectionClass(): string`
- `toggleCollapsible(string $itemKey): void`
- `isCollapsed(string $itemKey): bool`
- `isCollapsible(array $item): bool`
- `renderMenuItem(array $item, string $parentKey = ''): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `menu-title`
- `menu-title`
- `menu-title`
- `menu-title`
