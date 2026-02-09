<?php

use Livewire\Component;
use Livewire\Volt\Component as VoltComponent;

new class extends VoltComponent {
    /**
     * Mandatory standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Diff specific props
     */
    public array $changes = [];
    public bool $showLineNumbers = true;
    public string $language = 'plaintext';
    public string $icon = 'heroicon-o-document-text';

    /**
     * Get change type class
     */
    public function getChangeTypeClass(string $type): string
    {
        return match ($type) {
            'added' => 'bg-success/20 border-l-4 border-success',
            'removed' => 'bg-error/20 border-l-4 border-error',
            'modified' => 'bg-warning/20 border-l-4 border-warning',
            default => 'bg-base-200/50 border-l-4 border-base-300',
        };
    }

    /**
     * Get change type badge
     */
    public function getChangeTypeBadge(string $type): string
    {
        return match ($type) {
            'added' => '+',
            'removed' => '−',
            'modified' => '~',
            default => ' ',
        };
    }
}; ?>

<div
    class="diff {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($label)
        <div class="flex items-center gap-2 mb-4 pb-4 border-b border-base-300">
            @if ($icon)
                <x-dynamic-component :component="$icon" class="w-5 h-5" />
            @endif
            <h3 class="font-semibold">{{ $label }}</h3>
            <span class="text-xs text-base-content/50">{{ $language }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table table-compact w-full">
            <tbody>
                @forelse ($changes as $index => $change)
                    <tr class="{{ $this->getChangeTypeClass($change['type'] ?? 'normal') }} hover:bg-opacity-50 transition-all {{ $class }}">
                        @if ($showLineNumbers)
                            <td class="w-12 text-center text-xs text-base-content/50 select-none font-mono">
                                {{ $change['lineNumber'] ?? $index + 1 }}
                            </td>
                        @endif

                        <td class="w-8 text-center text-xs font-bold text-base-content/70 select-none">
                            <span class="badge badge-sm {{ match($change['type'] ?? 'normal') {
                                'added' => 'badge-success',
                                'removed' => 'badge-error',
                                'modified' => 'badge-warning',
                                default => 'badge-ghost',
                            } }}">
                                {{ $this->getChangeTypeBadge($change['type'] ?? 'normal') }}
                            </span>
                        </td>

                        <td class="font-mono text-sm py-3">
                            <code class="whitespace-pre-wrap break-words">{{ $change['content'] ?? '' }}</code>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-base-content/50">
                            {{ trans('daisylw4::no_items') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-sm block mt-4">{{ $message }}</span>
        @enderror
    @endif
</div>
