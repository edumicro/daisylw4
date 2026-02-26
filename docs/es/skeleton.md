# Guía del Componente Skeleton

## Nombre y Descripción

**Componente:** `daisylw4.feedback.skeleton`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.skeleton />
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
| `type` | `string` | `'card'` | Propiedad pública `type` del componente. |
| `lines` | `int` | `3` | Propiedad pública `lines` del componente. |
| `animated` | `bool` | `true` | Propiedad pública `animated` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `width` | `int` | `100` | Propiedad pública `width` del componente. |
| `children` | `array` | `[]` | Propiedad pública `children` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.feedback.skeleton
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getTypeClass(): string`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `mb-4`
- `skeleton rounded w-1/3 h-6 {{ $animated ? 'animate-pulse' : '' }}`
- `space-y-4`
