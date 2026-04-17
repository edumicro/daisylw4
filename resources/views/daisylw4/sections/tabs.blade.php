<?php
/**
 * Section: sections/tabs
 * Renders a Section of type 'tabs'.
 *
 * Livewire only drives tab switching ($activeTab). Field values travel as plain
 * HTML inputs (name="tabId[field]") so the controller receives a standard POST.
 * The section schema is the same shape used by form.blade.php.
 *
 * Expected $section->data:
 * [
 *     'tabs' => [
 *         [
 *             'id'     => 'general',
 *             'label'  => 'General',
 *             'icon'   => 'heroicon-o-cog',  // optional
 *             'schema' => ['name' => ['type' => 'text', 'label' => 'Name', ...], ...],
 *             'values' => ['name' => 'Acme'],
 *         ],
 *         ...
 *     ],
 *     'action'       => '/settings',          // form action URL
 *     'method'       => 'POST',
 *     'submit_label' => 'Save',
 * ]
 */

use Livewire\Component;

new class extends Component {
    public string $activeTab  = '';
    public string $action     = '';
    public string $method     = 'POST';
    public string $submitLabel = '';

    /** @var array<int, array{id: string, label: string, schema: array, values: array}> */
    public array $tabs = [];

    public function mount($section = null): void
    {
        if (!$section) {
            return;
        }

        $data = is_array($section['data'] ?? null) ? $section['data'] : [];

        $this->tabs        = $data['tabs'] ?? [];
        $this->action      = $section['action'] ?? ($data['action'] ?? '');
        $this->method      = strtoupper($section['method'] ?? ($data['method'] ?? 'POST'));
        $this->submitLabel = $data['submit_label']
            ?? ($section['metadata']['submit_label'] ?? __('Submit'));

        $this->activeTab = $this->tabs[0]['id'] ?? '';
    }

    public function selectTab(string $tabId): void
    {
        $this->activeTab = $tabId;
    }

    public function isActionForm(): bool
    {
        return true;
    }

    public function fieldValue(string $name, array $field): mixed
    {
        $tabId = $field['_tab_id'] ?? $this->activeTab;
        $tabValues = collect($this->tabs)->firstWhere('id', $tabId)['values'] ?? [];

        return $tabValues[$name] ?? ($field['default'] ?? null);
    }

    public function fieldModel(string $name): string
    {
        return $name;
    }

    public function fieldErrorKey(string $name): string
    {
        return $name;
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

<div class="space-y-0">

    {{-- ── Tab headers ────────────────────────────────────────────────────── --}}
    <div role="tablist" class="tabs tabs-lifted w-full">
        @foreach($tabs as $tab)
            @php $id = $tab['id'] ?? ''; @endphp
            <button
                type="button"
                role="tab"
                wire:click="selectTab('{{ $id }}')"
                @class(['tab', 'gap-2', 'tab-active' => $activeTab === $id])
                aria-selected="{{ $activeTab === $id ? 'true' : 'false' }}"
            >
                @if(!empty($tab['icon']))
                    <x-dynamic-component :component="$tab['icon']" class="w-4 h-4" />
                @endif
                {{ __($tab['label'] ?? $id) }}
                @if(($tab['badge'] ?? 0) > 0)
                    <span class="badge badge-sm badge-primary">{{ $tab['badge'] }}</span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- ── Form wrapping all tab panels ───────────────────────────────────── --}}
    <form
        action="{{ $action ?: '#' }}"
        method="{{ in_array($method, ['GET', 'POST'], true) ? $method : 'POST' }}"
        class="bg-base-100 border border-base-300 border-t-0 rounded-b-box"
    >
        @csrf
        @if(!in_array($method, ['GET', 'POST'], true))
            @method($method)
        @endif

        @foreach($tabs as $tab)
            @php
                $tabId  = $tab['id'] ?? '';
                $schema = $tab['schema'] ?? [];

                $scopedFields = [];
                foreach ($schema as $fieldName => $fieldDef) {
                    $fieldDef['_tab_id'] = $tabId;
                    $scopedFields["{$tabId}[{$fieldName}]"] = $fieldDef;
                }
            @endphp

            <div @class(['hidden' => $activeTab !== $tabId, 'p-6' => true])>

                @if(!empty($tab['description']))
                    <p class="text-sm text-base-content/60 mb-4">{{ __($tab['description']) }}</p>
                @endif

                <div class="grid grid-cols-12 gap-4">
                    @include('daisylw4::form.fields', ['fields' => $scopedFields])
                </div>

            </div>
        @endforeach

        <div class="flex justify-end gap-3 px-6 py-4 border-t border-base-300">
            <button type="submit" class="btn btn-primary">
                {{ $submitLabel }}
            </button>
        </div>

    </form>
</div>
