{{--
    Field Bridge — auto-form-field-render.blade.php

    Resolves which Livewire field component to render for a given field type,
    using the 'daisyui.component_map' config as the source of truth.
    Override per-field with a 'component' key in the field definition.

    Expected variables:
    - array  $field        — field definition (type, label, options, …)
    - string $name         — field key / attribute name (e.g. 'email')
    - string $modelBinding — wire:model path (e.g. 'record.email')
--}}

@php
    $fieldType = $field['type'] ?? 'text';

    $componentName = !empty($field['component'])
        ? $field['component']
        : (config("daisyui.component_map.{$fieldType}")
            ?? config('daisyui.component_map.text', 'daisylw4.form.input'));

    $cols = $field['cols'] ?? 'col-span-12';

    $options = [];
    if (!empty($field['options'])) {
        $options = $field['options'];
    } elseif (in_array($fieldType, ['relation', 'relation_search'], true) && isset($field['relation_model'])) {
        $options = $field['relation_model']::all()
            ->pluck($field['relation_label'] ?? 'name', $field['relation_value'] ?? 'id')
            ->toArray();
    }
@endphp

<div class="{{ $cols }} transition-all duration-200">
    @livewire($componentName, [
        'model'       => $modelBinding,
        'label'       => $field['label'] ?? ucfirst(str_replace('_', ' ', $name)),
        'placeholder' => $field['placeholder'] ?? '',
        'type'        => $fieldType,
        'options'     => $options,
        'icon'        => $field['icon'] ?? '',
        'class'       => $field['class'] ?? '',
    ], key('field-' . $name))

    @error($modelBinding)
        <span class="text-error text-xs mt-1">{{ $message }}</span>
    @enderror
</div>
