<?php
    use Livewire\Volt\Volt;

   it('can render the daisy button component', function () {
        $component = Volt::test('actions.button');

        $component->assertStatus(200)
                // Buscamos solo la parte clave, sin preocuparnos por las comillas escapadas
                ->assertSee('button')
                ->assertSee('type='); 
    });