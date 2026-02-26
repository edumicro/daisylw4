# Breadcrumb Component Guide

## Name and Description

**Component:** `daisylw4.navigation.breadcrumb`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.breadcrumb />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `items` | `array` | `[]` | Public `items` property of the component. |
| `separator` | `string` | `'/'` | Public `separator` property of the component. |
| `showHomeIcon` | `bool` | `true` | Public `showHomeIcon` property of the component. |
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
<livewire:daisylw4.navigation.breadcrumb
    :items="[]"
    separator="separator-demo"
    :showHomeIcon="true"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `mount(): void`
- `isLast(int $index): bool`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `text-sm breadcrumbs {{ $containerClass }}`
- `flex items-center gap-2 {{ $class }}`
- `text-base-content font-medium`
- `w-4 h-4 inline-block mr-1`
