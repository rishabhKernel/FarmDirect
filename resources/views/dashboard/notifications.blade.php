<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Notifications - FarmDirect</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="/js/tailwind.min.js"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "inverse-surface": "#2f312f",
                    "tertiary-fixed": "#ffd9e2",
                    "secondary-container": "#fed7ca",
                    "tertiary-container": "#b14b6f",
                    "on-tertiary-fixed": "#3f001c",
                    "on-surface-variant": "#40493d",
                    "on-error": "#ffffff",
                    "error": "#ba1a1a",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-highest": "#e2e3e0",
                    "on-secondary-container": "#795c51",
                    "on-primary-fixed": "#002204",
                    "on-primary-fixed-variant": "#005312",
                    "primary-fixed": "#a3f69c",
                    "error-container": "#ffdad6",
                    "tertiary": "#923357",
                    "primary-container": "#2e7d32",
                    "primary-fixed-dim": "#88d982",
                    "outline-variant": "#bfcaba",
                    "surface-container-high": "#e8e8e5",
                    "primary": "#0d631b",
                    "on-surface": "#1a1c1b",
                    "inverse-primary": "#88d982",
                    "surface-container-low": "#f4f4f1",
                    "surface-variant": "#e2e3e0",
                    "surface-dim": "#dadad7",
                    "outline": "#707a6c",
                    "on-primary-container": "#cbffc2",
                    "secondary": "#75584d",
                    "on-tertiary-fixed-variant": "#7f2448",
                    "on-secondary-fixed-variant": "#5b4137",
                    "surface-bright": "#f9f9f6",
                    "inverse-on-surface": "#f1f1ee",
                    "background": "#f9f9f6",
                    "on-primary": "#ffffff",
                    "surface-container": "#eeeeeb",
                    "secondary-fixed-dim": "#e4beb2",
                    "on-secondary": "#ffffff",
                    "surface": "#f9f9f6",
                    "on-tertiary-container": "#ffedf0",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed": "#2b160f",
                    "tertiary-fixed-dim": "#ffb1c7",
                    "surface-tint": "#1b6d24",
                    "on-error-container": "#93000a",
                    "on-background": "#1a1c1b",
                    "secondary-fixed": "#ffdbce"
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #f9f9f6; }
    </style>
</head>
<body class="font-body text-on-surface">
    <!-- Top Navigation Bar (Like Farmer Dashboard) -->
    <nav class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm bg-white/80">
        <div class="flex items-center gap-4">
            <!-- Search bar from dashboard -->
            <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <form action="{{ route('farmer.dashboard') }}" method="GET">
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-48" name="search" value="{{ request('search') }}" placeholder="Search your crops..." type="text" />
                </form>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('farmer.notifications') }}" class="p-2 bg-white/40 rounded-full transition-all active:scale-90 relative text-green-800">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
                </a>
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
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Side Navigation Bar (Dark theme, w-64 like project standard) -->
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
                @if(Auth::user()->role == 'buyer')
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="{{ route('buyer.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label text-sm">Dashboard</span>
                </a>
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="{{ route('buyer.dashboard') }}">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    <span class="font-label text-sm">Active Orders</span>
                </a>
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="#">
                    <span class="material-symbols-outlined">bookmark</span>
                    <span class="font-label text-sm">Saved Listings</span>
                </a>
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="#">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="font-label text-sm">Logistics</span>
                </a>
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="#">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="font-label text-sm">Account Center</span>
                </a>
                @else
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
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

                @endif
            </nav>
            <div class="px-4 mt-auto space-y-1 border-t border-white/5 pt-6">
                <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all"
                    href="{{ Auth::user()->role == 'buyer' ? '#' : route('farmer.settings') }}">
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

        <!-- Main Content Area -->
        <main class="flex-grow min-h-screen bg-surface-container-low p-6 md:p-12 ml-0 lg:ml-64 mt-20">
            <div class="max-w-5xl mx-auto">
                <!-- Header Section -->
                <header class="mb-12">
                    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Notifications</h1>
                    <p class="text-on-surface-variant font-medium max-w-2xl">Manage your system alerts, market movements, and delivery updates in one central hub. AI-driven insights are marked for your attention.</p>
                </header>
                <!-- Filter Tabs -->
                <div class="flex space-x-4 mb-8 overflow-x-auto pb-2">
                    <button class="px-6 py-2 bg-primary text-on-primary rounded-full font-label text-sm font-semibold shadow-lg shadow-primary/20">All Alerts</button>
                    <button class="px-6 py-2 bg-surface-container-lowest text-on-surface-variant rounded-full font-label text-sm font-semibold hover:bg-surface-container-high transition-colors">Orders</button>
                    <button class="px-6 py-2 bg-surface-container-lowest text-on-surface-variant rounded-full font-label text-sm font-semibold hover:bg-surface-container-high transition-colors">Price Alerts</button>
                    <button class="px-6 py-2 bg-surface-container-lowest text-on-surface-variant rounded-full font-label text-sm font-semibold hover:bg-surface-container-high transition-colors">System</button>
                </div>
                <!-- Notifications Bento Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    @foreach($notifications as $notification)
                        @if($notification->type === 'price_alert')
                            <!-- AI Price Alert - Featured Bento Card -->
                            <div class="md:col-span-8 bg-surface-container-lowest p-8 rounded-xl relative overflow-hidden group shadow-sm" id="notif-{{ $notification->id }}">
                                <div class="absolute top-0 right-0 p-4 flex gap-2 items-center">
                                    @if(!$notification->is_read)
                                        <button id="btn-read-{{ $notification->id }}" onclick="markRead('{{ $notification->id }}')" class="text-xs text-primary hover:underline">Mark Read</button>
                                    @endif
                                    <button onclick="deleteNotif('{{ $notification->id }}')" class="text-xs text-red-500 hover:underline">Delete</button>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-container text-on-primary-container text-[10px] font-black uppercase tracking-wider">AI Insight</span>
                                </div>
                                <div class="flex items-start space-x-6">
                                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <h3 class="text-xl font-bold text-on-surface">{{ $notification->title }}</h3>
                                            @if(!$notification->is_read)
                                                <div class="w-2 h-2 rounded-full bg-primary animate-pulse" id="dot-{{ $notification->id }}"></div>
                                            @endif
                                        </div>
                                        <p class="text-on-surface-variant mb-4 leading-relaxed">{{ $notification->message }}</p>
                                        <div class="flex items-center space-x-6">
                                            <a href="{{ $notification->data['url'] ?? '#' }}" class="flex items-center space-x-2 text-primary font-bold text-sm hover:underline">
                                                <span>View Analysis</span>
                                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                            </a>
                                            <span class="text-xs font-label text-outline uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors"></div>
                            </div>
                        @elseif($notification->type === 'stat')
                            <!-- Small Stat/Quick Action Card -->
                            <div class="md:col-span-4 bg-secondary-container p-6 rounded-xl shadow-sm flex flex-col justify-between relative" id="notif-{{ $notification->id }}">
                                <div class="absolute top-2 right-2 flex gap-1">
                                    @if(!$notification->is_read)
                                        <button onclick="markRead('{{ $notification->id }}')" class="text-xs text-on-secondary-container/60 hover:text-on-secondary-container" id="btn-read-{{ $notification->id }}">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                    @endif
                                    <button onclick="deleteNotif('{{ $notification->id }}')" class="text-xs text-on-secondary-container/60 hover:text-on-secondary-container">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                                <div>
                                    <span class="material-symbols-outlined text-on-secondary-container mb-4">verified</span>
                                    <h4 class="text-lg font-bold text-on-secondary-container leading-tight mb-2">{{ $notification->title }}</h4>
                                    <p class="text-on-secondary-container/80 text-sm">{{ $notification->message }}</p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="text-xs text-on-secondary-container font-bold hover:underline">View Details</a>
                                    <span class="text-xs font-label text-on-secondary-container/60 uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @elseif($notification->type === 'order')
                            <!-- Order Update Card -->
                            <div class="md:col-span-6 bg-surface-container-lowest p-6 rounded-xl shadow-sm border-l-4 border-tertiary relative" id="notif-{{ $notification->id }}">
                                <div class="absolute top-2 right-2 flex gap-1">
                                    @if(!$notification->is_read)
                                        <button onclick="markRead('{{ $notification->id }}')" class="text-xs text-outline hover:text-primary" id="btn-read-{{ $notification->id }}">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                    @endif
                                    <button onclick="deleteNotif('{{ $notification->id }}')" class="text-xs text-outline hover:text-red-500">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-tertiary-fixed flex items-center justify-center text-tertiary">
                                        <span class="material-symbols-outlined">local_shipping</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-bold text-on-surface">{{ $notification->title }}</h3>
                                        <p class="text-sm text-on-surface-variant mb-4">{{ $notification->message }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="px-3 py-1 bg-surface-container text-on-surface-variant text-[10px] font-bold rounded-lg uppercase tracking-wider">In Transit</span>
                                            <a href="{{ $notification->data['url'] ?? '#' }}" class="text-xs text-tertiary font-bold hover:underline">Track Order</a>
                                            <span class="text-xs font-label text-outline uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($notification->type === 'system')
                            <!-- System Alert Card -->
                            <div class="md:col-span-6 bg-surface-container-lowest p-6 rounded-xl shadow-sm relative" id="notif-{{ $notification->id }}">
                                <div class="absolute top-2 right-2 flex gap-1">
                                    @if(!$notification->is_read)
                                        <button onclick="markRead('{{ $notification->id }}')" class="text-xs text-outline hover:text-primary" id="btn-read-{{ $notification->id }}">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                    @endif
                                    <button onclick="deleteNotif('{{ $notification->id }}')" class="text-xs text-outline hover:text-red-500">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                                        <span class="material-symbols-outlined">account_balance_wallet</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-bold text-on-surface">{{ $notification->title }}</h3>
                                        <p class="text-sm text-on-surface-variant mb-4">{{ $notification->message }}</p>
                                        <div class="flex items-center justify-between">
                                            <a href="{{ $notification->data['url'] ?? '#' }}" class="text-xs font-bold text-primary hover:underline">View Account</a>
                                            <span class="text-xs font-label text-outline uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($notification->type === 'bid')
                            <!-- Bid Alert Card -->
                            <div class="md:col-span-12 bg-surface-container-lowest p-6 rounded-xl shadow-sm flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 relative" id="notif-{{ $notification->id }}">
                                <div class="absolute top-2 right-2 flex gap-1">
                                    @if(!$notification->is_read)
                                        <button onclick="markRead('{{ $notification->id }}')" class="text-xs text-outline hover:text-primary" id="btn-read-{{ $notification->id }}">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                    @endif
                                    <button onclick="deleteNotif('{{ $notification->id }}')" class="text-xs text-outline hover:text-red-500">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                                <div class="flex items-center space-x-6">
                                    <div class="w-16 h-16 rounded-xl bg-secondary-fixed flex items-center justify-center text-secondary">
                                        <span class="material-symbols-outlined text-3xl">gavel</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-on-surface text-lg">{{ $notification->title }}</h3>
                                        <p class="text-on-surface-variant text-sm">{{ $notification->message }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-xs font-label text-outline uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="px-6 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Review Bid</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Load More Section -->
                <div class="mt-12 flex justify-center">
                    <button class="px-8 py-3 bg-surface-container-highest text-on-surface font-label text-sm font-bold rounded-xl hover:bg-surface-container-high transition-all flex items-center space-x-2">
                        <span>Show Older Alerts</span>
                        <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer (Premium like Farmer Dashboard) -->
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
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Saakshi Jha</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Rishabh Chaurasia</span>
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
        function markRead(id) {
            fetch(`/dashboard/farmer/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const dot = document.getElementById(`dot-${id}`);
                    if (dot) dot.remove();
                    const btn = document.getElementById(`btn-read-${id}`);
                    if (btn) btn.remove();
                }
            });
        }

        function deleteNotif(id) {
            fetch(`/dashboard/farmer/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const card = document.getElementById(`notif-${id}`);
                    if (card) card.remove();
                }
            });
        }
    </script>
    @include('partials.live_notifications')
    @include('partials.aimodal')
    @include('partials.farmbot')
</body>
</html>
