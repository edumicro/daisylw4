<?php

use Livewire\Component;
use Livewire\Volt\Component as VoltComponent;

new class extends VoltComponent {
    /**
     * Mandatory edumicro standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Modal specific props
     */
    public bool $open = false;
    public string $title = '';
    public string $content = '';
    public string $size = 'md';
    public bool $backdropClose = true;
    public bool $showClose = true;
    public bool $showActions = true;
    public string $confirmText = '';
    public string $cancelText = '';
    public string $confirmVariant = 'btn-primary';
    public string $cancelVariant = 'btn-ghost';
    public string $icon = '';

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
    ];

    /**
     * Open modal
     */
    public function openModal(): void
    {
        $this->open = true;
    }

    /**
     * Close modal
     */
    public function closeModal(): void
    {
        $this->open = false;
    }

    /**
     * Confirm action
     */
    public function confirm(): void
    {
        $this->dispatch('modal-confirmed');
        $this->closeModal();
    }

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
        <button type="button" class="btn {{ $class }}" wire:click="openModal">
            {{ $label }}
        </button>
    @endif

    <input type="checkbox" class="modal-toggle" {{ $open ? 'checked' : '' }} />

    <div class="modal" @if ($backdropClose) wire:click.self="closeModal" @endif>
        <div class="modal-box {{ $this->getSizeClass() }}">
            <div class="flex items-start gap-3">
                @if ($icon)
                    <x-dynamic-component :component="$icon" class="w-6 h-6 text-primary flex-shrink-0" />
                @endif

                <div class="flex-1">
                    @if ($title)
                        <h3 class="font-bold text-lg">{{ $title }}</h3>
                    @endif

                    @if ($content)
                        <div class="py-4 text-sm text-base-content/80">
                            {!! $content !!}
                        </div>
                    @endif

                    {{ $slot ?? '' }}
                </div>

                @if ($showClose)
                    <button type="button" class="btn btn-sm btn-circle btn-ghost" wire:click="closeModal" aria-label="{{ trans('daisylw4::close') }}">✕</button>
                @endif
            </div>

            @if ($showActions)
                <div class="modal-action">
                    <button type="button" class="btn {{ $cancelVariant }}" wire:click="closeModal">
                        {{ $cancelText ?: trans('daisylw4::cancel') }}
                    </button>
                    <button type="button" class="btn {{ $confirmVariant }}" wire:click="confirm">
                        {{ $confirmText ?: trans('daisylw4::confirm') }}
                    </button>
                </div>
            @endif

            @if ($model)
                @error($model)
                    <span class="text-error text-xs block mt-3">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
</div>
