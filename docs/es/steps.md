# Guía del Componente Steps

## Nombre y Descripción

**Componente:** `daisylw4.navigation.steps`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.steps />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `steps` | `array` | `[]` | Propiedad pública `steps` del componente. |
| `currentStep` | `int` | `1` | Propiedad pública `currentStep` del componente. |
| `showDescriptions` | `bool` | `true` | Propiedad pública `showDescriptions` del componente. |
| `clickable` | `bool` | `false` | Propiedad pública `clickable` del componente. |
| `vertical` | `bool` | `false` | Propiedad pública `vertical` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `step-changed`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.navigation.steps
    :steps="[]"
    :currentStep="0"
    :showDescriptions="true"
    :clickable="true"
    :vertical="true"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `isCompleted(int $step): bool`
- `isActive(int $step): bool`
- `getStepClass(int $step): string`
- `goToStep(int $step): void`
- `nextStep(): void`
- `previousStep(): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `steps {{ $vertical ? 'steps-vertical' : '' }} w-full {{ $class }}`
- `step {{ $stepClass }} {{ $this->clickable ? 'cursor-pointer' : '' }}`
- `flex flex-col gap-1`
