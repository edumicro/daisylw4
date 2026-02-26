# Guía del Componente Rating

## Nombre y Descripción

**Componente:** `daisylw4.form.rating`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.rating />
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
| `max` | `int` | `5` | Propiedad pública `max` del componente. |
| `type` | `string` | `'star'` | Propiedad pública `type` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `readonly` | `bool` | `false` | Propiedad pública `readonly` del componente. |
| `clearable` | `bool` | `true` | Propiedad pública `clearable` del componente. |
| `half` | `float` | `0` | Propiedad pública `half` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.rating
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `setRating(float $rating): void`
- `clearRating(): void`
- `getSizeClass(): string`
- `getRatingDisplay(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `mb-2`
- `label`
- `label-text font-medium`
