# Guía del Componente Fieldset

## Nombre y Descripción

**Componente:** `daisylw4.form.fieldset`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.fieldset />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `legend` | `string` | `''` | Propiedad pública `legend` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `columns` | `string` | `'1'` | Propiedad pública `columns` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `legendClass` | `string` | `''` | Propiedad pública `legendClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.fieldset
    legend="legend-demo"
    description="description-demo"
    columns="columns-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getGridClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `border border-base-300 rounded-lg p-6 {{ $containerClass }}`
- `px-3 text-lg font-semibold text-base-content {{ $legendClass }}`
- `text-sm text-base-content/70 mb-4 px-3`
- `{{ $this->getGridClass() }} {{ $class }}`
