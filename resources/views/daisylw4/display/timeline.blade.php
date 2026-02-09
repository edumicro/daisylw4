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
     * Timeline specific props
     */
    public array $items = [];
    public string $orientation = 'vertical';
    public string $variant = 'default';
    public bool $showConnector = true;
    public string $icon = 'heroicon-o-circle';
    public bool $compact = false;

    /**
     * Variant mapping for colors
     */
    protected array $variantMap = [
        'default' => 'bg-primary',
        'primary' => 'bg-primary',
        'secondary' => 'bg-secondary',
        'accent' => 'bg-accent',
        'success' => 'bg-success',
        'warning' => 'bg-warning',
        'error' => 'bg-error',
        'info' => 'bg-info',
    ];

    /**
     * Get variant color
     */
    public function getVariantColor(string $itemVariant = ''): string
    {
        $variant = $itemVariant ?: $this->variant;
        return $this->variantMap[$variant] ?? $this->variantMap['default'];
    }
}; ?>

<div
    class="timeline {{ $orientation === 'horizontal' ? 'timeline-horizontal' : 'timeline-vertical' }} {{ $containerClass }}"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($label)
        <div class="mb-6 pb-4 border-b border-base-300">
            <h3 class="text-lg font-bold">{{ $label }}</h3>
        </div>
    @endif

    @forelse ($items as $index => $item)
        <div class="timeline-item">
            <div class="timeline-start {{ $compact ? 'text-xs' : 'text-sm' }} text-right">
                @if (isset($item['date']))
                    <time class="font-semibold">{{ $item['date'] }}</time>
                @endif
                @if (isset($item['time']))
                    <div class="text-base-content/70">{{ $item['time'] }}</div>
                @endif
            </div>

            <div
                class="timeline-middle"
            >
                <div
                    class="w-4 h-4 rounded-full {{ $this->getVariantColor($item['variant'] ?? '') }} flex items-center justify-center flex-shrink-0 ring-4 ring-base-100 {{ $class }}"
                >
                    @if (isset($item['icon']))
                        <x-dynamic-component :component="$item['icon']" class="w-2 h-2 text-white" />
                    @elseif ($icon)
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </div>
            </div>

            <div class="timeline-end {{ $compact ? 'mb-4' : 'mb-10' }} ml-4">
                @if (isset($item['title']))
                    <h3 class="font-bold {{ $compact ? 'text-sm' : 'text-base' }}">{{ $item['title'] }}</h3>
                @endif

                @if (isset($item['description']))
                    <p class="text-base-content/70 {{ $compact ? 'text-xs' : 'text-sm' }} mt-1">
                        {{ $item['description'] }}
                    </p>
                @endif

                @if (isset($item['content']))
                    <div class="prose prose-sm max-w-none mt-2 {{ $compact ? 'text-xs' : '' }}">
                        {!! $item['content'] !!}
                    </div>
                @endif

                @if (isset($item['tags']) && !empty($item['tags']))
                    <div class="flex gap-2 flex-wrap mt-3">
                        @foreach ($item['tags'] as $tag)
                            <span class="badge badge-sm {{ isset($tag['variant']) ? 'badge-' . $tag['variant'] : 'badge-ghost' }}">
                                {{ $tag['label'] ?? $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif

                @if (isset($item['actions']) && !empty($item['actions']))
                    <div class="flex gap-2 mt-3">
                        @foreach ($item['actions'] as $action)
                            <button
                                class="btn btn-xs {{ $action['variant'] ?? 'btn-ghost' }}"
                                @if (isset($action['wire'])) wire:click="{{ $action['wire'] }}" @endif
                            >
                                @if (isset($action['icon']))
                                    <x-dynamic-component :component="$action['icon']" class="w-3 h-3" />
                                @endif
                                {{ $action['label'] ?? 'Action' }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($showConnector && !$loop->last && $orientation === 'vertical')
                <hr />
            @endif
        </div>
    @empty
        <div class="text-center py-8 text-base-content/50">
            {{ trans('daisylw4::no_items') }}
        </div>
    @endforelse
</div>

@if ($model)
    @error($model)
        <span class="text-error text-sm block mt-4">{{ $message }}</span>
    @enderror
@endif
