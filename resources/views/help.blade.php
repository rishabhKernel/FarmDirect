<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Help Center | FarmDirect</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Plus+Jakarta+Sans:wght@200..800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-tertiary-container": "#ffedf0",
                "on-background": "#1a1c1b",
                "on-tertiary-fixed-variant": "#7f2448",
                "on-secondary-fixed-variant": "#5b4137",
                "surface-tint": "#1b6d24",
                "primary-fixed-dim": "#88d982",
                "surface-container-lowest": "#ffffff",
                "on-error-container": "#93000a",
                "surface": "#f9f9f6",
                "surface-container-highest": "#e2e3e0",
                "secondary-container": "#fed7ca",
                "surface-dim": "#dadad7",
                "inverse-on-surface": "#f1f1ee",
                "error": "#ba1a1a",
                "tertiary-fixed-dim": "#ffb1c7",
                "on-surface": "#1a1c1b",
                "on-tertiary": "#ffffff",
                "on-primary": "#ffffff",
                "secondary": "#75584d",
                "primary-container": "#2e7d32",
                "on-primary-fixed": "#002204",
                "tertiary": "#923357",
                "on-tertiary-fixed": "#3f001c",
                "on-secondary-fixed": "#2b160f",
                "surface-variant": "#e2e3e0",
                "surface-container-high": "#e8e8e5",
                "on-primary-fixed-variant": "#005312",
                "surface-container-low": "#f4f4f1",
                "secondary-fixed": "#ffdbce",
                "on-secondary": "#ffffff",
                "background": "#f9f9f6",
                "outline": "#707a6c",
                "on-secondary-container": "#795c51",
                "on-surface-variant": "#40493d",
                "surface-bright": "#f9f9f6",
                "on-primary-container": "#cbffc2",
                "secondary-fixed-dim": "#e4beb2",
                "inverse-primary": "#88d982",
                "tertiary-container": "#b14b6f",
                "surface-container": "#eeeeeb",
                "outline-variant": "#bfcaba",
                "inverse-surface": "#2f312f",
                "tertiary-fixed": "#ffd9e2",
                "primary": "#0d631b",
                "on-error": "#ffffff",
                "primary-fixed": "#a3f69c",
                "error-container": "#ffdad6"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "fontFamily": {
                "headline": ["Manrope"],
                "body": ["Manrope"],
                "label": ["Plus Jakarta Sans"]
            }
          }
        }
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8f5e9] via-white to-[#fff3e0] min-h-screen text-on-surface antialiased relative flex flex-col">
<!-- Dark Premium Hero Background for White Nav Contrast -->
<div class="absolute top-0 left-0 w-full h-[60vh] bg-gradient-to-b from-green-950 via-green-900/90 to-transparent -z-10"></div>

<!-- Top Navigation Shell (Mirrored from Landing Page / Contact) -->
<header id="main-header" class="fixed top-0 w-full z-50 bg-white/10 backdrop-blur-xl border-b border-white/10 transition-colors duration-300">
    <nav class="flex justify-between items-center px-6 lg:px-12 h-20 max-w-[1920px] mx-auto">
        <a href="javascript:void(0)" onclick="window.history.length > 1 ? window.history.back() : (window.location.href = '{{ auth()->check() ? '/dashboard/' . auth()->user()->role : '/' }}')" class="text-white/80 font-semibold hover:text-white transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span> Back
        </a>
        <div class="flex items-center gap-6">
            <a href="@auth @if(auth()->user()->role === 'admin') /dashboard/admin @elseif(auth()->user()->role === 'farmer') /dashboard/farmer @elseif(auth()->user()->role === 'buyer') /dashboard/buyer @else / @endif @else / @endauth" class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2 hover:opacity-80 transition-opacity">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                Farm<span class="text-primary-fixed">Direct</span>
            </a>
            <span class="text-white font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-white text-lg hidden md:block">Help Center</span>
        </div>
        <div class="w-24"></div> <!-- Spacer for perfect centering -->
</nav>
</header>

<main class="pt-24 pb-16 px-6 lg:px-12 max-w-7xl mx-auto flex-1">
<!-- Hero Search Section -->
<section class="mt-12 mb-20 text-center">
<h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-8 drop-shadow-md">How can we support <br/><span class="text-primary-fixed">your harvest today?</span></h1>
<div class="max-w-2xl mx-auto relative">
<span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-on-surface-variant text-2xl">search</span>
<input onfocus="openFarmBot(event)" class="w-full pl-16 pr-8 py-6 rounded-full bg-white shadow-2xl border-none focus:ring-4 focus:ring-primary-fixed/50 text-lg font-label transition-shadow" placeholder="Search for documentation, guides, and help..." type="text"/>
</div>
<div class="mt-6 flex flex-wrap justify-center gap-3">
<span class="font-label text-xs uppercase tracking-widest text-white/60 mr-2 self-center font-bold">Trending:</span>
<button class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md rounded-full text-sm font-label transition-all">Setting up Stripe</button>
<button class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md rounded-full text-sm font-label transition-all">Bulk Listing</button>
<button class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md rounded-full text-sm font-label transition-all">Shipping Labels</button>
</div>
</section>

<!-- Category Bento Grid -->
<section class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-20">
<!-- Large Main Card: Selling -->
<div class="md:col-span-8 bg-white/80 backdrop-blur-sm border border-white/50 rounded-[2rem] p-10 flex flex-col justify-between group cursor-pointer hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-1 transition-all duration-300">
<div>
<div class="w-14 h-14 bg-primary-container/10 rounded-2xl flex items-center justify-center mb-6 text-primary">
<span class="material-symbols-outlined text-3xl">inventory_2</span>
</div>
<h3 class="text-3xl font-headline font-bold mb-4">Selling on FarmDirect</h3>
<p class="text-on-surface-variant leading-relaxed max-w-md">Everything you need to know about listing your crops, managing yields, and growing your digital farm presence.</p>
</div>
<div class="mt-12 flex flex-wrap gap-4">
<div class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-xl group-hover:bg-primary group-hover:text-white transition-colors">
<span class="font-label text-sm font-semibold">Creating Listings</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
<div class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-xl group-hover:bg-primary group-hover:text-white transition-colors">
<span class="font-label text-sm font-semibold">Yield Forecasts</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
</div>
<!-- Vertical Card: Payments -->
<div class="md:col-span-4 bg-[#FFE5DC] rounded-[2rem] p-10 flex flex-col transition-transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-orange-900/10 duration-300">
<div class="w-14 h-14 bg-white/50 rounded-2xl flex items-center justify-center mb-6 text-[#795c51]">
<span class="material-symbols-outlined text-3xl">payments</span>
</div>
<h3 class="text-2xl font-headline font-bold mb-4 text-[#2b160f]">Payments &amp; Security</h3>
<p class="text-[#795c51] text-sm leading-relaxed mb-10 font-medium">Secure transactions, merchant verification, and automated payouts for your farm's productivity.</p>
<div class="mt-auto space-y-3">
<div class="w-full h-1 bg-black/10 rounded-full overflow-hidden">
<div class="w-2/3 h-full bg-[#795c51]"></div>
</div>
<span class="font-label text-xs uppercase tracking-widest text-[#795c51] font-bold">75% trust score</span>
</div>
</div>
<!-- Horizontal Card: Buying -->
<div class="md:col-span-5 bg-surface-container-high rounded-[2rem] p-10 flex flex-col group cursor-pointer transition-all hover:bg-surface-container-highest hover:-translate-y-1 hover:shadow-xl">
<div class="flex items-center gap-4 mb-6">
<div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
<span class="material-symbols-outlined text-2xl">shopping_basket</span>
</div>
<h3 class="text-xl font-headline font-bold">Buying Guide</h3>
</div>
<p class="text-on-surface-variant text-sm mb-6">Learn how to find the freshest produce and connect directly with local farmers.</p>
<div class="flex items-center text-primary font-label text-sm font-bold gap-2 group-hover:translate-x-1 transition-transform">
                    Browse Buying Guide <span class="material-symbols-outlined">east</span>
</div>
</div>
<!-- Dynamic Card: Logistics -->
<div class="md:col-span-7 bg-white/80 backdrop-blur-sm border border-white/50 rounded-[2rem] overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
<div class="p-8 flex-1">
<h3 class="text-xl font-headline font-bold mb-3">Logistics &amp; Shipping</h3>
<p class="text-on-surface-variant text-sm mb-6">Tools for cold-chain management and last-mile farm delivery tracking.</p>
<ul class="space-y-3">
<li class="flex items-center gap-3 text-sm font-label font-medium text-on-surface">
<span class="material-symbols-outlined text-primary text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Cold-storage protocols
                        </li>
<li class="flex items-center gap-3 text-sm font-label font-medium text-on-surface">
<span class="material-symbols-outlined text-primary text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Route optimization
                        </li>
</ul>
</div>
<div class="w-full md:w-48 bg-primary-container relative min-h-[160px]">
<img alt="Logistics background" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-multiply" data-alt="Minimalist top-down view of a delivery truck on a clean asphalt road surrounded by green fields" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBj9w1TBfX9JAP67uZGqC3LB-VAi-LZ9CFfjxk1GhGTLW_j-dmRWguOeHXedUN-LMzUcjDZA-Lxi24wrPwJOLHmcs4_JBm4d8XRbuBaAB-o62yKB6lkAplTfeG_xv3YAyx49lDvk5t3jDNvBGAQprvBjw8bbopFd-unNSfbG2QEhble8vELHknGWDxk2cu1pIZT0P7YXzAGjhRN-9g6yBmW0SXlmWy2kxcMnnhdtPuCZbYNZ-ulKDehkEAgW2HmguHhnHzk1R23s7zo"/>
</div>
</div>
</section>

<!-- FAQ Quick Links -->
<section class="bg-white/60 backdrop-blur-md border border-white rounded-[3rem] p-12 lg:p-16 mb-20 shadow-xl shadow-primary/5">
<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
<div class="max-w-xl">
<h2 class="text-4xl font-headline font-black tracking-tight mb-4">Quick Solutions</h2>
<p class="text-on-surface-variant font-label text-lg">Short, sharp answers to our most common farmer inquiries.</p>
</div>
<button class="px-8 py-4 bg-primary text-on-primary font-label font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">View Full FAQ</button>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
<div class="border-b border-outline-variant/30 pb-6 group cursor-pointer">
<div class="flex justify-between items-center">
<h4 class="font-headline font-bold text-lg group-hover:text-primary transition-colors">How do I verify my organic certification?</h4>
<span class="material-symbols-outlined text-zinc-400 group-hover:text-primary transition-colors">add</span>
</div>
</div>
<div class="border-b border-outline-variant/30 pb-6 group cursor-pointer">
<div class="flex justify-between items-center">
<h4 class="font-headline font-bold text-lg group-hover:text-primary transition-colors">What are the fees for marketplace transactions?</h4>
<span class="material-symbols-outlined text-zinc-400 group-hover:text-primary transition-colors">add</span>
</div>
</div>
<div class="border-b border-outline-variant/30 pb-6 group cursor-pointer">
<div class="flex justify-between items-center">
<h4 class="font-headline font-bold text-lg group-hover:text-primary transition-colors">Can I schedule multiple crop drop-offs?</h4>
<span class="material-symbols-outlined text-zinc-400 group-hover:text-primary transition-colors">add</span>
</div>
</div>
<div class="border-b border-outline-variant/30 pb-6 group cursor-pointer">
<div class="flex justify-between items-center">
<h4 class="font-headline font-bold text-lg group-hover:text-primary transition-colors">How does the yield reporting AI work?</h4>
<span class="material-symbols-outlined text-zinc-400 group-hover:text-primary transition-colors">add</span>
</div>
</div>
</div>
</section>

<!-- Contact Support -->
<section class="flex flex-col md:flex-row gap-8 items-center bg-zinc-950 rounded-[3rem] p-12 overflow-hidden relative shadow-2xl">
<div class="relative z-10 flex-1">
<h2 class="text-3xl md:text-5xl font-headline font-bold text-white mb-4">Still need assistance?</h2>
<p class="text-zinc-400 font-label mb-8 text-lg">Our support team is available 24/7 to help you keep your farm running smoothly.</p>
<div class="flex flex-wrap gap-4">
<button onclick="openFarmBot(event)" class="px-8 py-4 bg-white text-zinc-950 font-label font-bold rounded-xl flex items-center gap-3 hover:scale-105 transition-transform">
<span class="material-symbols-outlined">chat_bubble</span>
                        Live Chat
                    </button>
<a href="/contact" class="px-8 py-4 bg-zinc-800 hover:bg-zinc-700 text-white font-label font-bold rounded-xl flex items-center gap-3 transition-colors">
<span class="material-symbols-outlined">mail</span>
                        Email Us
                    </a>
</div>
</div>
<div class="relative w-full md:w-1/3 aspect-square rounded-2xl overflow-hidden shadow-2xl">
<img alt="Support team" class="w-full h-full object-cover" data-alt="Professional customer support team in a dark-themed, modern office setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlBVXUNkGKvT3vjTTBQLlMs-D8crlUW45eojJB4xM8SVGJoY7KhTyL7DKJNCHB4UTEPOaEOb04lzLM4TZhDlbU1a3RNbvvOpQnkDltCmz4lac8IG7lnx6yzrK4qsK0BLmODKzgdHpHCrlABcbZnMEl29hprrgsoboPFOLPN0Fyhcn-AZFI5trGlee4GoE0fJBWxVAywd4y719MfscJRd7-wXBRrZBUOWyALey-E5Ol7ogqtla5JjzftdDRazePqtPXW0FToOrXo_zm"/>
</div>
</section>
</main>

<footer class="bg-gradient-to-br from-green-950 to-zinc-950 w-full pt-24 pb-12 px-6 lg:px-12 mt-auto border-t border-white/10 relative overflow-hidden text-white">
<div class="absolute -top-32 -right-32 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-16 w-full max-w-[1920px] mx-auto mb-20 relative z-10">
<div class="col-span-1 md:col-span-4 lg:col-span-5">
<a href="/" class="text-2xl font-black text-primary-fixed mb-8 flex items-center gap-2 hover:opacity-80 transition-opacity">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                FarmDirect
            </a>
<p class="text-lg font-medium text-white/70 leading-relaxed max-w-sm">
                Digital transparency for the modern agrarian ecosystem. Empowering farmers with technology and fair trade since 2020.
            </p>
</div>
<div class="col-span-1 md:col-span-2">
<h6 class="font-headline font-extrabold mb-8 text-white text-lg">Company</h6>
<div class="flex flex-col gap-5">
<a class="text-white/70 font-medium hover:text-primary-fixed transition-colors" href="/about">About Us</a>
</div>
</div>
<div class="col-span-1 md:col-span-2">
<h6 class="font-headline font-extrabold mb-8 text-white text-lg">Support</h6>
<div class="flex flex-col gap-5">
<a class="text-white/70 font-medium hover:text-primary-fixed transition-colors" href="/help">Help Center</a>
<a class="text-white/70 font-medium hover:text-primary-fixed transition-colors" href="/contact">Contact Us</a>
</div>
</div>
<div class="col-span-1 md:col-span-4 lg:col-span-3">
<h6 class="font-headline font-extrabold mb-8 text-white text-lg">Developers</h6>
<div class="flex flex-col gap-5">
    <div class="flex items-center gap-4">
        <span class="text-white/70 font-medium flex-1">Shivansh Dubey</span>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
        </a>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
        </a>
    </div>
    <div class="flex items-center gap-4">
        <span class="text-white/70 font-medium flex-1">Saakshi Jha</span>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
        </a>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
        </a>
    </div>
    <div class="flex items-center gap-4">
        <span class="text-white/70 font-medium flex-1">Rishabh Chaurasia</span>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
        </a>
        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
        </a>
    </div>
</div>
</div>
</div>
<div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-white/10 max-w-[1920px] mx-auto relative z-10">
<p class="text-sm font-bold text-white/50">© 2026 FarmDirect. Cultivating Digital Transparency.</p>
<div class="flex gap-8 mt-8 md:mt-0">
<a class="text-white/50 hover:text-primary-fixed transition-colors" href="#"><span class="material-symbols-outlined">public</span></a>
<a class="text-white/50 hover:text-primary-fixed transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
<a class="text-white/50 hover:text-primary-fixed transition-colors" href="/contact"><span class="material-symbols-outlined">mail</span></a>
</div>
</div>
</footer>
<script>
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.remove('bg-white/10', 'border-white/10');
            header.classList.add('bg-green-950/90', 'border-white/5', 'shadow-lg');
        } else {
            header.classList.add('bg-white/10', 'border-white/10');
            header.classList.remove('bg-green-950/90', 'border-white/5', 'shadow-lg');
        }
    });
</script>
@include('partials.farmbot')
</body></html>
