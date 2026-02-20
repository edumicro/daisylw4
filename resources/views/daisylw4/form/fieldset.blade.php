<?php
/**
 * Component: form.fieldset
 * A fieldset wrapper component for grouping related form fields
 * Useful for organizing complex forms with sections
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Fieldset legend/title (translatable)
     */
    public string $legend = '';

    /**
     * Description/helper text (translatable)
     */
    public string $description = '';

    /**
     * Grid columns for responsive layout
     * Options: 1, 2, 3, 4, or responsive string like 'md:grid-cols-2'
     */
    public string $columns = '1';

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public string $legendClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get grid classes based on columns setting
     */
    public function getGridClass(): string
    {
        return match($this->columns) {
            '2' => 'grid grid-cols-1 md:grid-cols-2 gap-4',
            '3' => 'grid grid-cols-1 md:grid-cols-3 gap-4',
            '4' => 'grid grid-cols-1 md:grid-cols-4 gap-4',
            default => 'space-y-4',
        };
    }
}; ?>

<fieldset class="border border-base-300 rounded-lg p-6 {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    @if($legend)
        <legend class="px-3 text-lg font-semibold text-base-content {{ $legendClass }}">
            {{ __($legend) }}
        </legend>
    @endif

    @if($description)
        <p class="text-sm text-base-content/70 mb-4 px-3">
            {{ __($description) }}
        </p>
    @endif

    <div class="{{ $this->getGridClass() }} {{ $class }}">
        {{ $slot }}
    </div>
</fieldset>
