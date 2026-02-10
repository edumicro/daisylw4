<?php
/**
 * Component: feedback.toast
 * A toast notification component for displaying temporary messages
 * Perfect for success, error, info, and warning notifications
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Toast message (translatable)
     */
    public string $message = '';

    /**
     * Toast title (optional, translatable)
     */
    public string $title = '';

    /**
     * Toast type: info, success, warning, error
     */
    public string $type = 'info'; // 'info', 'success', 'warning', 'error'

    /**
     * Icon for the toast
     */
    public string $icon = '';

    /**
     * Auto-hide after milliseconds (0 = never auto-hide)
     */
    public int $autoHide = 5000;

    /**
     * Position: top-left, top-center, top-right, bottom-left, bottom-center, bottom-right
     */
    public string $position = 'bottom-right';

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
        if ($this->autoHide > 0) {
            $this->dispatch('toast-auto-hide', delay: $this->autoHide);
        }
    }

    /**
     * Close the toast
     */
    public function close(): void
    {
        $this->visible = false;
    }

    /**
     * Get toast styling based on type
     */
    public function getToastClass(): string
    {
        return match($this->type) {
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
            default => 'alert-info',
        };
    }

    /**
     * Get default icon if not explicitly set
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

    /**
     * Get position classes
     */
    public function getPositionClass(): string
    {
        return match($this->position) {
            'top-left' => 'top-0 left-0',
            'top-center' => 'top-0 left-1/2 -translate-x-1/2',
            'top-right' => 'top-0 right-0',
            'bottom-left' => 'bottom-0 left-0',
            'bottom-center' => 'bottom-0 left-1/2 -translate-x-1/2',
            default => 'bottom-0 right-0',
        };
    }
}; ?>

@if($visible)
    <div class="fixed {{ $this->getPositionClass() }} p-4 z-50 pointer-events-none" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
        <div class="alert {{ $this->getToastClass() }} shadow-lg {{ $containerClass }} pointer-events-auto max-w-sm {{ $class }}">
            <div class="flex items-start gap-3">
                <x-dynamic-component :component="$this->getDefaultIcon()" class="w-5 h-5 flex-shrink-0 mt-0.5" />

                <div class="flex-1">
                    @if($title)
                        <h3 class="font-bold text-sm">{{ __($title) }}</h3>
                    @endif
                    <div class="text-sm">
                        {{ __($message) }}
                    </div>
                </div>

                @if($closable)
                    <button
                        type="button"
                        wire:click="close"
                        class="btn btn-ghost btn-xs btn-circle"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
