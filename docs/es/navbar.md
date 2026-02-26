# Guía del Componente Navbar

## Nombre y Descripción

**Componente:** `daisylw4.navigation.navbar`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.navbar />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `brand` | `string` | `''` | Propiedad pública `brand` del componente. |
| `items` | `array` | `[]` | Propiedad pública `items` del componente. |
| `actions` | `array` | `[]` | Propiedad pública `actions` del componente. |
| `mobileMenuOpen` | `bool` | `false` | Propiedad pública `mobileMenuOpen` del componente. |
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
<livewire:daisylw4.navigation.navbar
    brand="brand-demo"
    :items="[]"
    :actions="[]"
    :mobileMenuOpen="true"
    class="class-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `toggleMobileMenu(): void`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `navbar bg-base-100 shadow-md sticky top-0 z-40 {{ $containerClass }}`
- `navbar-start`
- `dropdown dropdown-bottom dropdown-left`
- `btn btn-ghost btn-circle lg:hidden`
