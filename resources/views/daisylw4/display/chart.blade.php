<?php
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public string $id = 'chart-default';
    public string $type = 'bar';
    public string $title = '';
    public array $labels = [];
    public array $values = [];
    public string $color = '#570df8';
    
    /**
     * Live Update: can be 'false', '5s', '10s', '1m', etc.
     */
    public string|bool $refresh = false;

    /**
     * This function is executed if the user activates polling.
     * The developer can override this method or emit data.
     */
    public function fetchLiveData(): void
    {
        // Here we dispatch an event that the parent component can capture
        // or the component itself can update its values.
        $this->dispatch('refresh-data-' . $this->id);
    }

    #[On('update-chart-{id}')]
    public function updateData(array $labels, array $values): void
    {
        $this->labels = $labels;
        $this->values = $values;
        $this->dispatch('js-refresh-chart-' . $this->id, labels: $labels, values: $values);
    }
}; ?>

<div class="card bg-base-100 shadow-xl border border-base-300" 
     @if($refresh) wire:poll.{{ $refresh }}="fetchLiveData" @endif>
    
    <div class="card-body p-4">
        <div class="flex justify-between items-center mb-4">
            @if($title)
                <h2 class="card-title text-sm font-bold opacity-70 uppercase">{{ $title }}</h2>
            @endif
            
            @if($refresh)
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-success"></span>
                </span>
            @endif
        </div>

        <div 
            x-data="{ 
                chart: null,
                init() {
                    const options = {
                        chart: { 
                            id: '{{ $id }}', 
                            type: '{{ $type }}', 
                            height: 300,
                            animations: { enabled: true, easing: 'linear', dynamicAnimation: { speed: 500 } },
                            toolbar: { show: false }
                        },
                        series: [{ data: @js($values) }],
                        labels: @js($labels),
                        colors: ['{{ $color }}'],
                        theme: { mode: document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light' }
                    };
                    this.chart = new ApexCharts($el, options);
                    this.chart.render();
                }
            }"
            @js-refresh-chart-{{ $id }}.window="chart.updateOptions({ series: [{ data: $event.detail.values }], labels: $event.detail.labels })"
            class="w-full"
        ></div>
    </div>
</div>