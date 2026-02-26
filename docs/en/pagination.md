# Pagination Component Guide

## Name and Description

**Component:** `daisylw4.navigation.pagination`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.navigation.pagination />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `currentPage` | `int` | `1` | Public `currentPage` property of the component. |
| `total` | `int` | `0` | Public `total` property of the component. |
| `perPage` | `int` | `15` | Public `perPage` property of the component. |
| `showFirstLast` | `bool` | `true` | Public `showFirstLast` property of the component. |
| `showPrevNext` | `bool` | `true` | Public `showPrevNext` property of the component. |
| `queryParam` | `string` | `'page'` | Public `queryParam` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `page-changed`

## Advanced Example

```blade
<livewire:daisylw4.navigation.pagination
    :currentPage="0"
    :total="0"
    :perPage="0"
    :showFirstLast="true"
    :showPrevNext="true"
/>
```

Detected public methods:
- `mount(): void`
- `getTotalPages(): int`
- `getPageNumbers(): array`
- `goToPage(int $page): void`
- `getStartItem(): int`
- `getEndItem(): int`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `flex flex-col gap-4 {{ $containerClass }}`
- `text-sm text-base-content/70 text-center`
- `font-semibold`
- `font-semibold`
