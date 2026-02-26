# Guía del Componente Button

## Nombre y Descripción

**Componente:** `daisylw4.actions.button`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.actions.button />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `label` | `string` | `'Click me'` | Propiedad pública `label` del componente. |
| `type` | `string` | `'button'` | Propiedad pública `type` del componente. |
| `loading` | `bool` | `false` | Propiedad pública `loading` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `iconOnly` | `bool` | `false` | Propiedad pública `iconOnly` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.actions.button
    label="label-demo"
    type="type-demo"
    :loading="true"
    :disabled="true"
    id="id-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `btn-disabled`
- `loading loading-spinner loading-xs`
- `flex items-center`
