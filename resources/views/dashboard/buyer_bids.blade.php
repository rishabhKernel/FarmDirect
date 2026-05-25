<!DOCTYPE html>
<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>My Bids - FarmDirect</title>
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2E7D32",
                        "secondary": "#8D6E63",
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

<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl border-b border-outline-variant/30 h-20">
<div class="max-w-[1600px] mx-auto h-full flex justify-between items-center px-8">
<div class="flex items-center gap-12">
<a href="/" class="flex items-center gap-2">
    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
    <span class="text-2xl font-black tracking-tighter text-on-surface">Farm<span class="text-primary">Direct</span></span>
</a>
</div>
<div class="flex items-center gap-6">
    <div class="flex items-center gap-3 pr-2 border-r border-outline-variant/30">
        <a href="{{ route('buyer.notifications') }}" class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant relative">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </a>
        @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
        <a href="{{ route('checkout') }}" class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant relative">
            <span class="material-symbols-outlined">shopping_cart</span>
            @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 w-5 h-5 bg-primary text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ $cartCount }}</span>
            @endif
        </a>
    </div>
<div class="flex items-center gap-3 pl-2">
<div class="text-right hidden sm:block">
<p class="text-xs font-bold text-primary uppercase tracking-widest leading-none mb-1">Role: Buyer</p>
<p class="text-sm font-semibold text-on-surface leading-none">{{ $user->name }}</p>
</div>
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg cursor-pointer relative group">
    {{ substr($user->name, 0, 1) }}
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
<aside class="hidden lg:flex flex-col w-72 shrink-0 space-y-8">
<div class="p-6 bg-white rounded-3xl border border-outline-variant/30 shadow-soft">
<div class="flex items-center gap-4 mb-8">
<div class="relative">
<div class="w-14 h-14 rounded-2xl bg-stone-100 flex items-center justify-center text-primary font-bold text-xl border-2 border-primary/10">
    {{ substr($user->name, 0, 1) }}
</div>
<div class="absolute -bottom-1 -right-1 bg-primary text-white p-1 rounded-lg border-2 border-white">
<span class="material-symbols-outlined text-[10px] fill-icon">verified</span>
</div>
</div>
<div>
<h4 class="font-bold text-on-surface text-lg">{{ $user->name }}</h4>
<p class="text-xs text-on-surface-variant font-medium">Enterprise Buyer</p>
</div>
</div>
<nav class="space-y-2">
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.dashboard') }}">
<span class="material-symbols-outlined group-hover:fill-icon">dashboard</span>
<span class="font-bold text-sm">Dashboard</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20" href="{{ route('buyer.bids') }}">
<span class="material-symbols-outlined fill-icon">gavel</span>
<span class="text-sm">My Bids</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined group-hover:fill-icon">history</span>
<span class="font-bold text-sm">Orders & History</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.logistics') }}">
<span class="material-symbols-outlined group-hover:fill-icon">local_shipping</span>
<span class="font-bold text-sm">Logistics</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.account') }}">
<span class="material-symbols-outlined group-hover:fill-icon">account_circle</span>
<span class="font-bold text-sm">Account Center</span>
</a>
</nav>
</div>
</aside>

<section class="flex-1">
<header class="mb-10">
    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-2">My Bids</h1>
    <p class="text-on-surface-variant font-medium">Track your active negotiations and historical bids on agricultural produce.</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($bids as $bid)
        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft relative overflow-hidden group">
            @php
                $statusColor = match($bid->status) {
                    'pending' => 'amber',
                    'accepted' => 'green',
                    'rejected' => 'red',
                    'negotiating' => 'blue',
                    default => 'stone'
                };
            @endphp
            <div class="absolute top-0 right-0 p-6">
                <span class="px-4 py-1.5 bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 text-[10px] font-black rounded-lg uppercase tracking-widest border border-{{ $statusColor }}-200">
                    {{ $bid->status }}
                </span>
            </div>

            <div class="flex items-start gap-5 mb-8">
                <div class="w-16 h-16 bg-surface-container rounded-2xl flex items-center justify-center border border-outline-variant/20 shrink-0">
                    <span class="material-symbols-outlined text-primary text-3xl">eco</span>
                </div>
                <div>
                    <h3 class="font-black text-on-surface text-xl group-hover:text-primary transition-colors">{{ $bid->crop->name ?? 'Unknown Crop' }}</h3>
                    <p class="text-sm text-on-surface-variant font-medium">{{ $bid->quantity }} {{ $bid->crop->unit ?? 'kg' }} requested</p>
                    <p class="text-xs text-stone-400 mt-1 font-bold">{{ $bid->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 p-4 bg-surface-container rounded-2xl mb-6">
                <div>
                    <p class="text-[9px] font-black text-on-surface-variant/60 uppercase tracking-widest mb-1">Your Bid Price</p>
                    <p class="text-lg font-black text-primary">₹{{ number_format($bid->price, 2) }} <span class="text-xs text-on-surface-variant font-medium">/{{ $bid->crop->unit ?? 'kg' }}</span></p>
                </div>
                <div>
                    <p class="text-[9px] font-black text-on-surface-variant/60 uppercase tracking-widest mb-1">Total Value</p>
                    <p class="text-lg font-black text-on-surface">₹{{ number_format($bid->price * $bid->quantity, 2) }}</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-stone-100 flex items-center justify-center text-[10px] font-bold text-primary">
                        {{ substr($bid->crop->farmer->name ?? 'F', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-on-surface-variant/60 uppercase tracking-widest">Farmer</p>
                        <p class="text-xs font-bold text-on-surface">{{ $bid->crop->farmer->name ?? 'Unknown' }}</p>
                    </div>
                </div>
                @if($bid->status === 'accepted')
                    <a href="{{ route('buyer.orders') }}" class="text-primary font-black text-[10px] uppercase tracking-widest flex items-center gap-2 hover:gap-3 transition-all">
                        View Order <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                @elseif($bid->status === 'pending')
                    <span class="text-stone-400 font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">hourglass_empty</span> Waiting
                    </span>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white p-14 rounded-3xl border border-outline-variant/30 shadow-soft text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4 block">gavel</span>
            <h3 class="text-xl font-bold text-on-surface mb-2">No Bids Found</h3>
            <p class="text-on-surface-variant">You haven't placed any bids on crops yet.</p>
            <a href="{{ route('buyer.discover') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-black text-xs rounded-2xl uppercase tracking-widest shadow-lg shadow-primary/20">
                Start Bidding <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $bids->links() }}
</div>
</section>
</main>
@include('partials.buyer_footer')
@include('partials.live_notifications')

</body>
</html>
