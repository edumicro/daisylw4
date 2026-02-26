# Guía del Componente Range

## Nombre y Descripción

**Componente:** `daisylw4.form.range`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.range />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `minModel` | `string` | `''` | Propiedad pública `minModel` del componente. |
| `maxModel` | `string` | `''` | Propiedad pública `maxModel` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `min` | `int|float` | `0` | Propiedad pública `min` del componente. |
| `max` | `int|float` | `100` | Propiedad pública `max` del componente. |
| `step` | `int|float` | `1` | Propiedad pública `step` del componente. |
| `unit` | `string` | `''` | Propiedad pública `unit` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
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
<livewire:daisylw4.form.range
    minModel="minModel-demo"
    maxModel="maxModel-demo"
    label="label-demo"
    description="description-demo"
    :min="0"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `formatValue(int|float $value): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `text-sm text-base-content/70 mb-3`
