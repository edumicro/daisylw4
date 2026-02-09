<?php
/**
 * Component: form.radio
 * A radio button group component with DaisyUI styling
 * For selecting one option from multiple choices
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    /**
     * The model to bind the selected radio value
     */
    public string $model = '';

    /**
     * Label for the radio group
     */
    public string $label = '';

    /**
     * Description/helper text
     */
    public string $description = '';

    /**
     * Radio options
     * Structure: ['value' => 'Label text'] or ['value' => ['label' => 'Text', 'description' => 'Helper text']]
     */
    public array $options = [];

    /**
     * Layout direction: 'vertical' or 'horizontal'
     */
    public string $direction = 'vertical'; // 'vertical' or 'horizontal'

    /**
     * Radio styling
     */
    public string $color = 'radio-primary'; // radio-primary, radio-secondary, radio-accent, etc.
    public bool $disabled = false;
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get layout classes based on direction
     */
    public function getLayoutClass(): string
    {
        return $this->direction === 'horizontal'
            ? 'flex flex-wrap gap-4'
            : 'space-y-3';
    }
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    @if($label)
        <label class="label">
            <span class="label-text font-medium">{{ $label }}</span>
        </label>
    @endif

    @if($description)
        <p class="text-sm text-base-content/70 mb-3">{{ $description }}</p>
    @endif

    <div class="{{ $this->getLayoutClass() }}">
        @foreach($options as $value => $option)
            @php
                $optionLabel = is_array($option) ? $option['label'] : $option;
                $optionDescription = is_array($option) ? ($option['description'] ?? '') : '';
            @endphp

            <label class="label cursor-pointer gap-3">
                <div class="flex flex-col flex-1">
                    <span class="label-text font-medium">{{ __($optionLabel) }}</span>
                    
                    @if($optionDescription)
                        <span class="label-text-alt text-base-content/70 text-xs">
                            {{ __($optionDescription) }}
                        </span>
                    @endif
                </div>

                <input
                    type="radio"
                    name="{{ $id ?: $model }}"
                    value="{{ $value }}"
                    wire:model.live="{{ $model }}"
                    @disabled($disabled)
                    class="radio {{ $color }} {{ $class }}
                           @error($model) radio-error @enderror"
                    @foreach($extraAttributes as $attribute => $attributeValue)
                        {{ $attribute }}="{{ $attributeValue }}"
                    @endforeach
                />
            </label>
        @endforeach
    </div>

    @error($model)
        <label class="label p-0 mt-2">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </label>
    @enderror
</div>
