# Guía del Componente Timeline

## Nombre y Descripción

**Componente:** `daisylw4.display.timeline`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.timeline />
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
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `orientation` | `string` | `'vertical'` | Propiedad pública `orientation` del componente. |
| `variant` | `string` | `'default'` | Propiedad pública `variant` del componente. |
| `showConnector` | `bool` | `true` | Propiedad pública `showConnector` del componente. |
| `icon` | `string` | `'heroicon-o-circle'` | Propiedad pública `icon` del componente. |
| `compact` | `bool` | `false` | Propiedad pública `compact` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.timeline
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getVariantColor(string $itemVariant = ''): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `timeline {{ $orientation === 'horizontal' ? 'timeline-horizontal' : 'timeline-vertical' }} {{ $containerClass }}`
- `mb-6 pb-4 border-b border-base-300`
- `text-lg font-bold`
- `timeline-item`
