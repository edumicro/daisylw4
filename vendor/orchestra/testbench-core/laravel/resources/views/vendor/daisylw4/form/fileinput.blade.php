<?php
/**
 * Component: form.fileinput
 * A file input component with DaisyUI styling
 * Supports single/multiple file uploads with drag-drop preview
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Volt\Component;

new class extends Component {
    public string $model = '';
    public string $label = '';
    public string $description = '';
    public string $placeholder = ''; // Translatable placeholder text
    public string $accept = ''; // e.g., 'image/*', '.pdf', 'image/*,.pdf'
    public bool $multiple = false;
    public int $maxSize = 0; // In MB, 0 = unlimited
    public bool $disabled = false;
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    // File preview
    public array $uploadedFiles = [];
    public string $dragActive = ''; // For drag-drop styling

    public function mount(): void
    {
        //
    }

    /**
     * Handle file selection
     */
    public function handleFileSelected($files): void
    {
        if (empty($files)) {
            return;
        }

        $this->uploadedFiles = [];
        foreach ($files as $file) {
            $this->uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'size' => $this->formatBytes($file->getSize()),
                'type' => $file->getClientMimeType(),
            ];
        }
    }

    /**
     * Format bytes to human readable format
     */
    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    /**
     * Remove uploaded file from preview
     */
    public function removeFile(int $index): void
    {
        unset($this->uploadedFiles[$index]);
        $this->uploadedFiles = array_values($this->uploadedFiles);
    }
}; ?>

<div class="form-control w-full {{ $containerClass }}">
    @if($label)
        <label class="label">
            <span class="label-text font-medium">{{ __($label) }}</span>
            @if($maxSize > 0)
                <span class="label-text-alt text-xs">
                    {{ __('Max') }}: {{ $maxSize }}MB
                </span>
            @endif
        </label>
    @endif

    @if($description)
        <p class="text-sm text-base-content/70 mb-2">{{ __($description) }}</p>
    @endif

    <!-- File Input -->
    <label class="form-control w-full cursor-pointer">
        <div class="join w-full">
            <input
                id="{{ $id ?: $model }}"
                type="file"
                wire:model="{{ $model }}"
                wire:change="handleFileSelected($event.target.files)"
                accept="{{ $accept }}"
                @if($multiple) multiple @endif
                @disabled($disabled)
                class="file-input file-input-bordered w-full {{ $class }}
                       @error($model) file-input-error @enderror hidden"
                @foreach($extraAttributes as $attribute => $value)
                    {{ $attribute }}="{{ $value }}"
                @endforeach
            />

            <div class="join-item input input-bordered flex-1 flex items-center cursor-pointer
                        bg-base-100 hover:bg-base-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/50 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-sm text-base-content/70">
                    {{ __($placeholder ?: 'Choose file or drag here') }}
                </span>
            </div>
        </div>
    </label>

    <!-- Uploaded Files Preview -->
    @if(!empty($uploadedFiles))
        <div class="mt-4 space-y-2">
            <p class="text-sm font-medium text-base-content">
                {{ __('Uploaded files') }}:
            </p>
            <div class="space-y-2">
                @foreach($uploadedFiles as $index => $file)
                    <div class="flex items-center gap-3 p-3 bg-base-100 rounded-lg border border-base-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                        </svg>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ $file['name'] }}</p>
                            <p class="text-xs text-base-content/60">{{ $file['size'] }}</p>
                        </div>

                        <button
                            type="button"
                            wire:click="removeFile({{ $index }})"
                            class="btn btn-ghost btn-xs"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @error($model)
        <label class="label p-0 mt-1">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </label>
    @enderror
</div>
