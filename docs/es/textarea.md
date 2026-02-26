# Guía del Componente Textarea

## Nombre y Descripción

**Componente:** `daisylw4.form.textarea`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.textarea />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `model` | `string` | `''` | Propiedad pública `model` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `placeholder` | `string` | `''` | Propiedad pública `placeholder` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `rows` | `int` | `4` | Propiedad pública `rows` del componente. |
| `minLength` | `int` | `0` | Propiedad pública `minLength` del componente. |
| `maxLength` | `int` | `0` | Propiedad pública `maxLength` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `readonly` | `bool` | `false` | Propiedad pública `readonly` del componente. |
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
<livewire:daisylw4.form.textarea
    model="model-demo"
    label="label-demo"
    placeholder="placeholder-demo"
    description="description-demo"
    :rows="0"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getCharCountDisplay(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `label-text-alt text-xs`
