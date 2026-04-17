<div class="mb-6">
    @if(!empty($section['title']))
        <div class="mb-3">
            <h3 class="text-base font-semibold text-base-content">{{ $section['title'] }}</h3>
            @if(!empty($section['description']))
                <p class="text-sm text-base-content/60 mt-0.5">{{ $section['description'] }}</p>
            @endif
        </div>
    @endif
    {!! $inner !!}
</div>
