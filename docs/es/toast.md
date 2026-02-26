# Guía del Componente Toast

## Nombre y Descripción

**Componente:** `daisylw4.feedback.toast`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.toast />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `message` | `string` | `''` | Propiedad pública `message` del componente. |
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `autoHide` | `int` | `5000` | Propiedad pública `autoHide` del componente. |
| `position` | `string` | `'bottom-right'` | Propiedad pública `position` del componente. |
| `closable` | `bool` | `true` | Propiedad pública `closable` del componente. |
| `visible` | `bool` | `true` | Propiedad pública `visible` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `toast-auto-hide`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.feedback.toast
    message="message-demo"
    title="title-demo"
    icon="icon-demo"
    :autoHide="0"
    position="position-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `close(): void`
- `getToastClass(): string`
- `getDefaultIcon(): string`
- `getPositionClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `fixed {{ $this->getPositionClass() }} p-4 z-50 pointer-events-none`
- `alert {{ $this->getToastClass() }} shadow-lg {{ $containerClass }} pointer-events-auto max-w-sm {{ $class }}`
- `flex items-start gap-3`
- `w-5 h-5 flex-shrink-0 mt-0.5`
