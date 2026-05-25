<!DOCTYPE html>

<html lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Marketplace | FarmDirect</title>
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-primary-fixed": "#002204",
                    "surface-container": "#eeeeeb",
                    "surface": "#f9f9f6",
                    "on-error": "#ffffff",
                    "on-secondary": "#ffffff",
                    "surface-container-highest": "#e2e3e0",
                    "primary-fixed-dim": "#88d982",
                    "surface-tint": "#1b6d24",
                    "surface-dim": "#dadad7",
                    "inverse-surface": "#2f312f",
                    "error-container": "#ffdad6",
                    "inverse-primary": "#88d982",
                    "surface-container-lowest": "#ffffff",
                    "secondary": "#75584d",
                    "on-primary-container": "#cbffc2",
                    "primary-container": "#2e7d32",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#b14b6f",
                    "on-surface": "#1a1c1b",
                    "surface-container-high": "#e8e8e5",
                    "secondary-fixed": "#ffdbce",
                    "on-surface-variant": "#40493d",
                    "on-primary-fixed-variant": "#005312",
                    "secondary-container": "#fed7ca",
                    "primary": "#0d631b",
                    "tertiary-fixed-dim": "#ffb1c7",
                    "outline-variant": "#bfcaba",
                    "on-tertiary-container": "#ffedf0",
                    "on-secondary-container": "#795c51",
                    "on-tertiary-fixed-variant": "#7f2448",
                    "on-error-container": "#93000a",
                    "secondary-fixed-dim": "#e4beb2",
                    "surface-bright": "#f9f9f6",
                    "on-secondary-fixed": "#2b160f",
                    "background": "#f9f9f6",
                    "inverse-on-surface": "#f1f1ee",
                    "surface-container-low": "#f4f4f1",
                    "on-secondary-fixed-variant": "#5b4137",
                    "surface-variant": "#e2e3e0",
                    "primary-fixed": "#a3f69c",
                    "tertiary": "#923357",
                    "error": "#ba1a1a",
                    "tertiary-fixed": "#ffd9e2",
                    "on-primary": "#ffffff",
                    "on-background": "#1a1c1b",
                    "on-tertiary-fixed": "#3f001c",
                    "outline": "#707a6c"
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
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- TopNavBar Shell -->
<header class="fixed top-0 w-full z-50 bg-white/70 dark:bg-stone-900/70 backdrop-blur-xl shadow-sm shadow-stone-200/50 dark:shadow-none">
<div class="flex justify-between items-center w-full px-8 py-4 max-w-full mx-auto">
<div class="flex items-center gap-12">
<span class="text-2xl font-extrabold text-green-700 dark:text-green-500 tracking-tighter">FarmDirect</span>
<nav class="hidden md:flex gap-8 items-center font-['Manrope'] font-bold tracking-tight text-sm">
<a class="text-green-700 dark:text-green-400 border-b-2 border-green-700 dark:border-green-400 pb-1" href="#">Marketplace</a>
<a class="text-stone-600 dark:text-stone-400 hover:text-green-600 transition-colors" href="#">Direct-to-Buyer</a>
<a class="text-stone-600 dark:text-stone-400 hover:text-green-600 transition-colors" href="#">Insights</a>
</nav>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
<span class="material-symbols-outlined text-on-surface-variant mr-2">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-64 text-on-surface placeholder:text-on-surface-variant" placeholder="Search crops, farms, or regions..." type="text"/>
</div>
<div class="flex items-center gap-4">
<span class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">English | Hindi</span>
<button class="material-symbols-outlined text-green-800 dark:text-green-400 p-2 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors rounded-full">account_circle</button>
<button class="relative p-2 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors rounded-full">
<span class="material-symbols-outlined">shopping_cart</span>
<span class="absolute top-0 right-0 w-4 h-4 bg-tertiary text-white text-[10px] flex items-center justify-center rounded-full font-bold">3</span>
</button>
</div>
</div>
</div>
<div class="bg-stone-100/50 dark:bg-stone-800/50 h-[1px]"></div>
</header>
<main class="pt-24 pb-20 px-8 max-w-[1600px] mx-auto flex flex-col md:flex-row gap-8">
<!-- Filters Sidebar -->
<aside class="w-full md:w-72 flex-shrink-0 space-y-8">
<div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/15">
<h3 class="font-headline font-bold text-lg mb-6">Market Filters</h3>
<div class="space-y-6">
<!-- Crop Type -->
<div>
<label class="block font-label text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-3">Crop Type</label>
<div class="flex flex-wrap gap-2">
<button class="px-3 py-1.5 rounded-full text-xs font-semibold bg-primary text-on-primary">All Crops</button>
<button class="px-3 py-1.5 rounded-full text-xs font-semibold bg-surface-container-low hover:bg-surface-container-high transition-colors text-on-surface">Grains</button>
<button class="px-3 py-1.5 rounded-full text-xs font-semibold bg-surface-container-low hover:bg-surface-container-high transition-colors text-on-surface">Fruits</button>
<button class="px-3 py-1.5 rounded-full text-xs font-semibold bg-surface-container-low hover:bg-surface-container-high transition-colors text-on-surface">Legumes</button>
<button class="px-3 py-1.5 rounded-full text-xs font-semibold bg-surface-container-low hover:bg-surface-container-high transition-colors text-on-surface">Oilseeds</button>
</div>
</div>
<!-- Price Range -->
<div>
<label class="block font-label text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-3">Price Range (per quintal)</label>
<div class="space-y-4">
<input class="w-full h-1.5 bg-surface-container-highest rounded-lg appearance-none cursor-pointer accent-primary" max="10000" min="500" type="range"/>
<div class="flex justify-between text-xs font-medium text-on-surface-variant">
<span>₹500</span>
<span>₹10,000</span>
</div>
</div>
</div>
<!-- Location -->
<div>
<label class="block font-label text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-3">Location</label>
<select class="w-full bg-surface-container-low border-none rounded-lg text-sm font-medium focus:ring-1 focus:ring-primary py-3">
<option>All Regions</option>
<option>Punjab &amp; Haryana</option>
<option>Maharashtra</option>
<option>Madhya Pradesh</option>
<option>Karnataka</option>
</select>
</div>
<!-- Verified Only Toggle -->
<div class="flex items-center justify-between pt-4 border-t border-outline-variant/15">
<span class="text-sm font-medium text-on-surface">AI-Verified Only</span>
<button class="w-10 h-6 bg-primary rounded-full relative">
<span class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></span>
</button>
</div>
</div>
</div>
<!-- Cart Preview Section (Floating on desktop context) -->
<div class="bg-surface-container-low p-6 rounded-xl border border-outline-variant/10">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline font-bold text-md">Cart Preview</h3>
<span class="text-xs font-bold text-primary">3 Items</span>
</div>
<div class="space-y-3 mb-6">
<div class="flex gap-3 items-center">
<div class="w-10 h-10 rounded-lg bg-surface-container-highest flex-shrink-0 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="close-up of raw organic wheat grains with detailed texture and earthy tones" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_QC54RhCztRbVwCUhFbM_cjo45IQ8PN8qhq2OLIWa6iC6d2gCjMHRtWiJsTANJk5qgbrngdQjWMPnI9pygEG5WnZK-JS0NJtI2Noa6cBR8ztccvHoz2jPWtju0Fik2nF4KlKSQIf5fSSpamF5nQHuMjUpKfffB8mNGRWs3ez2O3aQdLI0OangjPIv0nJR11w8VlW7y1TwTgdYYhWVNzysCYW3OJzylETX584y0pwSix8pS47FMSsr4fC3IGKzcwqgLKIv5JX54cdB"/>
</div>
<div class="flex-1">
<p class="text-xs font-bold">Premium Sonalika Wheat</p>
<p class="text-[10px] text-on-surface-variant">50 Quintals</p>
</div>
<p class="text-xs font-bold">₹1.2L</p>
</div>
<div class="flex gap-3 items-center">
<div class="w-10 h-10 rounded-lg bg-surface-container-highest flex-shrink-0 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="fresh vibrant carrots on a rustic wooden table with natural soft side lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCad84HjQlF0tS8e0kvUZBqTYTcgoG115D2sinKc-xrEeN5P-esC3IJb5ii70bjsw_XfyIz7m4qcg1XE9CCxJ1vt5dPIo5NyADsKJKRRSyMpBB9n25n46JCh9vKoXPAQs1WwLrjsdNXKpgQW891rVeQ_AQgPiwzSTJM9QxSjS-i6YMbM9F-oe1l49aIQggPk9RnU7LJCB7nb1v9xXowEb4DH4F5pr4OBFVIW3oehBS2Yj2NG6hxIMupxeDMKIckT2Ix1ou8Rs9nuxpD"/>
</div>
<div class="flex-1">
<p class="text-xs font-bold">Hybrid Orange Carrots</p>
<p class="text-[10px] text-on-surface-variant">10 Quintals</p>
</div>
<p class="text-xs font-bold">₹28K</p>
</div>
</div>
<button class="w-full py-3 bg-primary text-on-primary text-xs font-bold rounded-xl shadow-lg shadow-primary/20 hover:opacity-90 transition-opacity">Checkout Now</button>
</div><div class="space-y-6 pt-6">
<!-- AI Insights Header -->
<div class="bg-primary-container p-4 rounded-xl text-on-primary-container flex items-center gap-3">
<span class="material-symbols-outlined">psychology</span>
<div>
<p class="text-xs font-bold uppercase tracking-wider opacity-80">AI Insights</p>
<p class="text-sm font-bold">Smart Recommendations</p>
</div>
</div>
<!-- Harvest Trend Card -->
<div class="bg-[#947467] p-6 rounded-3xl relative overflow-hidden text-white min-h-[220px] flex flex-col justify-between">
<div class="relative z-10">
<h3 class="text-xl font-bold font-headline mb-2">Harvest Trends</h3>
<p class="text-xs opacity-90 leading-relaxed">
        Spices are predicted to surge by 12% next month. Secure your contracts now.
      </p>
</div>
<div class="relative z-10 mt-6">
<button class="bg-white text-[#947467] px-4 py-2 rounded-full text-xs font-bold flex items-center gap-2 hover:bg-opacity-90 transition-all w-fit">
        View Data
        <span class="material-symbols-outlined text-sm">trending_up</span>
</button>
</div>
<!-- Subtle Trend Line Graphic -->
<div class="absolute bottom-0 right-0 w-full h-1/2 opacity-20 pointer-events-none">
<svg class="w-full h-full" preserveaspectratio="none" viewbox="0 0 100 100">
<path d="M0,100 L20,80 L40,90 L60,60 L80,70 L100,20 L100,100 Z" fill="currentColor"></path>
</svg>
</div>
</div>
</div>
</aside>
<!-- Product Grid -->
<section class="flex-1">
<header class="mb-10">
<h1 class="text-4xl md:text-5xl font-extrabold font-headline tracking-tighter mb-2">Refined Marketplace</h1>
<p class="text-on-surface-variant max-w-2xl font-label">Direct procurement from verified sustainable farms. Every listing is audited via AgriCore satellite and soil health analysis.</p>
</header>
<!-- Asymmetric Bento-style Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($crops as $crop)
                <div class="bg-surface-container-lowest rounded-3xl overflow-hidden border border-outline-variant/15 flex flex-col group p-2">
                    <div class="relative h-48 rounded-2xl overflow-hidden mb-4">
                        @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500'])
                        <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-on-surface" onclick="toggleSaveListing('{{ $crop->id }}')">
                            <span class="material-symbols-outlined text-[20px]">favorite</span>
                        </button>
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-primary flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span> AI-VERIFIED
                            </span>
                        </div>
                    </div>
                    <div class="px-4 pb-4 flex flex-col flex-1">
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                @if($crop->is_organic)
                                <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-bold rounded">ORGANIC</span>
                                @endif
                                <span class="px-2 py-0.5 bg-secondary-container text-on-secondary-container text-[10px] font-bold rounded">FRESH</span>
                            </div>
                            <h3 class="text-lg font-bold font-headline leading-tight">{{ $crop->name }}</h3>
                            <p class="text-xs text-on-surface-variant">{{ $crop->farmer->city ?? 'Rural Region' }}, {{ $crop->farmer->state ?? 'IN' }}</p>
                        </div>
                        <div class="mt-auto">
                            <div class="flex justify-between items-end mb-4">
                                <div>
                                    <p class="text-lg font-black text-on-surface">₹{{ $crop->price_per_unit }}</p>
                                    <p class="text-[10px] font-bold text-on-surface-variant uppercase">Per {{ $crop->unit }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-bold text-tertiary">{{ $crop->quantity }} {{ $crop->unit }} avail.</p>
                                </div>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full py-3 bg-surface-container-highest text-on-surface text-xs font-bold rounded-xl hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-sm">add</span>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-12 text-center bg-stone-50 rounded-3xl border-2 border-dashed border-stone-200">
                    <span class="material-symbols-outlined text-stone-400 text-4xl mb-2">inbox</span>
                    <p class="text-stone-500 font-bold">No crops available found.</p>
                </div>
                @endforelse
</div>
<!-- Pagination Space -->
<div class="mt-16 flex items-center justify-center gap-2">
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-on-primary font-bold">1</button>
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface font-bold hover:bg-surface-container-high transition-colors">2</button>
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface font-bold hover:bg-surface-container-high transition-colors">3</button>
<span class="px-2 text-on-surface-variant">...</span>
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface font-bold hover:bg-surface-container-high transition-colors">12</button>
<button class="w-10 h-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</section>
</main>
<!-- Footer Shell -->
<footer class="bg-stone-100 dark:bg-stone-900 border-t border-stone-200 dark:border-stone-800 w-full py-12 px-8">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center max-w-7xl mx-auto">
<div>
<p class="font-bold text-stone-900 dark:text-stone-100 mb-2">FarmDirect Ecosystem</p>
<p class="font-['Plus_Jakarta_Sans'] text-xs text-stone-500 dark:text-stone-400">© 2024 FarmDirect Ecosystem. AI-Verified Agriculture. Bridging the gap between earth and innovation.</p>
</div>
<div class="flex flex-wrap justify-md-end gap-6">
<a class="font-['Plus_Jakarta_Sans'] text-xs text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 underline transition-all" href="#">Privacy Policy</a>
<a class="font-['Plus_Jakarta_Sans'] text-xs text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 underline transition-all" href="#">Terms of Service</a>
<a class="font-['Plus_Jakarta_Sans'] text-xs text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 underline transition-all" href="#">Sustainability Report</a>
<a class="font-['Plus_Jakarta_Sans'] text-xs text-stone-500 hover:text-stone-800 dark:hover:text-stone-200 underline transition-all" href="#">Contact Us</a>
</div>
</div>
</footer>
<script>
    function toggleSaveListing(cropId) {
        const button = event.currentTarget;
        const icon = button.querySelector('.material-symbols-outlined');
        
        fetch("{{ route('buyer.toggleSaved') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ crop_id: cropId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (icon.classList.contains('text-red-500')) {
                    icon.classList.remove('text-red-500');
                    icon.style.fontVariationSettings = "'FILL' 0";
                } else {
                    icon.classList.add('text-red-500');
                    icon.style.fontVariationSettings = "'FILL' 1";
                }
                alert(data.message);
            }
        });
    }
</script>
</body></html>
