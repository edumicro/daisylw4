<?php
/**
 * Component: form.range
 * A range slider component for selecting minimum and maximum values
 * Perfect for price ranges, date ranges, or any numeric range selection
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * Model for the minimum value
     */
    public string $minModel = '';

    /**
     * Model for the maximum value
     */
    public string $maxModel = '';

    /**
     * Label (translatable)
     */
    public string $label = '';

    /**
     * Description/helper text (translatable)
     */
    public string $description = '';

    /**
     * Minimum allowed value
     */
    public int|float $min = 0;

    /**
     * Maximum allowed value
     */
    public int|float $max = 100;

    /**
     * Step increment
     */
    public int|float $step = 1;

    /**
     * Unit/currency symbol (translatable)
     */
    public string $unit = '';

    /**
     * Number format: 'currency', 'decimal', or 'integer'
     */
    public string $format = 'integer'; // 'integer', 'decimal', 'currency'

    /**
     * Styling
     */
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Format value based on format setting
     */
    public function formatValue(int|float $value): string
    {
        return match($this->format) {
            'currency' => '$' . number_format($value, 2),
            'decimal' => number_format($value, 2),
            default => (string)intval($value),
        };
    }
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    @if($label)
        <label class="label">
            <span class="label-text font-medium">{{ __($label) }}</span>
        </label>
    @endif

    @if($description)
        <p class="text-sm text-base-content/70 mb-3">{{ __($description) }}</p>
    @endif

    <!-- Range Sliders Container -->
    <div class="space-y-4">
        <!-- Minimum Value -->
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <label class="text-sm font-medium">{{ __('form.range.minimum') }}</label>
                <div class="badge badge-primary">
                    {{ $this->formatValue($minModel) }}
                    @if($unit)
                        <span class="ml-1">{{ __($unit) }}</span>
                    @endif
                </div>
            </div>

            <input
                type="range"
                id="{{ $id ? $id . '_min' : $minModel }}"
                wire:model.live="{{ $minModel }}"
                min="{{ $this->min }}"
                max="{{ $this->max }}"
                step="{{ $this->step }}"
                class="range range-primary w-full {{ $class }}"
                @foreach($extraAttributes as $attribute => $value)
                    {{ $attribute }}="{{ $value }}"
                @endforeach
            />
        </div>

        <!-- Maximum Value -->
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <label class="text-sm font-medium">{{ __('form.range.maximum') }}</label>
                <div class="badge badge-accent">
                    {{ $this->formatValue($maxModel) }}
                    @if($unit)
                        <span class="ml-1">{{ __($unit) }}</span>
                    @endif
                </div>
            </div>

            <input
                type="range"
                id="{{ $id ? $id . '_max' : $maxModel }}"
                wire:model.live="{{ $maxModel }}"
                min="{{ $this->min }}"
                max="{{ $this->max }}"
                step="{{ $this->step }}"
                class="range range-accent w-full {{ $class }}"
                @foreach($extraAttributes as $attribute => $value)
                    {{ $attribute }}="{{ $value }}"
                @endforeach
            />
        </div>

        <!-- Range Summary -->
        <div class="bg-base-100 p-3 rounded-lg border border-base-300">
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">{{ __('form.range.selected') }}</span>
                <span class="text-lg font-bold text-primary">
                    {{ $this->formatValue($minModel) }}
                    -
                    {{ $this->formatValue($maxModel) }}
                    @if($unit)
                        <span class="text-sm ml-1">{{ __($unit) }}</span>
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
