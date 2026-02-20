<?php

use Livewire\Component;

new class extends Component {
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
     * Rating specific props
     */
    public float $value = 0;
    public int $max = 5;
    public string $type = 'star';
    public string $size = 'md';
    public string $color = 'primary';
    public bool $readonly = false;
    public bool $clearable = true;
    public float $half = 0;
    public string $description = '';

    /**
     * Set rating value
     */
    public function setRating(float $rating): void
    {
        if (!$this->readonly) {
            $this->value = $rating;
        }
    }

    /**
     * Clear rating
     */
    public function clearRating(): void
    {
        if ($this->clearable && !$this->readonly) {
            $this->value = 0;
        }
    }

    /**
     * Size mapping
     */
    protected array $sizeMap = [
        'xs' => 'w-4 h-4',
        'sm' => 'w-5 h-5',
        'md' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
        'xl' => 'w-10 h-10',
        '2xl' => 'w-12 h-12',
    ];

    /**
     * Get size class
     */
    public function getSizeClass(): string
    {
        return $this->sizeMap[$this->size] ?? $this->sizeMap['md'];
    }

    /**
     * Get rating display
     */
    public function getRatingDisplay(): string
    {
        return number_format($this->value, 1);
    }
}; ?>

<div class="{{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="mb-2">
            <label class="label">
                <span class="label-text font-medium">{{ $label }}</span>
            </label>
        </div>
    @endif

    <div class="flex items-center gap-4">
        <div class="flex items-center gap-1">
            @for ($i = 1; $i <= $max; $i++)
                <button
                    type="button"
                    wire:click="setRating({{ $i }})"
                    class="transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-{{ $color }} rounded-full {{ $readonly ? 'cursor-not-allowed opacity-75' : 'cursor-pointer' }} {{ $class }}"
                    :disabled="$readonly"
                    aria-label="Rate {{ $i }} out of {{ $max }}"
                    title="Rate {{ $i }} out of {{ $max }}"
                >
                    @switch($type)
                        @case('star')
                            @if ($i <= $this->value)
                                <svg class="{{ $this->getSizeClass() }} text-{{ $color }} fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            @else
                                <svg class="{{ $this->getSizeClass() }} text-base-300" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            @endif
                        @break

                        @case('heart')
                            @if ($i <= $this->value)
                                <svg class="{{ $this->getSizeClass() }} text-{{ $color }} fill-current" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            @else
                                <svg class="{{ $this->getSizeClass() }} text-base-300" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            @endif
                        @break

                        @case('thumbs-up')
                            @if ($i <= $this->value)
                                <svg class="{{ $this->getSizeClass() }} text-{{ $color }} fill-current" viewBox="0 0 24 24">
                                    <path d="M14 9V5a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-4m-6 6h8a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2"/>
                                </svg>
                            @else
                                <svg class="{{ $this->getSizeClass() }} text-base-300" viewBox="0 0 24 24">
                                    <path d="M14 9V5a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-4m-6 6h8a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            @endif
                        @break

                        @default
                            @if ($i <= $this->value)
                                <svg class="{{ $this->getSizeClass() }} text-{{ $color }} fill-current" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/>
                                </svg>
                            @else
                                <svg class="{{ $this->getSizeClass() }} text-base-300" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            @endif
                    @endswitch
                </button>
            @endfor
        </div>

        <div class="flex items-center gap-2">
            <span class="text-lg font-semibold">{{ $this->getRatingDisplay() }}</span>
            <span class="text-sm text-base-content/60">/{{ $max }}</span>

            @if ($clearable && $value > 0 && !$readonly)
                <button
                    type="button"
                    wire:click="clearRating"
                    class="btn btn-ghost btn-xs"
                    title="Clear rating"
                >
                    ✕
                </button>
            @endif
        </div>
    </div>

    @if ($description)
        <p class="text-xs text-base-content/60 mt-2">{{ $description }}</p>
    @endif

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-2">{{ $message }}</span>
        @enderror
    @endif
</div>
