<?php
/**
 * Component: form.toggle
 * A toggle switch component with DaisyUI styling
 * Perfect for boolean on/off functionality
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $description = '';
    public string $onLabel = ''; // Translatable label for "on" state
    public string $offLabel = ''; // Translatable label for "off" state
    public bool $checked = false;
    public bool $disabled = false;
    public string $size = 'toggle-md'; // toggle-sm, toggle-md, toggle-lg
    public string $color = 'toggle-primary'; // toggle-primary, toggle-secondary, toggle-accent, toggle-success, toggle-warning, toggle-error
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    <label class="label cursor-pointer">
        <div class="flex flex-col flex-1">
            @if($label)
                <span class="label-text font-medium">{{ $label }}</span>
            @endif
            
            @if($description)
                <span class="label-text-alt text-base-content/70">{{ $description }}</span>
            @endif

            @if($onLabel || $offLabel)
                <div class="flex gap-2 text-xs mt-1">
                    @if($offLabel)
                        <span class="badge badge-outline">{{ __($offLabel) }}</span>
                    @endif
                    @if($onLabel)
                        <span class="badge badge-primary">{{ __($onLabel) }}</span>
                    @endif
                </div>
            @endif
        </div>

        <input
            id="{{ $id ?: $model }}"
            type="checkbox"
            wire:model.live="{{ $model }}"
            @disabled($disabled)
            class="toggle {{ $size }} {{ $color }} {{ $class }}
                   @error($model) toggle-error @enderror"
            @foreach($extraAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}"
            @endforeach
        />
    </label>

    @error($model)
        <label class="label p-0 mt-1">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </label>
    @enderror
</div>
