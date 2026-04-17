@php
    $items    = collect($items ?? []);
    $depth    = (int) ($depth ?? 0);
    $navIcons = $navIcons ?? [];                        // passed from app.blade.php
    $groups   = $navIcons['groups']     ?? [];
    $cats     = $navIcons['categories'] ?? [];

    /**
     * Resolve the icon for a nav node.
     *
     * Priority:
     *  1. Items with a parent  → parent group icon
     *  2. Items without parent → category icon (if 'category' key is present in node)
     *  3. Group nodes          → look up their own id in group map
     *  4. Default fallback
     */
    if (!function_exists('flowNavIcon')) {
    function flowNavIcon(array $node, array $groups, array $cats): ?string
    {
        $parent   = $node['parent']   ?? '';
        $category = $node['category'] ?? '';
        $id       = $node['id']       ?? '';
        $hasChildren = !empty($node['children']);

        // Group node: look up its own id (first segment) in group map
        if ($hasChildren) {
            $prefix = explode('.', $id)[0];
            return $groups[$id] ?? $groups[$prefix] ?? $groups['default'] ?? null;
        }

        // Leaf with a parent: inherit parent group icon
        if ($parent !== '') {
            $prefix = explode('.', $parent)[0];
            return $groups[$parent] ?? $groups[$prefix] ?? $groups['default'] ?? null;
        }

        // Leaf without parent: use category icon
        if ($category !== '') {
            return $cats[$category] ?? $cats['default'] ?? null;
        }

        return $groups['default'] ?? $cats['default'] ?? null;
    }
    } // end if (!function_exists)
@endphp

@if($items->isNotEmpty())
    <ul class="menu menu-md w-full {{ $depth > 0 ? 'pl-2' : '' }}">
        @foreach($items as $node)
            @php
                if (!is_array($node)) {
                    continue;
                }

                $label       = trim((string) ($node['name'] ?? $node['title'] ?? ''));
                $url         = (string) ($node['url'] ?? '#');
                $method      = strtoupper((string) ($node['method'] ?? 'GET'));
                $children    = collect($node['children'] ?? []);
                $isActive    = $url !== '#' && request()->fullUrlIs($url . '*');
                $hasActive   = $children->contains(fn ($c) =>
                    is_array($c) && ($c['url'] ?? '#') !== '#' && request()->fullUrlIs($c['url'] . '*')
                );
                $icon        = flowNavIcon($node, $groups, $cats);
            @endphp

            @if($children->isNotEmpty())
                <li>
                    <details {{ ($isActive || $hasActive) ? 'open' : '' }}>
                        <summary class="font-medium gap-2">
                            @if($icon)
                                <x-dynamic-component :component="$icon" class="w-4 h-4 shrink-0" />
                            @endif
                            {{ $label }}
                        </summary>
                        @include('daisylw4::navigation.sidebar-tree', [
                            'items'    => $children,
                            'depth'    => $depth + 1,
                            'navIcons' => $navIcons,
                        ])
                    </details>
                </li>
            @else
                <li>
                    @if($method === 'POST')
                        <form action="{{ $url }}" method="POST" class="w-full p-0">
                            @csrf
                            <button type="submit" class="w-full text-left gap-2 {{ $isActive ? 'active' : '' }}">
                                @if($icon)
                                    <x-dynamic-component :component="$icon" class="w-4 h-4 shrink-0" />
                                @endif
                                {{ $label }}
                            </button>
                        </form>
                    @else
                        <a href="{{ $url }}" class="gap-2 {{ $isActive ? 'active' : '' }}">
                            @if($icon)
                                <x-dynamic-component :component="$icon" class="w-4 h-4 shrink-0" />
                            @endif
                            {{ $label }}
                        </a>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
@endif
