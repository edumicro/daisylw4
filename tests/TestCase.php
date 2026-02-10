<?php

namespace EduMicro\DaisyLw4\Tests;

use EduMicro\DaisyLw4\DaisyServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        $providers = [
            \Livewire\LivewireServiceProvider::class,
            \EduMicro\DaisyLw4\DaisyServiceProvider::class,
        ];

        // Avoid crashing if Volt is not installed, but register it if it is
        if (class_exists(\Livewire\Volt\VoltServiceProvider::class)) {
            $providers[] = \Livewire\Volt\VoltServiceProvider::class;
        }

        return $providers;
    }


    protected function defineEnvironment($app)
    {
        //set view paths for testing
        \Livewire\Volt\Volt::mount([
            __DIR__ . '/../resources/views/daisylw4',
        ]);

        //set aplicattion key for testing
        $app['config']->set('app.key', 'base64:u8699dvS9Sshis7B8X85y3EdfP3Sshis7B8X85y3Edf=');
    }
}