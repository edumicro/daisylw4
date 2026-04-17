<?php

use Livewire\Component;

new class extends Component {
    public string $href = '/';
}; ?>

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'font-extrabold tracking-tight']) }}>
    {{ config('app.name') }}
</a>
