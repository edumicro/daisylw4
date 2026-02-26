# Guía del Componente Select

## Nombre y Descripción

**Componente:** `daisylw4.form.select`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.select />
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
| `options` | `array` | `[]` | Propiedad pública `options` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `placeholder` | `string` | `''` | Propiedad pública `placeholder` del componente. |
| `multiple` | `bool` | `false` | Propiedad pública `multiple` del componente. |
| `searchable` | `bool` | `true` | Propiedad pública `searchable` del componente. |
| `clearable` | `bool` | `true` | Propiedad pública `clearable` del componente. |
| `lazy` | `bool` | `false` | Propiedad pública `lazy` del componente. |
| `searchQuery` | `string` | `''` | Propiedad pública `searchQuery` del componente. |
| `isOpen` | `bool` | `false` | Propiedad pública `isOpen` del componente. |
| `filteredOptions` | `array` | `[]` | Propiedad pública `filteredOptions` del componente. |
| `debounceMs` | `int` | `300` | Propiedad pública `debounceMs` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `showCount` | `bool` | `true` | Propiedad pública `showCount` del componente. |
| `icon` | `string` | `'heroicon-o-chevron-down'` | Propiedad pública `icon` del componente. |
| `maxResults` | `int` | `10` | Propiedad pública `maxResults` del componente. |
| `loading` | `bool` | `false` | Propiedad pública `loading` del componente. |
| `noResultsText` | `string` | `''` | Propiedad pública `noResultsText` del componente. |
| `loadingText` | `string` | `''` | Propiedad pública `loadingText` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `input`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.select
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `toggleOpen(): void`
- `closeDropdown(): void`
- `search(string $query): void`
- `selectOption(string|int $value): void`
- `clearSelection(): void`
- `removeItem(string|int $value): void`
- `getSelectedLabels(): array`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `form-control w-full {{ $containerClass }}`
- `label`
- `label-text font-medium`
- `relative`
