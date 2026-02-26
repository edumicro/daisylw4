# Guía del Componente Tooltip

## Nombre y Descripción

**Componente:** `daisylw4.feedback.tooltip`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.tooltip />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `text` | `string` | `''` | Propiedad pública `text` del componente. |
| `color` | `string` | `'info'` | Propiedad pública `color` del componente. |
| `icon` | `string` | `'heroicon-o-question-mark-circle'` | Propiedad pública `icon` del componente. |
| `hasSlot` | `bool` | `false` | Propiedad pública `hasSlot` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `tooltipClass` | `string` | `''` | Propiedad pública `tooltipClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.feedback.tooltip
    text="text-demo"
    color="color-demo"
    icon="icon-demo"
    :hasSlot="true"
    class="class-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getPositionClass(): string`
- `getColorClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `tooltip {{ $this->getPositionClass() }} {{ $tooltipClass }}`
- `w-5 h-5 cursor-help {{ $this->getColorClass() }} {{ $class }}`
- `cursor-help underline underline-offset-2 {{ $this->getColorClass() }} {{ $class }}`
- `flex items-center gap-1 cursor-help {{ $class }}`
