# Tabs Component Guide

## Name and Description

**Component:** `daisylw4.navigation.tabs`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.tabs />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `tabs` | `array` | `[]` | Public `tabs` property of the component. |
| `content` | `array` | `[]` | Public `content` property of the component. |
| `activeTab` | `string` | `''` | Public `activeTab` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `showIcons` | `bool` | `true` | Public `showIcons` property of the component. |
| `fullWidth` | `bool` | `false` | Public `fullWidth` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `contentClass` | `string` | `''` | Public `contentClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `tab-changed`

## Advanced Example

```blade
<livewire:daisylw4.navigation.tabs
    :tabs="[]"
    :content="[]"
    activeTab="activeTab-demo"
    color="color-demo"
    :showIcons="true"
/>
```

Detected public methods:
- `mount(): void`
- `activateTab(string $tabId): void`
- `getTabsClass(): string`
- `isTabDisabled(array $tab): bool`
- `getTabContent(string $tabId): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `{{ $this->getTabsClass() }} {{ $class }}`
- `tab gap-2 {{ $isActive ? 'tab-active' : '' }} {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}`
- `w-4 h-4`
