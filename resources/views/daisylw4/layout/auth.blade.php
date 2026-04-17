<!DOCTYPE html>
<html data-theme="{{ $page->theme ?? 'light' }}">

<head>
    <title>{{ $page->title ?? 'Flow ERP' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('flow-styles')
</head>

<body class="min-h-screen bg-base-200 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">
        <div class="w-full max-w-md mx-auto">
            <div class="card bg-base-100 shadow-xl border border-base-300/60">
                <div class="card-body p-6 sm:p-8">
                    <div class="text-center mb-6">
                        <x-daisylw4::ui.logo class="w-24 mx-auto" />
                        <h1 class="text-2xl font-bold mt-4">{{ $page->title ?? 'Login' }}</h1>
                        @if(!empty($page->subtitle))
                            <p class="text-base-content/70 mt-1">{{ $page->subtitle }}</p>
                        @endif
                    </div>

                    {!! $content !!}

                    <div class="mt-4">
                        <x-flow::ui.hook name="zone.intent.complementary" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    @stack('flow-scripts')
</body>

</html>
