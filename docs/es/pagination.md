# Guía del Componente Pagination

## Nombre y Descripción

**Componente:** `daisylw4.navigation.pagination`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.pagination />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `currentPage` | `int` | `1` | Propiedad pública `currentPage` del componente. |
| `total` | `int` | `0` | Propiedad pública `total` del componente. |
| `perPage` | `int` | `15` | Propiedad pública `perPage` del componente. |
| `showFirstLast` | `bool` | `true` | Propiedad pública `showFirstLast` del componente. |
| `showPrevNext` | `bool` | `true` | Propiedad pública `showPrevNext` del componente. |
| `queryParam` | `string` | `'page'` | Propiedad pública `queryParam` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `page-changed`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.navigation.pagination
    :currentPage="0"
    :total="0"
    :perPage="0"
    :showFirstLast="true"
    :showPrevNext="true"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getTotalPages(): int`
- `getPageNumbers(): array`
- `goToPage(int $page): void`
- `getStartItem(): int`
- `getEndItem(): int`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `flex flex-col gap-4 {{ $containerClass }}`
- `text-sm text-base-content/70 text-center`
- `font-semibold`
- `font-semibold`
