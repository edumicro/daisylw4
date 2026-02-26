# Guía del Componente Dock

## Nombre y Descripción

**Componente:** `daisylw4.navigation.dock`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.dock />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `position` | `string` | `'bottom-center'` | Propiedad pública `position` del componente. |
| `direction` | `string` | `'horizontal'` | Propiedad pública `direction` del componente. |
| `showLabelsOnHover` | `bool` | `true` | Propiedad pública `showLabelsOnHover` del componente. |
| `iconSize` | `string` | `'w-6 h-6'` | Propiedad pública `iconSize` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.navigation.dock
    :items="[]"
    position="position-demo"
    direction="direction-demo"
    :showLabelsOnHover="true"
    iconSize="iconSize-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `handleItemClick(array $item): void`
- `getPositionClass(): string`
- `getDirectionClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `fixed {{ $this->getPositionClass() }} p-4 z-40 {{ $containerClass }}`
- `relative group`
- `btn btn-ghost btn-sm btn-circle relative transition-all duration-200 hover:bg-primary hover:text-primary-content`
- `{{ $this->iconSize }}`
