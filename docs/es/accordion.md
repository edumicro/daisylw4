# Guía del Componente Accordion

## Nombre y Descripción

**Componente:** `daisylw4.display.accordion`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.accordion />
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
| `activeIndex` | `?int` | `null` | Propiedad pública `activeIndex` del componente. |
| `icon` | `string` | `'heroicon-o-chevron-right'` | Propiedad pública `icon` del componente. |
| `iconSide` | `string` | `'right'` | Propiedad pública `iconSide` del componente. |
| `allowMultiple` | `bool` | `false` | Propiedad pública `allowMultiple` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.accordion
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `toggleItem(int $index): void`
- `mount(): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `join join-vertical w-full {{ $containerClass }}`
- `label mb-2`
- `label-text font-semibold`
- `collapse collapse-arrow join-item border border-base-300 {{ $item['open'] ?? false ? 'collapse-open' : '' }}`
