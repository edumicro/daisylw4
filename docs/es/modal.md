# Guía del Componente Modal

## Nombre y Descripción

**Componente:** `daisylw4.actions.modal`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.actions.modal />
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
| `open` | `bool` | `false` | Propiedad pública `open` del componente. |
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `content` | `string` | `''` | Propiedad pública `content` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `backdropClose` | `bool` | `true` | Propiedad pública `backdropClose` del componente. |
| `showClose` | `bool` | `true` | Propiedad pública `showClose` del componente. |
| `showActions` | `bool` | `true` | Propiedad pública `showActions` del componente. |
| `confirmText` | `string` | `''` | Propiedad pública `confirmText` del componente. |
| `cancelText` | `string` | `''` | Propiedad pública `cancelText` del componente. |
| `confirmVariant` | `string` | `'btn-primary'` | Propiedad pública `confirmVariant` del componente. |
| `cancelVariant` | `string` | `'btn-ghost'` | Propiedad pública `cancelVariant` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `modal-confirmed`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.actions.modal
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `openModal(): void`
- `closeModal(): void`
- `confirm(): void`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `btn {{ $class }}`
- `modal-toggle`
- `modal`
