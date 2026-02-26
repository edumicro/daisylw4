# Guía del Componente Carousel

## Nombre y Descripción

**Componente:** `daisylw4.display.carousel`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.carousel />
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
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `activeIndex` | `int` | `0` | Propiedad pública `activeIndex` del componente. |
| `autoplay` | `bool` | `true` | Propiedad pública `autoplay` del componente. |
| `interval` | `int` | `5000` | Propiedad pública `interval` del componente. |
| `showControls` | `bool` | `true` | Propiedad pública `showControls` del componente. |
| `showIndicators` | `bool` | `true` | Propiedad pública `showIndicators` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.carousel
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `nextSlide(): void`
- `prevSlide(): void`
- `goToSlide(int $index): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `carousel carousel-center max-w-4xl mx-auto rounded-box bg-neutral p-4 {{ $containerClass }}`
- `w-full h-96 object-cover rounded-lg`
- `w-full h-96 flex items-center justify-center bg-base-200 rounded-lg`
- `text-center`
