# Guía del Componente Data Table

## Nombre y Descripción

**Componente:** `daisylw4.display.data-table`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.data-table />
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
| `columns` | `array` | `[]` | Propiedad pública `columns` del componente. |
| `searchableFields` | `array` | `[]` | Propiedad pública `searchableFields` del componente. |
| `availableScopes` | `array` | `[]` | Propiedad pública `availableScopes` del componente. |
| `search` | `string` | `''` | Propiedad pública `search` del componente. |
| `perPage` | `int` | `10` | Propiedad pública `perPage` del componente. |
| `sortColumn` | `string` | `''` | Propiedad pública `sortColumn` del componente. |
| `sortDirection` | `string` | `'asc'` | Propiedad pública `sortDirection` del componente. |
| `selectable` | `bool` | `false` | Propiedad pública `selectable` del componente. |
| `selected` | `array` | `[]` | Propiedad pública `selected` del componente. |
| `bulkActions` | `array` | `[]` | Propiedad pública `bulkActions` del componente. |
| `showSearch` | `bool` | `true` | Propiedad pública `showSearch` del componente. |
| `showPerPage` | `bool` | `true` | Propiedad pública `showPerPage` del componente. |
| `striped` | `bool` | `true` | Propiedad pública `striped` del componente. |
| `hoverable` | `bool` | `true` | Propiedad pública `hoverable` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `activeScopes` | `array` | `[]` | Propiedad pública `activeScopes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `bulk-action-executed`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.data-table
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `query(): \Illuminate\Database\Eloquent\Builder`
- `data(): LengthAwarePaginator`
- `sortBy(string $column): void`
- `updatedSearch(): void`
- `updatedPerPage(): void`
- `updatedActiveScopes(): void`
- `toggleRow(string|int $rowId): void`
- `toggleAll(): void`
- `clearSelection(): void`
- `executeBulkAction(string $action): void`
- `toggleScope(string $scope, mixed $value = true): void`
- `getSizeClass(): string`
- `getColumnValue(mixed $row, array $column): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `space-y-4 {{ $containerClass }}`
- `flex flex-col md:flex-row justify-between gap-4`
- `flex-1`
- `text-lg font-bold mb-2`
