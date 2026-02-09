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
     * Chat bubble specific props
     */
    public string $message = '';
    public string $sender = 'user';
    public string $timestamp = '';
    public string $avatar = '';
    public string $variant = 'sent';
    public bool $loading = false;
    public array $actions = [];
    public string $icon = '';

    /**
     * Check if bubble is sent or received
     */
    public function isSent(): bool
    {
        return $this->variant === 'sent';
    }
}; ?>

<div
    class="chat {{ $this->isSent() ? 'chat-end' : 'chat-start' }} {{ $containerClass }}"
    {{ $attributes->merge($extraAttributes) }}
>
    @if ($avatar)
        <div class="chat-image avatar">
            <div class="w-10 h-10 rounded-full">
                <img src="{{ $avatar }}" alt="{{ $sender }}" />
            </div>
        </div>
    @endif

    <div class="chat-header">
        {{ $sender }}
        @if ($timestamp)
            <time class="text-xs opacity-50 ml-2">{{ $timestamp }}</time>
        @endif
    </div>

    <div class="chat-bubble {{ $this->isSent() ? 'chat-bubble-primary' : 'chat-bubble-neutral' }} {{ $class }}">
        @if ($loading)
            <span class="loading loading-spinner loading-sm"></span>
            {{ trans('daisylw4::typing') }}
        @else
            <div class="flex items-start gap-2">
                @if ($icon)
                    <x-dynamic-component :component="$icon" class="w-4 h-4 flex-shrink-0 mt-0.5" />
                @endif
                <div class="flex-1">
                    {!! $message ?: $label !!}
                </div>
            </div>
        @endif
    </div>

    @if (!empty($actions) && !$loading)
        <div class="chat-footer text-xs text-base-content/70 mt-1 flex gap-2">
            @foreach ($actions as $action)
                <button
                    class="link link-hover text-xs"
                    @if (isset($action['wire'])) wire:click="{{ $action['wire'] }}" @endif
                >
                    {{ $action['label'] ?? 'Action' }}
                </button>
            @endforeach
        </div>
    @endif
</div>

@if ($model)
    @error($model)
        <span class="text-error text-xs block mt-1">{{ $message }}</span>
    @enderror
@endif
