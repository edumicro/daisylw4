<?php

use Livewire\Component;

new class extends Component {
    public $model = null;
    public array $section = [];
    public array $schemaFields = [];

    public function mount($section = [], $schemaFields = []): void
    {
        $this->section = is_array($section) ? $section : [];

        $data = $this->section['data'] ?? null;

        if (is_array($data) && isset($data['__model'], $data['__key'])) {
            $data = $data['__model']::find($data['__key']);
        }

        $this->model = $data;

        if (!empty($schemaFields)) {
            $this->schemaFields = $schemaFields;
            return;
        }

        if ($this->model && method_exists($this->model, 'fields')) {
            foreach ($this->model->fields() as $name => $meta) {
                $this->schemaFields[$name] = [
                    'source'   => 'native',
                    'metadata' => is_array($meta) ? $meta : ['label' => $meta],
                ];
            }
        }
    }
};
?>

<x-daisylw4::display.card class="w-full">
    @if(!empty($section['title']))
        <h2 class="text-xl font-bold mb-4">{{ $section['title'] }}</h2>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($schemaFields as $field => $data)
            <div class="flex flex-col border-b border-base-200 pb-2">
                <span class="text-sm text-base-content/70 font-semibold mb-1">
                    {{ $data['metadata']['label'] ?? ucfirst(str_replace('_', ' ', $field)) }}
                </span>
                <span class="text-base text-base-content whitespace-pre-wrap">{{ $model?->$field ?? '-' }}</span>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 text-center text-base-content/70 italic p-4">
                No schema fields found for this model.
            </div>
        @endforelse
    </div>
</x-daisylw4::display.card>
