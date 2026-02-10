<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Component Mapping
    |--------------------------------------------------------------------------
    | Here you define which Livewire Volt component is responsible for each type 
    | of field in the Auto-Form. You can extend it with your own components.
    */
    'component_map' => [
        'text'     => 'daisylw4.form.input',
        'email'    => 'daisylw4.form.input',
        'password' => 'daisylw4.form.input',
        'number'   => 'daisylw4.form.input',
        'select'   => 'daisylw4.form.select',
        'relation' => 'daisylw4.form.select', // Relations are select by default
        'textarea' => 'daisylw4.form.textarea',
        'toggle'   => 'daisylw4.form.toggle',
        'checkbox' => 'daisylw4.form.checkbox',
        'date'     => 'daisylw4.form.input',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Styles
    |--------------------------------------------------------------------------
    | Default visual configuration for the package components.
    */
    'defaults' => [
        'container_class' => 'w-full',
        'input_class'     => 'input input-bordered',
        'select_class'    => 'select select-bordered',
        'button_variant'  => 'btn-primary',
    ],

    /*
    |--------------------------------------------------------------------------
    | Relationship Settings
    |--------------------------------------------------------------------------
    | Configuration for the automatic resolution of 'relation' fields.
    */
    'relations' => [
        // Field that will be attempted to be displayed by default if 'label_field' is not specified
        'default_label' => 'name', 
    ],
];