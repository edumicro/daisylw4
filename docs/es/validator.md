# Guía del Componente Validator

## Nombre y Descripción

**Componente:** `daisylw4.form.validator`

Componente Livewire Volt de DaisyLW4. Esta documentación se genera desde el código fuente para mantener API y eventos actualizados.

## Instalación / Uso Básico

```blade
<livewire:daisylw4.form.validator />
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
| `rules` | `array` | `[]` | Propiedad pública `rules` del componente. |
| `messages` | `array` | `[]` | Propiedad pública `messages` del componente. |
| `errors` | `array` | `[]` | Propiedad pública `errors` del componente. |
| `value` | `string` | `''` | Propiedad pública `value` del componente. |
| `showRules` | `bool` | `true` | Propiedad pública `showRules` del componente. |
| `validated` | `bool` | `false` | Propiedad pública `validated` del componente. |
| `type` | `string` | `'inline'` | Propiedad pública `type` del componente. |
| `validationRules` | `array` | `[]` | Propiedad pública `validationRules` del componente. |

## Eventos

### Eventos que escucha
- No se detectaron listeners `#[On(...)]`.

### Eventos que emite
- No se detectaron emisiones con `$this->dispatch(...)`.

## Ejemplo Avanzado

```blade
<livewire:daisylw4.form.validator
    model="model-demo"
    label="label-demo"
    id="id-demo"
    class="class-demo"
    containerClass="containerClass-demo"
/>
```

Métodos públicos detectados:
- `validate(): bool`
- `getRuleInfo(string $rule): array`
- `isRuleValid(string $rule): bool`

## Personalización

Usa clases DaisyUI/Tailwind en la vista o en el contenedor padre para ajustar aspecto y layout.

Clases detectadas en plantilla:
- `{{ $containerClass }}`
- `mb-4 pb-3 border-b border-base-300`
- `font-semibold`
- `space-y-3`
