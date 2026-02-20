<?php
/**
 * Component: navigation.navbar
 * A responsive navbar component with menu support
 * Perfect for main site/app navigation
 * Created by edumicro daisy-ui Livewire 4 components
 */

use Livewire\Component;

new class extends Component {
    /**
     * Brand/logo text (translatable)
     */
    public string $brand = '';

    /**
     * Navigation items
     * Structure: [
     *     ['label' => 'Home', 'route' => 'home', 'active' => true],
     *     ['label' => 'About', 'route' => 'about', 'icon' => 'heroicon-o-information-circle'],
     *     ['label' => 'Dropdown', 'dropdown' => [
     *         ['label' => 'Item 1', 'route' => 'item1'],
     *         ['label' => 'Item 2', 'route' => 'item2'],
     *     ]],
     * ]
     */
    public array $items = [];

    /**
     * Right-side actions (e.g., login, theme toggle)
     * Structure: [
     *     ['label' => 'Login', 'route' => 'login', 'icon' => 'heroicon-o-user'],
     * ]
     */
    public array $actions = [];

    /**
     * Mobile menu open state
     */
    public bool $mobileMenuOpen = false;

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
     * Toggle mobile menu
     */
    public function toggleMobileMenu(): void
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }
}; ?>

<navbar class="navbar bg-base-100 shadow-md sticky top-0 z-40 {{ $containerClass }}" @foreach($extraAttributes as $attribute => $value) {{ $attribute }}="{{ $value }}" @endforeach>
    <!-- Start Section -->
    <div class="navbar-start">
        <!-- Mobile Menu Button -->
        <div class="dropdown dropdown-bottom dropdown-left">
            <button tabindex="0" class="btn btn-ghost btn-circle lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>

            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                @foreach($items as $item)
                    @if($item['dropdown'] ?? false)
                        <li>
                            <a>
                                {{ __($item['label'] ?? '') }}
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17l4.59,-4.59L18,10l-6,6 -6,-6 1.41,-1.42z"/></svg>
                            </a>
                            <ul class="p-2">
                                @foreach($item['dropdown'] as $subitem)
                                    <li>
                                        <a href="{{ route($subitem['route'] ?? '#') }}">
                                            {{ __($subitem['label'] ?? '') }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route($item['route'] ?? '#') }}">
                                {{ __($item['label'] ?? '') }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Brand -->
        @if($brand)
            <a class="btn btn-ghost normal-case text-xl font-bold">
                {{ __($brand) }}
            </a>
        @endif
    </div>

    <!-- Center Section -->
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 gap-2">
            @foreach($items as $item)
                @if($item['dropdown'] ?? false)
                    <li>
                        <details>
                            <summary>
                                @if($item['icon'] ?? false)
                                    <x-dynamic-component :component="$item['icon']" class="w-4 h-4" />
                                @endif
                                {{ __($item['label'] ?? '') }}
                            </summary>
                            <ul class="p-2 bg-base-100 rounded-t-none">
                                @foreach($item['dropdown'] as $subitem)
                                    <li>
                                        <a href="{{ route($subitem['route'] ?? '#') }}">
                                            {{ __($subitem['label'] ?? '') }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    </li>
                @else
                    <li>
                        <a 
                            href="{{ route($item['route'] ?? '#') }}"
                            class="@if($item['active'] ?? false) active @endif"
                        >
                            @if($item['icon'] ?? false)
                                <x-dynamic-component :component="$item['icon']" class="w-4 h-4" />
                            @endif
                            {{ __($item['label'] ?? '') }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <!-- End Section -->
    <div class="navbar-end gap-2">
        @foreach($actions as $action)
            @if($action['route'] ?? false)
                <a 
                    href="{{ route($action['route']) }}"
                    class="btn btn-sm btn-ghost"
                >
                    @if($action['icon'] ?? false)
                        <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                    @endif
                    {{ __($action['label'] ?? '') }}
                </a>
            @else
                <button 
                    type="button"
                    wire:click="$dispatch('{{ $action['action'] ?? '' }}')"
                    class="btn btn-sm btn-ghost"
                >
                    @if($action['icon'] ?? false)
                        <x-dynamic-component :component="$action['icon']" class="w-4 h-4" />
                    @endif
                    {{ __($action['label'] ?? '') }}
                </button>
            @endif
        @endforeach
    </div>
</navbar>
