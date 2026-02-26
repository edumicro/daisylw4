# Guía del Componente Alert

## Nombre y Descripción

**Componente:** `daisylw4.feedback.alert`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.alert />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `message` | `string` | `''` | Propiedad pública `message` del componente. |
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `closable` | `bool` | `true` | Propiedad pública `closable` del componente. |
| `visible` | `bool` | `true` | Propiedad pública `visible` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.feedback.alert
    message="message-demo"
    title="title-demo"
    icon="icon-demo"
    :closable="true"
    :visible="true"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `close(): void`
- `getAlertClass(): string`
- `getDefaultIcon(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `alert {{ $this->getAlertClass() }} {{ $containerClass }}`
- `flex items-start gap-3 w-full {{ $class }}`
- `w-6 h-6 flex-shrink-0`
- `flex-1`
