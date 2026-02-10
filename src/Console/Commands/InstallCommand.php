<?php

namespace EduMicro\DaisyLw4\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'daisylw4:install';
    protected $description = 'Installs and configures the  DaisyUI Livewire 4 components';

    public function handle()
    {
        $this->info('📦 Installing Daisylw4: The View Painter...');

        // 1. Publish Resources
        $this->call('vendor:publish', [
            '--tag' => 'daisylw4-components',
            '--force' => true
        ]);

        // 2. Publish Configuration 
        $this->call('vendor:publish', [
            '--tag' => 'daisylw4-config',
            '--force' => true
        ]);
        
        //3 .Publish Translations
        $this->call('vendor:publish', [
            '--tag' => 'daisylw4-lang',
            '--force' => true
        ]);

        $this->info('✅ Resources and Config published in resources/views/vendor/daisylw4 and config/daisylw4.php');

        // 4. Clear caches
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->info('✅ Daisylw4 installed successfully.');
        
        $this->newLine();
        $this->warn('⚠️  Finalize your Tailwind setup:');
        $this->line('<fg=gray>1. npm install -D daisyui@latest</>');
        $this->line('<fg=gray>2. Add require("daisyui") to your tailwind.config.js</>');
        $this->line('<fg=gray>3. Add this path to your "content" array in tailwind.config.js:</>');
        $this->comment("'./resources/views/vendor/daisylw4/**/*.blade.php',");
        
        $this->newLine();
        $this->line('🚀 <info>Ready to go!</info> Use <comment><livewire:daisylw4.form.auto-form /></comment> to start painting.');
    }
}