<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FarmDirect') }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;800&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased bg-gray-50 text-gray-900 overflow-x-hidden">
    <div x-data="{ lang: 'en', mobileMenu: false }" id="app-wrapper" class="min-h-screen flex flex-col">
        <!-- Main Header -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0 flex items-center gap-2 text-[var(--color-primary)] font-display font-bold text-2xl">
                        🌱 FarmDirect
                    </div>
                    <nav class="hidden md:flex gap-6 items-center">
                        <a href="/" class="text-gray-600 hover:text-[var(--color-primary)] transition">Home</a>
                        <a href="/marketplace" class="text-gray-600 hover:text-[var(--color-primary)] transition">Marketplace</a>
                        <a href="/login" class="text-gray-600 hover:text-[var(--color-primary)] font-medium">Log In</a>
                        <a href="/register" class="bg-[var(--color-primary)] text-white px-5 py-2 rounded-full font-medium shadow-md shadow-green-900/20 hover:scale-105 transition transform delay-75">Start Selling</a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content Slot -->
        <main class="flex-grow pt-16">
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-[#1C201D] text-white py-12 text-center md:text-left">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                     <h3 class="font-display font-bold text-xl mb-4 text-[var(--color-accent)]">FarmDirect</h3>
                     <p class="text-gray-400 text-sm">Sell smarter, earn better. Connecting rural farmers directly with high-value buyers across the nation.</p>
                </div>
            </div>
            <div class="text-center text-sm text-gray-500 mt-12">
                &copy; {{ date('Y') }} FarmDirect. AI-Powered Farmer Marketplace Platform.
            </div>
        </footer>
    </div>
</body>
</html>
