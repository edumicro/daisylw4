# Guía del Componente Loading

## Nombre y Descripción

**Componente:** `daisylw4.feedback.loading`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.feedback.loading />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `message` | `string` | `''` | Propiedad pública `message` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `fullScreen` | `bool` | `false` | Propiedad pública `fullScreen` del componente. |
| `showMessage` | `bool` | `true` | Propiedad pública `showMessage` del componente. |
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
<livewire:daisylw4.feedback.loading
    message="message-demo"
    color="color-demo"
    :fullScreen="true"
    :showMessage="true"
    class="class-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `getSizeClass(): string`
- `getColorClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `flex flex-col items-center gap-4 {{ !$this->fullScreen ? 'p-6' : '' }}`
- `loading loading-spinner {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
- `loading loading-dots {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
- `loading loading-bars {{ $this->getSizeClass() }} {{ $this->getColorClass() }}`
