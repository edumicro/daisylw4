# Guía del Componente Input

## Nombre y Descripción

**Componente:** `daisylw4.form.input`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.input />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `name` | `string` | `''` | Propiedad pública `name` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `type` | `string` | `'text'` | Propiedad pública `type` del componente. |
| `placeholder` | `string` | `''` | Propiedad pública `placeholder` del componente. |
| `model` | `?string` | `null` | Propiedad pública `model` del componente. |
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
<livewire:daisylw4.form.input
    name="name-demo"
    label="label-demo"
    type="type-demo"
    placeholder="placeholder-demo"
    model="model-demo"
/>
```

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `relative flex items-center`
