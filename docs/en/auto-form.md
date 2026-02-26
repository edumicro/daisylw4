# Auto Form Component Guide

## Name and Description

**Component:** `daisylw4.form.auto-form`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.auto-form />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `schema` | `array` | `[]` | Public `schema` property of the component. |
| `modelPrefix` | `string` | `''` | Public `modelPrefix` property of the component. |
| `model` | `string` | `''` | Public `model` property of the component. |
| `submitLabel` | `string` | `'Submit'` | Public `submitLabel` property of the component. |
| `submitVariant` | `string` | `'btn-primary'` | Public `submitVariant` property of the component. |
| `submitLoading` | `bool` | `false` | Public `submitLoading` property of the component. |
| `submitDisabled` | `bool` | `false` | Public `submitDisabled` property of the component. |
| `record` | `?\Illuminate\Database\Eloquent\Model` | `null` | Public `record` property of the component. |
| `containerClass` | `string` | `'space-y-4'` | Public `containerClass` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `form-saved`
- `form-submitted`
- `notify`

## Advanced Example

```blade
<livewire:daisylw4.form.auto-form
    :schema="[]"
    modelPrefix="modelPrefix-demo"
    model="model-demo"
    submitLabel="submitLabel-demo"
    submitVariant="submitVariant-demo"
/>
```

Detected public methods:
- `mount(): void`
- `save(): void`
- `getComponentForType($type) { return config("daisylw4.component_map.{$type}", 'daisylw4.form.input'); } /** * Build the wire:model path for a field */ public function getModelPath(string $fieldName): string`
- `submit(): void`
- `getFormData(): array`
- `getRules(): array`
- `orderedSchema(): array`
- `getFieldOptions(array $field): array`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `grid grid-cols-12 gap-x-4 gap-y-2 {{ $class }}`
- `{{ $cols }}`
- `$field['class'] ?? ''`
