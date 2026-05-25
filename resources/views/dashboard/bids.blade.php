<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Active Bids - FarmDirect</title>
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
    <!-- Top Navigation Bar -->
    <nav class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm bg-white/80">
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <form action="{{ route('farmer.bids') }}" method="GET">
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-48" name="search" value="{{ request('search') }}" placeholder="Search bids..." type="text" />
                </form>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('farmer.notifications') }}" class="p-2 hover:bg-white/40 rounded-full transition-all active:scale-90 relative text-green-800">
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
    </nav>

    <div class="flex min-h-screen">
        <!-- Side Navigation Bar -->
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
                <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                    href="{{ route('farmer.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label text-sm">Dashboard</span>
                </a>
                <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner"
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

        <!-- Main Content Area -->
        <main class="flex-grow min-h-screen bg-surface-container-low p-6 md:p-12 ml-0 lg:ml-64 mt-20">
            <div class="max-w-5xl mx-auto">
                <!-- Header Section -->
                <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Orders & Bids</h1>
                        <p class="text-on-surface-variant font-medium max-w-2xl">Manage all your incoming orders and active bids in one place.</p>
                    </div>
                </header>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-primary/10 border border-primary/20 rounded-2xl text-primary font-bold flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Active Orders Section -->
                <div class="mb-16">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">shopping_bag</span>
                        <h2 class="text-2xl font-black text-on-surface tracking-tight">Active Orders</h2>
                    </div>
                    
                    <div class="space-y-6">
                        @forelse($activeOrders as $order)
                            @php
                                $statusMap = [
                                    'pending'    => ['label' => 'Awaiting Acceptance', 'color' => 'bg-amber-100 text-amber-700'],
                                    'processing' => ['label' => 'Accepted / Dispatched', 'color' => 'bg-blue-100 text-blue-700'],
                                    'in_transit' => ['label' => 'In Transit', 'color' => 'bg-purple-100 text-purple-700'],
                                ];
                                $st = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'color' => 'bg-stone-100 text-stone-700'];
                                $items = $order->items ?? [];
                                $itemCount = count($items);
                                $orderTitle = $itemCount > 1 ? $itemCount . ' Items' : ($items[0]['name'] ?? 'Order');
                            @endphp
                            <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/10">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 rounded-xl bg-primary/10 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-primary">shopping_basket</span>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3 mb-1">
                                                <h3 class="font-black text-on-surface text-xl">{{ $orderTitle }}</h3>
                                                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $st['color'] }}">{{ $st['label'] }}</span>
                                            </div>
                                            <p class="text-on-surface-variant text-sm font-medium">Order #{{ $order->order_number }}</p>
                                            <p class="text-on-surface-variant text-xs mt-1 italic">Buyer: <span class="font-bold text-primary">{{ $order->buyer->name ?? 'Buyer' }}</span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col items-end gap-3 w-full md:w-auto">
                                        <div class="text-right">
                                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Amount</p>
                                            <p class="text-2xl font-black text-primary">₹{{ number_format($order->total_price, 0) }}</p>
                                        </div>
                                        
                                        <div class="flex gap-2 w-full md:w-auto">
                                            @if($order->status === 'pending')
                                                <form action="{{ route('orders.accept', $order->id) }}" method="POST" class="flex flex-col gap-2 w-full md:w-64">
                                                    @csrf
                                                    <div class="relative">
                                                        <input type="date" name="delivery_date" required min="{{ date('Y-m-d') }}" 
                                                            class="w-full px-4 py-2 bg-white border border-outline-variant/30 rounded-xl text-xs font-bold focus:ring-primary focus:border-primary">
                                                        <span class="absolute -top-2 left-3 bg-white px-1 text-[8px] font-black uppercase tracking-widest text-on-surface-variant/60">EST. DELIVERY</span>
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button type="submit" class="flex-1 px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-[11px] font-black uppercase tracking-wider shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Accept & Dispatch</button>
                                                        <button type="submit" form="reject-form-{{ $order->id }}" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-[11px] font-black uppercase tracking-wider hover:bg-red-500 hover:text-white transition-all">Reject</button>
                                                    </div>
                                                </form>
                                                <form action="{{ route('orders.reject', $order->id) }}" method="POST" id="reject-form-{{ $order->id }}" class="hidden">
                                                    @csrf
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
                                                    
                                                    $statusColor = $order->status === 'completed' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-blue-50 text-blue-700 border-blue-200';
                                                @endphp
                                                <div class="px-6 py-2 {{ $statusColor }} border rounded-xl font-bold text-sm text-center w-full">
                                                    {{ $statusLabel }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-surface-container-low/30 border-2 border-dashed border-outline-variant/30 p-12 rounded-2xl text-center">
                                <span class="material-symbols-outlined text-4xl text-outline-variant mb-3 block">inbox</span>
                                <p class="text-on-surface-variant font-medium">No active orders at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Active Bids Section -->
                <div class="mb-12 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">gavel</span>
                        <h2 class="text-2xl font-black text-on-surface tracking-tight">Active Bids</h2>
                    </div>
                    <button onclick="clearRejectedBids()" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">history</span>
                        Clear Log
                    </button>
                </div>

                <!-- Bids List -->
                <div class="space-y-6">
                    @forelse($bids as $bid)
                        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 border border-outline-variant/10" id="bid-{{ $bid->id }}">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 rounded-xl bg-secondary-fixed flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                                </div>
                                <div class="flex-grow">
                                    <h3 class="font-bold text-on-surface text-lg">₹{{ number_format($bid->amount) }} / quintal</h3>
                                    <p class="text-on-surface-variant text-sm">For: <span class="font-bold">{{ $bid->crop->name ?? 'Unknown Crop' }}</span></p>
                                    <p class="text-on-surface-variant text-sm mt-1">Buyer: <span class="font-bold text-primary">{{ $bid->buyer->name ?? 'Buyer' }}</span></p>
                                    <p class="text-on-surface-variant text-xs mt-1">Quantity Requested: <span class="font-bold">{{ $bid->crop->quantity ?? 100 }} {{ $bid->crop->unit ?? 'kg' }}</span></p>
                                    <p class="text-on-surface-variant text-xs mt-1">Message: "{{ $bid->message }}"</p>
                                    @if($bid->counter_amount)
                                        <p class="text-primary text-xs mt-1 font-bold">Counter Offer: ₹{{ number_format($bid->counter_amount) }}</p>
                                    @endif
                                    <p class="text-outline text-xs mt-1">Status: <span class="font-bold uppercase">{{ $bid->status }}</span></p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-xs font-label text-outline uppercase tracking-widest">{{ $bid->created_at->diffForHumans() }}</span>
                                <div class="flex gap-2">
                                    @if($bid->status === 'pending' || $bid->status === 'negotiating')
                                        <button onclick="acceptBid('{{ $bid->id }}')" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Accept</button>
                                        <button onclick="rejectBid('{{ $bid->id }}')" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors">Reject</button>
                                        <button onclick="openNegotiateModal('{{ $bid->id }}', '{{ $bid->amount }}')" class="px-4 py-2 bg-secondary text-on-secondary rounded-xl font-label text-sm font-bold hover:bg-secondary/90 transition-colors">Negotiate</button>
                                    @else
                                        <span class="px-4 py-2 bg-surface-container text-on-surface-variant rounded-xl font-label text-sm font-bold uppercase">{{ $bid->status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest p-12 rounded-xl shadow-sm text-center">
                            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">gavel</span>
                            <h3 class="text-xl font-bold text-on-surface mb-2">No Active Bids</h3>
                            <p class="text-on-surface-variant">When buyers bid on your crops, they will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

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
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center pt-12 border-t border-white/10 max-w-[1920px] mx-auto relative z-10">
            <p class="text-sm font-bold text-white/50">© 2026 FarmDirect. Cultivating Digital Transparency.</p>
        </div>
    </footer>
    <!-- Negotiate Modal -->
    <div id="negotiate-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-on-surface mb-4">Negotiate Bid</h3>
            <form id="negotiate-form">
                @csrf
                <input type="hidden" id="negotiate-bid-id" />
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Original Bid</label>
                    <input type="text" id="original-amount" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" readonly />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Counter Offer (₹/quintal)</label>
                    <input type="number" id="counter-amount" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="Enter counter amount" required />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Message</label>
                    <textarea id="negotiate-message" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="Reason for counter offer..." rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeNegotiateModal()" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Send Counter Offer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function clearRejectedBids() {
            fetch('/dashboard/farmer/bids/clear-rejected', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function showToast(message, type = 'success') {
            const colors = { success: 'bg-primary', error: 'bg-red-500', info: 'bg-blue-500' };
            const toast = document.createElement('div');
            toast.className = `fixed bottom-6 right-6 z-[200] ${colors[type] || colors.success} text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-2xl flex items-center gap-3 transition-all`;
            toast.innerHTML = `<span class="material-symbols-outlined text-base">${ type === 'error' ? 'error' : 'check_circle' }</span>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 2500);
        }

        function acceptBid(id) {
            fetch(`/dashboard/farmer/bids/${id}/accept`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Bid accepted successfully! 🎉', 'success');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    showToast(data.message || 'Something went wrong.', 'error');
                }
            });
        }

        function rejectBid(id) {
            fetch(`/dashboard/farmer/bids/${id}/reject`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Bid rejected.', 'info');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    showToast(data.message || 'Something went wrong.', 'error');
                }
            });
        }

        function openNegotiateModal(id, amount) {
            document.getElementById('negotiate-bid-id').value = id;
            document.getElementById('original-amount').value = `₹${amount}`;
            document.getElementById('negotiate-modal').classList.remove('hidden');
        }

        function closeNegotiateModal() {
            document.getElementById('negotiate-modal').classList.add('hidden');
        }

        document.getElementById('negotiate-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('negotiate-bid-id').value;
            const counter_amount = document.getElementById('counter-amount').value;
            const message = document.getElementById('negotiate-message').value;

            fetch(`/dashboard/farmer/bids/${id}/negotiate`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    counter_amount: counter_amount,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.showToast('Counter offer sent!', 'success');
                    setTimeout(() => location.reload(), 1200);
                }
            });
        });
    </script>
    @include('partials.aimodal')
    @include('partials.farmbot')
</body>
</html>
