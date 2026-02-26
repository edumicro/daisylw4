# Guía del Componente Text Rotate

## Nombre y Descripción

**Componente:** `daisylw4.display.text-rotate`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.text-rotate />
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
| `texts` | `array` | `[]` | Propiedad pública `texts` del componente. |
| `currentIndex` | `int` | `0` | Propiedad pública `currentIndex` del componente. |
| `duration` | `int` | `3000` | Propiedad pública `duration` del componente. |
| `autoRotate` | `bool` | `true` | Propiedad pública `autoRotate` del componente. |
| `animation` | `string` | `'fade'` | Propiedad pública `animation` del componente. |
| `size` | `string` | `'lg'` | Propiedad pública `size` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `bold` | `bool` | `true` | Propiedad pública `bold` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.text-rotate
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `rotateNext(): void`
- `rotatePrev(): void`
- `getAnimationClass(): string`
- `getSizeClass(): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `mb-4 text-center`
- `text-sm font-medium text-base-content/70`
- `flex items-center justify-center gap-4`
