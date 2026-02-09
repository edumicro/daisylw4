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
     * Accordion specific props
     */
    public array $items = [];
    public ?int $activeIndex = null;
    public string $icon = 'heroicon-o-chevron-right';
    public string $iconSide = 'right';
    public bool $allowMultiple = false;

    /**
     * Toggle accordion item expansion
     */
    public function toggleItem(int $index): void
    {
        if ($this->allowMultiple) {
            // Allow multiple items open
            $this->items[$index]['open'] = !($this->items[$index]['open'] ?? false);
        } else {
            // Only one item open at a time
            foreach ($this->items as $key => &$item) {
                $item['open'] = ($key === $index) && !($item['open'] ?? false);
            }
        }
    }

    public function mount(): void
    {
        // Initialize items with 'open' key if not present
        foreach ($this->items as &$item) {
            $item['open'] = $item['open'] ?? false;
        }

        // Set first item as active if no active index specified
        if ($this->activeIndex === null && !empty($this->items)) {
            $this->items[0]['open'] = true;
        }
    }
}; ?>

<div
    class="join join-vertical w-full {{ $containerClass }}"
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($label)
        <label class="label mb-2">
            <span class="label-text font-semibold">{{ $label }}</span>
        </label>
    @endif

    @forelse ($items as $index => $item)
        <div class="collapse collapse-arrow join-item border border-base-300 {{ $item['open'] ?? false ? 'collapse-open' : '' }}">
            <input
                type="radio"
                name="accordion-{{ $id ?: 'default' }}"
                wire:click="toggleItem({{ $index }})"
                {{ $item['open'] ?? false ? 'checked' : '' }}
            />

            <div class="collapse-title flex items-center gap-2 font-medium {{ $class }}">
                @if ($icon && $iconSide === 'left')
                    <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0" />
                @endif

                <span>{{ $item['title'] ?? '' }}</span>

                @if ($icon && $iconSide === 'right')
                    <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0 ml-auto" />
                @endif
            </div>

            <div class="collapse-content">
                <div class="py-2 text-sm">
                    @if (isset($item['content']))
                        {!! $item['content'] !!}
                    @endif
                </div>

                @if ($model && isset($item['errors']) && $item['errors'])
                    <div class="mt-2">
                        @foreach ((array) $item['errors'] as $error)
                            <span class="text-error text-xs">{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            {{ trans('daisylw4::no_items') }}
        </div>
    @endforelse

    @if ($model)
        @error($model)
            <span class="text-error text-sm mt-2 block">{{ $message }}</span>
        @enderror
    @endif
</div>
