# Guía del Componente Fab

## Nombre y Descripción

**Componente:** `daisylw4.actions.fab`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.actions.fab />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.actions.fab
    label="label-demo"
    :disabled="true"
    id="id-demo"
    class="class-demo"
    :extraAttributes="[]"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `handleClick(): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `fixed {{ $position }} p-6 z-40`
- `tooltip tooltip-left`
- `w-6 h-6`
- `ml-2`
