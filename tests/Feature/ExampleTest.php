<?php
use Illuminate\Support\Facades\Route;

it('returns a successful response', function () {
    
    Route::get('/', fn () => 'Hola desde Daisy!');

    $response = $this->get('/');

    $response->assertStatus(200);
});
