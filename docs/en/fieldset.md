# Fieldset Component Guide

## Name and Description

**Component:** `daisylw4.form.fieldset`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.fieldset />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `legend` | `string` | `''` | Public `legend` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `columns` | `string` | `'1'` | Public `columns` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `legendClass` | `string` | `''` | Public `legendClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.fieldset
    legend="legend-demo"
    description="description-demo"
    columns="columns-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `mount(): void`
- `getGridClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `border border-base-300 rounded-lg p-6 {{ $containerClass }}`
- `px-3 text-lg font-semibold text-base-content {{ $legendClass }}`
- `text-sm text-base-content/70 mb-4 px-3`
- `{{ $this->getGridClass() }} {{ $class }}`
