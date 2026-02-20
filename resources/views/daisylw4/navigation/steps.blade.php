<?php
/**
 * Component: navigation.steps
 * A steps/stepper component for showing progression through a multi-step process
 * Perfect for wizards, onboarding flows, and multi-step forms
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Steps array
     * Structure: [
     *     ['label' => 'Step 1', 'description' => 'Optional description'],
     *     ['label' => 'Step 2', 'description' => 'Optional description'],
     *     ['label' => 'Step 3', 'description' => 'Optional description'],
     * ]
     */
    public array $steps = [];

    /**
     * Current active step (1-indexed)
     */
    public int $currentStep = 1;

    /**
     * Show descriptions
     */
    public bool $showDescriptions = true;

    /**
     * Make steps clickable to navigate
     */
    public bool $clickable = false;

    /**
     * Vertical layout instead of horizontal
     */
    public bool $vertical = false;

    /**
     * Color variant
     */
    public string $color = 'primary'; // primary, secondary, accent, success, warning, error

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
     * Check if step is completed
     */
    public function isCompleted(int $step): bool
    {
        return $step < $this->currentStep;
    }

    /**
     * Check if step is active
     */
    public function isActive(int $step): bool
    {
        return $step === $this->currentStep;
    }

    /**
     * Get step status class
     */
    public function getStepClass(int $step): string
    {
        if ($this->isCompleted($step)) {
            return "step-success";
        }
        if ($this->isActive($step)) {
            return "step-{$this->color}";
        }
        return '';
    }

    /**
     * Go to specific step
     */
    public function goToStep(int $step): void
    {
        if ($this->clickable && $step >= 1 && $step <= count($this->steps)) {
            $this->currentStep = $step;
            $this->dispatch('step-changed', step: $step);
        }
    }

    /**
     * Next step
     */
    public function nextStep(): void
    {
        if ($this->currentStep < count($this->steps)) {
            $this->currentStep++;
            $this->dispatch('step-changed', step: $this->currentStep);
        }
    }

    /**
     * Previous step
     */
    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('step-changed', step: $this->currentStep);
        }
    }
}; ?>

<div class="{{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <ul class="steps {{ $vertical ? 'steps-vertical' : '' }} w-full {{ $class }}">
        @foreach($steps as $index => $step)
            @php
                $stepNumber = $index + 1;
                $stepClass = $this->getStepClass($stepNumber);
            @endphp

            <li
                data-content="{{ $this->isCompleted($stepNumber) ? '✓' : $stepNumber }}"
                class="step {{ $stepClass }} {{ $this->clickable ? 'cursor-pointer' : '' }}"
                @if($this->clickable)
                    wire:click="goToStep({{ $stepNumber }})"
                @endif
            >
                <div class="flex flex-col gap-1">
                    <span class="font-medium text-sm">{{ __($step['label'] ?? '') }}</span>
                    @if($showDescriptions && ($step['description'] ?? false))
                        <span class="text-xs text-base-content/70">
                            {{ __($step['description']) }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Step Content Slot -->
    <div class="mt-6">
        {{ $slot }}
    </div>

    <!-- Navigation Buttons -->
    @if(count($steps) > 1)
        <div class="flex justify-between gap-3 mt-6">
            <button
                wire:click="previousStep"
                @disabled($currentStep === 1)
                class="btn btn-outline btn-sm"
            >
                {{ __('steps.previous') }}
            </button>

            <div class="text-sm text-base-content/70 flex items-center">
                {{ __('steps.step') }} {{ $currentStep }} / {{ count($steps) }}
            </div>

            <button
                wire:click="nextStep"
                @disabled($currentStep === count($steps))
                class="btn btn-primary btn-sm"
            >
                @if($currentStep === count($steps))
                    {{ __('steps.complete') }}
                @else
                    {{ __('steps.next') }}
                @endif
            </button>
        </div>
    @endif
</div>
