# Guía del Componente Mask

## Nombre y Descripción

**Componente:** `daisylw4.display.mask`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.mask />
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
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `iconSide` | `string` | `'left'` | Propiedad pública `iconSide` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.mask
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ trim($containerClass) }}`
- `flex items-center gap-2 mb-2`
- `h-5 w-5`
- `font-semibold`
