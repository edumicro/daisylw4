# Guía del Componente Diff

## Nombre y Descripción

**Componente:** `daisylw4.display.diff`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.display.diff />
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
| `changes` | `array` | `[]` | Propiedad pública `changes` del componente. |
| `showLineNumbers` | `bool` | `true` | Propiedad pública `showLineNumbers` del componente. |
| `language` | `string` | `'plaintext'` | Propiedad pública `language` del componente. |
| `icon` | `string` | `'heroicon-o-document-text'` | Propiedad pública `icon` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.display.diff
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `getChangeTypeClass(string $type): string`
- `getChangeTypeBadge(string $type): string`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `diff {{ $containerClass }}`
- `flex items-center gap-2 mb-4 pb-4 border-b border-base-300`
- `w-5 h-5`
- `font-semibold`
