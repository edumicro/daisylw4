# Guía del Componente Tabs

## Nombre y Descripción

**Componente:** `daisylw4.navigation.tabs`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.navigation.tabs />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `tabs` | `array` | `[]` | Propiedad pública `tabs` del componente. |
| `content` | `array` | `[]` | Propiedad pública `content` del componente. |
| `activeTab` | `string` | `''` | Propiedad pública `activeTab` del componente. |
| `color` | `string` | `'primary'` | Propiedad pública `color` del componente. |
| `showIcons` | `bool` | `true` | Propiedad pública `showIcons` del componente. |
| `fullWidth` | `bool` | `false` | Propiedad pública `fullWidth` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |
| `containerClass` | `string` | `''` | Propiedad pública `containerClass` del componente. |
| `contentClass` | `string` | `''` | Propiedad pública `contentClass` del componente. |
| `extraAttributes` | `array` | `[]` | Propiedad pública `extraAttributes` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `tab-changed`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.navigation.tabs
    :tabs="[]"
    :content="[]"
    activeTab="activeTab-demo"
    color="color-demo"
    :showIcons="true"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `activateTab(string $tabId): void`
- `getTabsClass(): string`
- `isTabDisabled(array $tab): bool`
- `getTabContent(string $tabId): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `{{ $this->getTabsClass() }} {{ $class }}`
- `tab gap-2 {{ $isActive ? 'tab-active' : '' }} {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}`
- `w-4 h-4`
