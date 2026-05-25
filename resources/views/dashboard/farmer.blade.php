<!DOCTYPE html>

<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>FarmDirect | Farmer Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <!-- Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind -->
    <script src="/js/tailwind.min.js"></script>
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
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f9f6;
            color: #1a1c1b;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Manrope', sans-serif;
        }

        .glass-header {
            backdrop-filter: blur(24px);
        }

        .pulse-soft {
            animation: pulse-soft 3s infinite;
        }

        @keyframes pulse-soft {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
        }

        .stagger-card:nth-child(even) {
            margin-top: 2rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .area-chart-gradient {
            fill: url(#chartGradient);
            filter: drop-shadow(0 4px 6px rgba(13, 99, 27, 0.2));
        }

        .sparkline-gradient {
            stroke: url(#sparklineGradient);
            stroke-width: 3;
            fill: none;
        }

        .ai-card-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(121, 92, 81, 0.05) 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="bg-surface text-on-surface">
    @if(session('success'))
        <div id="success-toast"
            class="fixed top-24 right-8 z-[100] bg-primary text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="font-bold">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('success-toast');
                if (toast) {
                    toast.style.transition = 'opacity 0.5s ease';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 5000);
        </script>
    @endif
    <!-- TopNavBar -->
    <nav
        class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm">
        <div class="flex items-center gap-4">
            <!-- Removed redundant label -->
        </div>
        <div class="flex items-center gap-4">
            <div
                class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <form action="{{ route('farmer.dashboard') }}" method="GET">
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-48" name="search"
                        value="{{ request('search') }}" placeholder="Search your crops..." type="text" />
                </form>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative group flex items-center">
                    <a href="{{ route('farmer.notifications') }}" class="p-2 hover:bg-white/40 rounded-full transition-all active:scale-90 relative cursor-pointer">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full notification-badge"></span>
                    </a>
                    <div class="absolute right-0 top-10 w-80 bg-white rounded-2xl shadow-xl border border-outline-variant/10 p-4 hidden group-hover:block z-50 text-on-surface">
                        <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest mb-3 border-b pb-2">Latest Notifications</p>
                        <div id="hover-notifications-list" class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                            <p class="text-xs text-on-surface-variant italic text-center py-2">Syncing...</p>
                        </div>
                        <a href="{{ route('farmer.notifications') }}" class="block text-center text-xs text-primary font-bold mt-4 hover:underline">View All</a>
                    </div>
                </div>
                <div class="relative group">
                    <a href="{{ route('farmer.settings') }}" class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold border border-outline-variant/10 cursor-pointer overflow-hidden">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-full h-full object-cover"/>
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </a>
                    <!-- Hover Card -->
                    <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-outline-variant/10 p-4 hidden group-hover:block z-50 text-on-surface">
                        <div class="font-headline font-bold text-sm truncate">{{ $user->name }}</div>
                        <div class="font-label text-xs text-outline mb-1">ID: {{ substr($user->id, -6) }}</div>
                        <div class="text-xs text-on-surface-variant mb-3 truncate" title="{{ $user->email }}">{{ $user->email }}</div>
                        <hr class="my-2 border-outline-variant/15">
                        <a href="{{ route('farmer.settings') }}" class="text-xs text-primary font-bold hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">settings</span>
                            Account Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- SideNavBar -->
    <!-- SideNavBar -->
    <aside
        class="hidden lg:flex flex-col fixed left-0 top-0 h-full py-4 w-64 bg-stone-950 z-40 border-r border-white/5 shadow-2xl">
        <div class="px-8 py-2 mb-6">
            <a href="/" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-4xl"
                    style="font-variation-settings: 'FILL' 1;">eco</span>
                <span class="text-3xl font-black tracking-tighter text-white">Farm<span
                        class="text-primary">Direct</span></span>
            </a>
        </div>
        <div class="px-6 mb-8">
            <div class="flex items-center gap-3 mb-6 p-3 bg-white/5 rounded-2xl border border-white/10">
                <img alt="Portrait of {{ $user->name }}"
                    class="w-10 h-10 rounded-xl object-cover border-2 border-primary/20 shadow-sm"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0d631b&color=fff&size=128' }}" />
                <div class="overflow-hidden">
                    <h3 class="font-bold text-white text-xs truncate">{{ $user->name }}</h3>
                    <p class="text-[10px] text-stone-400 truncate">Verified Farmer</p>
                </div>
            </div>
            <button onclick="openAIInsights()"
                class="w-full py-3 bg-primary text-white rounded-xl flex items-center justify-center gap-2 font-bold transition-transform active:scale-95 shadow-lg shadow-primary/20 hover:bg-primary/90">
                <span class="material-symbols-outlined text-sm"
                    style="font-variation-settings: 'FILL' 1;">psychology_alt</span>
                <span class="text-xs uppercase tracking-widest">AI Insights</span>
            </button>
        </div>
        <nav class="flex-1 space-y-2 px-4">
            <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner"
                href="{{ route('farmer.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label text-sm">Dashboard</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                href="{{ route('farmer.bids') }}">
                <span class="material-symbols-outlined">gavel</span>
                <span class="font-label text-sm">Orders & Bids</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                href="{{ route('farmer.crops') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="font-label text-sm">My Crops</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                href="{{ route('farmer.logistics') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="font-label text-sm">Logistics & History</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                href="{{ route('farmer.mandi') }}">
                <span class="material-symbols-outlined">store</span>
                <span class="font-label text-sm">Mandi Prices</span>
            </a>

        </nav>
        <div class="px-4 mt-auto space-y-1 border-t border-white/5 pt-6">
            <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all"
                href="{{ route('farmer.settings') }}">
                <span class="material-symbols-outlined text-sm">settings</span>
                <span class="font-label text-xs">Settings</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
            <a class="text-stone-400 hover:text-red-400 hover:bg-red-500/10 px-4 py-3 flex items-center gap-3 rounded-xl transition-all cursor-pointer"
                onclick="document.getElementById('logout-form').submit()">
                <span class="material-symbols-outlined text-sm">logout</span>
                <span class="font-label text-xs">Logout</span>
            </a>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="lg:ml-64 pt-28 px-8 pb-12">
        <header class="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-6">
            <div class="relative">
                <span class="text-primary font-black text-xs tracking-[0.3em] uppercase mb-4 block opacity-80">Farmer
                    Dashboard</span>
                <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-none">{{ $greeting }}, <br /><span
                        class="text-primary">{{ explode(' ', $user->name)[0] }}.</span></h1>
                <div class="flex items-center gap-3 mt-4">
                    <div class="flex -space-x-2">
                        <div
                            class="w-8 h-8 rounded-full border-2 border-surface bg-primary-fixed text-on-primary-fixed flex items-center justify-center text-[10px] font-bold">
                            12%</div>
                    </div>
                    <p class="text-on-surface-variant font-medium text-sm">Your farm performance is thriving this month.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-widest mb-1">Local Weather in
                        {{ $weather['city'] }}</p>
                    <div class="flex items-center gap-4 justify-end">
                        <p class="text-3xl font-bold text-primary">{{ now()->format('h:i A') }}</p>
                        <p class="font-black text-4xl text-on-surface flex items-center gap-1">{{ $weather['temp'] }}°C 
                        <span class="material-symbols-outlined text-amber-500 text-4xl">{{ $weather['condition'] }}</span>
                        </p>
                    </div>
                </div>
                <button onclick="toggleTheme()" class="w-12 h-12 bg-surface-container-high text-on-surface rounded-2xl flex items-center justify-center shadow-sm hover:bg-surface-container-highest transition-colors">
                    <span class="material-symbols-outlined" id="theme-icon">dark_mode</span>
                </button>
                <button onclick="openCropModal()"
                    class="bg-primary text-on-primary px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-2xl shadow-primary/20 hover:shadow-primary/40 transition-all hover:-translate-y-1 active:translate-y-0 flex items-center gap-3">
                    <span class="material-symbols-outlined">add</span>
                    List New Harvest
                </button>
            </div>
        </header>
        <!-- Bento Grid: Stats & AI -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Earnings Card -->
            <div
                class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="flex justify-between items-start z-10 relative">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-primary text-xl">account_balance_wallet</span>
                            <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">
                                Net Revenue Overview</h4>
                        </div>
                        <p class="text-5xl font-black tracking-tighter">₹{{ number_format($revenue, 2) }}</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-black flex items-center gap-2 border border-primary/20">
                            <span class="material-symbols-outlined text-base">trending_up</span>
                            +12.4%
                        </span>
                        <p class="text-[10px] text-on-surface-variant font-bold mt-2 uppercase tracking-tighter">vs last
                            30 days</p>
                    </div>
                </div>
                <!-- Modern Area Chart Visualization -->
                <div class="mt-12 h-48 relative w-full overflow-visible z-10">
                    <canvas id="revenueChart" class="w-full h-full"></canvas>
                </div>
            </div>
            <!-- AI Recommended Price Trends -->
            <div
                class="bg-secondary-container p-1 rounded-[2.5rem] border border-secondary/20 shadow-xl shadow-secondary/10 relative group overflow-hidden">
                <div
                    class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.3rem] h-full flex flex-col ai-card-pattern relative">
                    <div class="flex items-center justify-between mb-8">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-secondary to-on-secondary-container rounded-2xl flex items-center justify-center shadow-lg shadow-secondary/40 text-white relative">
                            <span class="material-symbols-outlined text-3xl"
                                style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-secondary"></span>
                            </span>
                        </div>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-secondary bg-secondary/10 px-3 py-1.5 rounded-full border border-secondary/20">AI
                            Insights</span>
                    </div>

                    <div class="space-y-4 mb-8 custom-scrollbar overflow-y-auto max-h-[300px] pr-2">
                        @forelse($trends as $trend)
                            <div
                                class="flex items-center justify-between p-4 rounded-2xl bg-white border border-stone-100 shadow-sm transition-transform hover:scale-[1.02]">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary">{{ $trend['status'] }}</span>
                                    <div>
                                        <p class="text-[10px] font-black text-stone-400 uppercase tracking-tighter">
                                            {{ $trend['name'] }}</p>
                                        <p class="text-lg font-black text-on-surface">₹{{ $trend['current'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-secondary uppercase tracking-tighter">AI Target
                                    </p>
                                    <p class="text-lg font-black text-secondary">₹{{ $trend['predicted'] }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 opacity-50">
                                <span class="material-symbols-outlined text-4xl mb-2">query_stats</span>
                                <p class="text-xs font-bold uppercase tracking-widest">No active listings to analyze</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('farmer.crops') }}"
                        class="mt-auto w-full py-5 bg-on-secondary-container text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-secondary/20 hover:shadow-secondary/40 transition-all hover:-translate-y-1 active:translate-y-0 group flex items-center justify-center">
                        Update All Listings
                        <span class="inline-block transition-transform group-hover:translate-x-1 ml-2">→</span>
                    </a>
                </div>
            </div>

            <!-- Profile Completeness Card -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="z-10 relative">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-primary text-xl">account_circle</span>
                        <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Profile Completeness</h4>
                    </div>
                    @php
                        $completeness = 0;
                        if ($user->name) $completeness += 20;
                        if ($user->email) $completeness += 20;
                        if ($user->phone) $completeness += 20;
                        if ($user->bio) $completeness += 20;
                        if (!empty($user->bank_accounts)) $completeness += 20;
                    @endphp
                    <p class="text-5xl font-black tracking-tighter">{{ $completeness }}%</p>
                    
                    <div class="w-full bg-surface-container-low rounded-full h-4 mt-6 overflow-hidden">
                        <div class="bg-primary h-full rounded-full transition-all duration-500" style="width: {{ $completeness }}%"></div>
                    </div>
                    
                    <p class="text-xs text-on-surface-variant mt-4 font-medium">
                        @if($completeness < 100)
                            Complete your profile to unlock all features.
                        @else
                            Your profile is fully complete!
                        @endif
                    </p>
                </div>
                @if($completeness < 100)
                    <a href="{{ route('farmer.settings') }}" class="mt-8 text-primary font-bold text-sm hover:underline flex items-center gap-1">
                        Finish Setup
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                @endif
            </div>

            <!-- Crop Demand Forecast Card -->
            <div class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-secondary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="z-10 relative w-full">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-secondary text-xl">trending_up</span>
                        <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Upcoming Season Demand Forecast</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-surface-container-low p-6 rounded-2xl border border-stone-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Wheat</span>
                                <span class="text-secondary font-black text-sm">+25%</span>
                            </div>
                            <div class="text-xs text-outline">High Demand expected in Punjab region.</div>
                        </div>
                        <div class="bg-surface-container-low p-6 rounded-2xl border border-stone-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Basmati Rice</span>
                                <span class="text-secondary font-black text-sm">+18%</span>
                            </div>
                            <div class="text-xs text-outline">Export demand is rising.</div>
                        </div>
                        <div class="bg-surface-container-low p-6 rounded-2xl border border-stone-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Mustard</span>
                                <span class="text-amber-600 font-black text-sm">+10%</span>
                            </div>
                            <div class="text-xs text-outline">Steady demand for oil extraction.</div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-between items-center text-xs text-outline">
                    <span>Powered by FarmBot AI</span>
                    <span>Updated weekly</span>
                </div>
            </div>
        </div>
        </div>
        <!-- Section: Indian Farmer Utilities -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <!-- Mandi Prices Widget -->
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">store</span>
                            <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Mandi Prices</h4>
                        </div>
                        <button onclick="refreshDashboardStats()" class="p-1.5 bg-primary/5 text-primary rounded-lg hover:bg-primary/10 transition-all group" title="Sync Prices">
                            <span class="material-symbols-outlined text-sm group-active:rotate-180 transition-transform duration-500">sync</span>
                        </button>
                    </div>
                    <div id="mandi-update-status" class="text-[9px] text-stone-400 font-bold uppercase tracking-tighter mb-2 hidden">Updating...</div>
                    <div class="space-y-3 mb-4 mt-2" id="mandi-price-list">
                        @forelse($mandiPrices as $price)
                            @if(is_array($price) || is_object($price))
                                @php
                                    $name = is_array($price) ? ($price['crop_name'] ?? 'Unknown') : ($price->crop_name ?? 'Unknown');
                                    $val = is_array($price) ? ($price['price_per_q'] ?? 0) : ($price->price_per_q ?? 0);
                                @endphp
                                <div class="flex justify-between items-center text-sm border-b border-stone-100 pb-2">
                                    <span class="font-bold text-on-surface">{{ $name }}</span>
                                    <span class="text-primary font-black">₹{{ number_format($val) }}</span>
                                </div>
                            @endif
                        @empty
                            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest text-center py-4">Fetching live prices...</p>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('farmer.mandi') }}" class="mt-4 w-full py-3 bg-surface-container-low text-primary rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-primary hover:text-white transition-all text-center block">View All Mandi Prices →</a>
            </div>

            <!-- Weather Advice -->
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary text-xl">psychology</span>
                        <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Agri Advice</h4>
                    </div>
                    <div class="text-sm text-on-surface-variant">
                        <p class="font-bold text-primary mb-2">Real-Time Insights</p>
                        <p>{{ $aiInsights }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    @if(str_contains(strtolower($weather['condition'] ?? ''), 'rain'))
                        <button onclick="askSampleQuestion('Rain is detected. What precautions should I take for my crops?')" class="w-full py-3 bg-amber-500 text-white rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-amber-600 transition-all text-center block">Ask FarmBot →</button>
                    @else
                        <button onclick="askSampleQuestion('Weather is clear. What are the best practices for my crops now?')" class="w-full py-3 bg-primary text-white rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-primary/90 transition-all text-center block">Ask FarmBot →</button>
                    @endif
                </div>
                <div class="mt-4 text-xs text-outline flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">info</span>
                    Based on current weather
                </div>
            </div>

            <!-- Logistics Tracker -->
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                        <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Logistics</h4>
                    </div>
                    <div class="text-sm space-y-3" id="logistics-list">
                        @foreach($logistics as $item)
                            <div class="flex flex-col border-b pb-2 mb-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-amber-500">{{ $item->status == 'Delivered' ? 'check_circle' : 'pending' }}</span>
                                        <div>
                                            <p class="font-bold">Order #{{ $item->tracking_number }}</p>
                                            <p class="text-xs text-outline">Status: {{ $item->status }}</p>
                                        </div>
                                    </div>
                                    @if($item->status != 'Delivered')
                                        <form action="{{ route('logistics.next-stage', $item->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @if($item->status === 'Out for Delivery')
                                                <button type="submit" class="text-xs text-white bg-primary px-2 py-1 rounded-lg font-bold hover:bg-primary/90 transition-colors">Deliver</button>
                                            @else
                                                <button type="submit" class="text-xs text-primary font-bold hover:underline">Next Stage</button>
                                            @endif
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('farmer.logistics') }}" class="mt-4 w-full py-3 bg-surface-container-low text-primary rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-primary hover:text-white transition-all text-center block">Track All Shipments →</a>
            </div>

            <!-- Financial Services -->
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary text-xl">account_balance</span>
                        <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Kisan Credit</h4>
                    </div>
                    <div class="text-sm">
                        <p class="font-bold text-on-surface mb-1">Available Limit</p>
                        <p class="text-2xl font-black text-primary mb-2">₹50,000</p>
                        <p class="text-xs text-outline">Interest rate: 4% p.a. (Govt. subsidized)</p>
                    </div>
                </div>
                <button onclick="showComingSoon('Kisan Credit Services')" class="mt-4 w-full py-3 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-xl font-bold text-xs uppercase tracking-wider hover:opacity-90 transition-all">Apply for Loan</button>
            </div>
        </div>

        <!-- Section: Active Orders -->
        <section class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Active Orders</h2>
                    <p class="text-on-surface-variant text-sm mt-1">New orders from buyers awaiting your acceptance</p>
                </div>
                <a class="group flex items-center gap-2 bg-surface-container-low px-4 py-2 rounded-full text-primary font-bold text-sm hover:bg-primary hover:text-white transition-all"
                    href="{{ route('farmer.orders') }}">
                    View All Orders
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                @forelse($activeOrders as $order)
                    <div class="stagger-card group relative bg-gradient-to-br from-primary/5 to-white p-1 rounded-2xl shadow-[0_20px_50px_rgba(13,99,27,0.1)] border border-primary/10 transition-all hover:-translate-y-2">
                        <div class="bg-white/60 backdrop-blur-md rounded-2xl p-6 h-full">
                            <div class="flex justify-between items-start mb-6">
                                <div class="bg-primary-fixed text-on-primary-fixed-variant p-3 rounded-2xl">
                                    <span class="material-symbols-outlined block text-2xl pulse-soft">local_shipping</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-on-surface-variant/60 block">Order ID</span>
                                    <span class="font-bold text-primary">#{{ substr($order->id, -6) }}</span>
                                </div>
                            </div>
                            <div class="mb-8">
                                <h4 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Buyer</h4>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed text-sm font-bold shadow-inner">
                                        {{ strtoupper(substr($order->buyer->name ?? 'B', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-surface">{{ $order->buyer->name ?? 'Buyer' }}</p>
                                        <p class="text-[11px] text-on-surface-variant flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">verified</span> Trusted Partner
                                        </p>
                                    </div>
                                </div>
                            </div>
                                @php
                                    $items = $order->items ?? [];
                                    $iCount = count($items);
                                    $itemLabel = $iCount > 1 ? $iCount . ' Items' : ($items[0]['name'] ?? 'Harvest Item');
                                    $qtyLabel  = $iCount > 1 ? collect($items)->sum('quantity') . ' Units' : (($items[0]['quantity'] ?? '') . ($items[0]['unit'] ?? 'kg'));
                                @endphp
                                <div class="bg-surface-container-low/40 rounded-xl p-4 mb-6">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm font-medium">{{ $itemLabel }}</span>
                                        <span class="text-xs font-bold">{{ $qtyLabel }}</span>
                                    </div>
                                    <div class="text-2xl font-black text-on-surface">₹{{ number_format($order->total_price, 0) }}</div>
                                </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-tighter text-primary">
                                    <span>Status</span>
                                    <span>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                                </div>
                                <div class="h-1.5 w-full bg-stone-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full relative" style="width: 25%"></div>
                                </div>
                                <div class="flex gap-2 mt-4">
                                    @if($order->status === 'pending')
                                        <form action="{{ route('orders.accept', $order->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm font-bold hover:bg-green-800 transition-colors">Accept</button>
                                        </form>
                                        <form action="{{ route('orders.reject', $order->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-surface-container-low text-on-surface-variant py-2 rounded-lg text-sm font-bold hover:bg-red-100 hover:text-red-600 transition-colors">Decline</button>
                                        </form>
                                    @else
                                        @php
                                            $statusLabel = [
                                                'accepted' => 'Accepted',
                                                'processing' => 'Processing',
                                                'dispatched' => 'Dispatched',
                                                'in_transit' => 'In Transit',
                                                'completed' => 'Completed'
                                            ][$order->status] ?? ucfirst($order->status);
                                            
                                            $statusColor = $order->status === 'completed' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-blue-50 text-blue-700 border-blue-200';
                                        @endphp
                                        <div class="flex-1 text-center py-2 {{ $statusColor }} rounded-lg text-sm font-bold border">
                                            {{ $statusLabel }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-3 py-12 text-center bg-stone-50 rounded-3xl border-2 border-dashed border-stone-200">
                        <span class="material-symbols-outlined text-stone-400 text-4xl mb-2">inbox</span>
                        <p class="text-stone-500 font-bold">No active orders found.</p>
                    </div>
                @endforelse
            </div>
        </section>
        <!-- Section: Active Crop Listings -->
        <section class="mt-20">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black tracking-tight flex items-center gap-2">
                        Active Crop Listings
                        <span class="bg-primary/10 text-primary text-xs px-2 py-1 rounded-md font-bold">LIVE</span>
                    </h2>
                    <p class="text-on-surface-variant text-sm mt-1">Manage your harvest inventory with real-time AI
                        pricing</p>
                </div>
                <a href="{{ route('farmer.crops') }}"
                    class="text-sm font-black text-primary hover:underline px-4 py-2 bg-primary/5 rounded-xl transition-all">View
                    Detailed Inventory →</a>
                <div class="flex items-center gap-3">
                    <form action="{{ route('farmer.dashboard') }}" method="GET" class="flex items-center gap-2">
                        <select name="category" onchange="this.form.submit()"
                            class="text-[10px] font-black uppercase tracking-widest bg-white border border-outline-variant/20 rounded-xl px-4 py-2.5 focus:ring-primary/20 cursor-pointer">
                            <option value="All">All Categories</option>
                            <option value="Grain" {{ request('category') == 'Grain' ? 'selected' : '' }}>Grains</option>
                            <option value="Vegetable" {{ request('category') == 'Vegetable' ? 'selected' : '' }}>
                                Vegetables</option>
                            <option value="Fruit" {{ request('category') == 'Fruit' ? 'selected' : '' }}>Fruits</option>
                            <option value="Spice" {{ request('category') == 'Spice' ? 'selected' : '' }}>Spices</option>
                        </select>
                    </form>
                    <div class="flex border border-outline-variant/20 rounded-xl overflow-hidden bg-white shadow-sm">
                        <button class="p-2.5 bg-surface-container-high text-primary"><span
                                class="material-symbols-outlined text-xl">grid_view</span></button>
                        <button class="p-2.5 hover:bg-surface-container-low transition-colors"><span
                                class="material-symbols-outlined text-xl">view_list</span></button>
                    </div>
                    <button onclick="openCropModal()"
                        class="bg-primary text-white pl-4 pr-6 py-3 rounded-xl font-bold flex items-center gap-2 shadow-lg shadow-primary/20 hover:shadow-primary/40 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        <span class="material-symbols-outlined">add</span>
                        New Crop
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($crops as $crop)
                    <div
                        class="group relative flex flex-col glass-card rounded-[2rem] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 border-0">
                        <div class="relative h-56 overflow-hidden">
                            @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110'])
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent">
                            </div>
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($crop->is_organic)
                                    <span
                                        class="bg-primary/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Organic</span>
                                @endif
                                <span
                                    class="bg-white/90 backdrop-blur-md text-on-surface text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px] text-primary">check_circle</span>
                                    Verified
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                                <div>
                                    <h3 class="text-white text-2xl font-black tracking-tight">{{ $crop->name }}</h3>
                                    <p class="text-white/80 text-xs font-medium">Harvested:
                                        {{ \Carbon\Carbon::parse($crop->harvest_date)->format('M d, Y') }}</p>
                                </div>
                                <div
                                    class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl p-2 text-center text-white min-w-[60px]">
                                    <span class="block text-[10px] uppercase font-bold opacity-70">Stock</span>
                                    <span class="text-sm font-black">{{ $crop->quantity }}{{ $crop->unit }}</span>
                                </div>
                            </div>
                            @if($crop->quality_image_url)
                                <div
                                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                    <a href="{{ $crop->quality_image_url }}" target="_blank"
                                        class="px-6 py-3 bg-white text-on-surface rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        Check Quality Photo
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Current
                                        Listing</span>
                                    <div class="text-2xl font-black text-primary">₹{{ $crop->price_per_unit }}<span
                                            class="text-sm font-medium text-on-surface-variant">/{{ $crop->unit }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto grid grid-cols-2 gap-3">
                                <button
                                    onclick="openManageModal('{{ $crop->id }}','{{ addslashes($crop->name) }}','{{ $crop->category }}','{{ $crop->quantity }}','{{ $crop->unit }}','{{ $crop->price_per_unit }}','{{ $crop->harvest_date }}','{{ $crop->is_organic ? 1 : 0 }}')"
                                    class="py-3 px-4 bg-on-surface text-surface rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-stone-800 transition-colors">Manage</button>
                                <form action="{{ route('crops.destroy', $crop->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this listing?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full py-3 px-4 border-2 border-red-200 text-red-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-red-50 transition-colors">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State / Add New -->
                    <div onclick="openCropModal()"
                        class="group relative flex flex-col items-center justify-center p-8 rounded-[2rem] border-4 border-dashed border-outline-variant/20 hover:border-primary/40 hover:bg-primary/5 transition-all cursor-pointer min-h-[450px]">
                        <div
                            class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                            <span class="material-symbols-outlined text-4xl text-primary"
                                style="font-variation-settings: 'wght' 600;">add_circle</span>
                        </div>
                        <h3 class="text-xl font-black text-on-surface mb-2">New Crop Listing</h3>
                        <p class="text-sm text-on-surface-variant text-center max-w-[200px] mb-8">Ready to sell? List your
                            harvest to reach thousands of buyers instantly.</p>
                        <button
                            class="px-8 py-3 bg-primary text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-xl shadow-primary/20 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">Start
                            Listing</button>
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- List New Harvest Modal -->
    <!-- Manage Crop Modal -->
    <div id="manageModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-modal="true" role="dialog">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeManageModal()"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-lg p-8">
                <button onclick="closeManageModal()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-surface-container-highest transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary text-3xl">edit</span>
                    <h2 class="text-2xl font-headline font-black">Manage Listing</h2>
                </div>
                <form id="manage-form" action="" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Crop Name</label>
                            <input type="text" name="name" id="manage-name" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30" required/>
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Category</label>
                            <select name="category" id="manage-category" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30">
                                <option value="Grain">Grain</option>
                                <option value="Vegetable">Vegetable</option>
                                <option value="Fruit">Fruit</option>
                                <option value="Spice">Spice</option>
                                <option value="Oilseed">Oilseed</option>
                                <option value="Cash Crop">Cash Crop</option>
                                <option value="Pulse">Pulse</option>
                                <option value="Uncategorized">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Price per Unit (₹)</label>
                            <input type="number" step="0.01" name="price_per_unit" id="manage-price" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30" required/>
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Quantity</label>
                            <input type="number" name="quantity" id="manage-quantity" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30" required/>
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Unit</label>
                            <select name="unit" id="manage-unit" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30">
                                <option value="kg">kg</option>
                                <option value="quintal">quintal</option>
                                <option value="ton">ton</option>
                                <option value="dozen">dozen</option>
                                <option value="litre">litre</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Harvest Date</label>
                            <input type="date" name="harvest_date" id="manage-harvest" class="w-full mt-1 p-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/30" required/>
                        </div>
                        <div class="col-span-2 flex items-center gap-3">
                            <input type="checkbox" name="is_organic" id="manage-organic" value="1" class="w-4 h-4 text-primary rounded focus:ring-primary"/>
                            <label for="manage-organic" class="text-sm font-bold">Certified Organic</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all mt-4">
                        Update Listing
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- List New Harvest Modal -->
    <div id="cropModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="closeCropModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-stone-100">
                <div class="bg-white px-8 pt-10 pb-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-3xl font-black tracking-tight text-on-surface" id="modal-title">List New
                                Harvest</h3>
                            <p class="text-on-surface-variant text-sm mt-1">Share your harvest with thousands of buyers.
                            </p>
                        </div>
                        <button onclick="closeCropModal()" class="p-2 hover:bg-stone-100 rounded-full transition-all">
                            <span class="material-symbols-outlined text-stone-500">close</span>
                        </button>
                    </div>

                    <form action="{{ route('crops.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Crop
                                    Name</label>
                                <input type="text" name="name" required placeholder="e.g. Basmati Rice"
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface placeholder:text-stone-400">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Quantity</label>
                                <input type="number" name="quantity" required placeholder="500"
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface placeholder:text-stone-400">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Unit</label>
                                <select name="unit"
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface">
                                    <option value="kg">kg</option>
                                    <option value="quintal">quintal</option>
                                    <option value="ton">ton</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Price
                                    per Unit (₹)</label>
                                <input type="number" name="price_per_unit" required placeholder="80"
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface placeholder:text-stone-400">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Category</label>
                                <select name="category"
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface">
                                    <option value="Grain">Grain</option>
                                    <option value="Vegetable">Vegetable</option>
                                    <option value="Fruit">Fruit</option>
                                    <option value="Spice">Spice</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Harvest
                                    Date</label>
                                <input type="date" name="harvest_date" required
                                    class="w-full px-5 py-4 bg-stone-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-semibold text-on-surface">
                            </div>
                            <div class="col-span-2">
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-on-surface-variant mb-2 ml-1">Upload
                                    Real Photo (Optional)</label>
                                <div class="relative group">
                                    <input type="file" name="image" id="farmer_crop_image" class="hidden"
                                        onchange="updateFarmerFileName(this)">
                                    <label for="farmer_crop_image"
                                        class="w-full bg-stone-50 border-2 border-dashed border-stone-200 rounded-2xl px-6 py-6 flex flex-col items-center justify-center cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                        <span
                                            class="material-symbols-outlined text-3xl text-stone-400 group-hover:text-primary mb-2">add_a_photo</span>
                                        <span id="farmer_file_name" class="text-sm font-bold text-stone-500">Select
                                            specific harvest photo</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 py-2">
                            <input type="checkbox" name="is_organic" id="is_organic"
                                class="w-5 h-5 rounded border-stone-300 text-primary focus:ring-primary">
                            <label for="is_organic" class="text-sm font-bold text-on-surface-variant">This is 100%
                                Organic Produce</label>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-5 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:shadow-primary/40 transition-all hover:-translate-y-1 active:translate-y-0">
                                Publish Listing
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.aimodal')

    <script>
        function openCropModal() {
            document.getElementById('cropModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeCropModal() {
            document.getElementById('cropModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        function openManageModal(id, name, category, qty, unit, price, harvest, organic) {
            document.getElementById('manage-form').action = `/crops/${id}`;
            document.getElementById('manage-name').value    = name;
            document.getElementById('manage-price').value   = price;
            document.getElementById('manage-quantity').value = qty;
            document.getElementById('manage-harvest').value = harvest ? harvest.substring(0, 10) : '';
            document.getElementById('manage-organic').checked = (organic == '1');
            // Set category select
            const catSel = document.getElementById('manage-category');
            for (let o of catSel.options) { o.selected = (o.value === category); }
            // Set unit select
            const unitSel = document.getElementById('manage-unit');
            for (let o of unitSel.options) { o.selected = (o.value === unit); }
            document.getElementById('manageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeManageModal() {
            document.getElementById('manageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function updateFarmerFileName(input) {
            const fileName = input.files[0]?.name || 'Select specific harvest photo';
            document.getElementById('farmer_file_name').textContent = fileName;
        }
    </script>
    <!-- Footer -->
    <footer class="lg:ml-64 bg-gradient-to-br from-green-950 to-zinc-950 w-full pt-24 pb-12 px-6 lg:px-12 mt-24 border-t border-white/10 relative overflow-hidden text-white">
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
    <!-- Floating AI Chat Widget -->
    @include('partials.farmbot')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                icon.textContent = 'dark_mode';
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                icon.textContent = 'light_mode';
            }
        }

        function showComingSoon(feature) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-24 left-1/2 -translate-x-1/2 z-[100] bg-zinc-900 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-white/10 animate-bounce';
            toast.innerHTML = `
                <span class="material-symbols-outlined text-primary">rocket_launch</span>
                <div class="flex flex-col">
                    <span class="font-bold text-sm">Coming Soon!</span>
                    <span class="text-xs text-white/60">${feature} is being optimized for your region.</span>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.transition = 'all 0.5s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, -20px)';
                setTimeout(() => toast.remove(), 500);
            }, 5000);
        }

        // Initialize theme
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            const themeIcon = document.getElementById('theme-icon');
            if (themeIcon) themeIcon.textContent = 'light_mode';
        } else {
            document.documentElement.classList.remove('dark');
            const themeIcon = document.getElementById('theme-icon');
            if (themeIcon) themeIcon.textContent = 'dark_mode';
        }
        // Initialize Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenueData),
                    borderColor: '#0d631b',
                    backgroundColor: 'rgba(13, 99, 27, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0d631b',
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#0d631b',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1a1c1b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#0d631b',
                        borderWidth: 1,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#a8a29e',
                            font: {
                                size: 11,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        display: false,
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Real-time Dashboard Sync
        function refreshDashboardStats() {
            const statusEl = document.getElementById('mandi-update-status');
            if (statusEl) statusEl.classList.remove('hidden');

            fetch('/api/dashboard/farmer/stats')
                .then(response => response.json())
                .then(data => {
                    if (statusEl) statusEl.classList.add('hidden');
                    // Update Revenue (Procurement)
                    const revenueEl = document.querySelector('.text-5xl.font-black.tracking-tighter');
                    if (revenueEl) revenueEl.innerText = '₹' + data.revenue;
                    
                    // Update Active Orders Count
                    const activeOrdersCountEl = document.getElementById('active-orders-count');
                    if (activeOrdersCountEl) activeOrdersCountEl.innerText = data.activeOrdersCount;
                    
                    // Update Mandi Prices
                    const mandiList = document.getElementById('mandi-price-list');
                    if (mandiList && data.mandiPrices) {
                        let html = '';
                        data.mandiPrices.forEach(price => {
                            if (price && typeof price === 'object') {
                                html += `
                                    <div class="flex justify-between items-center text-sm border-b border-stone-100 pb-2">
                                        <span class="font-bold text-on-surface">${price.crop_name || 'Unknown'}</span>
                                        <span class="text-primary font-black">₹${(price.price_per_q || 0).toLocaleString()}</span>
                                    </div>`;
                            }
                        });
                        if (html) mandiList.innerHTML = html;
                    }
                })
                .catch(err => console.error('Stats fetch error:', err));
        }
    </script>
    
    @include('partials.live_notifications')
</body>

</html>