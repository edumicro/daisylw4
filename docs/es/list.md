# Guía del Componente List

## Nombre y Descripción

**Componente:** `daisylw4.display.list`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.list />
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
| `ordered` | `bool` | `false` | Propiedad pública `ordered` del componente. |
| `divided` | `bool` | `true` | Propiedad pública `divided` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `hoverable` | `bool` | `false` | Propiedad pública `hoverable` del componente. |
| `selectable` | `bool` | `false` | Propiedad pública `selectable` del componente. |
| `selected` | `array` | `[]` | Propiedad pública `selected` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.list
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `toggleSelect(int $index): void`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `mb-4 pb-2 border-b border-base-300`
- `font-semibold`
- `list-decimal list-inside {{ $class }} {{ $this->getSizeClass() }} space-y-2`
