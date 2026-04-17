<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public array $filters = [];
    public ?\Illuminate\Database\Eloquent\Model $record = null;
    public string $model = '';
    public array $formValues = [];
    public string $modelPrefix = 'record';
    public array $schema = [];
    public string $action = '';

    public string $submitLabel = '';
    public string $submitVariant = 'btn-primary';
    public string $class = '';

    public function mount($section = null, $filters = [], $model = null, $schema = [], $values = [], $action = '') :void
    {
        $this->filters = is_array($filters) ? $filters : [];

        $this->model = is_string($model) ? $model : '';
        $this->action = $action;

        if ($section) {
            $sectionSchema = (array) data_get($section, 'data.schema', []);
            $sectionValues = (array) data_get($section, 'data.values', []);
            $sectionAction = data_get($section, 'action');

            if (!empty($sectionSchema)) {
                $this->schema = $sectionSchema;
                $this->formValues = $sectionValues;
                $this->modelPrefix = 'formValues';
            }

            if (is_string($sectionAction) && $sectionAction !== '') {
                $this->action = $sectionAction;
            }
        }

        if ($schema) {
            $this->schema = $schema;
            $this->formValues = $values;
            $this->modelPrefix = 'formValues';
        }
        if (!$this->record && !empty($this->model)) {
            $this->record = new $this->model;
        }

        if (empty($this->submitLabel)) {
           $this->submitLabel = __('Save');
        }
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, $this->modelPrefix . '.')) {
            $this->validateOnly($propertyName);
        }
    }

    #[Computed]
    public function groupedSchema()
    {
        return collect($this->schema)
            ->sortBy('order')
            ->groupBy(fn($field) => $field['context'] ?? 'main');
    }

    protected function rules(): array
    {
        $rules = [];
        foreach ($this->schema as $name => $field) {
            $fieldRules = $field['rules'] ?? $field['validation'] ?? null;
            if (is_string($fieldRules) && $fieldRules !== '') {
                $rules["{$this->modelPrefix}.{$name}"] = $fieldRules;
            }
        }
        return $rules;
    }

    public function save(): void
    {
        if (!$this->record) return;
        $this->validate();

        try {
            DB::beginTransaction();

            $this->record->save();

            $mode = $this->record->wasRecentlyCreated ? 'created' : 'updated';
            $this->dispatch('form-saved', id: $this->record->id, mode: $mode);

            if ($mode === 'created') {
                $this->record = new $this->model;
            }

            DB::commit();
            $this->dispatch('notify', type: 'success', message: 'Saved correctly');

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $message = str_contains($e->getMessage(), 'Unknown column')
                ? "Error: Missing column in DB. Check migrations."
                : "Database error.";
            $this->dispatch('notify', type: 'error', message: $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', type: 'error', message: $e->getMessage());
        }
    }

}; ?>

<div class="auto-form-container">
    <form @if($action) action="{{ $action }}" method="POST" @else wire:submit="save" @endif class="space-y-6">
        @if($action) @csrf @endif

        @php
            $groups = $this->groupedSchema;
            $hasTabs = $groups->count() > 1;
        @endphp

        @if(!$hasTabs)
            <div class="grid grid-cols-12 gap-4 {{ $class }}">
                @foreach($groups['main'] ?? [] as $name => $field)
                    @include('daisylw4::form.auto-form-field-render', [
                        'name'         => $name,
                        'field'        => $field,
                        'modelBinding' => $this->modelPrefix . '.' . $name,
                    ])
                @endforeach
            </div>
        @else
            <div role="tablist" class="tabs tabs-lifted w-full">
                @foreach($groups as $context => $fields)
                    <input type="radio" name="form_tabs" role="tab" class="tab"
                           aria-label="{{ strtoupper($context) }}"
                           {{ $loop->first ? 'checked' : '' }} />

                    <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                        <div class="grid grid-cols-12 gap-4">
                            @foreach($fields as $name => $field)
                                @include('daisylw4::form.auto-form-field-render', [
                                    'name'         => $name,
                                    'field'        => $field,
                                    'modelBinding' => $this->modelPrefix . '.' . $name,
                                ])
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center gap-3 pt-4">
            <button type="submit" class="btn {{ $submitVariant }}" wire:loading.attr="disabled">
                <span wire:loading class="loading loading-spinner loading-xs"></span>
                {{ $submitLabel }}
            </button>
            @if(isset($actions)) {{ $actions }} @endif
        </div>
    </form>
</div>
