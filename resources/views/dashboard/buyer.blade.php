<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect | Premium Buyer Marketplace</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2E7D32", // AgriCore Modern Green
                        "secondary": "#8D6E63", // AgriCore Modern Brown
                        "background": "#FDFDFB",
                        "surface": "#FFFFFF",
                        "surface-container": "#F4F5F2",
                        "on-surface": "#1A1C19",
                        "on-surface-variant": "#43493E",
                        "outline": "#73796E",
                        "outline-variant": "#C3C8BC",
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "2xl": "1.5rem",
                        "3xl": "2rem",
                        "full": "9999px"
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Manrope", "sans-serif"],
                        "label": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    boxShadow: {
                        "premium": "0 20px 40px -12px rgba(0, 0, 0, 0.05)",
                        "soft": "0 8px 30px rgba(0, 0, 0, 0.03)"
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .fill-icon {
            font-variation-settings: 'FILL' 1;
        }
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E0E0E0;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface overflow-x-hidden">
@if(session('success'))
<div id="success-toast" class="fixed top-24 right-8 z-[100] bg-primary text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
    <span class="material-symbols-outlined">check_circle</span>
    <span class="font-bold">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
        <span class="material-symbols-outlined text-sm">close</span>
    </button>
</div>
@endif
@if(session('error'))
<div id="error-toast" class="fixed top-24 right-8 z-[100] bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-pulse">
    <span class="material-symbols-outlined">error</span>
    <span class="font-bold">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
        <span class="material-symbols-outlined text-sm">close</span>
    </button>
</div>
@endif
<!-- Refined Header Navigation -->
<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl border-b border-outline-variant/30 h-20">
<div class="max-w-[1600px] mx-auto h-full flex justify-between items-center px-8">
<div class="flex items-center gap-12">
<a href="/" class="flex items-center gap-3">
    <span class="material-symbols-outlined text-primary text-5xl" style="font-variation-settings: 'FILL' 1;">eco</span>
    <span class="text-4xl font-black tracking-tighter text-on-surface">Farm<span class="text-primary">Direct</span></span>
</a>
</div>
<div class="flex items-center gap-6">
<div class="relative hidden md:block">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
<form action="{{ route('buyer.dashboard') }}" method="GET">
<input class="pl-11 pr-6 py-2.5 bg-surface-container rounded-full text-sm w-72 border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-on-surface-variant/60" name="search" value="{{ request('search') }}" placeholder="Search premium harvests..." type="text"/>
</form>
</div>
<div class="relative group flex items-center gap-3 pr-2 border-r border-outline-variant/30">
                <a href="{{ route('buyer.notifications') }}" class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant relative cursor-pointer">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white notification-badge"></span>
                </a>
                <div class="absolute right-0 top-12 w-80 bg-white rounded-3xl shadow-premium border border-outline-variant/30 p-5 hidden group-hover:block z-50">
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest mb-3 border-b pb-2">Latest Notifications</p>
                    <div id="hover-notifications-list" class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                        <p class="text-xs text-on-surface-variant italic text-center py-2">Syncing...</p>
                    </div>
                    <a href="{{ route('buyer.notifications') }}" class="block text-center text-xs text-primary font-bold mt-4 hover:underline">View All</a>
                </div>
</div>
<div class="flex items-center gap-3 pl-2">
<div class="text-right hidden sm:block">
<p class="text-xs font-bold text-primary uppercase tracking-widest leading-none mb-1">Role: Buyer</p>
<p class="text-sm font-semibold text-on-surface leading-none">{{ $user->name }}</p>
</div>
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg cursor-pointer relative group overflow-hidden">
    @if($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-full h-full object-cover"/>
    @else
        {{ substr($user->name, 0, 1) }}
    @endif
    <!-- Dropdown on hover -->
    <div class="absolute right-0 top-12 w-48 bg-white rounded-3xl shadow-premium border border-outline-variant/30 p-5 hidden group-hover:block z-50">
        <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">ID: #{{ substr($user->id, -6) }}</p>
        <p class="text-sm font-black text-on-surface mt-1">{{ $user->name }}</p>
        <p class="text-xs text-on-surface-variant font-medium">Verified Buyer</p>
        <div class="border-t border-outline-variant/30 my-3"></div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 text-xs font-bold text-red-500 hover:text-red-600 transition-colors w-full">
                <span class="material-symbols-outlined text-sm">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
</div>
</div>
</div>
</header>
<main class="pt-32 pb-24 px-8 max-w-[1600px] mx-auto flex flex-col lg:flex-row gap-12">
<!-- Refined Sidebar -->
<aside class="hidden lg:flex flex-col w-72 shrink-0 space-y-8">
<div class="p-6 bg-white rounded-3xl border border-outline-variant/30 shadow-soft">
<div class="flex items-center gap-4 mb-8">
<div class="relative">
<img class="w-14 h-14 rounded-2xl object-cover border-2 border-primary/10" data-alt="Portrait of {{ $user->name }}" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2e7d32&color=fff' }}"/>
<div class="absolute -bottom-1 -right-1 bg-primary text-white p-1 rounded-lg border-2 border-white">
<span class="material-symbols-outlined text-[10px] fill-icon">verified</span>
</div>
</div>
<div>
<h4 class="font-bold text-on-surface text-lg">{{ $user->name }}</h4>
<p class="text-xs text-on-surface-variant font-medium">Verified Enterprise Buyer</p>
</div>
</div>
<nav class="space-y-2">
<a class="flex items-center gap-4 px-4 py-3 {{ request()->routeIs('buyer.dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }} rounded-2xl transition-all group" href="{{ route('buyer.dashboard') }}">
<span class="material-symbols-outlined {{ request()->routeIs('buyer.dashboard') ? 'fill-icon' : 'group-hover:fill-icon' }}">dashboard</span>
<span class="font-bold text-sm">Buyer Dashboard</span>
</a>

<a class="flex items-center gap-4 px-4 py-3 {{ request()->routeIs('buyer.saved') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }} rounded-2xl transition-all group" href="{{ route('buyer.saved') }}">
<span class="material-symbols-outlined {{ request()->routeIs('buyer.saved') ? 'fill-icon' : 'group-hover:fill-icon' }}">bookmark</span>
<span class="font-bold text-sm">Saved Listings</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 {{ request()->routeIs('buyer.logistics') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }} rounded-2xl transition-all group" href="{{ route('buyer.logistics') }}">
<span class="material-symbols-outlined {{ request()->routeIs('buyer.logistics') ? 'fill-icon' : 'group-hover:fill-icon' }}">local_shipping</span>
<span class="font-bold text-sm">Logistics & Tracking</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 {{ request()->routeIs('buyer.orders') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }} rounded-2xl transition-all group" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined {{ request()->routeIs('buyer.orders') ? 'fill-icon' : 'group-hover:fill-icon' }}">history</span>
<span class="font-bold text-sm">Orders & History</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 {{ request()->routeIs('buyer.account') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }} rounded-2xl transition-all group" href="{{ route('buyer.account') }}">
<span class="material-symbols-outlined {{ request()->routeIs('buyer.account') ? 'fill-icon' : 'group-hover:fill-icon' }}">account_circle</span>
<span class="font-bold text-sm">Account Center</span>
</a>
<form action="{{ route('logout') }}" method="POST" id="logout-form-side" class="hidden">@csrf</form>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all group cursor-pointer" onclick="document.getElementById('logout-form-side').submit()">
<span class="material-symbols-outlined group-hover:fill-icon">logout</span>
<span class="font-bold text-sm">Logout</span>
</a>
</nav>
</div>
<div class="bg-[#F8EFEA] p-6 rounded-3xl relative overflow-hidden group border border-[#EEDCC5]">
    <div class="relative z-10">
        <div class="flex justify-between items-center mb-6">
            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined fill-icon text-xl">trending_up</span>
            </div>
            <span class="px-3 py-1 bg-primary/5 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest">Market Insights</span>
        </div>
        
        <div class="space-y-4 mb-6" id="mandi-sidebar-container">
            @php $prices = \App\Models\MandiPrice::limit(3)->get(); @endphp
            @foreach($prices as $price)
            <div class="flex items-center justify-between border-b border-outline-variant/10 pb-3 last:border-none">
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">{{ $price->crop_name }}</p>
                    <p class="text-sm font-black text-on-surface">₹{{ number_format($price->price_per_q) }}<span class="text-[8px] font-medium opacity-60 ml-0.5">/q</span></p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Market</p>
                    <p class="text-[10px] font-black text-primary truncate max-w-[80px]">{{ $price->mandi_name }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <a href="{{ route('buyer.discover') }}" class="w-full bg-[#8D6E63] text-white py-3 rounded-xl font-extrabold text-xs hover:bg-[#7B5E55] transition-all flex items-center justify-center gap-2">
            EXPLORE MARKETPLACE
            <span class="material-symbols-outlined text-xs">arrow_forward</span>
        </a>
    </div>
</div>
</aside>
<!-- Main Content Canvas -->
<section class="flex-1">
<div class="flex flex-col md:flex-row justify-between items-start mb-12 gap-6">
<div>
<p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Buyer Dashboard</p>
@php
    $hour = now()->hour;
    if ($hour < 12) {
        $greeting = 'Good morning';
    } elseif ($hour < 17) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }
@endphp
<h1 class="text-7xl md:text-8xl font-extrabold tracking-tight text-on-surface mb-4 font-headline leading-none">
{{ $greeting }},<br/>
<span class="text-primary">{{ explode(' ', $user->name)[0] }}.</span>
</h1>
<div class="flex items-center gap-2 mb-4">
<span class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-black rounded">12%</span>
<p class="text-sm font-medium text-on-surface-variant">Your procurement performance is thriving this month.</p>
</div>
</div>
<div class="flex items-center gap-6 self-center mt-8">
<div class="text-right">
<p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-widest mb-1">Local Weather in {{ $weather['city'] ?? 'Delhi' }}</p>
<div class="flex items-center gap-4 justify-end">
<p class="text-3xl font-bold text-primary">{{ now()->format('h:i A') }}</p>
<p class="font-black text-4xl text-on-surface flex items-center gap-1">{{ $weather['temp'] ?? '28' }}°C 
<span class="material-symbols-outlined text-amber-500 text-4xl">{{ $weather['condition'] ?? 'sunny' }}</span>
</p>
</div>
</div>
<button onclick="showComingSoon('Advanced Weather Tracking')" class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-2xl">wb_sunny</span>
</button>
</div>
</div>



<!-- Bento Grid: Analytics & Insights -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
    <!-- Spending Overview Card -->
    <div class="lg:col-span-1 bg-white p-10 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="flex justify-between items-start z-10 relative">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary text-xl">payments</span>
                    <h4 class="text-on-surface-variant font-label font-bold text-xs uppercase tracking-widest">Procurement Analytics</h4>
                </div>
                <p class="text-5xl font-black tracking-tighter text-on-surface" id="total-procurement">₹{{ number_format($totalProcurement ?? 0, 2) }}</p>
                <p class="text-sm font-medium text-on-surface-variant mt-1">Total spending across all harvests</p>
            </div>
            <div class="flex flex-col items-end">
                <span class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-black flex items-center gap-2 border border-primary/20">
                    <span class="material-symbols-outlined text-base">trending_up</span>
                    +8.2%
                </span>
            </div>
        </div>
        
        <!-- Chart Canvas -->
        <div class="h-48 mt-12 z-10 relative">
            <canvas id="spendingChart"></canvas>
        </div>
    </div>

    <!-- Agri Advice Widget -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 relative overflow-hidden group">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-primary text-xl">psychology</span>
                <h4 class="text-on-surface-variant font-label font-bold text-[10px] uppercase tracking-widest">Agri Advice</h4>
            </div>
            
            <h3 class="text-lg font-black text-primary mb-3">Real-Time Insights</h3>
            <p class="text-sm font-medium text-stone-500 leading-relaxed mb-6">
                You have <span id="active-orders-count-text">{{ $activeOrders->count() }}</span> active procurements as of <span id="current-time-text">{{ now()->format('M d, h:i A') }}</span>. Market prices for crops are currently stable. Great time for bulk procurement.
            </p>
            
            <button onclick="toggleAIChat()" class="w-full bg-primary text-white py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all flex items-center justify-center gap-2 mb-4">
                Ask FarmBot
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
            
            <div class="flex items-center gap-2 text-stone-400">
                <span class="material-symbols-outlined text-xs">info</span>
                <p class="text-[10px] font-bold uppercase tracking-widest">Based on current weather</p>
            </div>
        </div>

        <!-- Logistics Tracking Widget -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 relative overflow-hidden group">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                <h4 class="text-on-surface-variant font-label font-bold text-[10px] uppercase tracking-widest">Logistics</h4>
            </div>
            
            <div class="space-y-6 mb-8" id="logistics-tracking-widget">
                @if($recentOrders->count() > 0)
                    @foreach($recentOrders as $order)
                    <div class="flex items-center gap-4 group/item">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->status, ['delivered', 'completed']) ? 'bg-green-100 text-green-700' : 'bg-primary/10 text-primary' }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl fill-icon">
                                {{ in_array($order->status, ['delivered', 'completed']) ? 'check_circle' : 'local_shipping' }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-black text-on-surface tracking-tight">Order #{{ substr($order->order_number ?? (string)$order->id, -8) }}</p>
                            <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }} • {{ $order->updated_at->format('M d, h:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="border-t border-stone-100/50"></div>
                    @endforeach
                @else
                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest text-center py-4">No recent logistics</p>
                @endif
            </div>
            
            <a href="{{ route('buyer.logistics') }}" class="w-full bg-stone-50 text-primary py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-stone-100 transition-all flex items-center justify-center gap-2">
                Track All Shipments
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
</div>

<!-- Profile Completeness & Demand Forecast Widgets -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
    <!-- Profile Completeness Card -->
    @php
        $profileFields = [
            $user->name, $user->email, $user->phone, $user->bio,
            $user->city, $user->upi_id, $user->profile_picture
        ];
        $filledCount = count(array_filter($profileFields, fn($v) => !is_null($v) && $v !== ''));
        $profilePct = (int) round(($filledCount / count($profileFields)) * 100);
    @endphp
    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 flex flex-col justify-between relative overflow-hidden">
        <div>
            <div class="flex items-center gap-2 mb-6">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-sm fill-icon">account_circle</span>
                </div>
                <h4 class="text-on-surface-variant font-label font-bold text-[10px] uppercase tracking-widest">Profile Completeness</h4>
            </div>
            <p class="text-6xl font-black tracking-tighter text-on-surface mb-6">{{ $profilePct }}%</p>
            <div class="w-full bg-stone-100 h-2.5 rounded-full overflow-hidden mb-4">
                <div class="bg-primary h-full rounded-full transition-all duration-700" style="width: {{ $profilePct }}%"></div>
            </div>
            <p class="text-xs font-medium text-on-surface-variant mb-8 leading-relaxed">
                @if($profilePct < 100)
                    {{ count($profileFields) - $filledCount }} field(s) remaining. Complete your profile to unlock premium features.
                @else
                    Your profile is 100% complete! You have full platform access.
                @endif
            </p>
        </div>
        <a href="{{ route('buyer.account') }}" class="flex items-center gap-2 text-primary font-bold text-sm hover:gap-3 transition-all">
            {{ $profilePct < 100 ? 'Finish Setup' : 'View Profile' }}
            <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
    </div>

    <!-- Demand Forecast Card -->
    <div class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-xl shadow-stone-200/50 border border-stone-100 relative overflow-hidden">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-xl">trending_up</span>
                <h4 class="text-on-surface-variant font-label font-bold text-[10px] uppercase tracking-widest">Upcoming Season Demand Forecast</h4>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest">Updated weekly</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-surface-container/50 p-6 rounded-3xl border border-stone-50">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-on-surface">Wheat</p>
                    <span class="text-secondary font-bold text-xs">+25%</span>
                </div>
                <p class="text-[10px] font-medium text-on-surface-variant leading-relaxed">High Demand expected in Punjab region.</p>
            </div>
            <div class="bg-surface-container/50 p-6 rounded-3xl border border-stone-50">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-on-surface">Basmati Rice</p>
                    <span class="text-secondary font-bold text-xs">+18%</span>
                </div>
                <p class="text-[10px] font-medium text-on-surface-variant leading-relaxed">Export demand is rising globally.</p>
            </div>
            <div class="bg-surface-container/50 p-6 rounded-3xl border border-stone-50">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-black text-on-surface">Mustard</p>
                    <span class="text-secondary font-bold text-xs">+10%</span>
                </div>
                <p class="text-[10px] font-medium text-on-surface-variant leading-relaxed">Steady demand for oil extraction.</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <p class="text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest">Powered by FarmBot AI</p>
        </div>
    </div>
</div>

<!-- Filters Bar: Refined with Modern Shadows and Borders -->

<!-- Active Orders Section -->
<div class="mb-16">
    <h2 class="text-2xl font-black text-on-surface mb-8 flex items-center gap-3">
        Active Procurements
        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="active-procurements-grid">
        @forelse($activeOrders as $order)
        <div class="bg-white p-6 rounded-3xl border border-outline-variant/30 flex gap-6 items-center shadow-soft">
            <div class="w-20 h-20 bg-surface-container rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl text-primary">
                    @if($order->status == 'in_transit') local_shipping @else shopping_cart @endif
                </span>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start mb-1">
                    @php
                        $itemCount = count($order->items ?? []);
                        $orderLabel = $itemCount > 1 ? $itemCount . ' Items' : ($order->items[0]['name'] ?? 'Order');
                    @endphp
                    <h4 class="font-black text-on-surface">{{ $orderLabel }}</h4>
                    <span class="text-xs font-bold text-primary">₹{{ number_format($order->total_price) }}</span>
                </div>
                <p class="text-xs text-on-surface-variant font-medium mb-3">Farmer: {{ optional($order->farmer)->name ?? 'Unknown Farmer' }}</p>
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest">{{ $order->status }}</span>
                    <div class="text-right">
                        <span class="block text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">ID: #{{ $order->order_number }}</span>
                        <span class="block text-[10px] font-medium text-on-surface-variant/40 mt-1">{{ $order->created_at->format('M d, h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-10 bg-white rounded-3xl border border-outline-variant/30 text-on-surface-variant font-medium">
            No active procurements.
        </div>
        @endforelse
    </div>
</div>

<!-- Active Bids Section -->
@if($activeBids->count() > 0)
<div class="mb-16">
    <h2 class="text-2xl font-black text-on-surface mb-8 flex items-center gap-3">
        Active Bids
        <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($activeBids as $bid)
        <div class="bg-white p-6 rounded-3xl border border-outline-variant/30 flex gap-6 items-center shadow-soft">
            <div class="w-20 h-20 bg-surface-container rounded-2xl flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl text-primary">gavel</span>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start mb-1">
                    <h4 class="font-black text-on-surface">{{ $bid->crop->name ?? 'Deleted Crop' }}</h4>
                    <span class="text-xs font-bold text-primary">₹{{ number_format($bid->amount) }}</span>
                </div>
                <p class="text-xs text-on-surface-variant font-medium mb-3">Status: {{ ucfirst($bid->status) }}</p>
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-[10px] font-black rounded-lg uppercase tracking-widest">{{ $bid->status }}</span>
                    <div class="text-right">
                        <span class="block text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">ID: #{{ substr($bid->id, -6) }}</span>
                        <span class="block text-[10px] font-medium text-on-surface-variant/40 mt-1">{{ $bid->created_at->format('M d, h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-10 bg-white rounded-3xl border border-outline-variant/30 text-on-surface-variant font-medium">
            No active bids.
        </div>
        @endforelse
    </div>
</div>
@endif

<div class="mb-16" id="logistics-section-container">
    <h2 class="text-2xl font-black text-on-surface mb-8 flex items-center gap-3">
        Logistics & Tracking
        <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
    </h2>
    @if($activeLogistics)
    <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft">
        <div class="flex flex-col md:flex-row justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-4">
                    <span class="w-12 h-12 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl fill-icon">local_shipping</span>
                    </span>
                    <div>
                        <h4 class="font-black text-on-surface">{{ $activeLogistics->crop_name }} Shipment</h4>
                        <p class="text-xs text-on-surface-variant font-medium">{{ $activeLogistics->status }}</p>
                    </div>
                </div>
                <!-- Progress Bar -->
                @php
                    $stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
                    $currentIdx = array_search($activeLogistics->status, $stages) ?: 0;
                    $progress = ($currentIdx / (count($stages) - 1)) * 100;
                @endphp
                <div class="relative pt-1 mb-4">
                    <div class="overflow-hidden h-2 text-xs flex rounded bg-surface-container">
                        <div style="width:{{ $progress }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-secondary"></div>
                    </div>
                    <div class="flex justify-between text-[10px] font-bold text-on-surface-variant/60 mt-2">
                        <span>Pending Pickup</span>
                        <span class="{{ $currentIdx >= 1 ? 'text-secondary' : '' }}">Dispatched</span>
                        <span class="{{ $currentIdx >= 2 ? 'text-secondary' : '' }}">In Transit</span>
                        <span class="{{ $currentIdx >= 3 ? 'text-secondary' : '' }}">Out for Delivery</span>
                        <span class="{{ $currentIdx >= 4 ? 'text-secondary' : '' }}">Delivered</span>
                    </div>
                </div>
            </div>
            <div class="md:w-64 bg-surface-container rounded-2xl p-6 flex flex-col items-center justify-center text-center">
                @if($activeLogistics->status === 'Out for Delivery')
                    <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-wider mb-2">Delivery OTP</p>
                    <div class="text-3xl font-black text-primary tracking-widest mb-1">{{ $activeLogistics->delivery_otp }}</div>
                    <p class="text-[10px] font-medium text-on-surface-variant">Share this with the driver only upon delivery.</p>
                @else
                    <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-wider mb-2">Status</p>
                    <div class="text-xl font-black text-secondary mb-1">{{ $activeLogistics->status }}</div>
                    <p class="text-[10px] font-medium text-on-surface-variant">OTP will be shown when out for delivery.</p>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft text-center text-on-surface-variant">
        No active shipments at the moment.
    </div>
    @endif
</div>




<!-- Marketplace Items Grid -->
<h2 class="text-2xl font-black text-on-surface mb-8">Available Harvests</h2>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
    @forelse($crops->take(3) as $crop)
    <div class="group bg-white rounded-3xl overflow-hidden border border-outline-variant/30 shadow-soft hover:shadow-premium transition-all duration-500 hover:-translate-y-2">
        <div class="relative h-72 overflow-hidden">
            @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700'])
            <button class="absolute top-5 right-5 w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-on-surface-variant hover:text-red-500 transition-all z-10" onclick="toggleSaveListing('{{ $crop->id }}')">
                <span class="material-symbols-outlined text-xl {{ in_array($crop->id, session('saved_listings', [])) ? 'text-red-500' : '' }}" style="{{ in_array($crop->id, session('saved_listings', [])) ? "font-variation-settings: 'FILL' 1" : '' }}">favorite</span>
            </button>
            <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-primary text-sm fill-icon">verified</span>
                <span class="text-[10px] font-extrabold text-on-surface uppercase tracking-widest">AI Verified</span>
            </div>
            <div class="absolute bottom-5 right-5 bg-primary/95 backdrop-blur-md text-white px-5 py-2 rounded-2xl font-black text-lg shadow-xl">
                ₹{{ $crop->price_per_unit }}<span class="text-[10px] font-medium opacity-80 ml-1">/ {{ $crop->unit }}</span>
            </div>
        </div>
        <div class="p-8">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="text-2xl font-extrabold text-on-surface tracking-tight mb-1">{{ $crop->name }}</h3>
                    <p class="text-sm font-medium text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        {{ $crop->farmer->city ?? 'Rural Region' }}, {{ $crop->farmer->state ?? 'IN' }} • {{ $crop->quantity }} {{ $crop->unit }} available
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 mb-8">
                @if($crop->is_organic)
                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest">Organic</span>
                @endif
                <span class="px-3 py-1 bg-surface-container text-on-surface-variant text-[10px] font-black rounded-lg uppercase tracking-widest">Direct from Farm</span>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                <div class="flex items-center gap-4 mb-4">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Qty:</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $crop->quantity }}" class="w-20 bg-surface-container border-none rounded-xl p-2 text-sm text-center" />
                    <span class="text-xs text-on-surface-variant font-medium">{{ $crop->unit }}</span>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-primary text-white py-4 rounded-2xl font-extrabold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Add to Cart</button>
                    <button type="button" onclick="openBidModal('{{ $crop->id }}', '{{ $crop->name }}', '{{ $crop->price_per_unit }}')" class="flex-1 bg-white border border-primary text-primary py-4 rounded-2xl font-extrabold text-sm hover:bg-primary/5 transition-all">Place Bid</button>
                </div>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 py-20 text-center bg-white rounded-[3rem] border border-outline-variant/30">
        <span class="material-symbols-outlined text-6xl text-stone-200 mb-4">potted_plant</span>
        <h3 class="text-2xl font-black text-on-surface">No crops available right now.</h3>
        <p class="text-on-surface-variant">Check back later for fresh harvests.</p>
    </div>
    @endforelse
</div>
<!-- Discover More -->
<div class="mt-20 flex justify-center">
<a href="{{ route('buyer.discover') }}" class="group px-10 py-5 bg-white border border-outline-variant/30 text-on-surface font-extrabold rounded-3xl hover:bg-surface-container transition-all flex items-center gap-3 shadow-soft hover:shadow-premium">
<span>Discover More Harvests</span>
<span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
</section>
</main>
<!-- Unified Refined Footer -->
@include('partials.buyer_footer')
<!-- Modern FAB for Cart Summary/Quick Buy -->
<div class="fixed bottom-8 right-8 flex flex-col gap-4 z-40">
    <!-- Cart Option -->
    <a href="{{ route('checkout') }}" class="w-16 h-16 bg-white text-primary rounded-2xl shadow-soft flex items-center justify-center hover:scale-105 active:scale-95 transition-all group border border-outline-variant/30 relative">
        <span class="material-symbols-outlined text-3xl group-hover:fill-icon">shopping_cart</span>
        <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ count(session('cart', [])) }}</span>
    </a>
    <!-- Farmbot -->
    <button onclick="toggleAIChat()" class="w-16 h-16 bg-[#00684a] text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all group shadow-primary/30">
        <span class="material-symbols-outlined text-3xl">chat</span>
    </button>
</div>

<!-- Bid Modal -->
<div id="bid-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] hidden items-center justify-center">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl border border-outline-variant/30">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-black text-on-surface">Place a Bid</h3>
            <button onclick="closeBidModal()" class="text-on-surface-variant hover:text-on-surface">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('bids.place') }}" method="POST">
            @csrf
            <input type="hidden" name="crop_id" id="modal-crop-id">
            
            <div class="mb-6">
                <p class="text-sm font-bold text-on-surface-variant mb-1">Crop</p>
                <p id="modal-crop-name" class="text-lg font-extrabold text-primary"></p>
            </div>
            
            <div class="mb-6">
                <label class="text-sm font-bold text-on-surface-variant mb-1 block">Your Bid Amount (per unit)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold">₹</span>
                    <input type="number" name="amount" id="modal-bid-amount" class="w-full pl-10 pr-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-lg font-bold" required>
                </div>
                <p class="text-xs text-on-surface-variant/60 mt-1">Listed Price: ₹<span id="modal-listed-price"></span></p>
            </div>
            
            <div class="mb-6">
                <label class="text-sm font-bold text-on-surface-variant mb-1 block">Message (Optional)</label>
                <textarea name="message" class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium" placeholder="E.g., I can buy in bulk if price is good."></textarea>
            </div>
            
            <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-extrabold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Submit Bid</button>
        </form>
    </div>
</div>

<script>
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

    function openBidModal(cropId, cropName, listedPrice) {
        document.getElementById('modal-crop-id').value = cropId;
        document.getElementById('modal-crop-name').innerText = cropName;
        document.getElementById('modal-listed-price').innerText = listedPrice;
        document.getElementById('modal-bid-amount').value = listedPrice; // Default to listed price
        document.getElementById('modal-bid-amount').min = 1;
        
        const modal = document.getElementById('bid-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function closeBidModal() {
        const modal = document.getElementById('bid-modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
    
    function toggleSaveListing(cropId) {
        const button = event.currentTarget;
        const icon = button.querySelector('.material-symbols-outlined');
        
        fetch('{{ route('saved.toggle') }}', {
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
    
    // Close modal on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('bid-modal');
        if (event.target == modal) {
            closeBidModal();
        }
    }

    // Initialize Spending Chart
    const ctx = document.getElementById('spendingChart').getContext('2d');
    const spendingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Procurement Spending',
                data: @json($spendingData),
                borderColor: '#2E7D32',
                backgroundColor: 'rgba(46, 125, 50, 0.1)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2E7D32',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
                pointHoverBackgroundColor: '#2E7D32',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#1a1c1b',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#2E7D32',
                    borderWidth: 1,
                    displayColors: false
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: { display: false },
                    ticks: {
                        color: '#a8a29e',
                        font: { size: 11, weight: 'bold' }
                    }
                },
                y: {
                    display: false,
                    grid: { display: false }
                }
            }
        }
    });

    function refreshBuyerStats() {
        fetch('/api/dashboard/buyer/stats')
            .then(response => response.json())
            .then(data => {
                // Update Chart
                if (typeof spendingChart !== 'undefined' && data.spendingData) {
                    spendingChart.data.datasets[0].data = data.spendingData;
                    spendingChart.update();
                }

                // Update Total Procurement
                const totalProcEl = document.getElementById('total-procurement');
                if (totalProcEl) totalProcEl.innerText = '₹' + data.totalProcurement;

                // Update Active Orders Count in Advice
                const countTextEl = document.getElementById('active-orders-count-text');
                if (countTextEl) countTextEl.innerText = data.activeOrdersCount;
                
                const timeTextEl = document.getElementById('current-time-text');
                if (timeTextEl) {
                    const now = new Date();
                    timeTextEl.innerText = now.toLocaleString('en-US', { month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true });
                }

                // Update Logistics Widget (Right Sidebar)
                const logWidget = document.getElementById('logistics-tracking-widget');
                if (logWidget && data.recentOrders) {
                    let logHtml = '';
                    if (data.recentOrders.length > 0) {
                        data.recentOrders.forEach(order => {
                            const isDone = ['delivered', 'completed'].includes(order.status);
                            const bgColor = isDone ? 'bg-green-100 text-green-700' : 'bg-primary/10 text-primary';
                            const icon = isDone ? 'check_circle' : 'local_shipping';
                            const statusLabel = order.status.replace('_', ' ').charAt(0).toUpperCase() + order.status.replace('_', ' ').slice(1);
                            
                            logHtml += `
                                <div class="flex items-center gap-4 group/item">
                                    <div class="w-10 h-10 rounded-full ${bgColor} flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xl fill-icon">${icon}</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-black text-on-surface tracking-tight">Order #${order.order_number ? order.order_number.slice(-8) : '... '}</p>
                                        <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">
                                            ${statusLabel} • ${order.updated_at}
                                        </p>
                                    </div>
                                </div>
                                <div class="border-t border-stone-100/50"></div>`;
                        });
                    } else {
                        logHtml = '<p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest text-center py-4">No recent logistics</p>';
                    }
                    logWidget.innerHTML = logHtml;
                }

                // Update Active Procurements Grid (Main Section)
                const procGrid = document.getElementById('active-procurements-grid');
                if (procGrid && data.activeOrders) {
                    let gridHtml = '';
                    data.activeOrders.forEach(order => {
                        const icon = order.status === 'in_transit' ? 'local_shipping' : 'shopping_cart';
                        gridHtml += `
                            <div class="bg-white p-6 rounded-3xl border border-outline-variant/30 flex gap-6 items-center shadow-soft">
                                <div class="w-20 h-20 bg-surface-container rounded-2xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-3xl text-primary">${icon}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-black text-on-surface">${order.item_count > 1 ? order.item_count + ' Items' : order.item_name}</h4>
                                        <span class="text-xs font-bold text-primary">₹${order.total_price}</span>
                                    </div>
                                    <p class="text-xs text-on-surface-variant font-medium mb-3">Farmer: ${order.farmer_name}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest">${order.status}</span>
                                        <div class="text-right">
                                            <span class="block text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">ID: #${order.order_number}</span>
                                            <span class="block text-[10px] font-medium text-on-surface-variant/40 mt-1">${order.created_at}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                    procGrid.innerHTML = gridHtml;
                }

                // Update Logistics Tracking Section (Bottom section)
                const logSection = document.getElementById('logistics-section-container');
                if (logSection && data.activeLogistics) {
                    const item = data.activeLogistics;
                    const stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
                    const currentIdx = stages.indexOf(item.status) !== -1 ? stages.indexOf(item.status) : 0;
                    const progress = (currentIdx / (stages.length - 1)) * 100;
                    
                    let sectionHtml = `
                        <h2 class="text-2xl font-black text-on-surface mb-8 flex items-center gap-3">
                            Logistics & Tracking
                            <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                        </h2>
                        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft">
                            <div class="flex flex-col md:flex-row justify-between gap-6">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="w-12 h-12 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center">
                                            <span class="material-symbols-outlined text-2xl fill-icon">local_shipping</span>
                                        </span>
                                        <div>
                                            <h4 class="font-black text-on-surface">${item.crop_name} Shipment</h4>
                                            <p class="text-xs text-on-surface-variant font-medium">${item.status}</p>
                                        </div>
                                    </div>
                                    <div class="relative pt-1 mb-4">
                                        <div class="overflow-hidden h-2 text-xs flex rounded bg-surface-container">
                                            <div style="width:${progress}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-secondary"></div>
                                        </div>
                                        <div class="flex justify-between text-[10px] font-bold text-on-surface-variant/60 mt-2">
                                            <span>Pending Pickup</span>
                                            <span class="${currentIdx >= 1 ? 'text-secondary' : ''}">Dispatched</span>
                                            <span class="${currentIdx >= 2 ? 'text-secondary' : ''}">In Transit</span>
                                            <span class="${currentIdx >= 3 ? 'text-secondary' : ''}">Out for Delivery</span>
                                            <span class="${currentIdx >= 4 ? 'text-secondary' : ''}">Delivered</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:w-64 bg-surface-container rounded-2xl p-6 flex flex-col items-center justify-center text-center">
                                    ${item.status === 'Out for Delivery' ? `
                                        <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-wider mb-2">Delivery OTP</p>
                                        <div class="text-3xl font-black text-primary tracking-widest mb-1">${item.delivery_otp}</div>
                                        <p class="text-[10px] font-medium text-on-surface-variant">Share this with the driver only upon delivery.</p>
                                    ` : `
                                        <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-wider mb-2">Status</p>
                                        <div class="text-xl font-black text-secondary mb-1">${item.status}</div>
                                        <p class="text-[10px] font-medium text-on-surface-variant">OTP will be shown when out for delivery.</p>
                                    `}
                                </div>
                            </div>
                        </div>`;
                    logSection.innerHTML = sectionHtml;
                } else if (logSection && !data.activeLogistics) {
                     logSection.innerHTML = `
                        <h2 class="text-2xl font-black text-on-surface mb-8 flex items-center gap-3">
                            Logistics & Tracking
                            <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                        </h2>
                        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft text-center text-on-surface-variant">
                            No active shipments at the moment.
                        </div>`;
                }
                // Update Mandi Sidebar
                const mandiContainer = document.getElementById('mandi-sidebar-container');
                if (mandiContainer && data.mandiPrices) {
                    let mandiHtml = '';
                    data.mandiPrices.forEach(price => {
                        mandiHtml += `
                            <div class="flex items-center justify-between border-b border-outline-variant/10 pb-3 last:border-none">
                                <div>
                                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">${price.crop_name}</p>
                                    <p class="text-sm font-black text-on-surface">₹${price.price_per_q.toLocaleString()}<span class="text-[8px] font-medium opacity-60 ml-0.5">/q</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">${price.category}</p>
                                    <p class="text-[10px] font-black text-primary uppercase">Trending</p>
                                </div>
                            </div>`;
                    });
                    mandiContainer.innerHTML = mandiHtml;
                }
            })
            .catch(err => console.error('Buyer stats fetch error:', err));
    }

    // Initial fetch and poll every 5s
    refreshBuyerStats();
    setInterval(refreshBuyerStats, 5000);
</script>
@include('partials.farmbot', ['showButton' => false])
@include('partials.live_notifications')
</body></html>