<?php
/**
 * Component: navigation.pagination
 * A pagination component for navigating through paginated data
 * Perfect for tables, lists, and search results
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Current page number
     */
    public int $currentPage = 1;

    /**
     * Total number of items
     */
    public int $total = 0;

    /**
     * Items per page
     */
    public int $perPage = 15;

    /**
     * Number of page links to show around current page
     */
    public int $window = 2; // Shows current ± window pages

    /**
     * Show first/last page links
     */
    public bool $showFirstLast = true;

    /**
     * Show previous/next links
     */
    public bool $showPrevNext = true;

    /**
     * Custom query parameter name for page
     */
    public string $queryParam = 'page';

    /**
     * Additional styling
     */
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    public function mount(): void
    {
        //
    }

    /**
     * Calculate total pages
     */
    public function getTotalPages(): int
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }

    /**
     * Get page numbers to display
     */
    public function getPageNumbers(): array
    {
        $total = $this->getTotalPages();
        $current = $this->currentPage;
        $window = $this->window;

        $pages = [];

        // Add first page
        if ($this->showFirstLast && $current > ($window + 2)) {
            $pages[] = 1;
            if ($current > ($window + 3)) {
                $pages[] = '...';
            }
        }

        // Add window pages
        $start = max(1, $current - $window);
        $end = min($total, $current + $window);

        for ($i = $start; $i <= $end; $i++) {
            $pages[] = $i;
        }

        // Add last page
        if ($this->showFirstLast && $current < ($total - $window - 1)) {
            if ($current < ($total - $window - 2)) {
                $pages[] = '...';
            }
            $pages[] = $total;
        }

        return $pages;
    }

    /**
     * Go to specific page
     */
    public function goToPage(int $page): void
    {
        $totalPages = $this->getTotalPages();
        if ($page >= 1 && $page <= $totalPages) {
            $this->currentPage = $page;
            $this->dispatch('page-changed', page: $page);
        }
    }

    /**
     * Get start item number
     */
    public function getStartItem(): int
    {
        return ($this->currentPage - 1) * $this->perPage + 1;
    }

    /**
     * Get end item number
     */
    public function getEndItem(): int
    {
        return min($this->currentPage * $this->perPage, $this->total);
    }
}; ?>

<div class="flex flex-col gap-4 {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <!-- Page Info -->
    @if($total > 0)
        <div class="text-sm text-base-content/70 text-center">
            {{ __('pagination.showing') }}
            <span class="font-semibold">{{ $this->getStartItem() }}</span>
            {{ __('pagination.to') }}
            <span class="font-semibold">{{ $this->getEndItem() }}</span>
            {{ __('pagination.of') }}
            <span class="font-semibold">{{ $total }}</span>
            {{ __('pagination.items') }}
        </div>
    @endif

    <!-- Pagination Controls -->
    <div class="join justify-center {{ $class }}">
        @if($showPrevNext)
            <button
                wire:click="goToPage({{ max(1, $currentPage - 1) }})"
                @disabled($currentPage === 1)
                class="join-item btn btn-sm"
            >
                {{ __('pagination.previous') }}
            </button>
        @endif

        @foreach($this->getPageNumbers() as $page)
            @if($page === '...')
                <button disabled class="join-item btn btn-sm btn-disabled">
                    ...
                </button>
            @else
                <button
                    wire:click="goToPage({{ $page }})"
                    class="join-item btn btn-sm {{ $page === $currentPage ? 'btn-active' : '' }}"
                >
                    {{ $page }}
                </button>
            @endif
        @endforeach

        @if($showPrevNext)
            <button
                wire:click="goToPage({{ min($this->getTotalPages(), $currentPage + 1) }})"
                @disabled($currentPage === $this->getTotalPages())
                class="join-item btn btn-sm"
            >
                {{ __('pagination.next') }}
            </button>
        @endif
    </div>

    <!-- Page Selector (Optional) -->
    @if($this->getTotalPages() > 1)
        <div class="flex justify-center items-center gap-2">
            <label class="text-sm text-base-content/70">
                {{ __('pagination.go_to_page') }}:
            </label>
            <select
                wire:model.live="currentPage"
                class="select select-sm select-bordered w-20"
            >
                @for($i = 1; $i <= $this->getTotalPages(); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    @endif
</div>
