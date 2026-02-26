# Guía del Componente Avatar

## Nombre y Descripción

**Componente:** `daisylw4.display.avatar`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.avatar />
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
| `src` | `string` | `''` | Propiedad pública `src` del componente. |
| `alt` | `string` | `'Avatar'` | Propiedad pública `alt` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `online` | `bool` | `false` | Propiedad pública `online` del componente. |
| `offline` | `bool` | `false` | Propiedad pública `offline` del componente. |
| `placeholder` | `bool` | `false` | Propiedad pública `placeholder` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `initials` | `string` | `''` | Propiedad pública `initials` del componente. |
| `color` | `string` | `'neutral'` | Propiedad pública `color` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.avatar
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `flex items-center gap-2 {{ $containerClass }}`
- `text-sm font-medium`
- `avatar {{ $online ? 'online' : '' }} {{ $offline ? 'offline' : '' }} {{ $class }}`
- `{{ $this->getSizeClass() }} rounded-full {{ $placeholder ? 'bg-' . $color . ' flex items-center justify-center' : '' }}`
