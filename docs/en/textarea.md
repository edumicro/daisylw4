# Textarea Component Guide

## Name and Description

**Component:** `daisylw4.form.textarea`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.textarea />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `model` | `string` | `''` | Public `model` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `placeholder` | `string` | `''` | Public `placeholder` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `rows` | `int` | `4` | Public `rows` property of the component. |
| `minLength` | `int` | `0` | Public `minLength` property of the component. |
| `maxLength` | `int` | `0` | Public `maxLength` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `readonly` | `bool` | `false` | Public `readonly` property of the component. |
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
<livewire:daisylw4.form.textarea
    model="model-demo"
    label="label-demo"
    placeholder="placeholder-demo"
    description="description-demo"
    :rows="0"
/>
```

Detected public methods:
- `mount(): void`
- `getCharCountDisplay(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `label-text-alt text-xs`
