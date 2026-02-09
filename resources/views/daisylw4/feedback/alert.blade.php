<?php
/**
 * Component: feedback.alert
 * An alert component for displaying important information, warnings, and errors
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Alert message (translatable)
     */
    public string $message = '';

    /**
     * Alert type: info, success, warning, error
     */
    public string $type = 'info'; // 'info', 'success', 'warning', 'error'

    /**
     * Alert title (optional, translatable)
     */
    public string $title = '';

    /**
     * Icon for the alert (optional)
     */
    public string $icon = '';

    /**
     * Show close button
     */
    public bool $closable = true;

    /**
     * Initially visible
     */
    public bool $visible = true;

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Close the alert
     */
    public function close(): void
    {
        $this->visible = false;
    }

    /**
     * Get alert styling based on type
     */
    public function getAlertClass(): string
    {
        return match($this->type) {
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
            default => 'alert-info',
        };
    }

    /**
     * Get icon for alert type if not explicitly set
     */
    public function getDefaultIcon(): string
    {
        if (!empty($this->icon)) {
            return $this->icon;
        }

        return match($this->type) {
            'success' => 'heroicon-o-check-circle',
            'warning' => 'heroicon-o-exclamation',
            'error' => 'heroicon-o-x-circle',
            default => 'heroicon-o-information-circle',
        };
    }
}; ?>

@if($visible)
    <div class="alert {{ $this->getAlertClass() }} {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
        <div class="flex items-start gap-3 w-full {{ $class }}">
            <x-dynamic-component :component="$this->getDefaultIcon()" class="w-6 h-6 flex-shrink-0" />

            <div class="flex-1">
                @if($title)
                    <h3 class="font-bold">{{ __($title) }}</h3>
                @endif
                <div class="text-sm">
                    {{ __($message) }}
                </div>
            </div>

            @if($closable)
                <button
                    type="button"
                    wire:click="close"
                    class="btn btn-ghost btn-sm btn-circle"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>
    </div>
@endif
