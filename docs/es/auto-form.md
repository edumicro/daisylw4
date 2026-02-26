# Guía del Componente Auto Form

## Nombre y Descripción

**Componente:** `daisylw4.form.auto-form`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.auto-form />
```

## Propiedades (API)

| Propiedad | Tipo | Valor por defecto | Descripción |
|---|---|---|---|
| `schema` | `array` | `[]` | Propiedad pública `schema` del componente. |
| `modelPrefix` | `string` | `''` | Propiedad pública `modelPrefix` del componente. |
| `model` | `string` | `''` | Propiedad pública `model` del componente. |
| `submitLabel` | `string` | `'Submit'` | Propiedad pública `submitLabel` del componente. |
| `submitVariant` | `string` | `'btn-primary'` | Propiedad pública `submitVariant` del componente. |
| `submitLoading` | `bool` | `false` | Propiedad pública `submitLoading` del componente. |
| `submitDisabled` | `bool` | `false` | Propiedad pública `submitDisabled` del componente. |
| `record` | `?\Illuminate\Database\Eloquent\Model` | `null` | Propiedad pública `record` del componente. |
| `containerClass` | `string` | `'space-y-4'` | Propiedad pública `containerClass` del componente. |
| `class` | `string` | `''` | Propiedad pública `class` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- `form-saved`
- `form-submitted`
- `notify`

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.auto-form
    :schema="[]"
    modelPrefix="modelPrefix-demo"
    model="model-demo"
    submitLabel="submitLabel-demo"
    submitVariant="submitVariant-demo"
/>
```

Métodos públicos detectados:
- `mount(): void`
- `save(): void`
- `getComponentForType($type) { return config("daisylw4.component_map.{$type}", 'daisylw4.form.input'); } /** * Build the wire:model path for a field */ public function getModelPath(string $fieldName): string`
- `submit(): void`
- `getFormData(): array`
- `getRules(): array`
- `orderedSchema(): array`
- `getFieldOptions(array $field): array`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `grid grid-cols-12 gap-x-4 gap-y-2 {{ $class }}`
- `{{ $cols }}`
- `$field['class'] ?? ''`
