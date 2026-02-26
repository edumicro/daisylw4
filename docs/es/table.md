# Guía del Componente Table

## Nombre y Descripción

**Componente:** `daisylw4.display.table`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.table />
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
| `rows` | `array` | `[]` | Propiedad pública `rows` del componente. |
| `data` | `array` | `[]` | Propiedad pública `data` del componente. |
| `striped` | `bool` | `true` | Propiedad pública `striped` del componente. |
| `hoverable` | `bool` | `true` | Propiedad pública `hoverable` del componente. |
| `compact` | `bool` | `false` | Propiedad pública `compact` del componente. |
| `responsive` | `bool` | `true` | Propiedad pública `responsive` del componente. |
| `showHeader` | `bool` | `true` | Propiedad pública `showHeader` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `actions` | `array` | `[]` | Propiedad pública `actions` del componente. |
| `selectable` | `bool` | `false` | Propiedad pública `selectable` del componente. |
| `selected` | `array` | `[]` | Propiedad pública `selected` del componente. |
| `sortColumn` | `string` | `''` | Propiedad pública `sortColumn` del componente. |
| `sortDirection` | `string` | `'asc'` | Propiedad pública `sortDirection` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.table
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `toggleRow(string|int $rowId): void`
- `toggleAllRows(): void`
- `sortBy(string $column): void`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `overflow-x-auto {{ $containerClass }}`
- `mb-4 pb-4 border-b border-base-300`
- `text-lg font-bold`
- `bg-base-200/50`
