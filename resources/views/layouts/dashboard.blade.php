<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — ESG tech · Solar Tracker</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            esg: {
                                petrol: '#00464f',
                                teal: '#1A8593',
                                gold: '#fdd400',
                                goldDark: '#f0ac07',
                                mist: '#e8eced',
                                sand: '#F5F5F5',
                            },
                        },
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        },
                    },
                },
            };
        </script>
    @endif
    <style>
        :root {
            --esg-petrol: #00464f;
            --esg-teal: #1A8593;
            --esg-gold: #fdd400;
            --esg-mist: #e8eced;
            --esg-sand: #F5F5F5;
        }
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
    @stack('head')
</head>
<body class="min-h-screen bg-[var(--esg-sand)] text-[var(--esg-petrol)] antialiased">
    <header class="border-b-4 border-[var(--esg-gold)] bg-[var(--esg-petrol)] text-white shadow-md">
        <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--esg-gold)] text-lg font-bold text-[var(--esg-petrol)]">
                    E
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-widest text-[var(--esg-gold)]">ESG tech</p>
                    <p class="text-lg font-semibold leading-tight">Solar Tracker · Dashboard</p>
                </div>
            </div>
            <a href="{{ url('/') }}" class="rounded-lg border border-white/30 px-4 py-2 text-sm font-medium hover:bg-white/10">
                ← Home
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6">
        @yield('content')
    </main>

    <footer class="border-t border-[var(--esg-mist)] bg-white py-4 text-center text-xs text-[var(--esg-teal)]">
        Voorbeeld-dashboard met dummy data · ESG tech kleuren
    </footer>

    @stack('scripts')
</body>
</html>
