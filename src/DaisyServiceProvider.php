<?php

namespace EduMicro\DaisyLw4;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Livewire\Livewire;
use EduMicro\DaisyLw4\Console\Commands\InstallCommand;

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

        // 3. Register Livewire components namespace without Volt
        $publishedRoot = resource_path('views/vendor/daisylw4');
        $vendorRoot = __DIR__.'/../resources/views/daisylw4';
        $componentsRoot = File::isDirectory($publishedRoot) ? $publishedRoot : $vendorRoot;

        if (File::isDirectory($componentsRoot)) {
            Livewire::addNamespace('daisylw4', viewPath: $componentsRoot);
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
                \EduMicro\DaisyLw4\Console\Commands\MakeDaisyComponent::class,
            ]);
        }
    }
}
