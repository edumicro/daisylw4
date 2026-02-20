<?php
/**
 * Component: form.checkbox
 * A checkbox input component with DaisyUI styling
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $description = '';
    public bool $checked = false;
    public bool $disabled = false;
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
                <span class="label-text font-medium">{{ __($label) }}</span>
            @endif
            
            @if($description)
                <span class="label-text-alt text-base-content/70">{{ __($description) }}</span>
            @endif
        </div>

        <input
            id="{{ $id ?: $model }}"
            type="checkbox"
            wire:model.live="{{ $model }}"
            @disabled($disabled)
            class="checkbox checkbox-bordered {{ $class }}
                   @error($model) checkbox-error @enderror"
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
