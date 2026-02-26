# Guía del Componente Badge

## Nombre y Descripción

**Componente:** `daisylw4.display.badge`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.badge />
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
| `variant` | `string` | `'primary'` | Propiedad pública `variant` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `iconSide` | `string` | `'left'` | Propiedad pública `iconSide` del componente. |
| `outline` | `bool` | `false` | Propiedad pública `outline` del componente. |
| `ghost` | `bool` | `false` | Propiedad pública `ghost` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.badge
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

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `badge {{ $this->getVariantClass() }} {{ $this->getSizeClass() }} gap-2 {{ $class }}`
- `w-3 h-3`
- `w-3 h-3`
- `text-error text-xs block mt-1`
