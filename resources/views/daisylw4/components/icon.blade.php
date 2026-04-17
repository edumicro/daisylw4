<?php

use Livewire\Component;

new class extends Component {
    public string $name = '';
    public string $variant = 'o';
}; ?>

<x-dynamic-component :component="'heroicon-' . $variant . '-' . $name" {{ $attributes }} />
