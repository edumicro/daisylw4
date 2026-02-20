<?php
/**
 * Component: form.textarea
 * A textarea component with DaisyUI styling
 * Perfect for multi-line text input
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $placeholder = '';
    public string $description = '';
    public int $rows = 4;
    public int $minLength = 0;
    public int $maxLength = 0;
    public bool $disabled = false;
    public bool $readonly = false;
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Get character count display text
     */
    public function getCharCountDisplay(): string
    {
        if ($this->maxLength === 0) {
            return '';
        }

        $currentLength = strlen($this->model ?? '');
        return "{$currentLength}/{$this->maxLength}";
    }
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    @if($label)
        <label class="label">
            <span class="label-text font-medium">{{ __($label) }}</span>
            @if($maxLength > 0)
                <span class="label-text-alt text-xs">{{ $this->getCharCountDisplay() }}</span>
            @endif
        </label>
    @endif

    @if($description)
        <p class="text-sm text-base-content/70 mb-2">{{ __($description) }}</p>
    @endif

    <textarea
        id="{{ $id ?: $model }}"
        wire:model.live="{{ $model }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        @disabled($disabled)
        @readonly($readonly)
        @if($minLength > 0) minlength="{{ $minLength }}" @endif
        @if($maxLength > 0) maxlength="{{ $maxLength }}" @endif
        class="textarea textarea-bordered w-full {{ $class }}
               @error($model) textarea-error @enderror"
        @foreach($extraAttributes as $attribute => $value)
            {{ $attribute }}="{{ $value }}"
        @endforeach
    ></textarea>

    @error($model)
        <label class="label p-0 mt-1">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </label>
    @enderror
</div>
