<?php

use Livewire\Component;

new class extends Component {
    /**
     * Mandatory standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Hover 3D Card specific props
     */
    public string $image = '';
    public string $imageAlt = 'Card Image';
    public string $title = '';
    public string $description = '';
    public array $tags = [];
    public string $icon = '';
    public bool $shadow = true;
    public string $backgroundColor = 'bg-base-100';

    /**
     * Get inline styles for 3D perspective
     */
    public function get3DStyles(): array
    {
        return [
            'perspective' => '1000px',
        ];
    }
}; ?>

<div
    class="group relative {{ $containerClass }}"
    style="perspective: 1000px"
    {{ $attributes->merge($extraAttributes) }}
>
    <div
        class="relative w-full h-96 rounded-xl overflow-hidden {{ $shadow ? 'shadow-lg' : '' }} transition-all duration-500 ease-out"
        style="transform-style: preserve-3d; transition: transform 0.6s cubic-bezier(0.23, 1, 0.320, 1)"
        onmousemove="
            const rect = this.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width;
            const y = (event.clientY - rect.top) / rect.height;
            const rotateX = (y - 0.5) * 20;
            const rotateY = (x - 0.5) * -20;
            this.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        "
        onmouseleave="this.style.transform = 'rotateX(0) rotateY(0) scale(1)'"
    >
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            />
        @else
            <div class="w-full h-full {{ $backgroundColor }} flex items-center justify-center">
                @if ($icon)
                    <x-dynamic-component :component="$icon" class="w-24 h-24 text-base-content/20" />
                @else
                    <span class="text-base-content/30">{{ $label }}</span>
                @endif
            </div>
        @endif

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <!-- Content Overlay -->
        <div
            class="absolute inset-0 flex flex-col justify-end p-6 translate-y-10 group-hover:translate-y-0 transition-transform duration-500"
            style="transform-style: preserve-3d"
        >
            @if ($title)
                <h3 class="text-xl font-bold text-white mb-2 {{ $class }}">{{ $title }}</h3>
            @endif

            @if ($description)
                <p class="text-white/90 text-sm mb-4 line-clamp-2">{{ $description }}</p>
            @endif

            @if (!empty($tags))
                <div class="flex gap-2 flex-wrap">
                    @foreach ($tags as $tag)
                        <span class="badge badge-sm badge-primary/80">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if ($model)
        @error($model)
            <span class="text-error text-sm block mt-2">{{ $message }}</span>
        @enderror
    @endif
</div>
