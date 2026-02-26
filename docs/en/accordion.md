# Accordion Component Guide

## Name and Description

**Component:** `daisylw4.display.accordion`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.accordion />
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
| `items` | `array` | `[]` | Public `items` property of the component. |
| `activeIndex` | `?int` | `null` | Public `activeIndex` property of the component. |
| `icon` | `string` | `'heroicon-o-chevron-right'` | Public `icon` property of the component. |
| `iconSide` | `string` | `'right'` | Public `iconSide` property of the component. |
| `allowMultiple` | `bool` | `false` | Public `allowMultiple` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.accordion
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `toggleItem(int $index): void`
- `mount(): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `join join-vertical w-full {{ $containerClass }}`
- `label mb-2`
- `label-text font-semibold`
- `collapse collapse-arrow join-item border border-base-300 {{ $item['open'] ?? false ? 'collapse-open' : '' }}`
