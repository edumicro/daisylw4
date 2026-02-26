# Guía del Componente Filter

## Nombre y Descripción

**Componente:** `daisylw4.form.filter`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.filter />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `filters` | `array` | `[]` | Propiedad pública `filters` del componente. |
| `modelPrefix` | `string` | `'filters'` | Propiedad pública `modelPrefix` del componente. |
| `showButton` | `bool` | `true` | Propiedad pública `showButton` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `filters-applied`
- `filters-reset`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.filter
    :filters="[]"
    modelPrefix="modelPrefix-demo"
    :showButton="true"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `applyFilters(): void`
- `resetFilters(): void`
- `getLayoutClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `filter-container {{ $containerClass }}`
- `{{ $this->getLayoutClass() }} {{ $class }}`
- `flex-1 min-w-[200px]`
- `form-control w-full`
