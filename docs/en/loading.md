# Loading Component Guide

## Name and Description

**Component:** `daisylw4.feedback.loading`

Livewire Volt component for DaisyLW4. This page is generated from source code to keep API and events accurate.

## Installation / Basic Usage

```blade
<livewire:daisylw4.feedback.loading />
```

## Properties (API)

| Property | Type | Default | Description |
|---|---|---|---|
| `message` | `string` | `''` | Public `message` property of the component. |
| `color` | `string` | `'primary'` | Public `color` property of the component. |
| `fullScreen` | `bool` | `false` | Public `fullScreen` property of the component. |
| `showMessage` | `bool` | `true` | Public `showMessage` property of the component. |
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
<livewire:daisylw4.feedback.loading
    message="message-demo"
    color="color-demo"
    :fullScreen="true"
    :showMessage="true"
    class="class-demo"
/>
```

Detected public methods:
- `mount(): void`
- `getSizeClass(): string`
- `getColorClass(): string`

## Customization

Use DaisyUI/Tailwind classes in the component view or parent container to adjust visual style and layout.

Detected template classes:
- `flex flex-col items-center gap-4 {{ !$this->fullScreen ? 'p-6' : '' }}`
- `loading loading-spinner {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
- `loading loading-dots {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
- `loading loading-bars {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
