# Chart Component Guide

## Name and Description

**Component:** `daisylw4.display.chart`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.chart />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `id` | `string` | `'chart-default'` | Public `id` property of the component. |
| `type` | `string` | `'bar'` | Public `type` property of the component. |
| `title` | `string` | `''` | Public `title` property of the component. |
| `labels` | `array` | `[]` | Public `labels` property of the component. |
| `values` | `array` | `[]` | Public `values` property of the component. |
| `color` | `string` | `'#570df8'` | Public `color` property of the component. |
| `refresh` | `string|bool` | `false` | Public `refresh` property of the component. |

## Events

### Listens To
- `update-chart-{id}`

### Emits
- `js-refresh-chart-{id}`
- `refresh-data-{id}`

## Advanced Example

```blade
<livewire:daisylw4.display.chart
    id="id-demo"
    type="type-demo"
    title="title-demo"
    :labels="[]"
    :values="[]"
/>
```

Detected public methods:
- `fetchLiveData(): void`
- `updateData(array $labels, array $values): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `card bg-base-100 shadow-xl border border-base-300`
- `card-body p-4`
- `flex justify-between items-center mb-4`
- `card-title text-sm font-bold opacity-70 uppercase`
