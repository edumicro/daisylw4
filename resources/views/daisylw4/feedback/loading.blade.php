<?php
/**
 * Component: feedback.loading
 * A loading/spinner component with multiple styles
 * Perfect for indicating async operations, data fetching
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Loading message (translatable)
     */
    public string $message = '';

    /**
     * Spinner type: spinner, dots, bars, ring, ball
     */
    public string $type = 'spinner'; // 'spinner', 'dots', 'bars', 'ring', 'ball'

    /**
     * Size: sm, md, lg
     */
    public string $size = 'md'; // 'sm', 'md', 'lg'

    /**
     * Color/variant: primary, secondary, accent, success, warning, error
     */
    public string $color = 'primary';

    /**
     * Full screen overlay
     */
    public bool $fullScreen = false;

    /**
     * Show loading message
     */
    public bool $showMessage = true;

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
     * Get spinner size classes
     */
    public function getSizeClass(): string
    {
        return match($this->size) {
            'sm' => 'loading-sm',
            'lg' => 'loading-lg',
            default => 'loading-md',
        };
    }

    /**
     * Get color classes
     */
    public function getColorClass(): string
    {
        return "text-{$this->color}";
    }
}; ?>

<div class="{{ $this->fullScreen ? 'fixed inset-0 z-50 bg-base-content/20 backdrop-blur-sm' : '' }} flex items-center justify-center {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <div class="flex flex-col items-center gap-4 {{ !$this->fullScreen ? 'p-6' : '' }}">
        <!-- Spinner Animation -->
        @if($this->type === 'spinner')
            <div class="loading loading-spinner {{ $this->getSizeClass() }} {{ $this->getColorClass() }}"></div>

        @elseif($this->type === 'dots')
            <div class="loading loading-dots {{ $this->getSizeClass() }} {{ $this->getColorClass() }}"></div>

        @elseif($this->type === 'bars')
            <div class="loading loading-bars {{ $this->getSizeClass() }} {{ $this->getColorClass() }}"></div>

        @elseif($this->type === 'ring')
            <div class="loading loading-ring {{ $this->getSizeClass() }} {{ $this->getColorClass() }}"></div>

        @elseif($this->type === 'ball')
            <div class="loading loading-ball {{ $this->getSizeClass() }} {{ $this->getColorClass() }}"></div>
        @endif

        <!-- Loading Message -->
        @if($showMessage && !empty($message))
            <p class="text-center text-sm font-medium {{ $this->fullScreen ? 'text-base-content' : 'text-base-content/70' }}">
                {{ __($message) }}
            </p>
        @endif
    </div>
</div>
