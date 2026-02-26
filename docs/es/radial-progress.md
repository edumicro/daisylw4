# Guía del Componente Radial Progress

## Nombre y Descripción

**Componente:** `daisylw4.display.radial-progress`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.radial-progress />
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
| `value` | `float` | `0` | Propiedad pública `value` del componente. |
| `max` | `float` | `100` | Propiedad pública `max` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `thick` | `bool` | `false` | Propiedad pública `thick` del componente. |
| `unit` | `string` | `'%'` | Propiedad pública `unit` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `animated` | `bool` | `true` | Propiedad pública `animated` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.radial-progress
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getPercentage(): float`
- `getSizeClass(): string`
- `getColorClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `flex flex-col items-center gap-4 {{ $containerClass }}`
- `text-center`
- `font-semibold`
- `flex flex-col items-center`
