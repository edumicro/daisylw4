# Guía del Componente Chat Bubble

## Nombre y Descripción

**Componente:** `daisylw4.display.chat-bubble`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.chat-bubble />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `model` | `string` | `''` | Propiedad pública `model` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |
| `message` | `string` | `''` | Propiedad pública `message` del componente. |
| `sender` | `string` | `'user'` | Propiedad pública `sender` del componente. |
| `timestamp` | `string` | `''` | Propiedad pública `timestamp` del componente. |
| `avatar` | `string` | `''` | Propiedad pública `avatar` del componente. |
| `variant` | `string` | `'sent'` | Propiedad pública `variant` del componente. |
| `loading` | `bool` | `false` | Propiedad pública `loading` del componente. |
| `actions` | `array` | `[]` | Propiedad pública `actions` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.chat-bubble
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `isSent(): bool`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `chat {{ $this->isSent() ? 'chat-end' : 'chat-start' }} {{ $containerClass }}`
- `chat-image avatar`
- `w-10 h-10 rounded-full`
- `chat-header`
