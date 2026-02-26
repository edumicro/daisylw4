# Label Component Guide

## Name and Description

**Component:** `daisylw4.form.label`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.label />
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
| `text` | `string` | `''` | Public `text` property of the component. |
| `for` | `string` | `''` | Public `for` property of the component. |
| `variant` | `string` | `'default'` | Public `variant` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `required` | `bool` | `false` | Public `required` property of the component. |
| `optional` | `bool` | `false` | Public `optional` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `color` | `string` | `''` | Public `color` property of the component. |
| `bold` | `bool` | `false` | Public `bold` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.label
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getVariantClass(): string`
- `getSizeClass(): string`
- `getLabelText(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `label {{ $containerClass }}`
- `flex items-center gap-2`
- `w-4 h-4 flex-shrink-0`
- `text-error font-bold`
