<?php
/**
 * Component: form.auto-form
 * Orchestrator component that dynamically renders form fields based on a schema array
 * Supports wire:model prefixing and includes a submit button
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Form schema definition
     * Structure: [
     *     [
     *         'name' => 'username',
     *         'type' => 'text', // input, select, checkbox, toggle, etc.
     *         'label' => 'Username',
     *         'placeholder' => 'Enter your username',
     *         'options' => [], // For select components
     *         'class' => '', // Custom classes for field
     *         'rules' => 'required|min:3', // Validation rules
     *         'icon' => 'heroicon-o-user', // Optional icon
     *         'iconSide' => 'left',
     *        'cols' => 'col-span-6', // Grid column span
     *     ],
     *     ...
     * ]
     */
    public array $schema = [];

    /**
     * Model prefix for wire:model
     * e.g., 'form.username' -> wire:model="form.username"
     */
    public string $modelPrefix = '';


    public string $model = '';

    /**
     * Submit button configuration
     */
    public string $submitLabel = 'Submit';
    public string $submitVariant = 'btn-primary';
    public bool $submitLoading = false;
    public bool $submitDisabled = false;

    /**
     * Optional: The actual Eloquent record for editing
     */
    public ?\Illuminate\Database\Eloquent\Model $record = null;

    /**
     * Form styling
     */
    public string $containerClass = 'space-y-4';
    public string $class = '';

    /**
     * Component instance mapping
     */
    protected array $componentMap = [
        'text' => 'form.input',
        'email' => 'form.input',
        'password' => 'form.input',
        'number' => 'form.input',
        'tel' => 'form.input',
        'url' => 'form.input',
        'date' => 'form.input',
        'time' => 'form.input',
        'textarea' => 'form.textarea',
        'relation' => 'form.select',
        'select' => 'form.select',
        'checkbox' => 'form.checkbox',
        'toggle' => 'form.toggle',
        'radio' => 'form.radio',
    ];

    public function mount(): void
    {
        //
    }

    /**
     * Main save method
     */
    public function save(): void
    {
        // 1. Validate data based on schema rules
        $validatedData = $this->validate($this->getRules());

        // 2. Clean the prefix from the data (e.g., from 'user.name' to 'name')
        $data = collect($validatedData)
            ->mapWithKeys(fn($value, $key) => [str_replace($this->modelPrefix . '.', '', $key) => $value])
            ->toArray();

        try {
            if ($this->record && $this->record->exists) {
                // EDIT MODE
                $this->record->update($data);
                $this->dispatch('form-saved', id: $this->record->id, mode: 'updated');
            } else {
                // CREATE MODE
                if (empty($this->model)) {
                    throw new \Exception("Model class must be defined to create a new record.");
                }
                $newRecord = $this->model::create($data);
                $this->dispatch('form-saved', id: $newRecord->id, mode: 'created');
                
                // Optional: Clear the form after creating
                if (empty($this->modelPrefix)) {
                    $this->reset(); 
                } else {
                    $this->reset($this->modelPrefix);
                }
            }

            $this->dispatch('notify', type: 'success', message: 'Guardado correctamente');

        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Error al guardar: ' . $e->getMessage());
        }
    }

    /**
     * Get the component name for a given field type
     */
   

    public function getComponentForType($type)
    {
        return config("daisylw4.component_map.{$type}", 'daisylw4.form.input');
    }

    /**
     * Build the wire:model path for a field
     */
    public function getModelPath(string $fieldName): string
    {
        if (empty($this->modelPrefix)) {
            return $fieldName;
        }

        return "{$this->modelPrefix}.{$fieldName}";
    }

    /**
     * Handle form submission
     */
    public function submit(): void
    {
        // Validation is handled by the parent component
        $this->dispatch('form-submitted', formData: $this->getFormData());
    }

    /**
     * Get all form data as an array
     */
    public function getFormData(): array
    {
        $data = [];
        foreach ($this->schema as $field) {
            $modelPath = $this->getModelPath($field['name']);
            $data[$field['name']] = data_get($this, $modelPath);
        }
        return $data;
    }


    /**
     * Get validation rules from schema
     */
    public function getRules(): array
    {
        $rules = [];
        foreach ($this->schema as $field) {
            if (isset($field['rules'])) {
                $rules[$this->getModelPath($field['name'])] = $field['rules'];
            }
        }
        return $rules;
    }

    /**
     * Schema ordered by 'order' key
     */
    #[Computed]
    public function orderedSchema(): array
    {
        return collect($this->schema)
            ->map(function ($field, $index) {
                // Ensure it has an order, if not, use multiples of 10
                $field['order'] = $field['order'] ?? ($index + 1) * 10;
                return $field;
            })
            ->sortBy('order')
            ->values()
            ->toArray();
    }

    /**
     * Resolve options for select/relation fields
     */
    public function getFieldOptions(array $field): array
    {
        // Si ya trae opciones estáticas, las usamos
        if (!empty($field['options'])) {
            return $field['options'];
        }

        // Si es una relación, intentamos resolverla
        if (($field['type'] ?? '') === 'relation' && isset($field['relation_model'])) {
            $model = $field['relation_model'];
            $labelField = $field['relation_label'] ?? config('daisylw4.relations.default_label', 'name');
            $valueField = $field['relation_value'] ?? 'id';

            return $model::all()->pluck($labelField, $valueField)->toArray();
        }

        return [];
    }
}; ?>

<form wire:submit.prevent="save" class="{{ $containerClass }}">
    <div class="grid grid-cols-12 gap-x-4 gap-y-2 {{ $class }}">
        @foreach($this->orderedSchema as $field) 
            @php
                $fieldName = $field['name'];
                $fieldType = $field['type'] ?? 'text';
                $component = $this->getComponentForType($fieldType);
                $modelPath = $this->getModelPath($fieldName);
                $cols = $field['cols'] ?? 'col-span-12';
                
                // If data-origin is not set, default to 'core' , this is for tracking where the field comes from
                $origin = $field['data-origin'] ?? 'core';
                
                // Options resolution (relations or static)
                $options = ($fieldType === 'relation' || $fieldType === 'select') 
                    ? $this->getFieldOptions($field) 
                    : ($field['options'] ?? []);
            @endphp

            <div 
                class="{{ $cols }}" 
                data-origin="{{ $origin }}" 
                data-field="{{ $fieldName }}"
            >
                @if(isset(${$fieldName}))
                    {{ ${$fieldName} }}
                @else
                    <livewire:dynamic-component
                        :key="'field-'.$fieldName"
                        :component="$component"
                        wire:model="$modelPath"
                        :label="$field['label'] ?? ''"
                        :placeholder="$field['placeholder'] ?? ''"
                        :type="$fieldType"
                        :options="$options"
                        :disabled="$field['disabled'] ?? false"
                        :icon="$field['icon'] ?? ''"
                        :iconSide="$field['iconSide'] ?? 'left'"
                        :class="$field['class'] ?? ''"
                    />
                @endif
            </div>
        @endforeach

        <div class="col-span-12 pt-6">
            <div class="flex items-center gap-2">
                <livewire:actions.button
                    :label="$submitLabel"
                    type="submit"
                    :variant="$submitVariant"
                    wire:loading.attr="disabled"
                />

                <span wire:loading class="loading loading-spinner loading-sm text-primary"></span>
                
                @if(isset($actions))
                    {{ $actions }}
                @endif
            </div>
        </div>
    </div>
</form>
