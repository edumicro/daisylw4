# Guía del Componente Stat

## Nombre y Descripción

**Componente:** `daisylw4.display.stat`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.stat />
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
| `title` | `string` | `''` | Propiedad pública `title` del componente. |
| `value` | `string` | `''` | Propiedad pública `value` del componente. |
| `description` | `string` | `''` | Propiedad pública `description` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `unit` | `string` | `''` | Propiedad pública `unit` del componente. |
| `trend` | `string` | `''` | Propiedad pública `trend` del componente. |
| `trendValue` | `string` | `''` | Propiedad pública `trendValue` del componente. |
| `shadow` | `bool` | `true` | Propiedad pública `shadow` del componente. |
| `backgroundColor` | `string` | `'bg-base-100'` | Propiedad pública `backgroundColor` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.stat
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `isTrendPositive(): bool`
- `getTrendIcon(): string`
- `getTrendColor(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `stat {{ $shadow ? 'shadow' : '' }} {{ $backgroundColor }} rounded-lg p-6 {{ $containerClass }}`
- `flex items-start justify-between mb-4`
- `flex-1`
- `stat-title text-sm text-base-content/70 font-medium`
