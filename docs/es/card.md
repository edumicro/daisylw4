# Guía del Componente Card

## Nombre y Descripción

**Componente:** `daisylw4.display.card`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.card />
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
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `subtitle` | `string` | `''` | Propiedad pública `subtitle` del componente. |
| `body` | `string` | `''` | Propiedad pública `body` del componente. |
| `image` | `string` | `''` | Propiedad pública `image` del componente. |
| `imageAlt` | `string` | `'Card Image'` | Propiedad pública `imageAlt` del componente. |
| `actions` | `array` | `[]` | Propiedad pública `actions` del componente. |
| `shadow` | `bool` | `true` | Propiedad pública `shadow` del componente. |
| `compact` | `bool` | `false` | Propiedad pública `compact` del componente. |
| `background` | `string` | `'base-100'` | Propiedad pública `background` del componente. |
| `borderColor` | `string` | `''` | Propiedad pública `borderColor` del componente. |
| `hoverable` | `bool` | `false` | Propiedad pública `hoverable` del componente. |
| `glass` | `bool` | `false` | Propiedad pública `glass` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.card
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getBackgroundClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `relative h-64 overflow-hidden`
- `w-full h-full object-cover`
- `card-body {{ $class }}`
- `card-title text-lg font-bold`
