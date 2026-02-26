# Fileinput Component Guide

## Name and Description

**Component:** `daisylw4.form.fileinput`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.fileinput />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `model` | `string` | `''` | Public `model` property of the component. |
| `label` | `string` | `''` | Public `label` property of the component. |
| `description` | `string` | `''` | Public `description` property of the component. |
| `multiple` | `bool` | `false` | Public `multiple` property of the component. |
| `disabled` | `bool` | `false` | Public `disabled` property of the component. |
| `id` | `string` | `''` | Public `id` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |
| `uploadedFiles` | `array` | `[]` | Public `uploadedFiles` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.fileinput
    model="model-demo"
    label="label-demo"
    description="description-demo"
    :multiple="true"
    :disabled="true"
/>
```

Detected public methods:
- `mount(): void`
- `handleFileSelected($files): void`
- `removeFile(int $index): void`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `label-text-alt text-xs`
