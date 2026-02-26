# Guía del Componente Menu

## Nombre y Descripción

**Componente:** `daisylw4.navigation.menu`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.menu />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `showIcons` | `bool` | `true` | Propiedad pública `showIcons` del componente. |
| `compact` | `bool` | `false` | Propiedad pública `compact` del componente. |
| `fullWidth` | `bool` | `false` | Propiedad pública `fullWidth` del componente. |
| `collapsedItems` | `array` | `[]` | Propiedad pública `collapsedItems` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `menu-toggle`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.navigation.menu
    :items="[]"
    :showIcons="true"
    :compact="true"
    :fullWidth="true"
    :collapsedItems="[]"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getSizeClass(): string`
- `getDirectionClass(): string`
- `toggleCollapsible(string $itemKey): void`
- `isCollapsed(string $itemKey): bool`
- `isCollapsible(array $item): bool`
- `renderMenuItem(array $item, string $parentKey = ''): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `menu-title`
- `menu-title`
- `menu-title`
- `menu-title`
