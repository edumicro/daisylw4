# Guía del Componente Status

## Nombre y Descripción

**Componente:** `daisylw4.display.status`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.status />
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
| `status` | `string` | `'pending'` | Propiedad pública `status` del componente. |
| `text` | `string` | `''` | Propiedad pública `text` del componente. |
| `icon` | `string` | `''` | Propiedad pública `icon` del componente. |
| `pulse` | `bool` | `false` | Propiedad pública `pulse` del componente. |
| `size` | `string` | `'md'` | Propiedad pública `size` del componente. |
| `position` | `string` | `'inline'` | Propiedad pública `position` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.status
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getStatusColor(): string`
- `getStatusIcon(): string`
- `getStatusLabel(): string`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `badge {{ $this->getStatusColor() }} {{ $this->getSizeClass() }} gap-2 {{ $pulse ? 'animate-pulse' : '' }} {{ $class }}`
- `w-3 h-3`
- `flex items-center gap-2 {{ $containerClass }}`
- `flex items-center justify-center`
