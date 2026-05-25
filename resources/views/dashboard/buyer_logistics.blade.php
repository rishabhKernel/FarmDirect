<!DOCTYPE html>

<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Logistics & Tracking - FarmDirect</title>
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
        .status-badge {
            @apply px-3 py-1 text-[10px] font-black rounded-lg uppercase tracking-widest;
        }
        .badge-green { @apply bg-primary/10 text-primary; }
        .badge-amber { @apply bg-amber-100 text-amber-700; }
        .badge-blue { @apply bg-blue-100 text-blue-700; }
        .badge-purple { @apply bg-purple-100 text-purple-700; }
        .badge-stone { @apply bg-surface-container text-on-surface-variant; }
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
<a class="flex items-center gap-4 px-4 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20" href="{{ route('buyer.logistics') }}">
<span class="material-symbols-outlined fill-icon">local_shipping</span>
<span class="text-sm">Logistics & Tracking</span>
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
    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Logistics & Tracking</h1>
    <p class="text-on-surface-variant font-medium max-w-2xl">Track your orders from farm to warehouse. Share the OTP with the delivery partner when they arrive.</p>
</header>

<div class="space-y-8">
    @forelse($logistics ?? [] as $item)
        @php
            $stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
            $currIdx = array_search($item->status, $stages);
            if ($currIdx === false) $currIdx = 0; // fallback to first step
            $isLast = ($item->status === 'Delivered');
            $isCancelled = ($item->status === 'Cancelled');
            
            $col = 'stone';
            if($item->status === 'Dispatched') $col = 'blue';
            if($item->status === 'In Transit') $col = 'amber';
            if($item->status === 'Out for Delivery') $col = 'purple';
            if($isLast) $col = 'green';
            if($isCancelled) $col = 'red';
        @endphp
        <div class="bg-white rounded-3xl border border-outline-variant/30 shadow-soft overflow-hidden">
            <!-- Card Header -->
            <div class="p-6 border-b border-outline-variant/20 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-surface-container/30">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-2xl">local_shipping</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-black text-lg">Order #{{ $item->tracking_number }}</h3>
                            <span class="status-badge badge-{{ $col }}">{{ $item->status }}</span>
                        </div>
                        <p class="text-sm text-on-surface-variant mt-0.5">{{ $item->crop_name }} • {{ $item->quantity }} {{ $item->unit }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Farmer</p>
                    <p class="font-black">{{ $item->farmer_name ?? 'Vendor' }}</p>
                    @if($item->eta)
                    <p class="text-xs text-outline mt-1">ETA: {{ $item->eta }}</p>
                    @endif
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Timeline -->
                <div class="space-y-2">
                    <h4 class="text-xs font-black uppercase tracking-widest text-on-surface-variant mb-4">Delivery Timeline</h4>
                    @foreach($stages as $si => $stage)
                    @php
                        $done = $si <= $currIdx;
                        $historyEntry = collect($item->history ?? [])->firstWhere('status', $stage);
                    @endphp
                    <div class="flex items-start gap-4 pb-4 relative">
                        @if($si < count($stages) - 1)
                        <div class="absolute left-4 top-8 bottom-0 w-0.5 {{ $done ? 'bg-primary/30' : 'bg-surface-container-high' }}"></div>
                        @endif
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $done ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface-variant' }}">
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
                                <p class="text-xs text-on-surface-variant">Current status</p>
                            @else
                                <p class="text-xs text-on-surface-variant/40">Pending</p>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    @if($item->order_id)
                    <div class="pt-4 border-t border-stone-100 mt-4">
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
                    <div class="bg-surface-container/50 rounded-2xl p-4 space-y-3">
                        <div>
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">where_to_vote</span> Pickup (Farmer Location)
                            </p>
                            <p class="text-sm font-medium">{{ $item->pickup_address ?? '—' }}</p>
                        </div>
                        <div class="border-t border-outline-variant/20 pt-3">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-primary">location_on</span> Delivery (Buyer Location)
                            </p>
                            <p class="text-sm font-medium">{{ $item->delivery_address ?? '—' }}</p>
                        </div>
                        <div class="border-t border-outline-variant/20 pt-3">
                            <div id="map-{{ $item->id }}" class="w-full h-48 rounded-xl z-0 mt-2 bg-stone-200"></div>
                        </div>
                    </div>
                </div>

                <!-- OTP & Actions -->
                <div class="space-y-4">
                    <h4 class="text-xs font-black uppercase tracking-widest text-on-surface-variant">Actions</h4>

                    @if($isLast)
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                            <span class="material-symbols-outlined text-green-600 text-4xl mb-2 block">verified</span>
                            <p class="font-black text-green-700">Delivered Successfully</p>
                        </div>
                    @elseif($item->status === 'Out for Delivery')
                        <div class="bg-purple-50 border border-purple-200 rounded-2xl p-4 text-center">
                            <div class="flex items-center gap-2 justify-center mb-3">
                                <span class="material-symbols-outlined text-purple-600">lock</span>
                                <p class="font-black text-purple-700">Your Delivery OTP</p>
                            </div>
                            <p class="text-2xl font-black text-purple-600 tracking-[0.2em] mb-2">{{ $item->delivery_otp ?? 'N/A' }}</p>
                            <p class="text-xs text-purple-600">Share this OTP with the delivery partner to confirm receipt.</p>
                        </div>
                    @else
                        <div class="bg-surface-container/50 rounded-2xl p-4 text-center">
                            <span class="material-symbols-outlined text-on-surface-variant text-4xl mb-2 block">hourglass_empty</span>
                            <p class="font-bold text-on-surface">Tracking Active</p>
                            <p class="text-xs text-on-surface-variant mt-1">Updates will appear here as the shipment moves.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white p-12 rounded-3xl border border-outline-variant/30 shadow-soft text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">local_shipping</span>
            <h3 class="text-xl font-bold text-on-surface mb-2">No active shipments</h3>
            <p class="text-on-surface-variant">Your tracking records will appear here when orders are processed.</p>
            <a href="{{ route('buyer.discover') }}" class="mt-4 inline-block bg-primary text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Go to Marketplace</a>
        </div>
    @endforelse
</div>
</section>
</main>
@include('partials.buyer_footer')

@include('partials.live_notifications')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($logistics ?? [] as $item)
            @if($item->id)
                // Initialize map for order {{ $item->tracking_number }}
                setTimeout(() => {
                    const mapContainer = document.getElementById('map-{{ $item->id }}');
                    if(mapContainer) {
                        // Realistic Geocoding Simulation for Indian Cities
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

                        // Default to random offset if city not found
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

                        const map = L.map('map-{{ $item->id }}', {
                            zoomControl: false,
                            attributionControl: false,
                            dragging: false,
                            scrollWheelZoom: false
                        });

                        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                            maxZoom: 19
                        }).addTo(map);

                        const pickupIcon = L.divIcon({
                            className: 'custom-div-icon',
                            html: `<div class='w-8 h-8 bg-stone-800 text-white rounded-full flex items-center justify-center border-2 border-white shadow-lg'><span class="material-symbols-outlined text-[16px]">storefront</span></div>`,
                            iconSize: [32, 32],
                            iconAnchor: [16, 16]
                        });
                        
                        const deliveryIcon = L.divIcon({
                            className: 'custom-div-icon',
                            html: `<div class='w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center border-2 border-white shadow-lg'><span class="material-symbols-outlined text-[16px]">home</span></div>`,
                            iconSize: [32, 32],
                            iconAnchor: [16, 16]
                        });

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
                                html: `<div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg border-2 border-white rotate-90">🚛</div>`,
                                iconSize: [32, 32]
                            });

                            const truckMarker = L.marker(pickupCoords, { icon: truckIcon }).addTo(map);

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
</body></html>
