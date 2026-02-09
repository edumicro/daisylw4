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
     * List specific props
     */
    public array $items = [];
    public bool $ordered = false;
    public bool $divided = true;
    public string $size = 'md';
    public string $icon = '';
    public bool $hoverable = false;
    public bool $selectable = false;
    public array $selected = [];

    /**
     * Toggle item selection
     */
    public function toggleSelect(int $index): void
    {
        if ($this->selectable) {
            if (in_array($index, $this->selected)) {
                $this->selected = array_filter($this->selected, fn($i) => $i !== $index);
            } else {
                $this->selected[] = $index;
            }
        }
    }

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
    ];

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }
}; ?>

<div class="{{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="mb-4 pb-2 border-b border-base-300">
            <h3 class="font-semibold">{{ $label }}</h3>
        </div>
    @endif

    @if ($ordered)
        <ol class="list-decimal list-inside {{ $class }} {{ $this->getSizeClass() }} space-y-2">
            @forelse ($items as $index => $item)
                <li
                    class="{{ $divided ? 'pb-2 border-b border-base-300/50 last:border-b-0' : '' }} {{ $hoverable ? 'hover:bg-base-200/50 px-2 py-1 rounded transition-colors cursor-pointer' : '' }} {{ in_array($index, $this->selected) ? 'bg-primary/10' : '' }}"
                    wire:click="toggleSelect({{ $index }})"
                    role="{{ $selectable ? 'button' : 'listitem' }}"
                    tabindex="{{ $selectable ? '0' : '-1' }}"
                >
                    <span class="flex items-center gap-2">
                        @if ($selectable)
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                {{ in_array($index, $this->selected) ? 'checked' : '' }}
                            />
                        @endif

                        @if ($icon)
                            <x-dynamic-component :component="$icon" class="w-4 h-4 flex-shrink-0" />
                        @endif

                        <span>{{ $item['title'] ?? $item }}</span>
                    </span>

                    @if (isset($item['description']))
                        <div class="text-xs text-base-content/60 ml-6 mt-1">{{ $item['description'] }}</div>
                    @endif
                </li>
            @empty
                <li class="text-base-content/50 italic">{{ trans('daisylw4::no_items') }}</li>
            @endforelse
        </ol>
    @else
        <ul class="list-disc list-inside {{ $class }} {{ $this->getSizeClass() }} space-y-2">
            @forelse ($items as $index => $item)
                <li
                    class="{{ $divided ? 'pb-2 border-b border-base-300/50 last:border-b-0' : '' }} {{ $hoverable ? 'hover:bg-base-200/50 px-2 py-1 rounded transition-colors cursor-pointer' : '' }} {{ in_array($index, $this->selected) ? 'bg-primary/10' : '' }}"
                    wire:click="toggleSelect({{ $index }})"
                    role="{{ $selectable ? 'button' : 'listitem' }}"
                    tabindex="{{ $selectable ? '0' : '-1' }}"
                >
                    <span class="flex items-center gap-2">
                        @if ($selectable)
                            <input
                                type="checkbox"
                                class="checkbox checkbox-sm"
                                {{ in_array($index, $this->selected) ? 'checked' : '' }}
                            />
                        @endif

                        @if ($icon)
                            <x-dynamic-component :component="$icon" class="w-4 h-4 flex-shrink-0" />
                        @endif

                        <span>{{ $item['title'] ?? $item }}</span>
                    </span>

                    @if (isset($item['description']))
                        <div class="text-xs text-base-content/60 ml-6 mt-1">{{ $item['description'] }}</div>
                    @endif
                </li>
            @empty
                <li class="text-base-content/50 italic">{{ trans('daisylw4::no_items') }}</li>
            @endforelse
        </ul>
    @endif

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-4">{{ $message }}</span>
        @enderror
    @endif
</div>
