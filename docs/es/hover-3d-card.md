# Guía del Componente Hover 3D Card

## Nombre y Descripción

**Componente:** `daisylw4.display.hover-3d-card`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.hover-3d-card />
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
| `image` | `string` | `''` | Propiedad pública `image` del componente. |
| `imageAlt` | `string` | `'Card Image'` | Propiedad pública `imageAlt` del componente. |
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `tags` | `array` | `[]` | Propiedad pública `tags` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `shadow` | `bool` | `true` | Propiedad pública `shadow` del componente. |
| `backgroundColor` | `string` | `'bg-base-100'` | Propiedad pública `backgroundColor` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.hover-3d-card
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `get3DStyles(): array`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `group relative {{ $containerClass }}`
- `relative w-full h-96 rounded-xl overflow-hidden {{ $shadow ? 'shadow-lg' : '' }} transition-all duration-500 ease-out`
- `w-full h-full object-cover transition-transform duration-500 group-hover:scale-110`
- `w-full h-full {{ $backgroundColor }} flex items-center justify-center`
