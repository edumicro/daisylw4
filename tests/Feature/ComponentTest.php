<?php
use Livewire\Livewire;

it('can render the daisy button component', function () {
    $component = Livewire::test('daisylw4.actions.button');

    $component->assertStatus(200)
        ->assertSee('button')
        ->assertSee('type=');
});

it('renders using the correct namespace tag', function () {
    $view = $this->blade('<livewire:daisylw4.actions.button />');

    $view->assertSee('button');
});