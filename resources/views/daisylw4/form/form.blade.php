<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public array $filters = [];
    public array $formValues = [];
    public array $schema = [];
    public string $action = '';
    public string $method = 'POST';

    public string $submitLabel = '';
    public string $submitVariant = 'btn-primary';
    public string $class = '';

    public function mount($section = null, $filters = [], $schema = [], $values = [], $action = ''): void
    {
        $this->filters = is_array($filters) ? $filters : [];
        $this->action = is_string($action) ? $action : '';

        if ($section) {
            $sectionSchema = (array) data_get($section, 'data.schema', []);
            $sectionValues = (array) data_get($section, 'data.values', []);
            $sectionAction = data_get($section, 'action');
            $sectionMethod = data_get($section, 'method');
            $sectionSubmitLabel = data_get($section, 'metadata.submit_label');

            if (!empty($sectionSchema)) {
                $this->schema = $sectionSchema;
            }

            if (!empty($sectionValues)) {
                $this->formValues = $sectionValues;
            }

            if (is_string($sectionAction) && $sectionAction !== '') {
                $this->action = $sectionAction;
            }

            if (is_string($sectionMethod) && $sectionMethod !== '') {
                $this->method = strtoupper($sectionMethod);
            }

            if (is_string($sectionSubmitLabel) && $sectionSubmitLabel !== '') {
                $this->submitLabel = $sectionSubmitLabel;
            }
        }

        if ($schema !== []) {
            $this->schema = $schema;
        }

        if (is_array($values) && $values !== []) {
            $this->formValues = $values;
        }

        if ($this->submitLabel === '') {
            $this->submitLabel = __('Submit');
        }
    }

    #[Computed]
    public function normalizedSchema(): array
    {
        $normalized = [];

        foreach ($this->schema as $key => $field) {
            if (!is_array($field)) {
                continue;
            }

            $name = $this->resolveFieldName($key, $field);
            if ($name === '') {
                continue;
            }

            $field['name'] = $name;
            $normalized[$name] = $field;
        }

        return $normalized;
    }

    #[Computed]
    public function groupedSchema()
    {
        return collect($this->normalizedSchema)
            ->sortBy('order')
            ->groupBy(fn ($field) => $field['context'] ?? 'main', preserveKeys: true);
    }

    protected function resolveFieldName(string|int $key, array $field): string
    {
        $candidates = [
            $field['name'] ?? null,
            $field['field'] ?? null,
            $field['attribute'] ?? null,
            is_string($key) ? $key : null,
        ];

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && trim($candidate) !== '') {
                return trim($candidate);
            }
        }

        return '';
    }

    public function getFieldOptions(array $field): array
    {
        if (!empty($field['options'])) {
            return $field['options'];
        }

        if (in_array($field['type'] ?? '', ['relation', 'relation_search'], true) && isset($field['relation_model'])) {
            return $field['relation_model']::all()
                ->pluck($field['relation_label'] ?? 'name', $field['relation_value'] ?? 'id')
                ->toArray();
        }

        return [];
    }

    public function isMultipleField(array $field): bool
    {
        return in_array($field['type'] ?? '', ['multiselect', 'tags'], true)
            || !empty($field['multiple']);
    }

    public function fieldInputType(array $field): string
    {
        return match($field['type'] ?? 'text') {
            'email'               => 'email',
            'password'            => 'password',
            'number', 'money', 'percentage' => 'number',
            'date'                => 'date',
            'datetime'            => 'datetime-local',
            'color'               => 'color',
            'file'                => 'file',
            default               => 'text',
        };
    }

    public function fieldModel(string $name): string
    {
        return "formValues.{$name}";
    }

    public function fieldErrorKey(string $name): string
    {
        return $name;
    }

    public function fieldValue(string $name, array $field): mixed
    {
        return data_get($this->formValues, $name, $field['default'] ?? null);
    }

    public function isActionForm(): bool
    {
        return $this->action !== '';
    }
}; ?>

<div class="auto-form-container">
    <form
        action="{{ $action ?: '#' }}"
        method="{{ in_array($method, ['GET', 'POST'], true) ? $method : 'POST' }}"
        class="space-y-6"
    >
        @csrf
        @if(!in_array($method, ['GET', 'POST'], true))
            @method($method)
        @endif

        @php
            $groups = $this->groupedSchema;
            $hasTabs = $groups->count() > 1;
        @endphp

        @if(!$hasTabs)
            <div class="grid grid-cols-12 gap-4 {{ $class }}">
                @include('daisylw4::form.fields', ['fields' => $groups->first() ?? []])
            </div>
        @else
            <div role="tablist" class="tabs tabs-lifted w-full">
                @foreach($groups as $context => $fields)
                    <input type="radio" name="form_tabs" role="tab" class="tab" aria-label="{{ strtoupper($context) }}" {{ $loop->first ? 'checked' : '' }} />
                    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                        <div class="grid grid-cols-12 gap-4">
                            @include('daisylw4::form.fields', ['fields' => $fields])
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="btn {{ $submitVariant }}" @disabled($action === '')>
                {{ $submitLabel }}
            </button>
            @if(isset($actions)) {{ $actions }} @endif
        </div>
    </form>
</div>
