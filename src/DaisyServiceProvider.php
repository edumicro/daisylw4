<?php

namespace Edumicro\DaisyUI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Livewire\Volt\Volt;
use Edumicro\DaisyUI\Console\Commands\InstallCommand;

class DaisyServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->mergeConfigFrom(__DIR__.'/../config/daisyui.php', 'daisylw4');
    }

    public function boot(): void
    {
        // 1.Load Views (Namespace daisylw4)
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'daisylw4');

        //2.- Load Translations
       // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'daisylw4');
       $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        // 3. Register Livewire Volt Components

        $publishedRoot = resource_path('views/vendor');
        $vendorRoot = __DIR__.'/../resources/views';

        if (\Illuminate\Support\Facades\File::isDirectory($publishedRoot)) {
            \Livewire\Volt\Volt::mount($publishedRoot);
        }

        if (\Illuminate\Support\Facades\File::isDirectory($vendorRoot)) {
            \Livewire\Volt\Volt::mount($vendorRoot);
        }


        // 4. Commands and Publications (Only in console)
        if ($this->app->runningInConsole()) {

            // Publish Views
            $this->publishes([
                __DIR__.'/../resources/views/daisylw4' => resource_path('views/vendor/daisylw4'),
            ], 'daisylw4-components');



            // Publish Configuration
            $this->publishes([
                __DIR__.'/../config/daisyui.php' => config_path('daisylw4.php'),
            ], 'daisylw4-config');

            // Publish Translations
            $this->publishes([
                __DIR__.'/../resources/lang' => $this->app->langPath('vendor/daisylw4'),
            ], 'daisylw4-lang');


            // Register Commands
            $this->commands([
                InstallCommand::class,
                \Edumicro\DaisyUI\Console\Commands\MakeDaisyComponent::class,
            ]);
        }
    }
}
