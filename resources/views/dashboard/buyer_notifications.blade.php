<!DOCTYPE html>

<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect | Buyer Notifications</title>
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
<div class="flex items-center gap-3 pr-2 border-r border-outline-variant/30">
                <a href="{{ route('buyer.notifications') }}" class="p-2 bg-primary/10 rounded-full transition-all text-primary relative">
                    <span class="material-symbols-outlined fill-icon">notifications</span>
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
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined group-hover:fill-icon">history</span>
<span class="font-bold text-sm">Orders & History</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.account') }}">
<span class="material-symbols-outlined group-hover:fill-icon">account_circle</span>
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
            <div class="w-10 h-10 bg-[#8D6E63] rounded-xl flex items-center justify-center text-white">
                <span class="material-symbols-outlined fill-icon text-xl">auto_awesome</span>
            </div>
            <span class="px-3 py-1 bg-[#F1E4D3] text-[#8D6E63] text-[10px] font-black rounded-lg uppercase tracking-widest">AI Insights</span>
        </div>
        
        <div class="space-y-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Organic Tomatoes</p>
                    <p class="text-lg font-black text-on-surface">₹40/q</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Suggested Bid</p>
                    <p class="text-lg font-black text-primary">₹42.4</p>
                </div>
            </div>
            <div class="flex items-center justify-between border-t border-[#EEDCC5] pt-4">
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Alphonso Mangoes</p>
                    <p class="text-lg font-black text-on-surface">₹150/q</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Suggested Bid</p>
                    <p class="text-lg font-black text-primary">₹166.5</p>
                </div>
            </div>
            <div class="flex items-center justify-between border-t border-[#EEDCC5] pt-4">
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Red Onions</p>
                    <p class="text-lg font-black text-on-surface">₹25/q</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Suggested Bid</p>
                    <p class="text-lg font-black text-primary">₹25.75</p>
                </div>
            </div>
        </div>
        
        <a href="{{ route('buyer.discover') }}" class="w-full bg-[#8D6E63] text-white py-3 rounded-xl font-extrabold text-xs hover:bg-[#7B5E55] transition-all flex items-center justify-center gap-2">
            EXPLORE MARKETPLACE
            <span class="material-symbols-outlined text-xs">arrow_forward</span>
        </a>
    </div>
</div>
</aside>
    <!-- Main Content Area -->
    <section class="flex-1">
        <header class="mb-12">
            <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Alerts Center</p>
            <h1 class="text-7xl md:text-8xl font-extrabold tracking-tight text-on-surface mb-4 font-headline leading-none">
                Noti<span class="text-primary">fications.</span>
            </h1>
            <p class="text-on-surface-variant font-medium text-lg max-w-2xl opacity-70">Your consolidated feed for procurement updates and market intelligence.</p>
        </header>

        <!-- Filters/Tabs -->
        <div class="flex flex-wrap gap-4 mb-12">
            <button onclick="filterNotifications('all', this)" class="filter-btn px-8 py-3 bg-on-surface text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-stone-200 active-filter">All Updates</button>
            <button onclick="filterNotifications('price_alert', this)" class="filter-btn px-8 py-3 bg-white text-on-surface-variant border border-outline-variant/30 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-surface-container transition-all">Price Alerts</button>
            <button onclick="filterNotifications('order', this)" class="filter-btn px-8 py-3 bg-white text-on-surface-variant border border-outline-variant/30 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-surface-container transition-all">Procurements</button>
            <button onclick="filterNotifications('system', this)" class="filter-btn px-8 py-3 bg-white text-on-surface-variant border border-outline-variant/30 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-surface-container transition-all">System</button>
        </div>

        <!-- Notification Feed -->
        <div class="space-y-6">
            @forelse($notifications as $notification)
                <div class="notification-card bg-white p-8 rounded-[2.5rem] border border-outline-variant/30 shadow-soft hover:shadow-premium transition-all flex flex-col md:flex-row items-start md:items-center justify-between gap-8 relative group overflow-hidden" id="notif-{{ $notification->id }}" data-type="{{ $notification->type }}">
                    @if(!$notification->is_read)
                        <div class="absolute top-0 left-0 w-2 h-full bg-primary" id="bar-{{ $notification->id }}"></div>
                    @endif
                    
                    <div class="flex items-start md:items-center gap-6 flex-1">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 shadow-inner
                            @if($notification->type == 'price_alert') bg-amber-50 text-amber-600 border border-amber-100/50
                            @elseif($notification->type == 'order') bg-primary/5 text-primary border border-primary/10
                            @elseif($notification->type == 'system') bg-blue-50 text-blue-600 border border-blue-100/50
                            @else bg-surface-container text-on-surface-variant border border-outline-variant/20 @endif">
                            <span class="material-symbols-outlined text-3xl @if($notification->type == 'order') fill-icon @endif">
                                @if($notification->type == 'price_alert') trending_up
                                @elseif($notification->type == 'order') shopping_cart_checkout
                                @elseif($notification->type == 'system') priority_high
                                @else notifications @endif
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-1">
                                <h3 class="font-black text-on-surface text-xl tracking-tight">{{ $notification->title }}</h3>
                                @if(!$notification->is_read)
                                    <span class="px-2 py-0.5 bg-primary text-white text-[9px] font-black rounded uppercase tracking-tighter animate-pulse" id="label-{{ $notification->id }}">New</span>
                                @endif
                            </div>
                            <p class="text-on-surface-variant/80 font-medium text-sm leading-relaxed mb-3">{{ $notification->message }}</p>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-xs text-on-surface-variant/40">schedule</span>
                                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <span class="w-1 h-1 bg-outline-variant/20 rounded-full"></span>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-xs text-on-surface-variant/40">label</span>
                                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest">{{ str_replace('_', ' ', $notification->type ?? 'General Alert') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full md:w-auto shrink-0">
                        @if(!$notification->is_read)
                        <button onclick="markRead('{{ $notification->id }}')" id="btn-read-{{ $notification->id }}" class="flex-1 md:flex-none px-6 py-3 bg-primary text-white font-black text-xs rounded-xl hover:bg-green-800 transition-all shadow-lg shadow-primary/20">Mark as Read</button>
                        @endif
                        <button onclick="deleteNotif('{{ $notification->id }}')" class="w-12 h-12 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-xl transition-all border border-outline-variant/20 hover:border-red-100 group/del">
                            <span class="material-symbols-outlined text-xl group-hover/del:fill-icon">delete</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[3rem] p-24 text-center border-2 border-dashed border-outline-variant/20 shadow-soft">
                    <div class="w-24 h-24 bg-surface-container rounded-[2rem] flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <span class="material-symbols-outlined text-5xl text-on-surface-variant/20">notifications_paused</span>
                    </div>
                    <h3 class="text-3xl font-black text-on-surface mb-3 tracking-tighter">Quiet on the Market.</h3>
                    <p class="text-on-surface-variant font-medium text-base max-w-sm mx-auto opacity-60">Your intelligence feed is currently empty. We'll alert you as soon as market conditions shift.</p>
                </div>
            @endforelse
        </div>
    </section>
</main>

@include('partials.buyer_footer')

<script>
        function filterNotifications(type, btn) {
            // Update button styles
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-on-surface', 'text-white', 'shadow-xl', 'shadow-stone-200');
                b.classList.add('bg-white', 'text-on-surface-variant');
            });
            btn.classList.remove('bg-white', 'text-on-surface-variant');
            btn.classList.add('bg-on-surface', 'text-white', 'shadow-xl', 'shadow-stone-200');

            const cards = document.querySelectorAll('.notification-card');
            cards.forEach(card => {
                if (type === 'all' || card.getAttribute('data-type') === type) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }

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
                    const bar = document.getElementById(`bar-${id}`);
                    if (bar) bar.remove();
                    const label = document.getElementById(`label-${id}`);
                    if (label) label.remove();
                    const btn = document.getElementById(`btn-read-${id}`);
                    if (btn) {
                        btn.style.opacity = '0';
                        btn.style.transform = 'scale(0.9)';
                        setTimeout(() => btn.remove(), 400);
                    }
                }
            });
        }

        function deleteNotif(id) {
            if(!confirm('Are you sure you want to permanently remove this alert?')) return;
            
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
                    if (card) {
                        card.style.opacity = '0';
                        card.style.transform = 'translateX(100px)';
                        setTimeout(() => card.remove(), 400);
                    }
                }
            });
        }
    </script>
</body>
</html>
