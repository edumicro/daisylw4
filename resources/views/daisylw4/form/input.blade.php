<?php
use Livewire\Component;

new class extends Component {
    public string $name = '';
    public string $label = '';
    public string $type = 'text';
    public string $placeholder = '';
    public ?string $model = null;

    // Customizations
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    // Icons
    public string $icon = ''; // Icon name, e.g., 'heroicon-o-envelope'
    public string $iconSide = 'left'; // 'left' or 'right'
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    @if($label)
        <label class="label">
            <span class="label-text font-medium">{{ $label }}</span>
        </label>
    @endif

    <div class="relative flex items-center">
        {{-- Icon on the Left --}}
        @if($icon && $iconSide === 'left')
            <div class="absolute left-0 pl-3 flex items-center pointer-events-none text-base-content/50">
                <x-dynamic-component :component="$icon" class="w-5 h-5" />
            </div>
        @endif

        <input
            id="{{ $id ?: $model }}"
            type="{{ $type }}"
            wire:model="{{ $model }}"
            placeholder="{{ $placeholder }}"
            class="input input-bordered w-full {{ $class }}
                   {{ $icon && $iconSide === 'left' ? 'pl-10' : '' }}
                   {{ $icon && $iconSide === 'right' ? 'pr-10' : '' }}
                   @error($model) border-error text-error @enderror"

            @foreach($extraAttributes as $attribute => $value)
                {{ $attribute }}="{{ $value }}"
            @endforeach
        />

        {{-- Icon on the Right (Useful for passwords or checks) --}}
        @if($icon && $iconSide === 'right')
            <div class="absolute right-0 pr-3 flex items-center pointer-events-none text-base-content/50">
                <x-dynamic-component :component="$icon" class="w-5 h-5" />
            </div>
        @endif
    </div>

    @error($model)
        <label class="label p-0 mt-1">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </label>
    @enderror
</div>
