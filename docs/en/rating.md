# Rating Component Guide

## Name and Description

**Component:** `daisylw4.form.rating`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.rating />
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
| `value` | `float` | `0` | Public `value` property of the component. |
| `max` | `int` | `5` | Public `max` property of the component. |
| `type` | `string` | `'star'` | Public `type` property of the component. |
| `size` | `string` | `'md'` | Public `size` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `readonly` | `bool` | `false` | Public `readonly` property of the component. |
| `clearable` | `bool` | `true` | Public `clearable` property of the component. |
| `half` | `float` | `0` | Public `half` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.rating
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `setRating(float $rating): void`
- `clearRating(): void`
- `getSizeClass(): string`
- `getRatingDisplay(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-2`
- `label`
- `label-text font-medium`
