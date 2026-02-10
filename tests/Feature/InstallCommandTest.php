<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

it('publishes the configuration file', function () {
    $configPath = config_path('daisylw4.php');

    // Asegurarnos de que no existe antes
    if (File::exists($configPath)) {
        File::delete($configPath);
    }

    Artisan::call('daisylw4:install');

    expect(File::exists($configPath))->toBeTrue();
});