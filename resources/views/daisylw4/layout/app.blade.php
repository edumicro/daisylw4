<!DOCTYPE html>
<html data-theme="{{ $page->theme ?? 'light' }}">

<head>
    <title>{{ $page->title ?? 'Flow ERP' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('flow-styles')
</head>

<body class="antialiased">

    {{-- ── Toast notifications (fixed, top-right) ─────────────────────────── --}}
    @if(!empty($page->toasts))
        <div class="toast toast-top toast-end z-50">
            @foreach($page->toasts as $toast)
                <div class="alert alert-{{ $toast['type'] ?? 'info' }}">
                    <span>{{ $toast['message'] ?? '' }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <div class="drawer {{ $page->showSidebar ? 'lg:drawer-open' : '' }}">
        <input id="flow-drawer" type="checkbox" class="drawer-toggle" />

        {{-- ── Sidebar ──────────────────────────────────────────────────────── --}}
        @if($page->showSidebar)
            <aside class="drawer-side border-r border-base-200 z-20">
                <label for="flow-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                <div class="flex flex-col w-72 min-h-full bg-base-100">

                    {{-- Logo / brand identity --}}
                    <div class="p-4 border-b border-base-200 flex items-center gap-3">
                        <x-flow::ui.logo class="h-8" />
                        <x-flow::ui.hook name="zone.app.identity" />
                    </div>

                    {{-- Navigation tree (from manifest, fallback to MenuManager) --}}
                    <nav class="flex-1 p-3 overflow-y-auto">
                        @php
                            // MenuManager reads from the compiled manifest (opcode cache),
                            // applies permission filtering, then caches the result per
                            // user+buildStamp — no DB queries on subsequent requests.
                            $menuTree  = app(\Flow\Base\Services\MenuManager::class)->getTree('sidebar');
                            $navIcons  = $driver->getNavigationIcons();
                        @endphp
                        @include('daisylw4::navigation.sidebar-tree', [
                            'items'    => $menuTree,
                            'navIcons' => $navIcons,
                        ])
                        <x-flow::ui.hook name="zone.app.navigation" />
                    </nav>

                    {{-- Status bar + user profile (pinned to sidebar bottom) --}}
                    <div class="p-3 border-t border-base-200 space-y-1">
                        <x-flow::ui.hook name="zone.app.status_bar" />
                        <x-flow::ui.hook name="zone.app.user_profile" />
                    </div>
                </div>
            </aside>
        @endif

        {{-- ── Main area ───────────────────────────────────────────────────── --}}
        <main class="drawer-content flex flex-col min-h-screen {{ !$page->showSidebar ? 'bg-base-200 pt-10' : '' }}">

            {{-- Top navigation bar (sidebar layout only) --}}
            @if($page->showSidebar)
                <header class="navbar bg-base-100 border-b border-base-200 sticky top-0 z-10 gap-1">

                    {{-- Hamburger (mobile) --}}
                    <div class="flex-none lg:hidden">
                        <label for="flow-drawer" class="btn btn-square btn-ghost">
                            <x-heroicon-o-bars-3 class="w-6" />
                        </label>
                    </div>

                    {{-- Breadcrumbs or page title --}}
                    <div class="flex-1 px-2 min-w-0">
                        @if(!empty($page->breadcrumbs))
                            <div class="breadcrumbs text-sm py-0">
                                <ul>
                                    @foreach($page->breadcrumbs as $crumb)
                                        <li>
                                            @if(!empty($crumb['url']))
                                                <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                            @else
                                                {{ $crumb['label'] }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="truncate">
                                <span class="font-semibold text-sm">{{ $page->title ?? '' }}</span>
                                @if(!empty($page->subtitle))
                                    <span class="text-xs text-base-content/50 ml-2">{{ $page->subtitle }}</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Location / context zone (e.g. tenant selector, environment badge) --}}
                    <x-flow::ui.hook name="zone.intent.location" />

                    {{-- Page-level primary actions ($page->actions) --}}
                    @if(!empty($page->actions))
                        <div class="flex items-center gap-1 px-1">
                            @foreach($page->actions as $action)
                                @php
                                    $btnClass = match($action['style'] ?? 'default') {
                                        'primary'   => 'btn-primary',
                                        'secondary' => 'btn-neutral',
                                        'danger'    => 'btn-error',
                                        default     => 'btn-ghost',
                                    };
                                @endphp
                                <a href="{{ $action['url'] ?? '#' }}"
                                   class="btn btn-sm {{ $btnClass }}">
                                    @if(!empty($action['icon']))
                                        <x-dynamic-component
                                            :component="'heroicon-o-' . $action['icon']"
                                            class="w-4 h-4" />
                                    @endif
                                    {{ $action['label'] ?? '' }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Intent: injected primary & secondary action zones --}}
                    <x-flow::ui.hook name="zone.intent.primary_actions" />
                    <x-flow::ui.hook name="zone.intent.secondary_actions" />

                    {{-- App utilities (global search, notifications, user avatar…) --}}
                    <x-flow::ui.hook name="zone.app.utilities" />

                </header>
            @endif

            {{-- Announcements (full-width banners above content) --}}
            <x-flow::ui.hook name="zone.intent.announcements" />

            {{-- Alert messages from PageDescriptor --}}
            @if(!empty($page->alerts))
                <div class="px-4 pt-4 space-y-2">
                    @foreach($page->alerts as $alert)
                        <div role="alert" class="alert alert-{{ $alert['type'] ?? 'info' }}">
                            @if(!empty($alert['icon']))
                                <x-dynamic-component
                                    :component="'heroicon-o-' . $alert['icon']"
                                    class="w-5 h-5 shrink-0" />
                            @endif
                            <span>{{ $alert['message'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Intent: summary / KPI strip above the page body --}}
            <x-flow::ui.hook name="zone.intent.summary" />

            {{-- ── Page body ─────────────────────────────────────────────── --}}
            <section class="flex-1 p-4 {{ !$page->showSidebar ? 'w-full max-w-4xl mx-auto' : 'w-full' }}">

                {{-- No-sidebar: centred logo + title header --}}
                @if(!$page->showSidebar)
                    <div class="text-center mb-6">
                        <x-flow::ui.logo class="w-32 mx-auto" />
                        <h1 class="text-2xl font-bold mt-4">{{ $page->title ?? '' }}</h1>
                        @if(!empty($page->subtitle))
                            <p class="text-base-content/70 mt-1">{{ $page->subtitle }}</p>
                        @endif
                    </div>
                @endif

                {{-- Rendered sections --}}
                {!! $content !!}

                {{-- Complementary zone (footer widgets, related links…) --}}
                <div class="mt-8">
                    <x-flow::ui.hook name="zone.intent.complementary" />
                </div>

            </section>

        </main>
    </div>

    @livewireScripts
    @stack('flow-scripts')

</body>

</html>
