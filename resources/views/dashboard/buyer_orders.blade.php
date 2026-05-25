<!DOCTYPE html>

<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Orders & History - FarmDirect</title>
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
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.saved') }}">
<span class="material-symbols-outlined group-hover:fill-icon">bookmark</span>
<span class="font-bold text-sm">Saved Listings</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.logistics') }}">
<span class="material-symbols-outlined group-hover:fill-icon">local_shipping</span>
<span class="font-bold text-sm">Logistics & Tracking</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined fill-icon">history</span>
<span class="text-sm">Orders & History</span>
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
<header class="mb-10">
    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-2">Orders & History</h1>
    <p class="text-on-surface-variant font-medium">Review your procurement history, download invoices, and manage your active orders.</p>
</header>

@if(session('success'))
    <div class="mb-6 p-4 bg-primary/10 border border-primary/20 rounded-2xl text-primary font-bold flex items-center gap-3">
        <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-600 font-bold flex items-center gap-3">
        <span class="material-symbols-outlined">error</span> {{ session('error') }}
    </div>
@endif

<!-- Tabs -->
<div class="flex gap-2 mb-8 bg-surface-container p-1.5 rounded-2xl w-fit">
    <button onclick="switchTab('active')" id="tab-active"
        class="tab-btn px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest transition-all bg-white text-primary shadow-sm">
        Active Orders
        <span class="ml-2 bg-primary text-white text-[9px] px-2 py-0.5 rounded-full">{{ $activeOrders->total() }}</span>
    </button>
    <button onclick="switchTab('completed')" id="tab-completed"
        class="tab-btn px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest transition-all text-on-surface-variant">
        Completed
        <span class="ml-2 bg-stone-200 text-stone-500 text-[9px] px-2 py-0.5 rounded-full">{{ $completedOrders->total() }}</span>
    </button>
</div>

<!-- Active Orders Panel -->
<div id="panel-active" class="space-y-5">
    @forelse($activeOrders as $order)
        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h3 class="font-black text-on-surface text-xl">Order #{{ substr($order->order_number ?? $order->id, -8) }}</h3>
                    <p class="text-xs text-on-surface-variant font-medium uppercase tracking-widest">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    @php
                        $statusColors = ['pending' => 'bg-amber-100 text-amber-700', 'processing' => 'bg-blue-100 text-blue-700', 'in_transit' => 'bg-purple-100 text-purple-700'];
                        $sc = $statusColors[$order->status] ?? 'bg-stone-100 text-stone-600';
                    @endphp
                    <span class="px-4 py-1.5 {{ $sc }} text-[10px] font-black rounded-lg uppercase tracking-widest border border-current/20">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                    <p class="text-2xl font-black text-on-surface">₹{{ number_format($order->total_price ?? 0, 2) }}</p>
                </div>
            </div>

            <div class="space-y-3 mb-6">
                @foreach($order->items ?? [] as $item)
                <div class="flex items-center gap-4 p-4 bg-surface-container rounded-2xl">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-outline-variant/20">
                        <span class="material-symbols-outlined text-primary text-lg">eco</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-on-surface text-sm">{{ $item['name'] ?? 'Crop Item' }}</h4>
                        <p class="text-xs text-on-surface-variant font-medium">{{ $item['quantity'] ?? 0 }} {{ $item['unit'] ?? 'kg' }} • ₹{{ number_format($item['price'] ?? 0, 2) }}/{{ $item['unit'] ?? 'kg' }}</p>
                    </div>
                    <p class="font-black text-on-surface text-sm">₹{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex justify-end gap-3 flex-wrap">
                @if($order->status === 'pending')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Cancel this order?')">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 border border-red-200 font-black text-[10px] rounded-xl uppercase tracking-widest hover:bg-red-100 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">cancel</span> Cancel Order
                        </button>
                    </form>
                @endif
                <a href="{{ route('buyer.logistics') }}" class="px-5 py-2.5 bg-surface-container text-on-surface font-black text-[10px] rounded-xl uppercase tracking-widest hover:bg-stone-200 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">local_shipping</span> Track Shipment
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white p-14 rounded-3xl border border-outline-variant/30 shadow-soft text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4 block">shopping_bag</span>
            <h3 class="text-xl font-bold text-on-surface mb-2">No Active Orders</h3>
            <p class="text-on-surface-variant mb-6">Head to the marketplace to start a new procurement.</p>
            <a href="{{ route('buyer.discover') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-black text-xs rounded-2xl uppercase tracking-widest">
                Browse Marketplace <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    @endforelse
    <div class="mt-4">{{ $activeOrders->appends(['completed_page' => request('completed_page')])->links() }}</div>
</div>

<!-- Completed Orders Panel -->
<div id="panel-completed" class="space-y-5 hidden">
    @forelse($completedOrders as $order)
        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h3 class="font-black text-on-surface text-xl">Order #{{ substr($order->order_number ?? $order->id, -8) }}</h3>
                    <p class="text-xs text-on-surface-variant font-medium uppercase tracking-widest">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 bg-green-100 text-green-700 text-[10px] font-black rounded-lg uppercase tracking-widest border border-green-200">{{ ucfirst($order->status) }}</span>
                    <p class="text-2xl font-black text-on-surface">₹{{ number_format($order->total_price ?? 0, 2) }}</p>
                </div>
            </div>

            <div class="space-y-3 mb-6">
                @foreach($order->items ?? [] as $item)
                <div class="flex items-center gap-4 p-4 bg-surface-container rounded-2xl">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-outline-variant/20">
                        <span class="material-symbols-outlined text-primary text-lg">eco</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-on-surface text-sm">{{ $item['name'] ?? 'Crop Item' }}</h4>
                        <p class="text-xs text-on-surface-variant font-medium">{{ $item['quantity'] ?? 0 }} {{ $item['unit'] ?? 'kg' }}</p>
                    </div>
                    <p class="font-black text-on-surface text-sm">₹{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                    class="px-5 py-2.5 bg-primary text-white font-black text-[10px] rounded-xl uppercase tracking-widest shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">download</span> Download Invoice
                </a>
                <a href="{{ route('buyer.logistics') }}" class="px-5 py-2.5 bg-surface-container text-on-surface font-black text-[10px] rounded-xl uppercase tracking-widest hover:bg-stone-200 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">receipt_long</span> View Tracking
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white p-14 rounded-3xl border border-outline-variant/30 shadow-soft text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4 block">history</span>
            <h3 class="text-xl font-bold text-on-surface mb-2">No Completed Orders Yet</h3>
            <p class="text-on-surface-variant">Your completed and delivered orders will appear here.</p>
        </div>
    @endforelse
    <div class="mt-4">{{ $completedOrders->appends(['active_page' => request('active_page')])->links() }}</div>
</div>

</section>
</main>
@include('partials.buyer_footer')

@include('partials.live_notifications')

<script>
function switchTab(tab) {
    const panels = ['active', 'completed'];
    panels.forEach(p => {
        document.getElementById('panel-' + p).classList.add('hidden');
        const btn = document.getElementById('tab-' + p);
        btn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
        btn.classList.add('text-on-surface-variant');
    });
    document.getElementById('panel-' + tab).classList.remove('hidden');
    const activeBtn = document.getElementById('tab-' + tab);
    activeBtn.classList.add('bg-white', 'text-primary', 'shadow-sm');
    activeBtn.classList.remove('text-on-surface-variant');
}
</script>
</body>
</html>


