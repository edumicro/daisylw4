<?php

namespace Edumicro\DaisyUI\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeDaisyComponent extends Command
{
    protected $signature = 'daisylw4:make {name?}';
    protected $description = 'Create a new DaisyUI Livewire 4 component';

    public function handle()
    {
        $name = $this->argument('name') ?? $this->ask('What is the component name? (e.g. input, table)');

        $section = $this->choice(
            'In which section should it be placed?',
            ['form', 'actions', 'display', 'feedback', 'navigation', 'layout'],
            0
        );

        $fileName = Str::kebab($name);
        
        $basePath = resource_path("views/vendor/daisylw4");
        $fullPath = "{$basePath}/{$section}/{$fileName}.blade.php";

        if (File::exists($fullPath)) {
            $this->error("Component {$section}/{$fileName} already exists!");
            return;
        }

        File::ensureDirectoryExists(dirname($fullPath));
        File::put($fullPath, $this->getStub($section, $fileName));

        $this->info("🚀 Component created: resources/views/vendor/daisylw4/{$section}/{$fileName}.blade.php");
        
        
        $this->line("<info>Usage:</info> <livewire:daisylw4.{$section}.{$fileName} />");
    }

    protected function getStub($section, $name)
    {
        
        return <<<PHP
<?php
/**
 * Component: daisylw4.{$section}.{$name}
 * Agnostic UI Component for Daisylw4
 */

use Livewire\Volt\Component;

new class extends Component {
    public string \$model = '';
    public string \$label = '';
    public string \$id = '';
    public string \$class = '';
    public string \$containerClass = '';
    public array \$extraAttributes = [];

    public function mount(): void
    {
        //
    }
}; ?>

<div class="{{ trim('form-control w-full ' . \$containerClass) }}">
    @if(\$label)
        <label class="label">
            <span class="label-text font-medium text-base-content/80">
                {{ Lang::has('daisylw4::' . \$label) ? __('daisylw4::' . \$label) : __(\$label) }}
            </span>
        </label>
    @endif

    <div 
        @if(\$id) id="{{ \$id }}" @endif
        {{ \$attributes->merge(['class' => \$class])->merge(\$extraAttributes) }}
    >
        {{-- Default content --}}
        <div class="p-6 border-2 border-dashed border-base-300 rounded-xl text-center bg-base-200/50">
            <span class="text-base-content/50">Component</span> 
            <span class="font-bold text-primary">{$name}</span> 
            <span class="text-base-content/50">ready to be edited.</span>
        </div>
    </div>

    @error(\$model)
        <label class="label p-0 mt-1">
            <span class="label-text-alt text-error font-semibold">{{ \$message }}</span>
        </label>
    @enderror
</div>
PHP;
    }
}