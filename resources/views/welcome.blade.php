<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect | Sell Smarter, Earn Better</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Plus_Jakarta_Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#ffb1c7",
                        "on-surface": "#1a1c1b",
                        "error-container": "#ffdad6",
                        "on-background": "#1a1c1b",
                        "secondary-container": "#fed7ca",
                        "primary-fixed-dim": "#88d982",
                        "on-secondary-container": "#795c51",
                        "on-tertiary-fixed": "#3f001c",
                        "outline": "#707a6c",
                        "surface-dim": "#dadad7",
                        "secondary-fixed-dim": "#e4beb2",
                        "error": "#ba1a1a",
                        "background": "#f9f9f6",
                        "on-secondary-fixed-variant": "#5b4137",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#cbffc2",
                        "primary": "#0d631b",
                        "tertiary-fixed": "#ffd9e2",
                        "on-surface-variant": "#40493d",
                        "on-error": "#ffffff",
                        "primary-fixed": "#a3f69c",
                        "inverse-surface": "#2f312f",
                        "surface-bright": "#f9f9f6",
                        "on-tertiary-container": "#ffedf0",
                        "primary-container": "#2e7d32",
                        "surface-tint": "#1b6d24",
                        "tertiary": "#923357",
                        "tertiary-container": "#b14b6f",
                        "surface-variant": "#e2e3e0",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#2b160f",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#88d982",
                        "secondary-fixed": "#ffdbce",
                        "secondary": "#75584d",
                        "on-primary-fixed": "#002204",
                        "outline-variant": "#bfcaba",
                        "surface-container": "#eeeeeb",
                        "surface-container-low": "#f4f4f1",
                        "on-tertiary-fixed-variant": "#7f2448",
                        "surface-container-high": "#e8e8e5",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#f1f1ee",
                        "on-primary-fixed-variant": "#005312",
                        "surface-container-highest": "#e2e3e0",
                        "surface": "#f9f9f6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "4xl": "2rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Manrope", "sans-serif"],
                        "label": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    "boxShadow": {
                        "premium": "0 20px 50px -12px rgba(13, 99, 27, 0.08)",
                        "premium-hover": "0 30px 60px -12px rgba(13, 99, 27, 0.15)"
                    },
                    "animation": {
                        "marquee": "marquee 60s linear infinite",
                        "marquee-reverse": "marquee-reverse 60s linear infinite"
                    },
                    "keyframes": {
                        "marquee": {
                            "0%": { transform: "translateX(0)" },
                            "100%": { transform: "translateX(-50%)" }
                        },
                        "marquee-reverse": {
                            "0%": { transform: "translateX(-50%)" },
                            "100%": { transform: "translateX(0)" }
                        }
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .text-shadow-hero {
            text-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 100%);
        }
        .timeline-line {
            width: 2px;
            background: repeating-linear-gradient(to bottom, transparent, transparent 4px, #0d631b 4px, #0d631b 8px);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-fixed selection:text-on-primary-fixed">
<header id="main-header" class="fixed top-0 w-full z-50 bg-white/10 backdrop-blur-xl border-b border-white/10 transition-colors duration-300">
<nav class="flex justify-between items-center px-6 lg:px-12 h-20 max-w-[1920px] mx-auto">
<a href="/" class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2 hover:opacity-80 transition-opacity">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
            FarmDirect
        </a>
<div class="hidden md:flex items-center gap-10" id="desktop-nav-links">
<a class="nav-item text-white font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-white" href="#">Marketplace</a>
<a class="nav-item text-white/80 font-semibold hover:text-white transition-all" href="#cultivate">Direct-to-Buyer</a>
<a class="nav-item text-white/80 font-semibold hover:text-white transition-all" href="#insights">Insights</a>
<a class="nav-item text-white/80 font-semibold hover:text-white transition-all" href="#harvests">Yields</a>
</div>
<div class="flex items-center gap-2">
<div class="hidden lg:flex items-center bg-white/20 px-4 py-1.5 rounded-full mr-2">
<span class="text-white font-label font-bold text-xs uppercase tracking-wider">Farmer Mode</span>
</div>
<a href="/about" class="flex items-center gap-2 px-3 py-2 md:px-4 hover:bg-white/10 rounded-full transition-all text-white font-label font-bold text-sm" title="About Us">
<span class="material-symbols-outlined text-lg">language</span>
<span class="hidden md:inline">About</span>
</a>
<a href="/contact" class="flex items-center gap-2 px-3 py-2 md:px-4 hover:bg-white/10 rounded-full transition-all text-white font-label font-bold text-sm" title="Contact Us">
<span class="material-symbols-outlined text-lg">call</span>
<span class="hidden md:inline">Contact</span>
</a>
<a href="/help" class="flex items-center gap-2 px-3 py-2 md:px-4 hover:bg-white/10 rounded-full transition-all text-white font-label font-bold text-sm" title="Help Center">
<span class="material-symbols-outlined text-lg">help</span>
<span class="hidden md:inline">Help</span>
</a>
</div>
</nav>
</header>
<main>
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="A successful modern farmer smiling in a vibrant, sun-drenched organic field, looking aspirational and proud." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_XEIgOf6gBe7dAZrb0-lzXVW2dQvDc8C6lSb12v4ox3N5lRu7CdZdTgMuOAMsuVsZEgw7FCjXjSq5iItOwfkfLtTZu8ekW40rO354RbegCezCcN8LP8UN3SJcC8hhNVvA-BajW-GBw1cprKGH3vKDMn3Byhi1YXRXxFxZiIFiVHuycUhlIAa3j4ap8Lk6VcV0XK3bzWgNRRZrI-6fT9G-tkpOSfjjy-gnWvR-1L6ths9vZWrUk3d8ixUc-Qy1eWexZCbElAPCnmpg"/>
<div class="absolute inset-0 hero-overlay"></div>
</div>
<div class="relative z-10 w-full max-w-5xl mx-auto px-6 text-center">
<div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 backdrop-blur-md rounded-full text-white font-label font-bold text-sm mb-10">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                Empowering 50,000+ Farmers Globally
            </div>
<h1 class="text-7xl md:text-8xl lg:text-[10rem] font-headline font-extrabold tracking-tighter text-white leading-[0.85] mb-12 text-shadow-hero">
                Sell <span class="text-primary-fixed italic">smarter</span>,<br/>
                earn <span class="text-primary-fixed italic">better</span>
</h1>
<p class="text-xl md:text-3xl text-white/90 font-body mb-16 max-w-2xl mx-auto leading-relaxed font-medium">
                Bridging the gap between rural harvest and urban demand. Direct-to-consumer trading powered by AI-pricing insights.
            </p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-6">
<a href="/register" class="group w-full sm:w-auto px-12 py-6 bg-primary text-on-primary font-label font-bold text-xl rounded-2xl shadow-2xl hover:scale-105 transition-all flex items-center justify-center gap-3">
                    Start Selling
                    <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
<a href="#transform" class="w-full sm:w-auto px-12 py-6 glass-panel border border-white/30 text-white font-label font-bold text-xl rounded-2xl hover:bg-white/20 transition-all flex items-center justify-center">
                    Explore Marketplace
                </a>
</div>
</div>
<div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/60">
<span class="text-xs font-bold uppercase tracking-widest">Scroll to explore</span>
<div class="w-px h-12 bg-gradient-to-b from-white to-transparent"></div>
</div>
<a href="/login" class="absolute bottom-24 right-6 w-14 h-14 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-40 md:bottom-10 md:right-10" title="Login / Authenticate">
<span class="material-symbols-outlined">account_circle</span>
</a>
</section>
<section class="py-32 px-6 lg:px-12 bg-surface-container-low relative">
<div class="max-w-[1920px] mx-auto">
<div class="flex flex-col lg:flex-row lg:items-end justify-between mb-20 gap-8">
<div class="max-w-2xl">
<h2 class="text-4xl md:text-5xl lg:text-6xl font-headline font-extrabold tracking-tight mb-6 text-on-surface leading-tight">
                        Precision Commerce for <br class="hidden md:block"/> Modern Farmers
                    </h2>
<p class="text-on-surface-variant text-xl leading-relaxed opacity-80">Harness the power of direct trade with tools designed for the field.</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-8">
<div class="md:col-span-8 bg-white p-10 lg:p-14 rounded-4xl flex flex-col justify-between group transition-all duration-300 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 border border-outline-variant/10">
<div class="flex justify-between items-start">
<div class="w-24 h-24 bg-primary/10 rounded-3xl flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary" style="font-variation-settings: 'FILL' 1;">trending_up</span>
</div>
<span class="bg-primary text-on-primary px-5 py-2 rounded-full text-xs font-black font-label tracking-widest uppercase">AI POWERED</span>
</div>
<div class="mt-16">
<h3 class="text-3xl lg:text-4xl font-headline font-bold mb-6 text-on-surface">Smart Dynamic Pricing</h3>
<p class="text-on-surface-variant text-lg lg:text-xl leading-relaxed max-w-2xl">Real-time market analytics ensure you never undersell. We calculate the best price based on local demand, seasonality, and harvest quality.</p>
</div>
</div>
<div class="md:col-span-4 bg-[#FFE5DC] p-10 lg:p-12 rounded-4xl flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-orange-900/20 hover:-translate-y-2">
<div class="w-24 h-24 bg-white/50 rounded-3xl flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-[#795c51]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
</div>
<div class="mt-8">
<h3 class="text-2xl lg:text-3xl font-headline font-bold mb-4 text-[#2b160f]">Secure Escrow</h3>
<p class="text-[#795c51] font-medium text-lg leading-relaxed">Funds are held safely until delivery is confirmed. Guaranteed peace of mind for both parties.</p>
</div>
</div>
<div class="md:col-span-4 bg-surface-container-high p-10 lg:p-12 rounded-4xl flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 border border-outline-variant/10">
<div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary">forum</span>
</div>
<div class="mt-8">
<h3 class="text-2xl lg:text-3xl font-headline font-bold mb-4 text-on-surface">Direct Buyer Chat</h3>
<p class="text-on-surface-variant text-lg leading-relaxed">Negotiate and coordinate logistics directly with verified institutional buyers and local retailers.</p>
</div>
</div>
<div class="md:col-span-8 bg-surface-container-highest p-10 lg:p-12 rounded-4xl flex flex-col md:flex-row gap-12 items-center overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2">
<div class="md:w-1/2">
<h3 class="text-3xl lg:text-4xl font-headline font-bold mb-6 text-on-surface leading-tight">Zero Intermediaries</h3>
<p class="text-on-surface-variant text-lg lg:text-xl leading-relaxed">Keep 100% of your margins by bypassing traditional wholesalers. Connect directly with your end customers.</p>
</div>
<div class="md:w-1/2 relative">
<img class="rounded-3xl shadow-2xl transform group-hover:rotate-0 rotate-2 transition-transform duration-500" data-alt="farmer shaking hands with a restaurant chef in a sunlit organic farm setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8XTaRyzWyQA4wQnCBZ2Jvg6ZMDRWBrxtsm7Cnwq7accVCGPpcvg2dlitQfyeOJ_H8OSg52z0WtD8j_grYdCRuBh7Bfm0l6tvfhSDGpZcaDkLAJr1ANUPizYOrIYI70YoIqHq5_jJtSL7AJ0c7i4YLOmU0uMEET1Db91T2j48Fh9fnvPF5TiPUNMBQap2W6y-dn0vFH_Hpe9CD1UAhtRp7O28whFHiE_hy1eYirMfs0PAchBQe-veeSW3RMkfcD12Tl87stkebnUKR"/>
</div>
</div>
</div>
</div>
</section>
<section id="cultivate" class="py-32 px-6 lg:px-12 bg-gradient-to-br from-[#e8f5e9] via-white to-[#fff3e0] relative overflow-hidden">
<div class="absolute inset-0 z-0 flex flex-col justify-around opacity-40 saturate-[1.75] contrast-125 pointer-events-none w-[200vw] mix-blend-multiply">
    <div class="flex animate-marquee gap-8 w-max">
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
    </div>
    <div class="flex animate-marquee-reverse gap-8 w-max ml-[-50%] mt-8">
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
    </div>
    <div class="flex animate-marquee gap-8 w-max mt-8">
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1506485338023-6ce5f36692df?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
<img src="https://images.unsplash.com/photo-1590682680695-43b964a3ae17?w=600&h=400&fit=crop" class="w-80 h-56 rounded-3xl object-cover" />
<div class="w-80 h-56 rounded-3xl border border-white/20 glass-panel shadow-sm"></div>
    </div>
</div>
<div class="max-w-[1200px] mx-auto relative z-10">
<div class="text-center mb-32">
<h2 class="text-4xl md:text-6xl font-headline font-extrabold mb-8 tracking-tight">Cultivate to Consumer</h2>
<div class="h-1.5 w-32 bg-primary mx-auto rounded-full"></div>
</div>
<div class="relative">
<div class="absolute left-4 md:left-1/2 top-0 bottom-0 timeline-line -translate-x-1/2 opacity-20"></div>
<div class="relative flex flex-col md:flex-row items-center mb-40 gap-12 md:gap-0">
<div class="w-full md:w-1/2 md:pr-24 text-left md:text-right">
<h3 class="text-3xl md:text-4xl font-headline font-extrabold mb-6">List Your Harvest</h3>
<p class="text-on-surface-variant text-xl leading-relaxed opacity-80">Upload high-res photos and specify variety, quantity, and precise harvest date.</p>
</div>
<div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-2xl z-20 shadow-xl">1</div>
<div class="w-full md:w-1/2 md:pl-24">
<div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] transform hover:scale-[1.02] transition-transform">
<img class="w-full h-full object-cover" data-alt="Farmer taking high resolution photo of fresh vegetables in a sunlit barn" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6S1L9BZzhaOg2goI_ztErJWeL49EgLHWjgQuTzJWVmMi7dzy1d0gYMxgQyyqEES5Gj25PQiSv04vYEF94xnrWndgIO15r1dE4e40Vlh8OPpTLyCL6sElifur6qYUywgUHKInWwCDw074_t7oJffCiZiNdNXYUVv6t7k-I9atRax7JK2Xl6XAMxvssLfQPxTzFe1cryeS6PGx_fEf24NaCpalVo4N_Eqawz6UHtHOTEqq-BNUhi-0oh2nSA9R8N3752t3XwDXLYXFz"/>
</div>
</div>
</div>
<div class="relative flex flex-col md:flex-row-reverse items-center mb-40 gap-12 md:gap-0">
<div class="w-full md:w-1/2 md:pl-24">
<h3 class="text-3xl md:text-4xl font-headline font-extrabold mb-6">Match with Buyers</h3>
<p class="text-on-surface-variant text-xl leading-relaxed opacity-80">Our AI notifies matching buyers—from artisanal chefs to international retail chains.</p>
</div>
<div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-2xl z-20 shadow-xl">2</div>
<div class="w-full md:w-1/2 md:pr-24">
<div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] transform hover:scale-[1.02] transition-transform">
<img class="w-full h-full object-cover" data-alt="A professional chef browsing a tablet with fresh farm produce listings in a high-end restaurant kitchen" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAYC0nZZANGNKphd2YA11mLS56Ky3ZJXNEvsM5B9fAiB2HrMMnG8pA0xv23o1-Abkrh4qsIqAaH4yg8Rf0mDxgkRA1NYHnmLWJLlsproOqHsYWd3OEW7w3l9dfTGqs9GNASSKbkggd8D9YbTjxDQKaV-XRvzU0scjJnovBOVbRahwQBOWaW5yUhLvXgjQ7FKK9K4oh3wLPVBZlwgTIVG5ne25igLEEYE14iArG6SrC07jKXVsyOe8QVvrBJVAyEPR_0khOyVkbGCsq"/>
</div>
</div>
</div>
<div class="relative flex flex-col md:flex-row items-center gap-12 md:gap-0">
<div class="w-full md:w-1/2 md:pr-24 text-left md:text-right">
<h3 class="text-3xl md:text-4xl font-headline font-extrabold mb-6">Direct Delivery</h3>
<p class="text-on-surface-variant text-xl leading-relaxed opacity-80">Coordinate logistics and get paid instantly upon secure buyer verification.</p>
</div>
<div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-2xl z-20 shadow-xl">3</div>
<div class="w-full md:w-1/2 md:pl-24">
<div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] transform hover:scale-[1.02] transition-transform">
<img class="w-full h-full object-cover" data-alt="Handover of fresh produce from a farmer to a local store owner at sunrise" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8XTaRyzWyQA4wQnCBZ2Jvg6ZMDRWBrxtsm7Cnwq7accVCGPpcvg2dlitQfyeOJ_H8OSg52z0WtD8j_grYdCRuBh7Bfm0l6tvfhSDGpZcaDkLAJr1ANUPizYOrIYI70YoIqHq5_jJtSL7AJ0c7i4YLOmU0uMEET1Db91T2j48Fh9fnvPF5TiPUNMBQap2W6y-dn0vFH_Hpe9CD1UAhtRp7O28whFHiE_hy1eYirMfs0PAchBQe-veeSW3RMkfcD12Tl87stkebnUKR"/>
</div>
</div>
</div>
</div>
</div>
</section>
<section id="harvests" class="py-32 bg-surface-container-lowest px-6 lg:px-12">
<div class="max-w-[1920px] mx-auto">
<div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-16 gap-6">
<div>
<h2 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight mb-2">Featured Harvests</h2>
<p class="text-on-surface-variant font-medium">Fresh produce available for immediate dispatch</p>
</div>
<a class="group text-primary font-label font-bold text-lg flex items-center gap-3 py-2 border-b-2 border-transparent hover:border-primary transition-all" href="#">
                    Explore Full Marketplace 
                    <span class="material-symbols-outlined transition-transform group-hover:translate-x-2">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
<div class="bg-white/80 backdrop-blur-md rounded-4xl overflow-hidden shadow-lg transition-all duration-300 group border border-zinc-200 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 hover:border-primary/40">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="crate of vibrant fresh organic red tomatoes with morning dew" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6S1L9BZzhaOg2goI_ztErJWeL49EgLHWjgQuTzJWVmMi7dzy1d0gYMxgQyyqEES5Gj25PQiSv04vYEF94xnrWndgIO15r1dE4e40Vlh8OPpTLyCL6sElifur6qYUywgUHKInWwCDw074_t7oJffCiZiNdNXYUVv6t7k-I9atRax7JK2Xl6XAMxvssLfQPxTzFe1cryeS6PGx_fEf24NaCpalVo4N_Eqawz6UHtHOTEqq-BNUhi-0oh2nSA9R8N3752t3XwDXLYXFz"/>
<div class="absolute top-5 left-5 bg-white/95 backdrop-blur shadow-lg px-4 py-1.5 rounded-full text-[10px] font-black font-label tracking-widest text-primary uppercase">ORGANIC</div>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-bold mb-1 text-on-surface">Roma Tomatoes</h4>
<p class="text-on-surface-variant text-sm mb-6 flex items-center gap-1">
<span class="material-symbols-outlined text-sm">location_on</span> Ambala, Haryana
                        </p>
<div class="flex items-center justify-between">
<div class="flex flex-col">
<span class="text-3xl font-extrabold text-primary">₹100</span>
<span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">per kilogram</span>
</div>
<button class="w-14 h-14 bg-surface-container hover:bg-primary hover:text-on-primary rounded-2xl flex items-center justify-center transition-all">
<span class="material-symbols-outlined text-2xl">shopping_cart</span>
</button>
</div>
</div>
</div>
<div class="bg-white/80 backdrop-blur-md rounded-4xl overflow-hidden shadow-lg transition-all duration-300 group border border-zinc-200 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 hover:border-primary/40">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="fresh crisp green peas in pods on a wooden background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMRa1RweKK99Wy2BgShpoxn3BYgYUHbyaK9pnUuvzrbDbWXLbMV-Y_1s7rI45KvyCLVycT_cjcpQ1qUQMngHxAfN-LNYn1meqEAKeb2RXFIZ90Rb8sco5Kvdmo1ZcAjpPdoa-t5-JOW9Il2NbGT7bQPKPXh4jIRgpTkuOz8-9csSOGf2s5a2uuSyhvZHUrJ2L3LtXZSQotcEI4pzzT4XsQUmSag57GgdP8vLLxwB7FZoeKU7PwnAz-gHvY-e7-2nReOx2R_zTEJGm7"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-bold mb-1 text-on-surface">Sweet Peas</h4>
<p class="text-on-surface-variant text-sm mb-6 flex items-center gap-1">
<span class="material-symbols-outlined text-sm">location_on</span> Solan, HP
                        </p>
<div class="flex items-center justify-between">
<div class="flex flex-col">
<span class="text-3xl font-extrabold text-primary">₹200</span>
<span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">per kilogram</span>
</div>
<button class="w-14 h-14 bg-surface-container hover:bg-primary hover:text-on-primary rounded-2xl flex items-center justify-center transition-all">
<span class="material-symbols-outlined text-2xl">shopping_cart</span>
</button>
</div>
</div>
</div>
<div class="bg-white/80 backdrop-blur-md rounded-4xl overflow-hidden shadow-lg transition-all duration-300 group border border-zinc-200 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 hover:border-primary/40">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="bundles of organic kale and spinach in a rustic wooden crate" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCL5RDf_SzkM9IU10xJ_fwBTibgX935EJoAbCjbEdMSpVsVEBPMD40PGyP1S_P6OORw2x6yfusazaKqMNk2gWOFAMUGwgDf3TlqGgJzRJqPkD6aNZIFbMLM_DwrsHQEixZrZJ8oQQbus9HRP9WGMMwTFvLpTPYwNIRZsBPQ65Gzo4B3Ny6gHYKhOF1QsdWm-alF9uzla2hhjhVjjkGyuuk6UcRsbsHf-wovfBkoflRW9FuVtk_c5nqninGtfkrHHVUMmGrVq_xvIt_x"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-bold mb-1 text-on-surface">Tuscan Kale</h4>
<p class="text-on-surface-variant text-sm mb-6 flex items-center gap-1">
<span class="material-symbols-outlined text-sm">location_on</span> Nilgiris, TN
                        </p>
<div class="flex items-center justify-between">
<div class="flex flex-col">
<span class="text-3xl font-extrabold text-primary">₹80</span>
<span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">per bunch</span>
</div>
<button class="w-14 h-14 bg-surface-container hover:bg-primary hover:text-on-primary rounded-2xl flex items-center justify-center transition-all">
<span class="material-symbols-outlined text-2xl">shopping_cart</span>
</button>
</div>
</div>
</div>
<div class="bg-white/80 backdrop-blur-md rounded-4xl overflow-hidden shadow-lg transition-all duration-300 group border border-zinc-200 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-2 hover:border-primary/40">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="earthy organic russet potatoes in a brown burlap sack" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDj_fEoEZRMr2wFc1PcqL-o_zv333xE2dJY10P1EzuATeQ1kAY29727uwNq0UohcoDu5t6xAkbw1zK6w6hgz8wETh-vob5UA-V3Y_dt1MVOHmt7cBxdj7IZNbsDjgTjgUltM4WBJc7MZHc1S6WnKo5rIzY-t4uT83Wnli7Ri3IyEcWK9t0eLffucUNFmxqGGx9-n_zgkJoo9VwAkKfE10JMgt6pTYbdE6ERrKrEzibPVp9uj8tREhkv2uCsOUMj62SkM8gr516M86di"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-bold mb-1 text-on-surface">Starch Potatoes</h4>
<p class="text-on-surface-variant text-sm mb-6 flex items-center gap-1">
<span class="material-symbols-outlined text-sm">location_on</span> Indore, MP
                        </p>
<div class="flex items-center justify-between">
<div class="flex flex-col">
<span class="text-3xl font-extrabold text-primary">₹50</span>
<span class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">per kilogram</span>
</div>
<button class="w-14 h-14 bg-surface-container hover:bg-primary hover:text-on-primary rounded-2xl flex items-center justify-center transition-all">
<span class="material-symbols-outlined text-2xl">shopping_cart</span>
</button>
</div>
</div>
</div>
</div>
</div>
</section>

<section id="mandi-ticker" class="py-24 bg-primary/5 border-y border-primary/10 overflow-hidden">
    <div class="max-w-[1920px] mx-auto px-6 lg:px-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 rounded-full text-primary font-bold text-xs uppercase tracking-widest mb-3">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Live Market Updates
                </div>
                <h2 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight">Today's Mandi Prices</h2>
            </div>
            <a href="/login" class="px-6 py-3 bg-primary text-white rounded-2xl font-bold hover:bg-primary/90 transition-all flex items-center gap-2">
                View All Markets <span class="material-symbols-outlined">trending_up</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($mandiPrices ?? [] as $price)
            <div class="bg-white p-6 rounded-3xl border border-outline-variant/10 shadow-sm hover:shadow-xl transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-xs font-bold text-primary uppercase tracking-wider bg-primary/5 px-2 py-1 rounded-lg">{{ $price->category }}</span>
                        <h4 class="text-xl font-bold mt-2">{{ $price->crop_name }}</h4>
                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">location_on</span> {{ $price->mandi_name }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-black text-primary">₹{{ number_format($price->price_per_q) }}</p>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-tighter">per quintal</p>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-50">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="text-[10px] font-bold text-green-600 uppercase">Steady Market</span>
                    </div>
                    <span class="text-[10px] text-on-surface-variant font-medium">Updated 2h ago</span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant bg-white rounded-3xl border border-dashed border-outline-variant/30">
                <span class="material-symbols-outlined text-4xl mb-2">analytics</span>
                <p class="font-bold">Aggregating live market data...</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="insights" class="py-32 px-6 lg:px-12 bg-surface-container-low overflow-hidden">
<div class="max-w-[1920px] mx-auto">
<div class="text-center mb-24">
<h2 class="text-4xl md:text-5xl lg:text-6xl font-headline font-extrabold mb-4">Rooted in Trust</h2>
<p class="text-on-surface-variant font-medium text-lg">Real stories from our agrarian community</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-10">
<div class="bg-white p-10 rounded-4xl shadow-premium border border-outline-variant/10 hover:-translate-y-2 transition-transform">
<div class="flex gap-1 text-amber-400 mb-8">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-xl text-on-surface leading-relaxed font-medium italic mb-10">"FarmDirect increased my annual profit margin by 32%. Dealing directly with grocery chains changed my life."</p>
<div class="flex items-center gap-5">
<img class="w-16 h-16 rounded-2xl object-cover shadow-lg" data-alt="portrait of a confident middle-aged farmer with a weathered face and warm smile" src="{{ asset('images/farmer_rajesh.png') }}"/>
<div>
<h5 class="font-bold text-lg text-on-surface">Rajesh Kumar</h5>
<p class="text-sm text-primary font-bold uppercase tracking-wider">Apple Farmer, Himachal</p>
</div>
</div>
</div>
<div class="bg-white p-10 rounded-4xl shadow-premium border border-outline-variant/10 hover:-translate-y-2 transition-transform">
<div class="flex gap-1 text-amber-400 mb-8">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-xl text-on-surface leading-relaxed font-medium italic mb-10">"The transparency is unmatched. I know exactly where my money is going and the buyers get the freshest stock."</p>
<div class="flex items-center gap-5">
<img class="w-16 h-16 rounded-2xl object-cover shadow-lg" data-alt="close up headshot of a professional female chef in a white uniform" src="{{ asset('images/chef_ananya.png') }}"/>
<div>
<h5 class="font-bold text-lg text-on-surface">Ananya Sharma</h5>
<p class="text-sm text-primary font-bold uppercase tracking-wider">Head Chef, The Green Room</p>
</div>
</div>
</div>
<div class="bg-white p-10 rounded-4xl shadow-premium border border-outline-variant/10 hover:-translate-y-2 transition-transform">
<div class="flex gap-1 text-amber-400 mb-8">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined">star_half</span>
</div>
<p class="text-xl text-on-surface leading-relaxed font-medium italic mb-10">"Finally a platform that understands agriculture. The AI insights for pricing are spot on every season."</p>
<div class="flex items-center gap-5">
<img class="w-16 h-16 rounded-2xl object-cover shadow-lg" data-alt="portrait of a young female entrepreneur in a sustainable tech workspace" src="{{ asset('images/entrepreneur_meera.png') }}"/>
<div>
<h5 class="font-bold text-lg text-on-surface">Meera Nair</h5>
<p class="text-sm text-primary font-bold uppercase tracking-wider">Wholesale Distributor</p>
</div>
</div>
</div>
</div>
</div>
</section>
<section id="transform" class="py-32 px-6 lg:px-12 bg-surface-container-lowest">
<div class="max-w-7xl mx-auto bg-gradient-to-br from-green-950 via-primary to-green-900 rounded-[3.5rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl border border-white/10">
<!-- Decorative Glowing Orbs -->
<div class="absolute -top-32 -left-32 w-96 h-96 bg-white/20 rounded-full blur-[100px] pointer-events-none"></div>
<div class="absolute -bottom-32 -right-32 w-96 h-96 bg-black/40 rounded-full blur-[100px] pointer-events-none"></div>

<div class="absolute inset-0 opacity-40 pointer-events-none mix-blend-overlay">
<img class="w-full h-full object-cover" data-alt="top down view of organized rows of seedlings in a greenhouse" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMx8DE6wDVRlGUl7YMfP7mFyIi73tMocwg2UZquOQQ8uDGtmocfpgWZUrDx12CFdaWDx41yrBATlN7KSirRn5Zau5bkvyMVHfAMNN9p0i_il0YjaxFgANGJgONxbVQtBbS8VqaVe-Hqpy8H_Esuwze4i-9Iujyif1v0F-QUQRYg5zE4PqRZO1GmUyGrSXj2n4Sg4YLIBTioaaTTsjSGlDB_uFk8SwhgN9TF0m6NRhdiO4NBPsyP8_zMl8s4WlYiyutD77az1a_XMTs"/>
</div>

<div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
<div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 backdrop-blur-md rounded-full text-white font-label font-bold text-sm mb-8">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
    Join the Agrarian Revolution
</div>

<h2 class="text-5xl md:text-7xl lg:text-8xl font-headline font-extrabold text-white mb-8 leading-[1.05] tracking-tight text-shadow-lg">
    Ready to transform <br/> <span class="italic text-green-100/90 font-light">your trade?</span>
</h2>

<p class="text-xl text-white/80 font-medium mb-16 max-w-2xl leading-relaxed">
    Whether you are growing the future or buying the best, FarmDirect provides the tools to thrive. Choose your path.
</p>

<div class="flex flex-col sm:flex-row justify-center items-center gap-6 w-full max-w-2xl">
<a href="/register?role=farmer" class="group flex-1 w-full flex items-center justify-center gap-4 px-8 py-6 bg-white text-green-950 font-label font-black text-xl rounded-2xl hover:scale-105 hover:shadow-2xl hover:shadow-white/20 transition-all duration-300">
    <span class="material-symbols-outlined text-3xl transition-transform group-hover:-rotate-12" style="font-variation-settings: 'FILL' 1;">agriculture</span>
    Join as Farmer
</a>
<a href="/register?role=buyer" class="group flex-1 w-full flex items-center justify-center gap-4 px-8 py-6 bg-white/10 text-white border-2 border-white/30 backdrop-blur-md font-label font-bold text-xl rounded-2xl hover:bg-white/20 hover:border-white/50 hover:scale-105 transition-all duration-300 shadow-xl">
    <span class="material-symbols-outlined text-3xl transition-transform group-hover:scale-110">shopping_basket</span>
    Join as Buyer
</a>
</div>
</div>
</div>
</section>
</main>
<footer class="bg-gradient-to-br from-green-950 to-zinc-950 w-full pt-24 pb-12 px-6 lg:px-12 mt-24 border-t border-white/10 relative overflow-hidden text-white">
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
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/80 backdrop-blur-xl border-t border-outline-variant/10 flex justify-around items-center h-20 z-50 px-4">
<button class="flex flex-col items-center text-primary font-black">
<span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">home</span>
<span class="text-[10px] font-label mt-1">Home</span>
</button>
<button class="flex flex-col items-center text-on-surface-variant font-bold">
<span class="material-symbols-outlined text-2xl">shopping_basket</span>
<span class="text-[10px] font-label mt-1">Market</span>
</button>
<button class="flex flex-col items-center text-on-surface-variant font-bold">
<span class="material-symbols-outlined text-2xl">chat_bubble</span>
<span class="text-[10px] font-label mt-1">Chat</span>
</button>
<button class="flex flex-col items-center text-on-surface-variant font-bold">
<span class="material-symbols-outlined text-2xl">person</span>
<span class="text-[10px] font-label mt-1">Account</span>
</button>
</nav>

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

    // Handle Active Nav Link Underline
    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.nav-item');
        const activeClasses = ['font-bold', 'relative', "after:content-['']", 'after:absolute', 'after:-bottom-1', 'after:left-0', 'after:w-full', 'after:h-0.5', 'after:bg-white'];
        const inactiveClasses = ['text-white/80', 'font-semibold', 'hover:text-white', 'transition-all'];
        
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                // Reset all items to inactive state
                navItems.forEach(nav => {
                    nav.classList.remove('text-white', ...activeClasses);
                    nav.classList.add(...inactiveClasses);
                });
                
                // Set clicked item to active state
                this.classList.remove(...inactiveClasses);
                this.classList.add('text-white', ...activeClasses);
            });
        });
    });
</script>
</body></html>