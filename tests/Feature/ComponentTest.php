<?php
    use Livewire\Volt\Volt;

   it('can render the daisy button component', function () {
        $component = Volt::test('actions.button');

        $component->assertStatus(200)
                
                ->assertSee('button')
                ->assertSee('type='); 
    });


    it('renders using the correct namespace tag', function () {
   
        $view = $this->blade('<livewire:actions.button />');

        $view->assertSee('button');
    });