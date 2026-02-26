# Guía del Componente Chart

## Nombre y Descripción

**Componente:** `daisylw4.display.chart`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.chart />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `id` | `string` | `'chart-default'` | Propiedad pública `id` del componente. |
| `type` | `string` | `'bar'` | Propiedad pública `type` del componente. |
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `labels` | `array` | `[]` | Propiedad pública `labels` del componente. |
| `values` | `array` | `[]` | Propiedad pública `values` del componente. |
| `color` | `string` | `'#570df8'` | Propiedad pública `color` del componente. |
| `refresh` | `string|bool` | `false` | Propiedad pública `refresh` del componente. |

## Eventos

### Eventos que escucha
- `update-chart-{id}`

### Eventos que emite
- `js-refresh-chart-{id}`
- `refresh-data-{id}`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.chart
    id="id-demo"
    type="type-demo"
    title="title-demo"
    :labels="[]"
    :values="[]"
/>
```

Métodos públicos detectados:
- `fetchLiveData(): void`
- `updateData(array $labels, array $values): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `card bg-base-100 shadow-xl border border-base-300`
- `card-body p-4`
- `flex justify-between items-center mb-4`
- `card-title text-sm font-bold opacity-70 uppercase`
