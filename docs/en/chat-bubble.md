# Chat Bubble Component Guide

## Name and Description

**Component:** `daisylw4.display.chat-bubble`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.display.chat-bubble />
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
| `message` | `string` | `''` | Public `message` property of the component. |
| `sender` | `string` | `'user'` | Public `sender` property of the component. |
| `timestamp` | `string` | `''` | Public `timestamp` property of the component. |
| `avatar` | `string` | `''` | Public `avatar` property of the component. |
| `variant` | `string` | `'sent'` | Public `variant` property of the component. |
| `loading` | `bool` | `false` | Public `loading` property of the component. |
| `actions` | `array` | `[]` | Public `actions` property of the component. |
| `icon` | `string` | `''` | Public `icon` property of the component. |

## Events

### Listens To
- No `#[On(...)]` listeners were detected.

### Emits
- No `$this->dispatch(...)` event emissions were detected.

## Advanced Example

```blade
<livewire:daisylw4.display.chat-bubble
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Detected public methods:
- `isSent(): bool`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `chat {{ $this->isSent() ? 'chat-end' : 'chat-start' }} {{ $containerClass }}`
- `chat-image avatar`
- `w-10 h-10 rounded-full`
- `chat-header`
