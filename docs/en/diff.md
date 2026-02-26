# Diff Component Guide

## Name and Description

**Component:** `daisylw4.display.diff`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.diff />
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
| `changes` | `array` | `[]` | Public `changes` property of the component. |
| `showLineNumbers` | `bool` | `true` | Public `showLineNumbers` property of the component. |
| `language` | `string` | `'plaintext'` | Public `language` property of the component. |
| `icon` | `string` | `'heroicon-o-document-text'` | Public `icon` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.diff
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `getChangeTypeClass(string $type): string`
- `getChangeTypeBadge(string $type): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `diff {{ $containerClass }}`
- `flex items-center gap-2 mb-4 pb-4 border-b border-base-300`
- `w-5 h-5`
- `font-semibold`
