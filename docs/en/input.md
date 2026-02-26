# Input Component Guide

## Name and Description

**Component:** `daisylw4.form.input`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.input />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `name` | `string` | `''` | Public `name` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `type` | `string` | `'text'` | Public `type` property of the component. |
| `placeholder` | `string` | `''` | Public `placeholder` property of the component. |
| `model` | `?string` | `null` | Public `model` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
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
<livewire:daisylw4.form.input
    name="name-demo"
    label="label-demo"
    type="type-demo"
    placeholder="placeholder-demo"
    model="model-demo"
/>
```

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `relative flex items-center`
