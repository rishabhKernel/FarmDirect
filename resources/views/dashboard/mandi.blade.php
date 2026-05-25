<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect | Mandi Prices</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="/js/tailwind.min.js"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary":"#0d631b","on-primary":"#ffffff","primary-container":"#b2f2bb",
        "on-primary-container":"#002108","secondary":"#506352","on-secondary":"#ffffff",
        "secondary-container":"#d3e8d3","on-secondary-container":"#0e1f10",
        "surface":"#f8faf8","on-surface":"#1a1c1b","surface-container-low":"#f2f4f2",
        "surface-container-lowest":"#ffffff","surface-container-high":"#e8eae8",
        "outline-variant":"#c0c9c0","outline":"#70796f","error":"#ba1a1a","on-surface-variant":"#404943",
      },
      fontFamily: { headline:['"Plus Jakarta Sans"','sans-serif'], label:['Manrope','sans-serif'] }
    }
  }
};
</script>
<style>
  body { font-family: 'Manrope', sans-serif; background: #f8faf8; }
  .dark body { background: #1a1c1b; color: #e2e8e2; }
  .dark aside { background: #111312 !important; }
  .dark .bg-white { background: #252826 !important; color: #e2e8e2 !important; }
  .dark .text-on-surface { color: #e2e8e2 !important; }
  .dark .text-on-surface-variant { color: #aab4aa !important; }
  .dark .bg-surface-container-low { background: #2a2e2a !important; }
  .dark .bg-surface-container-lowest { background: #1e221e !important; }
  .dark nav { background: rgba(37,40,38,0.85) !important; }
  .dark input, .dark select { background: #2a2e2a !important; color: #e2e8e2 !important; border-color: #3a403a !important; }
  .price-card { transition: all 0.2s; }
  .price-card:hover { transform: translateY(-2px); box-shadow: 0 20px 40px rgba(13,99,27,0.1); }
</style>
</head>
<body class="min-h-screen">

<!-- Sidebar -->
<aside class="hidden lg:flex flex-col fixed left-0 top-0 h-full py-4 w-64 bg-stone-950 z-40 border-r border-white/5 shadow-2xl">
    <div class="px-8 py-2 mb-6">
        <a href="/" class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings:'FILL' 1;">eco</span>
            <span class="text-3xl font-black tracking-tighter text-white">Farm<span class="text-primary">Direct</span></span>
        </a>
    </div>
    <div class="px-6 mb-8">
        <div class="flex items-center gap-3 mb-6 p-3 bg-white/5 rounded-2xl border border-white/10">
            <img alt="{{ $user->name }}" class="w-10 h-10 rounded-xl object-cover border-2 border-primary/20"
                 src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0d631b&color=fff&size=128' }}"/>
            <div class="overflow-hidden">
                <h3 class="font-bold text-white text-xs truncate">{{ $user->name }}</h3>
                <p class="text-[10px] text-stone-400 truncate">
                    @if($user->role === 'admin')
                        Executive Admin
                    @elseif($user->role === 'buyer')
                        Enterprise Buyer
                    @else
                        Verified Farmer
                    @endif
                </p>
            </div>
        </div>
        <button onclick="openAIInsights()" class="w-full py-3 bg-primary text-white rounded-xl flex items-center justify-center gap-2 font-bold transition-transform active:scale-95 shadow-lg shadow-primary/20 hover:bg-primary/90">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">psychology_alt</span>
            <span class="text-xs uppercase tracking-widest">AI Insights</span>
        </button>
    </div>
    <nav class="flex-1 space-y-2 px-4">
        @if($user->role === 'admin')
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="/dashboard/admin#dashboard">
                <span class="material-symbols-outlined">dashboard</span><span class="font-label text-sm">Overview</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="/dashboard/admin#farmers">
                <span class="material-symbols-outlined">agriculture</span><span class="font-label text-sm">Farmers</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="/dashboard/admin#buyers">
                <span class="material-symbols-outlined">storefront</span><span class="font-label text-sm">Buyers</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="/dashboard/admin#logistics">
                <span class="material-symbols-outlined">local_shipping</span><span class="font-label text-sm">Logistics Hub</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="/dashboard/admin#bids">
                <span class="material-symbols-outlined">gavel</span><span class="font-label text-sm">Bid Monitor</span>
            </a>
            <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner" href="/dashboard/mandi">
                <span class="material-symbols-outlined">store</span><span class="font-label text-sm">Mandi Reference</span>
            </a>
        @elseif($user->role === 'buyer')
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('buyer.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span><span class="font-label text-sm">Buyer Dashboard</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('buyer.saved') }}">
                <span class="material-symbols-outlined">bookmark</span><span class="font-label text-sm">Saved Listings</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('buyer.logistics') }}">
                <span class="material-symbols-outlined">local_shipping</span><span class="font-label text-sm">Logistics Hub</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('buyer.orders') }}">
                <span class="material-symbols-outlined">history</span><span class="font-label text-sm">Orders & History</span>
            </a>
            <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner" href="/dashboard/mandi">
                <span class="material-symbols-outlined">store</span><span class="font-label text-sm">Mandi Board</span>
            </a>
        @else
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span><span class="font-label text-sm">Dashboard</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.bids') }}">
                <span class="material-symbols-outlined">gavel</span><span class="font-label text-sm">Orders & Bids</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.crops') }}">
                <span class="material-symbols-outlined">inventory_2</span><span class="font-label text-sm">My Crops</span>
            </a>
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.logistics') }}">
                <span class="material-symbols-outlined">history</span><span class="font-label text-sm">Logistics & History</span>
            </a>
            <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner" href="{{ route('farmer.mandi') }}">
                <span class="material-symbols-outlined">store</span><span class="font-label text-sm">Mandi Prices</span>
            </a>
        @endif
    </nav>
    <div class="px-4 mt-auto space-y-1 border-t border-white/5 pt-6">
        @if($user->role === 'admin')
            <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all" href="/dashboard/admin#dashboard">
                <span class="material-symbols-outlined text-sm">settings</span><span class="font-label text-xs">Settings</span>
            </a>
        @elseif($user->role === 'buyer')
            <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all" href="{{ route('buyer.account') }}">
                <span class="material-symbols-outlined text-sm">settings</span><span class="font-label text-xs">Settings</span>
            </a>
        @else
            <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all" href="{{ route('farmer.settings') }}">
                <span class="material-symbols-outlined text-sm">settings</span><span class="font-label text-xs">Settings</span>
            </a>
        @endif
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
        <a class="text-stone-400 hover:text-red-400 hover:bg-red-500/10 px-4 py-3 flex items-center gap-3 rounded-xl transition-all cursor-pointer" onclick="document.getElementById('logout-form').submit()">
            <span class="material-symbols-outlined text-sm">logout</span><span class="font-label text-xs">Logout</span>
        </a>
    </div>
</aside>

<!-- Top Nav -->
<nav class="fixed top-0 left-64 right-0 z-50 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-2xl">store</span>
        <h1 class="text-xl font-black tracking-tight">Live Mandi Prices</h1>
        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold">Updated Today</span>
    </div>
    <div class="flex items-center gap-4">
        @if($user->role === 'admin')
            <a href="/dashboard/admin" class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center overflow-hidden border border-outline-variant/10">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/'.$user->profile_picture) }}" class="w-full h-full object-cover"/>
                @else
                    <span class="font-bold text-on-primary-container">{{ strtoupper(substr($user->name,0,1)) }}</span>
                @endif
            </a>
        @elseif($user->role === 'buyer')
            <a href="{{ route('buyer.notifications') }}" class="p-2 hover:bg-stone-100 rounded-full transition-all relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
            </a>
            <a href="{{ route('buyer.account') }}" class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center overflow-hidden border border-outline-variant/10">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/'.$user->profile_picture) }}" class="w-full h-full object-cover"/>
                @else
                    <span class="font-bold text-on-primary-container">{{ strtoupper(substr($user->name,0,1)) }}</span>
                @endif
            </a>
        @else
            <a href="{{ route('farmer.notifications') }}" class="p-2 hover:bg-stone-100 rounded-full transition-all relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
            </a>
            <a href="{{ route('farmer.settings') }}" class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center overflow-hidden border border-outline-variant/10">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/'.$user->profile_picture) }}" class="w-full h-full object-cover"/>
                @else
                    <span class="font-bold text-on-primary-container">{{ strtoupper(substr($user->name,0,1)) }}</span>
                @endif
            </a>
        @endif
    </div>
</nav>

<!-- Main -->
<main class="lg:ml-64 pt-28 px-6 lg:px-10 pb-16">

    <!-- Hero Bar -->
    <div class="bg-gradient-to-r from-primary to-green-700 rounded-[2rem] p-8 mb-10 flex flex-wrap justify-between items-center gap-4 text-white shadow-2xl shadow-primary/20">
        <div>
            <h2 class="text-3xl font-black tracking-tighter">Today's Mandi Rates</h2>
            <p class="text-white/80 text-sm mt-1">Compare prices across major Indian markets before selling your harvest</p>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <div class="bg-white/20 backdrop-blur rounded-xl px-4 py-2 text-center">
                <p class="font-black text-2xl">{{ $prices->count() }}</p>
                <p class="text-[10px] uppercase tracking-wider opacity-80">Showing</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-xl px-4 py-2 text-center">
                <p class="font-black text-2xl">6</p>
                <p class="text-[10px] uppercase tracking-wider opacity-80">Categories</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-xl px-4 py-2 text-center">
                <p class="font-black text-2xl">28+</p>
                <p class="text-[10px] uppercase tracking-wider opacity-80">States</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-4 mb-8">
        <form action="{{ route('farmer.mandi') }}" method="GET" class="flex flex-wrap gap-3 items-center">
            <div class="relative flex-1 min-w-[200px]">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search any crop e.g. Wheat, Tomato, Cumin..."
                       class="w-full pl-11 pr-4 py-3 rounded-xl border border-outline-variant/20 text-sm focus:ring-2 focus:ring-primary/20 bg-surface-container-low"/>
            </div>
            <select name="category" onchange="this.form.submit()"
                    class="py-3 px-4 rounded-xl border border-outline-variant/20 text-sm font-bold focus:ring-2 focus:ring-primary/20 bg-surface-container-low cursor-pointer">
                <option value="All" {{ $category === '' || $category === 'All' ? 'selected' : '' }}>All Categories</option>
                <option value="Cereal"    {{ $category === 'Cereal'    ? 'selected' : '' }}>🌾 Cereals</option>
                <option value="Pulse"     {{ $category === 'Pulse'     ? 'selected' : '' }}>🫘 Pulses</option>
                <option value="Vegetable" {{ $category === 'Vegetable' ? 'selected' : '' }}>🥦 Vegetables</option>
                <option value="Fruit"     {{ $category === 'Fruit'     ? 'selected' : '' }}>🍎 Fruits</option>
                <option value="Spice"     {{ $category === 'Spice'     ? 'selected' : '' }}>🌶️ Spices</option>
                <option value="Oilseed"   {{ $category === 'Oilseed'   ? 'selected' : '' }}>🌻 Oilseeds</option>
                <option value="Cash Crop" {{ $category === 'Cash Crop' ? 'selected' : '' }}>💰 Cash Crops</option>
            </select>
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-primary/90 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">search</span> Search
            </button>
            @if($search || ($category && $category !== 'All'))
            <a href="{{ route('farmer.mandi') }}" class="border border-outline-variant px-5 py-3 rounded-xl font-bold text-sm hover:bg-surface-container-low transition-colors flex items-center gap-1 text-on-surface-variant">
                <span class="material-symbols-outlined text-sm">close</span> Clear
            </a>
            @endif
        </form>
        <div class="flex flex-wrap gap-2 mt-3">
            @foreach(['Cereal','Pulse','Vegetable','Fruit','Spice','Oilseed','Cash Crop'] as $cat)
            <a href="{{ route('farmer.mandi', ['category' => $cat]) }}"
               class="text-xs px-3 py-1.5 rounded-full font-bold transition-all {{ $category === $cat ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant hover:bg-primary/10 hover:text-primary' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
        <p class="text-xs text-on-surface-variant mt-3">All prices in <strong>₹ per Quintal (100 kg)</strong> · Sourced from AGMARKNET India</p>
    </div>

    <!-- Category Groups -->
    @php $grouped = $prices->groupBy('category'); @endphp
    @forelse($grouped as $category => $items)
    <div class="mb-10">
        <h3 class="text-lg font-black tracking-tight mb-4 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-primary inline-block"></span>
            {{ $category }}
            <span class="text-xs text-on-surface-variant font-normal">({{ $items->count() }} items)</span>
        </h3>
        
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="divide-y divide-stone-100">
                @foreach($items as $price)
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 sm:p-5 hover:bg-stone-50/50 transition-all gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-primary/10 flex items-center justify-center text-primary font-black text-sm">
                            {{ strtoupper(substr($price->crop_name, 0, 2)) }}
                        </div>
                        <div>
                            <h4 class="font-extrabold text-on-surface text-base leading-snug">{{ $price->crop_name }}</h4>
                            <p class="text-xs text-on-surface-variant/80 flex items-center gap-1 mt-1 font-bold">
                                <span class="material-symbols-outlined text-xs text-primary font-black">location_on</span>
                                {{ $price->mandi_name }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 sm:gap-10 w-full sm:w-auto justify-between sm:justify-end border-t sm:border-t-0 pt-3 sm:pt-0">
                        <div class="bg-surface-container-low px-3 py-1.5 rounded-xl text-[10px] font-black text-on-surface-variant uppercase tracking-widest">
                            {{ $price->category }}
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-on-surface font-extrabold">≈ ₹{{ number_format($price->price_per_q / 100, 1) }}</p>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider mt-0.5">Est. per kg</p>
                        </div>
                        <div class="text-right min-w-[110px]">
                            <p class="text-2xl font-black text-primary">₹{{ number_format($price->price_per_q) }}</p>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider">Per Quintal</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-20 text-on-surface-variant bg-white border border-stone-100 rounded-3xl shadow-sm">
        <span class="material-symbols-outlined text-6xl mb-4 block text-stone-400">search_off</span>
        <h3 class="text-xl font-black text-on-surface">No results for "{{ $search }}"</h3>
        <a href="{{ route('farmer.mandi') }}" class="text-primary font-bold text-sm hover:underline mt-2 inline-block">Clear search</a>
    </div>
    @endforelse

    <!-- Disclaimer -->
    <div class="mt-8 bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
        <span class="material-symbols-outlined text-amber-600 mt-0.5">info</span>
        <div>
            <p class="font-bold text-amber-800 text-sm">Price Disclaimer</p>
            <p class="text-xs text-amber-700 mt-1">These prices are indicative and based on recent market data. Actual mandi prices may vary. Always verify at your local APMC before selling.</p>
        </div>
    </div>
</main>

@include('partials.farmbot')
<script>
function openAIInsights() {
    const el = document.getElementById('farmbot-widget');
    if (el) el.classList.toggle('hidden');
}
</script>
</body>
</html>
