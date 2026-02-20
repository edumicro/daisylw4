<?php

namespace EduMicro\DaisyLw4\Tests;

use EduMicro\DaisyLw4\DaisyServiceProvider;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            DaisyServiceProvider::class,
        ];
    }


    protected function defineEnvironment($app)
    {
        $viewsPath = realpath(__DIR__ . '/../resources/views');
        $componentsPath = $viewsPath . '/daisylw4';

        Livewire::addLocation(viewPath: $viewsPath);
        Livewire::addNamespace('daisylw4', viewPath: $componentsPath);

        //set aplicattion key for testing
        $app['config']->set('app.key', 'base64:u8699dvS9Sshis7B8X85y3EdfP3Sshis7B8X85y3Edf=');

        // Add the view namespace for testing
        $app['view']->addNamespace('daisylw4', $componentsPath);
    }
}