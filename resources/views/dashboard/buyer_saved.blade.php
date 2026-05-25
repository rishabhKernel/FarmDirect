<!DOCTYPE html>

<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Saved Listings - FarmDirect</title>
<script src="/js/tailwind.min.js"></script>
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
    </style>
</head>
<body class="bg-background font-body text-on-surface overflow-x-hidden">

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
<form action="{{ route('buyer.discover') }}" method="GET">
<input class="pl-11 pr-6 py-2.5 bg-surface-container rounded-full text-sm w-72 border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-on-surface-variant/60" name="search" value="{{ request('search') }}" placeholder="Search premium harvests..." type="text"/>
</form>
</div>
<div class="flex items-center gap-3 pr-2 border-r border-outline-variant/30">
                <a href="{{ route('buyer.notifications') }}" class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </a>
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
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.dashboard') }}">
<span class="material-symbols-outlined group-hover:fill-icon">dashboard</span>
<span class="font-bold text-sm">Buyer Dashboard</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20" href="{{ route('buyer.saved') }}">
<span class="material-symbols-outlined fill-icon">bookmark</span>
<span class="text-sm">Saved Listings</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.logistics') }}">
<span class="material-symbols-outlined group-hover:fill-icon">local_shipping</span>
<span class="font-bold text-sm">Logistics & Tracking</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined group-hover:fill-icon">history</span>
<span class="font-bold text-sm">Orders & History</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.account') }}">
<span class="material-symbols-outlined group-hover:fill-icon">account_circle</span>
<span class="font-bold text-sm">Account Center</span>
</a>
</nav>
</div>
</aside>

<!-- Main Content Area -->
<section class="flex-1">
<header class="mb-12">
    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Saved Listings</h1>
    <p class="text-on-surface-variant font-medium max-w-2xl">Keep track of premium harvests you're interested in. Review them here and procure when ready.</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @forelse($savedCrops ?? [] as $crop)
        <div class="group bg-white rounded-3xl overflow-hidden border border-outline-variant/30 shadow-soft hover:shadow-premium transition-all duration-500 hover:-translate-y-2">
            <div class="relative h-64 overflow-hidden">
                @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700'])
                <button class="absolute top-5 right-5 w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-red-500 shadow-sm z-10" onclick="toggleSaveListing('{{ $crop->id }}')">
                    <span class="material-symbols-outlined text-xl fill-icon">favorite</span>
                </button>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-extrabold text-on-surface tracking-tight mb-2">{{ $crop->name }}</h3>
                <p class="text-xs text-on-surface-variant font-medium mb-4 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    {{ $crop->farmer->city ?? 'Rural Region' }}, {{ $crop->farmer->state ?? 'IN' }}
                </p>
                <div class="flex justify-between items-end">
                    <div>
                        <span class="text-xl font-black text-primary block">₹{{ $crop->price_per_unit }}<span class="text-[10px] font-medium opacity-60">/{{ $crop->unit }}</span></span>
                        <p class="text-[10px] font-bold text-on-surface-variant/40 uppercase tracking-widest mt-1">{{ $crop->quantity }} {{ $crop->unit }} Left</p>
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="crop_id" value="{{ $crop->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="px-4 py-2 bg-primary text-white font-black text-[10px] rounded-lg uppercase tracking-widest hover:bg-green-800 transition-all shadow-md shadow-primary/10">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-2 bg-white p-12 rounded-3xl border border-outline-variant/30 shadow-soft text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">bookmark_outline</span>
            <h3 class="text-xl font-bold text-on-surface mb-2">Your collection is empty</h3>
            <p class="text-on-surface-variant mb-6">Start saving listings from the marketplace to track them here.</p>
            <a href="{{ route('buyer.discover') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Browse Marketplace</a>
        </div>
    @endforelse
</div>
</section>
</main>
@include('partials.buyer_footer')

<!-- Modern FAB for Cart Summary/Quick Buy -->
<div class="fixed bottom-8 right-8 flex flex-col gap-4 z-40">
    <!-- Cart Option -->
    <a href="{{ route('checkout') }}" class="w-16 h-16 bg-white text-primary rounded-2xl shadow-soft flex items-center justify-center hover:scale-105 active:scale-95 transition-all group border border-outline-variant/30 relative">
        <span class="material-symbols-outlined text-3xl group-hover:fill-icon">shopping_cart</span>
        <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ count(session('cart', [])) }}</span>
    </a>
</div>

<script>
    function toggleSaveListing(cropId) {
        fetch(`{{ route('saved.toggle') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ crop_id: cropId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
</script>

@include('partials.live_notifications')

</body></html>
