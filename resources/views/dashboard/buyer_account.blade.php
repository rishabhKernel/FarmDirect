<!DOCTYPE html>

<html class="light" lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Account Center - FarmDirect</title>
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
<a class="flex items-center gap-4 px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary/5 rounded-2xl transition-all group" href="{{ route('buyer.orders') }}">
<span class="material-symbols-outlined group-hover:fill-icon">history</span>
<span class="font-bold text-sm">Orders & History</span>
</a>
<a class="flex items-center gap-4 px-4 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20" href="{{ route('buyer.account') }}">
<span class="material-symbols-outlined fill-icon">account_circle</span>
<span class="text-sm">Account Center</span>
</a>
</nav>
</div>
</aside>

<!-- Main Content Area -->
<section class="flex-1">
<header class="mb-12">
    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Account Center</h1>
    <p class="text-on-surface-variant font-medium max-w-2xl">Manage your professional profile, payment methods, and security settings.</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Profile Info -->
    <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft">
        <h3 class="text-xl font-black text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">person</span>
            Professional Profile
        </h3>
        <form action="{{ route('buyer.account.profile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all opacity-60" readonly>
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Phone Number</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Profile Picture</label>
                <div class="flex items-center gap-4">
                    <img id="profile-preview" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2e7d32&color=fff' }}" class="w-12 h-12 rounded-xl object-cover border-2 border-primary/20">
                    <input type="file" name="profile_picture" onchange="previewProfile(this)" class="text-xs font-bold text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
            </div>
            <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all">Update Profile</button>
        </form>
    </div>

    <!-- Security -->
    <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft">
        <h3 class="text-xl font-black text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">shield</span>
            Security Settings
        </h3>
        <form action="{{ route('buyer.account.password') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Current Password</label>
                <input type="password" name="current_password" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">New Password</label>
                <input type="password" name="password" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <button type="submit" class="w-full bg-surface-container text-on-surface py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-surface-container-high transition-all">Change Password</button>
        </form>
    </div>

    <!-- Payments (Placeholder) -->
    <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-soft md:col-span-2">
        <h3 class="text-xl font-black text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">payments</span>
            Payment Methods
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($user->bank_accounts ?? [] as $index => $bank)
            <div class="p-6 bg-surface-container rounded-2xl border border-outline-variant/30 flex flex-col justify-between group relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <span class="material-symbols-outlined text-primary">account_balance</span>
                        @if($bank['is_primary'] ?? false)
                            <span class="px-2 py-0.5 bg-primary/10 text-primary text-[8px] font-black rounded uppercase">Primary</span>
                        @endif
                    </div>
                    <p class="text-xs font-black text-on-surface mb-1">{{ $bank['bank_name'] }}</p>
                    <p class="text-[10px] font-bold text-on-surface-variant/60 tracking-widest">•••• {{ substr($bank['account_number'], -4) }}</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-primary/5 rounded-full blur-xl group-hover:bg-primary/10 transition-all"></div>
            </div>
            @endforeach
            <div onclick="openBankModal()" class="p-6 bg-surface-container rounded-2xl border border-outline-variant/30 border-dashed flex flex-col items-center justify-center text-center group cursor-pointer hover:border-primary/50 transition-all">
                <span class="material-symbols-outlined text-3xl text-on-surface-variant/40 mb-2 group-hover:text-primary transition-colors">add_card</span>
                <p class="text-xs font-black text-on-surface-variant uppercase tracking-widest">Add New Bank</p>
            </div>
            <div onclick="openCardModal()" class="p-6 bg-surface-container rounded-2xl border border-outline-variant/30 border-dashed flex flex-col items-center justify-center text-center group cursor-pointer hover:border-primary/50 transition-all">
                <span class="material-symbols-outlined text-3xl text-on-surface-variant/40 mb-2 group-hover:text-primary transition-colors">account_balance</span>
                <p class="text-xs font-black text-on-surface-variant uppercase tracking-widest">Add New Card</p>
            </div>
        </div>
    </div>
</div>
</section>
</main>
@include('partials.buyer_footer')

<!-- Bank Modal -->
<div id="bank-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] p-8 w-full max-w-md shadow-premium">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-black text-on-surface">Add Bank Account</h3>
            <button onclick="closeBankModal()" class="w-10 h-10 flex items-center justify-center hover:bg-surface-container rounded-xl transition-all">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        <form action="{{ route('buyer.account.bank') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Bank Name</label>
                <input type="text" name="bank_name" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="e.g. State Bank of India" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Account Number</label>
                <input type="text" name="account_number" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Enter account number" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">IFSC Code</label>
                <input type="text" name="ifsc_code" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Enter IFSC code" required>
            </div>
            <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Link Bank Account</button>
        </form>
    </div>
</div>

<!-- Card Modal -->
<div id="card-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] p-8 w-full max-w-md shadow-premium">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-black text-on-surface">Add Payment Card</h3>
            <button onclick="closeCardModal()" class="w-10 h-10 flex items-center justify-center hover:bg-surface-container rounded-xl transition-all">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        <form action="{{ route('buyer.account.card') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Card Number</label>
                <input type="text" name="card_number" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="XXXX XXXX XXXX XXXX" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">Expiry Date</label>
                    <input type="text" name="expiry_date" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="MM/YY" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest mb-1">CVV</label>
                    <input type="password" name="cvv" class="w-full bg-surface-container border-none rounded-xl px-4 py-3 font-bold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="XXX" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Add Card</button>
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

@include('partials.live_notifications')

</body></html>
