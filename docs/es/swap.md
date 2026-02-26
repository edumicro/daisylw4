# Guía del Componente Swap

## Nombre y Descripción

**Componente:** `daisylw4.actions.swap`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.actions.swap />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `model` | `string` | `''` | Propiedad pública `model` del componente. |
| `offIcon` | `string` | `'heroicon-o-moon'` | Propiedad pública `offIcon` del componente. |
| `onIcon` | `string` | `'heroicon-o-sun'` | Propiedad pública `onIcon` del componente. |
| `offLabel` | `string` | `''` | Propiedad pública `offLabel` del componente. |
| `onLabel` | `string` | `''` | Propiedad pública `onLabel` del componente. |
| `disabled` | `bool` | `false` | Propiedad pública `disabled` del componente. |
| `id` | `string` | `''` | Propiedad pública `id` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.actions.swap
    model="model-demo"
    offIcon="offIcon-demo"
    onIcon="onIcon-demo"
    offLabel="offLabel-demo"
    onLabel="onLabel-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getAnimationClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `swap swap-animate {{ $this->getAnimationClass() }} {{ $containerClass }}`
- `swap-off`
- `w-5 h-5`
- `ml-2`
