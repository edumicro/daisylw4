# Validator Component Guide

## Name and Description

**Component:** `daisylw4.form.validator`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.form.validator />
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
| `rules` | `array` | `[]` | Public `rules` property of the component. |
| `messages` | `array` | `[]` | Public `messages` property of the component. |
| `errors` | `array` | `[]` | Public `errors` property of the component. |
| `value` | `string` | `''` | Public `value` property of the component. |
| `showRules` | `bool` | `true` | Public `showRules` property of the component. |
| `validated` | `bool` | `false` | Public `validated` property of the component. |
| `type` | `string` | `'inline'` | Public `type` property of the component. |
| `validationRules` | `array` | `[]` | Public `validationRules` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.form.validator
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `validate(): bool`
- `getRuleInfo(string $rule): array`
- `isRuleValid(string $rule): bool`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `{{ $containerClass }}`
- `mb-4 pb-3 border-b border-base-300`
- `font-semibold`
- `space-y-3`
