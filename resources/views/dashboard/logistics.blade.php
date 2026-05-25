<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect | Logistics & History</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="/js/tailwind.min.js"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary":                "#0d631b",
        "on-primary":             "#ffffff",
        "primary-container":      "#b2f2bb",
        "on-primary-container":   "#002108",
        "secondary":              "#506352",
        "on-secondary":           "#ffffff",
        "secondary-container":    "#d3e8d3",
        "on-secondary-container": "#0e1f10",
        "surface":                "#f8faf8",
        "on-surface":             "#1a1c1b",
        "surface-container-low":  "#f2f4f2",
        "surface-container-lowest":"#ffffff",
        "surface-container-high": "#e8eae8",
        "outline-variant":        "#c0c9c0",
        "outline":                "#70796f",
        "error":                  "#ba1a1a",
        "on-surface-variant":     "#404943",
      },
      fontFamily: {
        headline: ['"Plus Jakarta Sans"', 'sans-serif'],
        label: ['Manrope', 'sans-serif'],
      }
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
  .dark .border-outline-variant { border-color: #3a403a !important; }
  .dark input, .dark select, .dark textarea { background: #2a2e2a !important; color: #e2e8e2 !important; border-color: #3a403a !important; }

  .timeline-step { position: relative; }
  .timeline-step:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 15px;
    top: 32px;
    width: 2px;
    height: calc(100% - 8px);
    background: #c0c9c0;
  }
  .timeline-step.done::after { background: #0d631b; }
  .status-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 800;
    text-transform: uppercase; letter-spacing: .08em;
  }
  .badge-amber   { background: #fef3c7; color: #92400e; }
  .badge-blue    { background: #dbeafe; color: #1e40af; }
  .badge-purple  { background: #ede9fe; color: #5b21b6; }
  .badge-green   { background: #d1fae5; color: #065f46; }
</style>
</head>
<body class="min-h-screen">

@if(session('success'))
<div id="toast" class="fixed top-24 right-8 z-[200] bg-primary text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
    <span class="material-symbols-outlined">check_circle</span>
    <span class="font-bold">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-sm">close</span></button>
</div>
<script>setTimeout(()=>{ const t=document.getElementById('toast'); if(t){t.style.opacity='0'; setTimeout(()=>t.remove(),500);} }, 5000);</script>
@endif
@if(session('error'))
<div id="toast-err" class="fixed top-24 right-8 z-[200] bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
    <span class="material-symbols-outlined">error</span>
    <span class="font-bold">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-sm">close</span></button>
</div>
@endif
@if($errors->any())
<div id="toast-val" class="fixed top-24 right-8 z-[200] bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
    <span class="material-symbols-outlined">error</span>
    <span class="font-bold">{{ $errors->first() }}</span>
    <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-sm">close</span></button>
</div>
@endif

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
                <p class="text-[10px] text-stone-400 truncate">Verified Farmer</p>
            </div>
        </div>
        <button onclick="openAIInsights()" class="w-full py-3 bg-primary text-white rounded-xl flex items-center justify-center gap-2 font-bold transition-transform active:scale-95 shadow-lg shadow-primary/20 hover:bg-primary/90">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">psychology_alt</span>
            <span class="text-xs uppercase tracking-widest">AI Insights</span>
        </button>
    </div>
    <nav class="flex-1 space-y-2 px-4">
        <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span><span class="font-label text-sm">Dashboard</span>
        </a>
        <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.bids') }}">
            <span class="material-symbols-outlined">gavel</span><span class="font-label text-sm">Orders & Bids</span>
        </a>
        <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.crops') }}">
            <span class="material-symbols-outlined">inventory_2</span><span class="font-label text-sm">My Crops</span>
        </a>
        <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner" href="{{ route('farmer.logistics') }}">
            <span class="material-symbols-outlined">history</span><span class="font-label text-sm">Logistics & History</span>
        </a>
        <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all" href="{{ route('farmer.mandi') }}">
            <span class="material-symbols-outlined">store</span><span class="font-label text-sm">Mandi Prices</span>
        </a>
    </nav>
    <div class="px-4 mt-auto space-y-1 border-t border-white/5 pt-6">
        <a class="text-stone-400 hover:text-white hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-xl transition-all" href="{{ route('farmer.settings') }}">
            <span class="material-symbols-outlined text-sm">settings</span><span class="font-label text-xs">Settings</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
        <a class="text-stone-400 hover:text-red-400 hover:bg-red-500/10 px-4 py-3 flex items-center gap-3 rounded-xl transition-all cursor-pointer" onclick="document.getElementById('logout-form').submit()">
            <span class="material-symbols-outlined text-sm">logout</span><span class="font-label text-xs">Logout</span>
        </a>
    </div>
</aside>

<!-- Top Nav -->
<nav class="fixed top-0 left-64 right-0 z-50 bg-white/80 backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm">
    <div class="flex items-center gap-3">
        <h1 class="text-xl font-black tracking-tight">Logistics & History</h1>
    </div>
    <div class="flex items-center gap-4">
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
    </div>
</nav>

<!-- Main -->
<main class="lg:ml-64 pt-28 px-6 lg:px-10 pb-16">

    <!-- Header -->
    <div class="flex flex-wrap justify-between items-center gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-black tracking-tighter">Logistics & History</h2>
            <p class="text-on-surface-variant text-sm mt-1">Manage current shipments and review your delivery history</p>
        </div>
        <div class="flex items-center gap-3 text-sm">
            <span class="status-badge badge-amber">{{ $logistics->where('status','Pending Pickup')->count() }} Pending</span>
            <span class="status-badge badge-blue">{{ $logistics->where('status','Dispatched')->count() }} Dispatched</span>
            <span class="status-badge badge-purple" style="background:#f3e8ff; color:#6b21a8;">{{ $logistics->where('status','In Transit')->count() }} In Transit</span>
            <span class="status-badge badge-indigo" style="background:#e0e7ff; color:#3730a3;">{{ $logistics->where('status','Out for Delivery')->count() }} Out for Delivery</span>
            <span class="status-badge badge-green">{{ $logistics->where('status','Delivered')->count() }} Delivered</span>
        </div>
    </div>

    <!-- Shipment Cards -->
    @forelse($logistics as $item)
    @php
        $stages    = ['Pending Pickup','Dispatched','In Transit','Out for Delivery','Delivered'];
        $currIdx   = array_search($item->status, $stages);
        $isLast    = $currIdx === count($stages) - 1;
        $colorMap  = ['Pending Pickup'=>'amber','Dispatched'=>'blue','In Transit'=>'purple','Out for Delivery'=>'indigo','Delivered'=>'green'];
        $col       = $colorMap[$item->status] ?? 'stone';
    @endphp
    <div class="bg-white rounded-[2rem] shadow-xl shadow-stone-200/50 border border-stone-100 mb-8 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-primary/5 to-transparent p-6 border-b border-stone-100 flex flex-wrap justify-between items-start gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">{{ \App\Models\Logistics::statusIcon($item->status) }}</span>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="font-black text-lg">Order #{{ $item->tracking_number }}</h3>
                        <span class="status-badge badge-{{ $col }}">{{ $item->status }}</span>
                    </div>
                    <p class="text-sm text-on-surface-variant mt-0.5">{{ $item->crop_name }} • {{ $item->quantity }} {{ $item->unit }} • via {{ $item->provider }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Buyer</p>
                <p class="font-black">{{ $item->buyer_name }}</p>
                @if($item->eta)
                <p class="text-xs text-outline mt-1 italic">Est: {{ $item->eta }}</p>
                @endif
            </div>
        </div>

        <!-- Card Body: Timeline + Addresses + Actions -->
        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Timeline + History Log -->
            <div class="space-y-2">
                <h4 class="text-xs font-black uppercase tracking-widest text-on-surface-variant mb-4">Delivery Timeline</h4>
                @foreach($stages as $si => $stage)
                @php
                    $done = $si <= $currIdx;
                    // Find matching history entry for this stage
                    $historyEntry = collect($item->history ?? [])->firstWhere('status', $stage);
                @endphp
                <div class="timeline-step {{ $done ? 'done' : '' }} flex items-start gap-4 pb-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $done ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
                        @if($done)
                            <span class="material-symbols-outlined text-sm">check</span>
                        @else
                            <span class="text-xs font-black">{{ $si + 1 }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-sm {{ $done ? 'text-primary' : 'text-on-surface-variant' }}">{{ $stage }}</p>
                        @if($historyEntry)
                            <p class="text-xs text-on-surface-variant font-medium">
                                {{ \Carbon\Carbon::parse($historyEntry['timestamp'])->setTimezone('Asia/Kolkata')->format('d M Y, h:i A') }}
                            </p>
                            @if(!empty($historyEntry['description']))
                                <p class="text-xs text-outline">{{ $historyEntry['description'] }}</p>
                            @endif
                        @elseif($stage === $item->status && !$isLast)
                            <p class="text-xs text-on-surface-variant">← Current status</p>
                        @else
                            <p class="text-xs text-on-surface-variant/50">Pending</p>
                        @endif
                    </div>
                </div>
                @endforeach

                @if($item->order_id)
                <div class="pt-4 border-t border-stone-50 mt-4">
                    <a href="{{ route('orders.invoice', $item->order_id) }}" target="_blank" class="w-full py-3 px-4 bg-surface-container hover:bg-primary/5 text-primary rounded-xl flex items-center justify-center gap-2 font-bold text-xs transition-all border border-primary/10">
                        <span class="material-symbols-outlined text-sm">receipt_long</span>
                        DOWNLOAD INVOICE
                    </a>
                </div>
                @endif
            </div>

            <!-- Addresses -->
            <div class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-widest text-on-surface-variant">Route Info</h4>
                <div class="bg-surface-container-low rounded-2xl p-4 space-y-3">
                    <div>
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">where_to_vote</span> Pickup
                        </p>
                        <p class="text-sm font-medium">{{ $item->pickup_address ?? '—' }}</p>
                    </div>
                    <div class="border-t border-outline-variant/20 pt-3">
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-primary">location_on</span> Delivery
                        </p>
                        <p class="text-sm font-medium">{{ $item->delivery_address ?? '—' }}</p>
                    </div>
                    <div class="border-t border-outline-variant/20 pt-3">
                        <div id="map-{{ $item->id }}" class="w-full h-48 rounded-xl z-0 mt-2 bg-stone-200"></div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-widest text-on-surface-variant">Actions</h4>

                @if($isLast)
                    <!-- Delivered -->
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                        <span class="material-symbols-outlined text-green-600 text-4xl mb-2 block">verified</span>
                        <p class="font-black text-green-700">Delivered Successfully</p>
                        <p class="text-xs text-green-600 mt-1">OTP Verified • Order Completed</p>
                    </div>

                @elseif($item->status === 'Out for Delivery')
                    <!-- OTP Verification for Farmer -->
                    <div class="bg-primary/5 border border-primary/20 rounded-2xl p-5">
                        <p class="text-sm font-black text-primary uppercase tracking-widest mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">key</span> Verify Delivery
                        </p>
                        <p class="text-xs text-on-surface-variant mb-4">Enter the 6-digit OTP provided by the buyer to complete this delivery.</p>
                        
                        <div class="space-y-3">
                            <input type="text" id="otp-{{ $item->id }}" maxlength="6" class="w-full text-center text-2xl font-black tracking-[0.5em] bg-white border-2 border-primary/20 rounded-xl py-3 focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all" placeholder="000000">
                            <button onclick="verifyOrderOTP('{{ $item->id }}')" class="w-full py-4 bg-primary text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">verified</span> Confirm Delivery
                            </button>
                        </div>
                    </div>

                @else
                    <!-- Advance Stage -->
                    <div class="bg-surface-container-low rounded-2xl p-4">
                        <p class="text-sm font-bold mb-1">Next Stage</p>
                        @php $nextStage = $stages[$currIdx + 1] ?? null; @endphp
                        @if($nextStage)
                        <p class="text-xs text-on-surface-variant mb-3">Move this shipment to: <strong>{{ $nextStage }}</strong></p>
                        <form action="{{ route('logistics.next-stage', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-primary text-white rounded-xl font-black text-sm hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                Mark as {{ $nextStage }}
                            </button>
                        </form>
                        @endif
                    </div>
                @endif


            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-24 text-on-surface-variant">
        <span class="material-symbols-outlined text-6xl mb-4 block">local_shipping</span>
        <h3 class="text-xl font-black">No Shipments Yet</h3>
        <p class="text-sm mt-2">Your logistics records will appear here when buyers place orders.</p>
    </div>
    @endforelse

</main>

<!-- FarmBot partial -->
@include('partials.farmbot')

<script>
function openAIInsights() {
    const el = document.getElementById('farmbot-widget');
    if (el) el.classList.toggle('hidden');
}
// Dark mode
if (document.documentElement.classList.contains('dark')) {
    document.querySelectorAll('.bg-white').forEach(el => {
        if (!el.closest('img') && !el.closest('a')) el.classList.add('bg-[#252826]');
    });
}
</script>

@include('partials.live_notifications')

<script>
    function verifyOrderOTP(id) {
        const otp = document.getElementById(`otp-${id}`).value;
        if (otp.length < 4 || otp.length > 6) {
            window.showToast('Please enter a valid 4 to 6-digit OTP', 'error');
            return;
        }

        fetch(`/dashboard/logistics/${id}/verify-otp`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ otp: otp })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.showToast('Delivery verified successfully!', 'success');
                setTimeout(() => location.reload(), 1200);
            } else {
                window.showToast(data.message || 'Verification failed', 'error');
            }
        })
        .catch(err => {
            console.error('OTP Error:', err);
            window.showToast('An error occurred. Please try again.', 'error');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const pickupIcon = L.divIcon({
            className: 'pickup-marker',
            html: '<div class="w-8 h-8 bg-amber-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center text-white"><span class="material-symbols-outlined text-xs">store</span></div>',
            iconSize: [32, 32], iconAnchor: [16, 32]
        });

        const deliveryIcon = L.divIcon({
            className: 'delivery-marker',
            html: '<div class="w-8 h-8 bg-primary rounded-full border-4 border-white shadow-lg flex items-center justify-center text-white"><span class="material-symbols-outlined text-xs">location_on</span></div>',
            iconSize: [32, 32], iconAnchor: [16, 32]
        });

        @foreach($logistics as $item)
            @if($item->id)
                // Initialize map for order {{ $item->tracking_number }}
                setTimeout(() => {
                    const mapContainer = document.getElementById('map-{{ $item->id }}');
                    if(mapContainer) {
                        const map = L.map('map-{{ $item->id }}', {
                            zoomControl: false,
                            attributionControl: false,
                            dragging: false,
                            scrollWheelZoom: false
                        });

                        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                            maxZoom: 19
                        }).addTo(map);

                        const indianCities = {
                            'Delhi': [28.6139, 77.2090], 'Mumbai': [19.0760, 72.8777], 'Bangalore': [12.9716, 77.5946],
                            'Hyderabad': [17.3850, 78.4867], 'Chennai': [13.0827, 80.2707], 'Kolkata': [22.5726, 88.3639],
                            'Pune': [18.5204, 73.8567], 'Ahmedabad': [23.0225, 72.5714], 'Jaipur': [26.9124, 75.7873],
                            'Lucknow': [26.8467, 80.9462], 'Kanpur': [26.4499, 80.3319], 'Nagpur': [21.1458, 79.0882],
                            'Indore': [22.7196, 75.8577], 'Bhopal': [23.2599, 77.4126], 'Patna': [25.5941, 85.1376],
                            'Ludhiana': [30.9010, 75.8573], 'Agra': [27.1767, 78.0081], 'Nashik': [19.9975, 73.7898],
                            'Faridabad': [28.4089, 77.3178], 'Meerut': [28.9845, 77.7064], 'Rajkot': [22.3039, 70.8022],
                            'Varanasi': [25.3176, 82.9739], 'Srinagar': [34.0837, 74.7973], 'Aurangabad': [19.8762, 75.3433],
                            'Amritsar': [31.6340, 74.8723], 'Jodhpur': [26.2389, 73.0243], 'Raipur': [21.2514, 81.6296],
                            'Gwalior': [26.2124, 78.1772], 'Vijayawada': [16.5062, 80.6480], 'Madurai': [9.9252, 78.1198],
                        };

                        const pickupCity = '{{ $item->pickup_address }}';
                        const deliveryCity = '{{ $item->delivery_address }}';

                        const getCoords = (city, seed) => {
                            if (indianCities[city]) return indianCities[city];
                            return [22.0 + (seed % 5), 77.0 + (seed % 6)];
                        };

                        const hash = '{{ $item->id }}'.split('').reduce((a,b)=>{a=((a<<5)-a)+b.charCodeAt(0);return a&a},0);
                        const seed = Math.abs(hash);

                        const pickupCoords = getCoords(pickupCity, seed);
                        const deliveryCoords = [
                            getCoords(deliveryCity, seed + 1)[0] + 0.1, 
                            getCoords(deliveryCity, seed + 1)[1] + 0.1
                        ];

                        L.marker(pickupCoords, {icon: pickupIcon}).addTo(map);
                        L.marker(deliveryCoords, {icon: deliveryIcon}).addTo(map);

                        const route = L.polyline([pickupCoords, deliveryCoords], {
                            color: '#2E7D32',
                            weight: 3,
                            dashArray: '10, 10',
                            opacity: 0.5
                        }).addTo(map);

                        map.fitBounds(route.getBounds(), { padding: [30, 30] });

                        // Animated Truck Marker
                        const isDone = '{{ $item->status }}' === 'Delivered';
                        if (!isDone) {
                            const truckIcon = L.divIcon({
                                className: 'truck-icon',
                                html: `<div class="bg-primary text-white w-6 h-6 rounded-full flex items-center justify-center shadow-lg border-2 border-white rotate-90">🚛</div>`,
                                iconSize: [24, 24]
                            });

                            const truckMarker = L.marker(pickupCoords, { icon: truckIcon, zIndexOffset: 1000 }).addTo(map);

                            let progress = 0;
                            const statusWeights = { 'Pending Pickup': 0.1, 'Dispatched': 0.3, 'In Transit': 0.6, 'Out for Delivery': 0.9 };
                            const targetProgress = statusWeights['{{ $item->status }}'] || 0.5;

                            function animateTruck() {
                                progress += 0.002;
                                if (progress > targetProgress) progress = targetProgress;

                                const lat = pickupCoords[0] + (deliveryCoords[0] - pickupCoords[0]) * progress;
                                const lng = pickupCoords[1] + (deliveryCoords[1] - pickupCoords[1]) * progress;
                                
                                truckMarker.setLatLng([lat, lng]);

                                if (progress < targetProgress) {
                                    requestAnimationFrame(animateTruck);
                                }
                            }
                            animateTruck();
                        }
                    }
                }, 100);
            @endif
        @endforeach
    });
</script>
</body>
</html>
