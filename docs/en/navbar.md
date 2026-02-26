# Navbar Component Guide

## Name and Description

**Component:** `daisylw4.navigation.navbar`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.navbar />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `brand` | `string` | `''` | Public `brand` property of the component. |
| `items` | `array` | `[]` | Public `items` property of the component. |
| `actions` | `array` | `[]` | Public `actions` property of the component. |
| `mobileMenuOpen` | `bool` | `false` | Public `mobileMenuOpen` property of the component. |
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
<livewire:daisylw4.navigation.navbar
    brand="brand-demo"
    :items="[]"
    :actions="[]"
    :mobileMenuOpen="true"
    class="class-demo"
/>
```

Detected public methods:
- `mount(): void`
- `toggleMobileMenu(): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `navbar bg-base-100 shadow-md sticky top-0 z-40 {{ $containerClass }}`
- `navbar-start`
- `dropdown dropdown-bottom dropdown-left`
- `btn btn-ghost btn-circle lg:hidden`
