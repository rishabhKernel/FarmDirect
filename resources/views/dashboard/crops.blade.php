<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Crops & AI Insights | FarmDirect</title>
    <script src="/js/tailwind.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d631b',
                        secondary: '#75584d',
                        surface: '#fcfaf7',
                        'on-surface': '#1c1b18',
                        'surface-container': '#f3f0ea',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        manrope: ['Manrope', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-surface font-sans text-on-surface selection:bg-primary/10 selection:text-primary">
    <!-- TopNavBar -->
    <nav
        class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm">
        <div class="flex items-center gap-4">
            <!-- Removed redundant label -->
        </div>
        <div class="flex items-center gap-4">
            <div
                class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <form action="{{ route('farmer.crops') }}" method="GET">
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-48" name="search"
                        value="{{ request('search') }}" placeholder="Search your inventory..." type="text" />
                </form>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('farmer.notifications') }}" class="p-2 hover:bg-white/40 rounded-full transition-all active:scale-90 relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
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

    <!-- SideNavBar -->
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
            <a class="text-stone-400 hover:text-white hover:bg-white/5 rounded-xl flex items-center gap-3 px-4 py-3 font-medium transition-all"
                href="{{ route('farmer.bids') }}">
                <span class="material-symbols-outlined">gavel</span>
                <span class="font-label text-sm">Orders & Bids</span>
            </a>
            <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner"
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
                <span class="material-symbols-outlined text-sm text-stone-400">settings</span>
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

    <main class="lg:ml-64 pt-32 pb-20 px-8 max-w-[1440px] mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <span class="text-primary font-black text-xs tracking-[0.3em] uppercase mb-4 block opacity-80">Inventory
                    Management</span>
                <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-none">My Crops & <br /><span
                        class="text-primary italic">AI Insights</span></h1>
                <p class="text-on-surface-variant mt-6 max-w-xl font-medium leading-relaxed text-lg">Manage your active
                    listings, monitor price predictions, and optimize your harvest value with our AI-driven marketplace
                    insights.</p>
            </div>
            <button onclick="openCropModal()"
                class="bg-primary text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-primary/20 hover:shadow-primary/40 transition-all hover:-translate-y-1 active:translate-y-0 flex items-center gap-3">
                <span class="material-symbols-outlined">add</span>
                Add New Harvest
            </button>
        </div>

        <!-- New Filters Section from Image 1 -->
        <form action="{{ route('farmer.crops') }}" method="GET" id="filter-form" class="bg-white p-5 rounded-3xl border border-outline-variant/30 shadow-soft mb-12">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Search Input -->
                <div class="w-full md:flex-1 flex items-center gap-3 px-5 py-3 bg-surface-container rounded-2xl border border-transparent hover:border-primary/20 transition-all">
                    <span class="material-symbols-outlined text-outline text-xl">search</span>
                    <input type="text" name="search" placeholder="Search your inventory..." class="border-none p-0 text-sm font-bold focus:ring-0 bg-transparent flex-1" value="{{ request('search') }}"/>
                </div>
                
                <!-- Category Dropdown -->
                <div class="w-full md:w-auto flex items-center gap-3 px-5 py-3 bg-surface-container rounded-2xl border border-transparent hover:border-primary/20 transition-all cursor-pointer">
                    <select name="category" class="border-none p-0 text-sm font-bold focus:ring-0 bg-transparent">
                        <option value="">All Categories</option>
                        <option value="Cereal" {{ request('category') == 'Cereal' ? 'selected' : '' }}>Cereal</option>
                        <option value="Pulse" {{ request('category') == 'Pulse' ? 'selected' : '' }}>Pulse</option>
                        <option value="Vegetable" {{ request('category') == 'Vegetable' ? 'selected' : '' }}>Vegetable</option>
                        <option value="Fruit" {{ request('category') == 'Fruit' ? 'selected' : '' }}>Fruit</option>
                        <option value="Spice" {{ request('category') == 'Spice' ? 'selected' : '' }}>Spice</option>
                        <option value="Oilseed" {{ request('category') == 'Oilseed' ? 'selected' : '' }}>Oilseed</option>
                        <option value="CashCrop" {{ request('category') == 'CashCrop' ? 'selected' : '' }}>Cash Crop</option>
                    </select>
                </div>
                
                <!-- Search Button -->
                <button type="submit" class="w-full md:w-auto bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg shadow-primary/20 flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm">search</span>
                    <span>Search</span>
                </button>
            </div>
            
            <!-- Chips -->
            <div class="flex flex-wrap gap-2 mt-4">
                <button type="button" onclick="setCategory('Cereal')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Cereal</button>
                <button type="button" onclick="setCategory('Pulse')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Pulse</button>
                <button type="button" onclick="setCategory('Vegetable')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Vegetable</button>
                <button type="button" onclick="setCategory('Fruit')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Fruit</button>
                <button type="button" onclick="setCategory('Spice')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Spice</button>
                <button type="button" onclick="setCategory('Oilseed')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Oilseed</button>
                <button type="button" onclick="setCategory('CashCrop')" class="px-4 py-1.5 bg-surface-container text-on-surface-variant text-xs font-bold rounded-full hover:bg-primary/10 hover:text-primary transition-all">Cash Crop</button>
            </div>
            
            <!-- Footnote -->
            <div class="mt-3 text-[10px] font-medium text-on-surface-variant/60 flex justify-between items-center">
                <span>All prices in ₹ per Quintal (100 kg) · Sourced from AGMARKNET India</span>
                <span class="font-black uppercase tracking-widest text-xs">Active Listings: {{ $crops->count() }}</span>
            </div>
        </form>

        <!-- Crops Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($crops as $crop)
                <div
                    class="group glass-card rounded-[2.5rem] overflow-hidden border-0 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        @include('partials.crop_image', ['crop' => $crop, 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110'])
                        <div class="absolute inset-0 bg-gradient-to-t from-on-surface/80 via-transparent to-transparent">
                        </div>

                        <div class="absolute top-4 left-4 flex gap-2">
                            @if($crop->is_organic)
                                <span
                                    class="bg-primary/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Organic</span>
                            @endif
                            <span
                                class="bg-white/90 backdrop-blur-md text-on-surface text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg border border-white/20">{{ $crop->category }}</span>
                        </div>

                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="flex justify-between items-end">
                                <div>
                                    <h3 class="text-white text-2xl font-black tracking-tight leading-none mb-2">
                                        {{ $crop->name }}</h3>
                                    <p class="text-white/70 text-xs font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[10px]">calendar_today</span>
                                        Harvested: {{ \Carbon\Carbon::parse($crop->harvest_date)->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p
                                        class="text-primary-fixed-variant bg-primary-fixed px-3 py-1 rounded-lg text-lg font-black leading-none">
                                        ₹{{ number_format($crop->price_per_unit) }}<span
                                            class="text-[10px] font-medium opacity-70">/{{ $crop->unit }}</span></p>
                                </div>
                            </div>
                        </div>
                        @if($crop->quality_image_url)
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                <a href="{{ $crop->quality_image_url }}" target="_blank"
                                    class="px-6 py-3 bg-white text-on-surface rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">photo_camera</span>
                                    Check Quality
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <!-- AI Insight Section -->
                        <div
                            class="bg-secondary/5 rounded-2xl p-5 mb-6 border border-secondary/10 relative overflow-hidden">
                            <div class="flex justify-between items-center mb-3">
                                <span
                                    class="flex items-center gap-2 text-[10px] font-black text-secondary uppercase tracking-widest">
                                    <span class="material-symbols-outlined text-sm">auto_awesome</span>
                                    AI Market Insight
                                </span>
                                <span
                                    class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-0.5 rounded uppercase tracking-tighter">Bullish</span>
                            </div>
                            <p class="text-sm font-semibold text-on-surface-variant leading-relaxed">Demand expected to rise
                                by 15% in the next 2 weeks. <span class="text-primary font-black">Recommendation:
                                    Sell.</span></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="p-4 rounded-2xl bg-surface-container/50 border border-outline-variant/10">
                                <p class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-1">
                                    Available Stock</p>
                                <p class="text-lg font-black">{{ $crop->quantity }} {{ $crop->unit }}</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-surface-container/50 border border-outline-variant/10">
                                <p class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-1">
                                    Total Valuation</p>
                                <p class="text-lg font-black text-primary">
                                    ₹{{ number_format($crop->quantity * $crop->price_per_unit) }}</p>
                            </div>
                        </div>

                        <div class="mt-auto flex items-center gap-3">
                            <button onclick='openEditModal({!! json_encode($crop) !!})'
                                class="flex-1 py-4 bg-on-surface text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-primary transition-all shadow-lg hover:shadow-primary/20">Edit
                                Listing</button>
                            <form action="{{ route('crops.destroy', $crop->id) }}" method="POST"
                                onsubmit="return confirm('Remove this listing? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-12 h-12 rounded-2xl border-2 border-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all group">
                                    <span
                                        class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center flex flex-col items-center">
                    <div
                        class="w-32 h-32 bg-surface-container rounded-full flex items-center justify-center mb-6 animate-float">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/20">potted_plant</span>
                    </div>
                    <h3 class="text-2xl font-black tracking-tight mb-2">No active harvest listings</h3>
                    <p class="text-on-surface-variant font-medium max-w-sm mb-8">Start by adding your first crop harvest to
                        the marketplace using the AI optimizer.</p>
                    <button onclick="openCropModal()"
                        class="px-8 py-4 bg-primary text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-primary/20">Create
                        First Listing</button>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Crop Modal (Simplified for demo) -->
    <div id="cropModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm" onclick="closeCropModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-xl px-4">
            <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 overflow-hidden relative">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-black tracking-tighter">List New Harvest</h2>
                    <button onclick="closeCropModal()"
                        class="w-10 h-10 bg-surface-container rounded-full flex items-center justify-center hover:bg-red-50 text-on-surface-variant hover:text-red-500 transition-all">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form action="{{ route('crops.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Crop
                                Name (e.g., Basmati Rice, Red Tomato)</label>
                            <input type="text" name="name" required placeholder="Enter crop name..."
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Category</label>
                            <select name="category"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                                <option value="Grain">Grain</option>
                                <option value="Vegetable">Vegetable</option>
                                <option value="Fruit">Fruit</option>
                                <option value="Spice">Spice</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Unit</label>
                            <select name="unit"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                                <option value="kg">kg</option>
                                <option value="quintal">quintal</option>
                                <option value="ton">ton</option>
                                <option value="piece">piece</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Quantity</label>
                            <input type="number" name="quantity" required placeholder="0.00"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Price
                                per Unit (₹)</label>
                            <input type="number" name="price_per_unit" required placeholder="0.00"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Harvest
                                Date</label>
                            <input type="date" name="harvest_date" required
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Upload
                                Crop Photo (Optional - for Quality Check)</label>
                            <div class="relative group">
                                <input type="file" name="image" id="crop_image" class="hidden"
                                    onchange="updateFileName(this)">
                                <label for="crop_image"
                                    class="w-full bg-surface-container/50 border-2 border-dashed border-outline-variant/30 rounded-2xl px-6 py-8 flex flex-col items-center justify-center cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                    <span
                                        class="material-symbols-outlined text-4xl text-on-surface-variant group-hover:text-primary mb-2">cloud_upload</span>
                                    <span id="file_name" class="text-sm font-bold text-on-surface-variant">Click to
                                        upload or drag and drop</span>
                                    <span class="text-[10px] font-medium text-on-surface-variant/60 mt-1">PNG, JPG, JPEG
                                        (Max 5MB)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                        <input type="checkbox" name="is_organic" id="is_organic"
                            class="w-5 h-5 text-primary border-outline-variant rounded focus:ring-primary">
                        <label for="is_organic" class="text-sm font-bold text-on-surface">This is a certified organic
                            harvest</label>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-primary text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:shadow-primary/40 transition-all hover:-translate-y-1">List
                        on Marketplace</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Crop Modal -->
    <div id="editModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-xl px-4">
            <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 overflow-hidden relative">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-black tracking-tighter text-on-surface">Edit <span
                            id="edit_crop_display_name" class="text-primary">Listing</span></h2>
                    <button onclick="closeEditModal()"
                        class="w-10 h-10 bg-surface-container rounded-full flex items-center justify-center hover:bg-red-50 text-on-surface-variant hover:text-red-500 transition-all">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Crop
                                Name</label>
                            <input type="text" name="name" id="edit_name" required
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Category</label>
                            <select name="category" id="edit_category"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                                <option value="Grain">Grain</option>
                                <option value="Vegetable">Vegetable</option>
                                <option value="Fruit">Fruit</option>
                                <option value="Spice">Spice</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Unit</label>
                            <select name="unit" id="edit_unit"
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                                <option value="kg">kg</option>
                                <option value="quintal">quintal</option>
                                <option value="ton">ton</option>
                                <option value="piece">piece</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity" required
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Price
                                (₹)</label>
                            <input type="number" name="price_per_unit" id="edit_price" required
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div class="col-span-2">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 ml-4">Harvest
                                Date</label>
                            <input type="date" name="harvest_date" id="edit_date" required
                                class="w-full bg-surface-container/50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-primary/20">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                        <input type="checkbox" name="is_organic" id="edit_organic"
                            class="w-5 h-5 text-primary border-outline-variant rounded focus:ring-primary">
                        <label for="edit_organic" class="text-sm font-bold text-on-surface">Certified organic
                            harvest</label>
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-4">Update
                            Quality Photo (Optional)</label>
                        <div class="relative group">
                            <input type="file" name="image" id="edit_image" class="hidden"
                                onchange="updateEditFileName(this)">
                            <label for="edit_image"
                                class="w-full bg-surface-container/50 border-2 border-dashed border-outline-variant/30 rounded-2xl px-6 py-8 flex flex-col items-center justify-center cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                <span
                                    class="material-symbols-outlined text-4xl text-on-surface-variant group-hover:text-primary mb-2">add_a_photo</span>
                                <span id="edit_file_name" class="text-sm font-bold text-on-surface-variant">Replace
                                    existing quality photo</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:shadow-primary/40 transition-all">Update
                        Listing</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    @if(session('success'))
        <div id="toast"
            class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[200] bg-on-surface text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce-short">
            <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-xs">check</span>
            </div>
            <p class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</p>
        </div>
        <script>
            setTimeout(() => document.getElementById('toast').remove(), 4000);
        </script>
    @endif

    <script>
        function setCategory(cat) {
            document.querySelector('select[name="category"]').value = cat;
            document.getElementById('filter-form').submit();
        }

        function openCropModal() { document.getElementById('cropModal').classList.remove('hidden'); }
        function closeCropModal() { document.getElementById('cropModal').classList.add('hidden'); }

        function openEditModal(crop) {
            const form = document.getElementById('editForm');
            form.action = `/crops/${crop.id}`;
            document.getElementById('edit_crop_display_name').textContent = crop.name;
            document.getElementById('edit_name').value = crop.name;
            document.getElementById('edit_category').value = crop.category;
            document.getElementById('edit_unit').value = crop.unit;
            document.getElementById('edit_quantity').value = crop.quantity;
            document.getElementById('edit_price').value = crop.price_per_unit;
            document.getElementById('edit_date').value = crop.harvest_date;
            document.getElementById('edit_organic').checked = !!crop.is_organic;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

        function updateEditFileName(input) {
            const fileName = input.files[0]?.name || 'Replace existing quality photo';
            document.getElementById('edit_file_name').textContent = fileName;
        }

        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Click to upload or drag and drop';
            document.getElementById('file_name').textContent = fileName;
        }
    </script>
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
            <div class="col-span-1 md:col-span-4 lg:col-span-3">
                <h6 class="font-headline font-extrabold mb-8 text-white text-lg">Developers</h6>
                <div class="flex flex-col gap-5">
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Shivansh Dubey</span>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Saakshi Jha</span>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Rishabh Chaurasia</span>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" class="text-white/50 hover:text-white transition-colors" title="GitHub">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
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
    @include('partials.aimodal')
    @include('partials.farmbot')
</body>

</html>