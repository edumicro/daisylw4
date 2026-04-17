<?php
/**
 * Section: sections/wizard
 * Multi-step form using Livewire state.
 *
 * Livewire drives: current step, field values (wire:model), per-step validation.
 * Only the active step's fields are rendered at any time.
 * On final submit, dispatches 'daisy:wizard-submitted' with the merged payload.
 *
 * Expected $section->data:
 * [
 *     'steps' => [
 *         ['label' => 'Company', 'description' => 'Basic info', 'schema' => [...], 'values' => [...]],
 *         ['label' => 'Settings',                               'schema' => [...], 'values' => [...]],
 *         ['label' => 'Confirm',                                'schema' => [...], 'values' => [...]],
 *     ],
 *     'action'       => '/onboarding',
 *     'method'       => 'POST',
 *     'submit_label' => 'Finish Setup',
 * ]
 *
 * Listening for completion:
 *   Livewire.on('daisy:wizard-submitted', ({ payload, action, method }) => { ... })
 */

use Livewire\Component;

new class extends Component {
    /** @var array<int, array<string, mixed>> Values indexed [stepIndex][fieldName] */
    public array $formValues = [];

    public int    $currentStep  = 0;
    public string $action       = '';
    public string $method       = 'POST';
    public string $submitLabel  = '';

    /** @var array<int, array{label: string, description?: string, schema: array, values: array}> */
    public array $steps = [];

    public function mount($section = null): void
    {
        if (!$section) {
            return;
        }

        $data = is_array($section['data'] ?? null) ? $section['data'] : [];

        $this->steps       = array_values($data['steps'] ?? []);
        $this->action      = $section['action'] ?? ($data['action'] ?? '');
        $this->method      = strtoupper($section['method'] ?? ($data['method'] ?? 'POST'));
        $this->submitLabel = $data['submit_label']
            ?? ($section['metadata']['submit_label'] ?? __('Finish'));

        foreach ($this->steps as $i => $step) {
            $this->formValues[$i] = $step['values'] ?? [];
        }
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();

        if ($this->currentStep < count($this->steps) - 1) {
            $this->currentStep++;
        }
    }

    public function prevStep(): void
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
        }
    }

    public function submitWizard(): void
    {
        $this->validateCurrentStep();

        $payload = [];
        foreach ($this->formValues as $stepData) {
            if (is_array($stepData)) {
                $payload = [...$payload, ...$stepData];
            }
        }

        $this->dispatch('daisy:wizard-submitted', [
            'payload' => $payload,
            'action'  => $this->action,
            'method'  => $this->method,
        ]);
    }

    protected function validateCurrentStep(): void
    {
        $schema = $this->steps[$this->currentStep]['schema'] ?? [];
        $rules  = [];

        foreach ($schema as $fieldName => $field) {
            $rule = $field['rules'] ?? $field['validation'] ?? null;
            if (is_string($rule) && $rule !== '') {
                $rules["formValues.{$this->currentStep}.{$fieldName}"] = $rule;
            }
        }

        if (!empty($rules)) {
            $this->validate($rules);
        }
    }

    public function isActionForm(): bool
    {
        return false;
    }

    public function fieldModel(string $name): string
    {
        return "formValues.{$name}";
    }

    public function fieldValue(string $name, array $field): mixed
    {
        return data_get($this->formValues, $name, $field['default'] ?? null);
    }

    public function fieldErrorKey(string $name): string
    {
        return "formValues.{$name}";
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
}; ?>

<div class="space-y-6">

    {{-- ── Steps indicator ─────────────────────────────────────────────────── --}}
    <ul class="steps w-full">
        @foreach($steps as $i => $step)
            @php
                $isCompleted = $i < $currentStep;
                $isActive    = $i === $currentStep;
                $stepClass   = $isCompleted ? 'step-success' : ($isActive ? 'step-primary' : '');
            @endphp
            <li
                data-content="{{ $isCompleted ? '✓' : ($i + 1) }}"
                class="step {{ $stepClass }}"
            >
                <div class="flex flex-col gap-0.5 text-left">
                    <span class="text-sm font-medium leading-tight">{{ __($step['label'] ?? '') }}</span>
                    @if(!empty($step['description']))
                        <span class="text-xs text-base-content/50">{{ __($step['description']) }}</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

    {{-- ── Current step card ──────────────────────────────────────────────── --}}
    @php $stepIndex = (int) $currentStep; @endphp
    @if(isset($steps[$stepIndex]))
        @php
            $step   = $steps[$stepIndex];
            $schema = $step['schema'] ?? [];

            $scopedFields = [];
            foreach ($schema as $fieldName => $fieldDef) {
                $scopedFields["{$stepIndex}.{$fieldName}"] = $fieldDef;
            }
        @endphp

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body">
                @if(!empty($step['label']))
                    <h3 class="card-title text-base">{{ __($step['label']) }}</h3>
                @endif
                @if(!empty($step['description']))
                    <p class="text-sm text-base-content/60 mb-2">{{ __($step['description']) }}</p>
                @endif

                <div class="grid grid-cols-12 gap-4">
                    @include('daisylw4::form.fields', ['fields' => $scopedFields])
                </div>
            </div>
        </div>
    @endif

    {{-- ── Navigation ─────────────────────────────────────────────────────── --}}
    <div class="flex items-center justify-between">

        <button
            type="button"
            wire:click="prevStep"
            @disabled($currentStep === 0)
            class="btn btn-ghost btn-sm"
        >
            <x-heroicon-o-arrow-left class="w-4 h-4" />
            {{ __('Back') }}
        </button>

        <span class="text-sm text-base-content/50">
            {{ $currentStep + 1 }} / {{ count($steps) }}
        </span>

        @if($currentStep < count($steps) - 1)
            <button
                type="button"
                wire:click="nextStep"
                wire:loading.attr="disabled"
                wire:target="nextStep"
                class="btn btn-primary btn-sm"
            >
                <span wire:loading wire:target="nextStep" class="loading loading-spinner loading-xs"></span>
                {{ __('Next') }}
                <x-heroicon-o-arrow-right class="w-4 h-4" />
            </button>
        @else
            <button
                type="button"
                wire:click="submitWizard"
                wire:loading.attr="disabled"
                wire:target="submitWizard"
                class="btn btn-success btn-sm"
            >
                <span wire:loading wire:target="submitWizard" class="loading loading-spinner loading-xs"></span>
                <x-heroicon-o-check class="w-4 h-4" />
                {{ $submitLabel }}
            </button>
        @endif

    </div>

</div>
