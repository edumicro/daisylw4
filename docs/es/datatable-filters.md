# Guía del Componente Datatable Filters

## Nombre y Descripción

**Componente:** `daisylw4.display.datatable-filters`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.datatable-filters />
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
| `availableFilters` | `array` | `[]` | Propiedad pública `availableFilters` del componente. |
| `activeFilters` | `array` | `[]` | Propiedad pública `activeFilters` del componente. |
| `icon` | `string` | `'heroicon-o-funnel'` | Propiedad pública `icon` del componente. |
| `showBadge` | `bool` | `true` | Propiedad pública `showBadge` del componente. |
| `dropdownPosition` | `string` | `'dropdown-end'` | Propiedad pública `dropdownPosition` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `filters-cleared`
- `filters-updated`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.datatable-filters
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `clearFilters(): void`
- `updateFilter(string $key, mixed $value): void`
- `getActiveFilterCount(): int`
- `isFilterActive(string $key): bool`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `dropdown {{ $dropdownPosition }} {{ $containerClass }}`
- `btn btn-sm btn-ghost gap-2 {{ $class }}`
- `w-4 h-4`
- `loading loading-spinner loading-xs`
