# Guía del Componente Breadcrumb

## Nombre y Descripción

**Componente:** `daisylw4.navigation.breadcrumb`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.breadcrumb />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `separator` | `string` | `'/'` | Propiedad pública `separator` del componente. |
| `showHomeIcon` | `bool` | `true` | Propiedad pública `showHomeIcon` del componente. |
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
<livewire:daisylw4.navigation.breadcrumb
    :items="[]"
    separator="separator-demo"
    :showHomeIcon="true"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `isLast(int $index): bool`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `text-sm breadcrumbs {{ $containerClass }}`
- `flex items-center gap-2 {{ $class }}`
- `text-base-content font-medium`
- `w-4 h-4 inline-block mr-1`
