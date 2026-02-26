# Guía del Componente Label

## Nombre y Descripción

**Componente:** `daisylw4.form.label`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.label />
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
| `text` | `string` | `''` | Propiedad pública `text` del componente. |
| `for` | `string` | `''` | Propiedad pública `for` del componente. |
| `variant` | `string` | `'default'` | Propiedad pública `variant` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `required` | `bool` | `false` | Propiedad pública `required` del componente. |
| `optional` | `bool` | `false` | Propiedad pública `optional` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `color` | `string` | `''` | Propiedad pública `color` del componente. |
| `bold` | `bool` | `false` | Propiedad pública `bold` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.label
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getVariantClass(): string`
- `getSizeClass(): string`
- `getLabelText(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `label {{ $containerClass }}`
- `flex items-center gap-2`
- `w-4 h-4 flex-shrink-0`
- `text-error font-bold`
