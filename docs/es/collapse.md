# Guía del Componente Collapse

## Nombre y Descripción

**Componente:** `daisylw4.display.collapse`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.collapse />
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
| `content` | `string` | `''` | Propiedad pública `content` del componente. |
| `open` | `bool` | `false` | Propiedad pública `open` del componente. |
| `icon` | `string` | `'heroicon-o-chevron-right'` | Propiedad pública `icon` del componente. |
| `iconSide` | `string` | `'left'` | Propiedad pública `iconSide` del componente. |
| `variant` | `string` | `'default'` | Propiedad pública `variant` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.collapse
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `toggle(): void`
- `getVariantClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `peer`
- `collapse-title flex items-center gap-2 font-medium {{ $class }}`
- `w-5 h-5 flex-shrink-0 transition-transform`
- `w-5 h-5 flex-shrink-0 ml-auto transition-transform`
