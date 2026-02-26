# Toast Component Guide

## Name and Description

**Component:** `daisylw4.feedback.toast`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.toast />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `message` | `string` | `''` | Public `message` property of the component. |
| `title` | `string` | `''` | Public `title` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `autoHide` | `int` | `5000` | Public `autoHide` property of the component. |
| `position` | `string` | `'bottom-right'` | Public `position` property of the component. |
| `closable` | `bool` | `true` | Public `closable` property of the component. |
| `visible` | `bool` | `true` | Public `visible` property of the component. |
| `class` | `string` | `''` | Public `class` property of the component. |
| `containerClass` | `string` | `''` | Public `containerClass` property of the component. |
| `extraAttributes` | `array` | `[]` | Public `extraAttributes` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- `toast-auto-hide`

## Advanced Example

```blade
<livewire:daisylw4.feedback.toast
    message="message-demo"
    title="title-demo"
    icon="icon-demo"
    :autoHide="0"
    position="position-demo"
/>
```

Detected public methods:
- `mount(): void`
- `close(): void`
- `getToastClass(): string`
- `getDefaultIcon(): string`
- `getPositionClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `fixed {{ $this->getPositionClass() }} p-4 z-50 pointer-events-none`
- `alert {{ $this->getToastClass() }} shadow-lg {{ $containerClass }} pointer-events-auto max-w-sm {{ $class }}`
- `flex items-start gap-3`
- `w-5 h-5 flex-shrink-0 mt-0.5`
