# Guía del Componente Progress

## Nombre y Descripción

**Componente:** `daisylw4.feedback.progress`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.progress />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `value` | `int|float` | `0` | Propiedad pública `value` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `showPercent` | `bool` | `true` | Propiedad pública `showPercent` del componente. |
| `showValue` | `bool` | `false` | Propiedad pública `showValue` del componente. |
| `max` | `int|float` | `100` | Propiedad pública `max` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `indeterminate` | `bool` | `false` | Propiedad pública `indeterminate` del componente. |
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
<livewire:daisylw4.feedback.progress
    :value="0"
    label="label-demo"
    :showPercent="true"
    :showValue="true"
    :max="0"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getSizeClass(): string`
- `getColorClass(): string`
- `getPercentage(): int`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `w-full {{ $containerClass }}`
- `flex justify-between items-center mb-2`
- `text-sm font-medium`
- `text-sm text-base-content/70`
