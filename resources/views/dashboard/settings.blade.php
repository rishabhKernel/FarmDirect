<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Settings - FarmDirect</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <!-- Dark Mode Overrides -->
    <style>
        .dark body {
            background-color: #121212 !important;
            color: #e4e4e7 !important;
        }
        .dark .bg-white {
            background-color: #1e1e1e !important;
            border-color: #2e2e2e !important;
        }
        .dark .text-on-surface {
            color: #e4e4e7 !important;
        }
        .dark .text-zinc-500 {
            color: #a1a1aa !important;
        }
        .dark .border-outline-variant\/10 {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        .dark .hover\:bg-surface-container-low:hover {
            background-color: #2e2e2e !important;
        }
        .dark input, .dark textarea, .dark select {
            background-color: #2e2e2e !important;
            color: #e4e4e7 !important;
            border-color: #404040 !important;
        }
        .dark .bg-surface-container-low {
            background-color: #121212 !important;
        }
    </style>
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
    <!-- Success Toast -->
    @if(session('success'))
        <div id="success-toast" class="fixed top-24 right-8 z-[100] bg-primary text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="font-bold">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('success-toast');
                if (toast) { toast.remove(); }
            }, 5000);
        </script>
    @endif

    <!-- Top Navigation Bar (Like Farmer Dashboard) -->
    <nav class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm bg-white/80">
        <div class="flex items-center gap-4">
            <!-- Search bar from dashboard -->
            <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <form action="{{ route('farmer.dashboard') }}" method="GET">
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-48" name="search" value="{{ request('search') }}" placeholder="Search your crops..." type="text" />
                </form>
            </div>
        </div>
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
    </nav>

    <div class="flex min-h-screen">
        <!-- Side Navigation Bar (Dark theme, w-64 like project standard) -->
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
                <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner"
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

        <!-- Main Content Canvas -->
        <main class="flex-1 ml-0 lg:ml-64 mt-20 p-6 md:p-12 max-w-5xl">
            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-green-800 mb-2">Account Settings</h1>
                <p class="text-on-surface-variant font-label text-lg">Manage your digital farm's preferences and security details.</p>
            </header>
            
            <div class="space-y-12">
                <!-- Profile Settings Section -->
                <section class="bg-surface-container-low p-8 rounded-xl shadow-sm" id="profile">
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">person</span>
                        <h2 class="text-2xl font-headline font-bold">Profile Information</h2>
                    </div>
                    <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-span-2 flex items-center gap-6 mb-6">
                            <div class="relative group">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0d631b&color=fff&size=128' }}" class="w-20 h-20 rounded-full object-cover border-2 border-primary/20 shadow-sm" id="profile-preview"/>
                                <label for="profile_picture" class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                    <span class="material-symbols-outlined text-white">photo_camera</span>
                                </label>
                                <input type="file" name="profile_picture" id="profile_picture" class="hidden" onchange="previewProfile(this)"/>
                            </div>
                            <div>
                                <h4 class="font-bold text-on-surface">Profile Picture</h4>
                                <p class="text-xs text-outline">Click on image to change.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Full Name</label>
                                <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" type="text" name="name" value="{{ old('name', $user->name) }}"/>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Email Address</label>
                                <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" type="email" name="email" value="{{ old('email', $user->email) }}"/>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Farm Name</label>
                                <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" placeholder="e.g. Green Valley Estates" type="text" name="farm_name" value="{{ old('farm_name', $user->farm_name) }}"/>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Location (City)</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400">location_on</span>
                                    <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" type="text" name="city" value="{{ old('city', $user->city) }}"/>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Phone Number</label>
                                <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" type="text" name="phone" value="{{ old('phone', $user->phone) }}"/>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Language</label>
                                <select class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" name="language">
                                    <option value="en" @if(old('language', $user->language) == 'en') selected @endif>English</option>
                                    <option value="hi" @if(old('language', $user->language) == 'hi') selected @endif>Hindi</option>
                                    <option value="pa" @if(old('language', $user->language) == 'pa') selected @endif>Punjabi</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">UPI ID (VPA)</label>
                                <input class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" placeholder="example@upi" type="text" name="upi_id" value="{{ old('upi_id', $user->upi_id) }}"/>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="font-label text-sm font-semibold uppercase tracking-wider text-zinc-500">Bio</label>
                                <textarea class="w-full bg-surface-container-lowest border-none rounded-xl p-4 text-on-surface focus:ring-2 focus:ring-primary-container shadow-sm" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-xl font-label font-bold text-sm shadow-lg hover:opacity-90 transition-all">Save Changes</button>
                        </div>
                    </form>
                </section>

                <!-- Payment Methods Section (Bento Style) -->
                <section class="space-y-6" id="payment">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="material-symbols-outlined text-primary text-3xl">payments</span>
                        <h2 class="text-2xl font-headline font-bold">Payment Methods</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($user->bank_accounts ?? [] as $index => $bank)
                            <div class="md:col-span-2 bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                                <div class="relative z-10">
                                    <div class="flex justify-between items-start mb-12">
                                        <div class="text-secondary font-bold font-label">
                                            @if($bank['is_primary'] ?? false) PRIMARY @else SECONDARY @endif Payout Method
                                        </div>
                                        <span class="material-symbols-outlined text-4xl text-secondary">credit_card</span>
                                    </div>
                                    <div class="text-xl font-headline font-bold mb-1">{{ $bank['bank_name'] }}</div>
                                    <div class="text-on-surface-variant font-label tracking-[0.2em] mb-4">•••• •••• •••• {{ substr($bank['account_number'], -4) }}</div>
                                    <div class="flex justify-between items-center">
                                        <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold font-label">VERIFIED</span>
                                        <button onclick="openEditBankModal({{ $index }}, '{{ $bank['bank_name'] }}', '{{ $bank['account_number'] }}', '{{ $bank['ifsc_code'] }}')" class="text-primary font-bold text-sm">Edit Details</button>
                                    </div>
                                </div>
                                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-all"></div>
                            </div>
                        @empty
                            <div class="md:col-span-2 bg-surface-container-low p-6 rounded-xl relative overflow-hidden group">
                                <div class="relative z-10">
                                    <div class="flex justify-between items-start mb-12">
                                        <div class="text-secondary font-bold font-label">PRIMARY Payout Method</div>
                                        <span class="material-symbols-outlined text-4xl text-secondary">credit_card</span>
                                    </div>
                                    <div class="text-xl font-headline font-bold mb-1">State Bank of India</div>
                                    <div class="text-on-surface-variant font-label tracking-[0.2em] mb-4">•••• •••• •••• 5592</div>
                                    <div class="flex justify-between items-center">
                                        <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold font-label">MOCK</span>
                                        <button class="text-primary font-bold text-sm opacity-50 cursor-not-allowed">Edit Details</button>
                                    </div>
                                </div>
                                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-all"></div>
                            </div>
                        @endforelse
                        <button onclick="openBankModal()" class="flex flex-col items-center justify-center p-8 bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-xl hover:bg-surface-container-low transition-all">
                            <span class="material-symbols-outlined text-zinc-400 text-4xl mb-2">add_circle</span>
                            <span class="font-label font-bold text-zinc-600">Add New Bank</span>
                        </button>
                    </div>
                </section>

                <!-- UPI & QR Payments Section -->
                <section class="bg-surface-container-low p-8 rounded-xl shadow-sm mb-8" id="upi-qr">
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">qr_code_2</span>
                        <h2 class="text-2xl font-headline font-bold">UPI & QR Payments</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Info Card -->
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline font-bold text-lg mb-2">Receive Money Directly</h3>
                                <p class="text-sm text-outline mb-4">Set your UPI ID in the profile section to generate a QR code. Buyers can scan this QR code to pay you directly to your bank account.</p>
                            </div>
                            <div class="flex items-center gap-2 text-primary">
                                <span class="material-symbols-outlined">security</span>
                                <span class="text-xs font-bold">Secure peer-to-peer transactions</span>
                            </div>
                        </div>
                        
                        <!-- QR Code Card -->
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10 flex flex-col items-center justify-center min-h-[200px]">
                            @if($user->upi_id)
                                <div class="text-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode('upi://pay?pa=' . $user->upi_id . '&pn=' . $user->name) }}" class="mb-4 mx-auto border-4 border-white shadow-md rounded-lg"/>
                                    <p class="text-xs font-bold text-on-surface">Scan to pay {{ $user->name }}</p>
                                    <p class="text-xs text-outline">{{ $user->upi_id }}</p>
                                </div>
                            @else
                                <div class="text-center text-outline">
                                    <span class="material-symbols-outlined text-5xl mb-2">qr_code_none</span>
                                    <p class="text-sm font-bold">Set your UPI ID in Profile to generate a QR code</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- Payment Cards Section -->
                <section class="bg-surface-container-low p-8 rounded-xl shadow-sm" id="cards">
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">credit_card</span>
                        <h2 class="text-2xl font-headline font-bold">Payment Cards</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($user->cards ?? [] as $card)
                            <div class="bg-gradient-to-br from-purple-600 to-indigo-600 p-6 rounded-xl shadow-lg relative overflow-hidden text-white min-h-[200px] flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <span class="font-bold font-label">{{ $card['card_type'] }}</span>
                                    <span class="material-symbols-outlined text-4xl">contactless</span>
                                </div>
                                <div>
                                    <div class="text-xl font-headline font-bold mb-1">•••• •••• •••• {{ substr($card['card_number'], -4) }}</div>
                                    <div class="flex justify-between items-center text-xs">
                                        <span>{{ strtoupper($user->name) }}</span>
                                        <span>{{ $card['expiry_date'] }}</span>
                                    </div>
                                </div>
                                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
                            </div>
                        @empty
                            <!-- MOCK Card if none exist -->
                            <div class="bg-gradient-to-br from-purple-600 to-indigo-600 p-6 rounded-xl shadow-lg relative overflow-hidden text-white min-h-[200px] flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <span class="font-bold font-label">VISA</span>
                                    <span class="material-symbols-outlined text-4xl">contactless</span>
                                </div>
                                <div>
                                    <div class="text-xl font-headline font-bold mb-1">•••• •••• •••• 4321</div>
                                    <div class="flex justify-between items-center text-xs">
                                        <span>{{ strtoupper($user->name) }}</span>
                                        <span>12/28</span>
                                    </div>
                                </div>
                                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
                            </div>
                        @endforelse
                        
                        <!-- Add Card Button -->
                        <button onclick="openCardModal()" class="flex flex-col items-center justify-center p-8 bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-xl hover:bg-surface-container-low transition-all">
                            <span class="material-symbols-outlined text-zinc-400 text-4xl mb-2">add_circle</span>
                            <span class="font-label font-bold text-zinc-600">Add New Card</span>
                        </button>
                    </div>
                </section>

                <!-- Notification & Security (Asymmetric Grid) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Notification Preferences -->
                    <section class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm" id="notifications">
                        <div class="flex items-center space-x-3 mb-8">
                            <span class="material-symbols-outlined text-primary">notifications_active</span>
                            <h2 class="text-xl font-headline font-bold">Notifications</h2>
                        </div>
                        <form action="{{ route('settings.notifications') }}" method="POST" id="notifications-form">
                            @csrf
                            <div class="space-y-6">
                                <!-- Dark Mode -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-headline font-bold text-sm">Dark Mode</div>
                                        <div class="text-xs text-zinc-500 font-label">Enable dark theme aesthetics</div>
                                    </div>
                                    <input type="checkbox" name="dark_mode" value="1" {{ $user->dark_mode ? 'checked' : '' }} class="hidden" id="dark_mode_cb" onchange="document.getElementById('notifications-form').submit()"/>
                                    <div onclick="document.getElementById('dark_mode_cb').click()" class="w-12 h-6 {{ $user->dark_mode ? 'bg-primary' : 'bg-zinc-200' }} rounded-full relative p-1 cursor-pointer transition-colors">
                                        <div class="w-4 h-4 bg-white rounded-full {{ $user->dark_mode ? 'ml-auto' : '' }} transition-all"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-headline font-bold text-sm">New Bids</div>
                                        <div class="text-xs text-zinc-500 font-label">Notify me when a buyer places a bid</div>
                                    </div>
                                    <input type="checkbox" name="bid_alerts" value="1" {{ $user->bid_alerts ? 'checked' : '' }} class="hidden" id="bid_alerts_cb" onchange="document.getElementById('notifications-form').submit()"/>
                                    <div onclick="document.getElementById('bid_alerts_cb').click()" class="w-12 h-6 {{ $user->bid_alerts ? 'bg-primary' : 'bg-zinc-200' }} rounded-full relative p-1 cursor-pointer transition-colors">
                                        <div class="w-4 h-4 bg-white rounded-full {{ $user->bid_alerts ? 'ml-auto' : '' }} transition-all"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-headline font-bold text-sm">Market Insights</div>
                                        <div class="text-xs text-zinc-500 font-label">Weekly price fluctuation reports</div>
                                    </div>
                                    <input type="checkbox" name="price_alerts" value="1" {{ $user->price_alerts ? 'checked' : '' }} class="hidden" id="price_alerts_cb" onchange="document.getElementById('notifications-form').submit()"/>
                                    <div onclick="document.getElementById('price_alerts_cb').click()" class="w-12 h-6 {{ $user->price_alerts ? 'bg-primary' : 'bg-zinc-200' }} rounded-full relative p-1 cursor-pointer transition-colors">
                                        <div class="w-4 h-4 bg-white rounded-full {{ $user->price_alerts ? 'ml-auto' : '' }} transition-all"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-headline font-bold text-sm">Direct Messages</div>
                                        <div class="text-xs text-zinc-500 font-label">Alerts for buyer inquiries</div>
                                    </div>
                                    <input type="checkbox" name="email_notifications" value="1" {{ $user->email_notifications ? 'checked' : '' }} class="hidden" id="email_notifications_cb" onchange="document.getElementById('notifications-form').submit()"/>
                                    <div onclick="document.getElementById('email_notifications_cb').click()" class="w-12 h-6 {{ $user->email_notifications ? 'bg-primary' : 'bg-zinc-200' }} rounded-full relative p-1 cursor-pointer transition-colors">
                                        <div class="w-4 h-4 bg-white rounded-full {{ $user->email_notifications ? 'ml-auto' : '' }} transition-all"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>

                    <!-- Security Section -->
                    <section class="bg-surface-container-high/40 p-8 rounded-xl" id="security">
                        <div class="flex items-center space-x-3 mb-8">
                            <span class="material-symbols-outlined text-primary">verified_user</span>
                            <h2 class="text-xl font-headline font-bold">Security</h2>
                        </div>
                        <div class="space-y-4">
                            <!-- Change Password Form -->
                            <form action="{{ route('settings.security') }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="bg-white p-4 rounded-xl space-y-3">
                                    <h3 class="font-bold text-sm">Change Password</h3>
                                    <input type="password" name="current_password" placeholder="Current Password" class="w-full bg-surface-container-low border-none rounded-lg p-2 text-sm focus:ring-2 focus:ring-primary-container"/>
                                    <input type="password" name="password" placeholder="New Password" class="w-full bg-surface-container-low border-none rounded-lg p-2 text-sm focus:ring-2 focus:ring-primary-container"/>
                                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" class="w-full bg-surface-container-low border-none rounded-lg p-2 text-sm focus:ring-2 focus:ring-primary-container"/>
                                    <button type="submit" class="w-full py-2 bg-primary text-white rounded-lg font-bold text-sm hover:opacity-90 transition-all">Update Password</button>
                                </div>
                            </form>

                            <!-- 2FA Toggle -->
                            <form action="{{ route('settings.security') }}" method="POST">
                                @csrf
                                <input type="hidden" name="toggle_2fa" value="1"/>
                                <button type="submit" class="w-full flex items-center justify-between p-4 bg-surface-container-lowest rounded-xl hover:translate-x-1 transition-transform group">
                                    <div class="flex items-center space-x-3">
                                        <span class="material-symbols-outlined text-zinc-400 group-hover:text-primary">phonelink_lock</span>
                                        <span class="font-label font-bold text-sm">Two-Factor Auth</span>
                                    </div>
                                    <span class="{{ $user->two_factor_enabled ? 'bg-primary-container/20 text-primary' : 'bg-zinc-200 text-zinc-500' }} px-2 py-0.5 rounded text-[10px] font-bold">
                                        {{ $user->two_factor_enabled ? 'ACTIVE' : 'INACTIVE' }}
                                    </span>
                                </button>
                            </form>

                            <!-- Deactivate Account -->
                            <form action="{{ route('settings.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?')">
                                @csrf
                                <div class="bg-red-50 p-4 rounded-xl space-y-3">
                                    <h3 class="font-bold text-sm text-red-700">Deactivate Account</h3>
                                    <p class="text-xs text-red-600">Type DELETE to confirm.</p>
                                    <input type="text" name="confirm_delete" placeholder="DELETE" class="w-full bg-white border-red-200 rounded-lg p-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" required/>
                                    <button type="submit" class="w-full flex items-center justify-between p-3 bg-error-container/20 rounded-xl hover:bg-error-container/40 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <span class="material-symbols-outlined text-error">delete_forever</span>
                                            <span class="font-label font-bold text-sm text-error">Deactivate Account</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer (Premium like Farmer Dashboard) -->
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
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Saakshi Jha</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/70 font-medium flex-1">Rishabh Chaurasia</span>
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
    <!-- Bank Modal -->
    <div id="bank-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-on-surface mb-4">Add Bank Account</h3>
            <form action="{{ route('settings.bank') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Bank Name</label>
                    <input type="text" name="bank_name" list="bank-list" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="e.g. State Bank of India" required />
                    <datalist id="bank-list">
                        <option value="State Bank of India">
                        <option value="HDFC Bank">
                        <option value="ICICI Bank">
                        <option value="Axis Bank">
                        <option value="Punjab National Bank">
                        <option value="Bank of Baroda">
                        <option value="Canara Bank">
                        <option value="Union Bank of India">
                    </datalist>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Account Number</label>
                    <input type="text" name="account_number" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="Enter account number" required />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">IFSC Code</label>
                    <input type="text" name="ifsc_code" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="Enter IFSC code" required />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeBankModal()" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Add Bank</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Bank Modal -->
    <div id="edit-bank-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-on-surface mb-4">Edit Bank Account</h3>
            <form id="edit-bank-form" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Bank Name</label>
                    <input type="text" id="edit-bank-name" name="bank_name" list="bank-list" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Account Number</label>
                    <input type="text" id="edit-account-number" name="account_number" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" required />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">IFSC Code</label>
                    <input type="text" id="edit-ifsc-code" name="ifsc_code" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" required />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditBankModal()" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Card Modal -->
    <div id="card-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold text-on-surface mb-4">Add Payment Card</h3>
            <form action="{{ route('settings.card') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Card Number</label>
                    <input type="text" name="card_number" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="XXXX XXXX XXXX XXXX" required />
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-on-surface-variant mb-1">Expiry Date</label>
                        <input type="text" name="expiry_date" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="MM/YY" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-on-surface-variant mb-1">CVV</label>
                        <input type="password" name="cvv" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm" placeholder="XXX" required />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCardModal()" class="px-4 py-2 bg-surface-container-highest text-on-surface rounded-xl font-label text-sm font-bold hover:bg-surface-container-high transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-label text-sm font-bold shadow-lg shadow-primary/10 hover:bg-primary-container transition-colors">Add Card</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBankModal() {
            document.getElementById('bank-modal').classList.remove('hidden');
        }

        function closeBankModal() {
            document.getElementById('bank-modal').classList.add('hidden');
        }

        function openCardModal() {
            document.getElementById('card-modal').classList.remove('hidden');
        }

        function closeCardModal() {
            document.getElementById('card-modal').classList.add('hidden');
        }

        function openEditBankModal(index, bankName, accountNumber, ifscCode) {
            document.getElementById('edit-bank-form').action = `/dashboard/settings/bank/${index}`;
            document.getElementById('edit-bank-name').value = bankName;
            document.getElementById('edit-account-number').value = accountNumber;
            document.getElementById('edit-ifsc-code').value = ifscCode;
            document.getElementById('edit-bank-modal').classList.remove('hidden');
        }

        function closeEditBankModal() {
            document.getElementById('edit-bank-modal').classList.add('hidden');
        }

        function previewProfile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @include('partials.aimodal')
    @include('partials.farmbot')
</body>
</html>
