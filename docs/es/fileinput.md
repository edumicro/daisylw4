# Guía del Componente Fileinput

## Nombre y Descripción

**Componente:** `daisylw4.form.fileinput`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.fileinput />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `model` | `string` | `''` | Propiedad pública `model` del componente. |
| `label` | `string` | `''` | Propiedad pública `label` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `multiple` | `bool` | `false` | Propiedad pública `multiple` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |
| `uploadedFiles` | `array` | `[]` | Propiedad pública `uploadedFiles` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.fileinput
    model="model-demo"
    label="label-demo"
    description="description-demo"
    :multiple="true"
    :disabled="true"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `handleFileSelected($files): void`
- `removeFile(int $index): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `label-text-alt text-xs`
