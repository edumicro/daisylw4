# Guía del Componente Hover Gallery

## Nombre y Descripción

**Componente:** `daisylw4.display.hover-gallery`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.hover-gallery />
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
| `images` | `array` | `[]` | Propiedad pública `images` del componente. |
| `columns` | `int` | `3` | Propiedad pública `columns` del componente. |
| `showCaptions` | `bool` | `true` | Propiedad pública `showCaptions` del componente. |
| `showOverlay` | `bool` | `true` | Propiedad pública `showOverlay` del componente. |
| `overlayEffect` | `string` | `'slide'` | Propiedad pública `overlayEffect` del componente. |
| `icon` | `string` | `'heroicon-o-photo'` | Propiedad pública `icon` del componente. |
| `rounded` | `bool` | `true` | Propiedad pública `rounded` del componente. |
| `shadow` | `bool` | `true` | Propiedad pública `shadow` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.hover-gallery
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getGridClass(): string`
- `getOverlayClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `flex items-center gap-2 mb-6`
- `w-6 h-6`
- `text-2xl font-bold`
- `grid {{ $this->getGridClass() }} gap-4 {{ $containerClass }}`
