# Alert Component Guide

## Name and Description

**Component:** `daisylw4.feedback.alert`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.alert />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `message` | `string` | `''` | Public `message` property of the component. |
| `title` | `string` | `''` | Public `title` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |
| `closable` | `bool` | `true` | Public `closable` property of the component. |
| `visible` | `bool` | `true` | Public `visible` property of the component. |
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
<livewire:daisylw4.feedback.alert
    message="message-demo"
    title="title-demo"
    icon="icon-demo"
    :closable="true"
    :visible="true"
/>
```

Detected public methods:
- `mount(): void`
- `close(): void`
- `getAlertClass(): string`
- `getDefaultIcon(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `alert {{ $this->getAlertClass() }} {{ $containerClass }}`
- `flex items-start gap-3 w-full {{ $class }}`
- `w-6 h-6 flex-shrink-0`
- `flex-1`
