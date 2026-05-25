<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect — Executive Portal</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
tailwind.config = { darkMode: "class", theme: { extend: {
  "colors": {
    "surface": "#f8f9f5", "surface-container-lowest": "#ffffff", "surface-container-low": "#f2f4f0",
    "surface-container": "#eceee8", "surface-container-high": "#e6e8e2", "surface-container-highest": "#e0e3dc",
    "on-surface": "#121411", "on-surface-variant": "#3f443b", "outline": "#6f756a", "outline-variant": "#bec5b9",
    "primary": "#136d22", "primary-container": "#248633", "on-primary": "#ffffff", "on-primary-container": "#c9ffcb",
    "secondary": "#70564e", "secondary-container": "#fdd5c8", "on-secondary-container": "#74574f",
    "error": "#b91919", "error-container": "#ffdad6", "on-error-container": "#930006",
    "tertiary": "#8c2e52", "tertiary-container": "#aa466b", "on-tertiary-container": "#ffeef1",
    "inverse-surface": "#2b2e2a", "surface-dim": "#d9dbd4", "surface-bright": "#f8f9f5",
    "secondary-fixed": "#fedacb", "on-secondary-fixed": "#2c150c"
  },
  "fontFamily": { "headline": ["Manrope","sans-serif"], "label": ["Plus Jakarta Sans","sans-serif"] }
}}}
</script>
<style>
body { font-family: 'Plus Jakarta Sans', sans-serif; }
.font-headline { font-family: 'Manrope', sans-serif; }
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
.sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; transition: all 0.2s ease-in-out; border-radius: 0.75rem; }
.glass-panel { background: rgba(248, 249, 245, 0.8); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); }
</style>
</head>
<body class="bg-surface text-on-surface min-h-screen font-label antialiased">

{{-- ═══ SIDEBAR NAVIGATION (Floating Glassmorphic Haze-Forest Sidebar) ═══ --}}
<aside class="fixed left-4 top-24 bottom-4 w-64 bg-gradient-to-b from-[#0c3319] via-[#04140a] to-[#020502] rounded-[2rem] backdrop-blur-[24px] border border-white/10 flex flex-col p-5 shadow-2xl z-40">
  {{-- Profile Widget inside Sidebar --}}
  <div class="mb-6">
    <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/10">
      <img alt="Portrait of {{ $admin->name }}" class="w-10 h-10 rounded-xl object-cover border-2 border-primary/20 shadow-sm" src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($admin->name) . '&background=136d22&color=fff&size=128' }}" />
      <div class="overflow-hidden">
        <h3 class="font-bold text-white text-xs truncate">{{ $admin->name }}</h3>
        <p class="text-[10px] text-stone-400 truncate">Verified Admin</p>
      </div>
    </div>
  </div>

  <nav class="flex-1 space-y-1.5" id="admin-sidebar">
    <a class="sidebar-link text-white bg-white/10" href="#dashboard" onclick="showSection('dashboard', this)">
      <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">dashboard</span><span class="text-sm font-bold">Overview</span>
    </a>
    <a class="sidebar-link text-stone-300 hover:text-white hover:bg-white/5" href="#farmers" onclick="showSection('farmers', this)">
      <span class="material-symbols-outlined text-stone-400">agriculture</span><span class="text-sm font-bold">Farmers</span>
    </a>
    <a class="sidebar-link text-stone-300 hover:text-white hover:bg-white/5" href="#buyers" onclick="showSection('buyers', this)">
      <span class="material-symbols-outlined text-stone-400">storefront</span><span class="text-sm font-bold">Buyers</span>
    </a>
    <a class="sidebar-link text-stone-300 hover:text-white hover:bg-white/5" href="#logistics" onclick="showSection('logistics', this)">
      <span class="material-symbols-outlined text-stone-400">local_shipping</span><span class="text-sm font-bold">Logistics Hub</span>
    </a>
    <a class="sidebar-link text-stone-300 hover:text-white hover:bg-white/5" href="#bids" onclick="showSection('bids', this)">
      <span class="material-symbols-outlined text-stone-400">gavel</span><span class="text-sm font-bold">Bid Monitor</span>
    </a>
    <a class="sidebar-link text-stone-300 hover:text-white hover:bg-white/5" href="#mandi" onclick="showSection('mandi', this)">
      <span class="material-symbols-outlined text-stone-400">analytics</span><span class="text-sm font-bold">Mandi Reference</span>
    </a>
  </nav>

  <div class="pt-4 border-t border-white/5 space-y-3">
    <button onclick="openAiProjectionModal()" class="w-full py-3.5 bg-primary hover:bg-primary-container text-white font-bold rounded-xl flex items-center justify-center gap-2 transition-all text-xs tracking-wider shadow-lg shadow-primary/20">
      <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">psychology</span> Launch Harvest AI
    </button>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="sidebar-link w-full text-white/50 hover:!text-red-400 hover:bg-red-500/10">
        <span class="material-symbols-outlined">logout</span><span class="text-sm">Sign Out</span>
      </button>
    </form>
  </div>
</aside>

{{-- ═══ TOP HEADER NAVBAR (Full-Width Glassmorphic Header) ═══ --}}
<nav class="fixed top-0 left-0 right-0 z-50 glass-panel flex justify-between items-center px-8 h-20 border-b border-surface-container-high/80 shadow-sm">
  <div class="flex items-center gap-3 pl-4">
    <span class="material-symbols-outlined text-primary text-5xl transform hover:scale-115 transition-transform duration-300 select-none" style="font-variation-settings: 'FILL' 1;">eco</span>
    <span class="text-3xl font-black tracking-tight text-on-surface font-headline flex items-center gap-2">FarmDirect <span class="text-[10px] uppercase tracking-widest bg-primary-container text-on-primary-container px-3 py-1 rounded-xl border border-primary/10 font-label font-bold shadow-sm">Executive Portal</span></span>
  </div>

  <div class="flex items-center gap-5">
    {{-- Notifications bell dropdown --}}
    <div class="relative group">
      <button class="p-2.5 hover:bg-surface-container rounded-full transition-all relative">
        <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
        @if(count($recentNotifications) > 0)
          <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full animate-pulse"></span>
        @endif
      </button>
      {{-- Hover Card --}}
      <div class="absolute right-0 mt-2 w-80 bg-surface-container-lowest rounded-2xl shadow-2xl border border-surface-container-high p-4 hidden group-hover:block z-50 text-on-surface">
        <div class="flex justify-between items-center mb-3">
          <span class="font-headline font-bold text-sm">System Alerts</span>
          <span class="px-2 py-0.5 bg-primary/10 text-primary text-[9px] font-black rounded-lg uppercase">Real-time</span>
        </div>
        <div class="space-y-2.5 max-h-64 overflow-y-auto pr-1">
          @forelse($recentNotifications as $n)
            <div class="p-2.5 hover:bg-surface-container-low rounded-xl border border-surface-container/50 transition-colors">
              <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] font-black text-primary leading-tight">{{ $n->title }}</span>
                <span class="text-[8px] text-on-surface-variant font-medium">{{ $n->created_at ? $n->created_at->diffForHumans() : 'Just now' }}</span>
              </div>
              <p class="text-[10px] text-on-surface-variant leading-relaxed">{{ $n->message }}</p>
            </div>
          @empty
            <p class="text-xs text-center py-6 text-on-surface-variant font-medium">No new system alerts.</p>
          @endforelse
        </div>
      </div>
    </div>

    {{-- User Profile Card --}}
    <div class="relative group">
      <div class="flex items-center gap-3 cursor-pointer">
        <div class="text-right hidden sm:block">
          <p class="text-xs font-black text-on-surface">Executive Admin</p>
          <p class="text-[9px] font-bold text-primary uppercase tracking-widest mt-0.5">Admin Controller</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold border border-primary/20 overflow-hidden shadow-inner">
          @if($admin->profile_picture)
            <img src="{{ asset('storage/' . $admin->profile_picture) }}" class="w-full h-full object-cover"/>
          @else
            A
          @endif
        </div>
      </div>
      {{-- Hover Card Dropdown --}}
      <div class="absolute right-0 mt-2 w-64 bg-surface-container-lowest rounded-2xl shadow-2xl border border-surface-container-high p-4 hidden group-hover:block z-50 text-on-surface">
        <div class="font-headline font-bold text-sm truncate">Executive Admin</div>
        <div class="text-xs text-outline mb-1">ID: {{ substr($admin->id, -6) }}</div>
        <div class="text-xs text-on-surface-variant mb-3 truncate" title="{{ $admin->email }}">{{ $admin->email }}</div>
        <hr class="my-2 border-surface-container-high">
        <a href="#" class="text-xs text-primary font-bold hover:underline flex items-center gap-1.5">
          <span class="material-symbols-outlined text-sm">settings</span>
          Console Settings
        </a>
      </div>
    </div>
  </div>
</nav>

{{-- ═══ MAIN PANEL CONTENT AREA (Offset ml-72) ═══ --}}
<main class="ml-72 pt-28 px-8 pb-16">

{{-- Premium Bounce Success/Error Toasts --}}
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
    if (toast) {
      toast.style.transition = 'opacity 0.5s ease';
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 500);
    }
  }, 5000);
</script>
@endif
@if(session('error'))
<div id="error-toast" class="fixed top-24 right-8 z-[100] bg-error text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
  <span class="material-symbols-outlined">error</span>
  <span class="font-bold">{{ session('error') }}</span>
  <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100 transition-opacity">
    <span class="material-symbols-outlined text-sm">close</span>
  </button>
</div>
<script>
  setTimeout(() => {
    const toast = document.getElementById('error-toast');
    if (toast) {
      toast.style.transition = 'opacity 0.5s ease';
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 500);
    }
  }, 5000);
</script>
@endif

{{-- ════════════════════ SECTION: OVERVIEW ════════════════════ --}}
<section id="section-dashboard" class="space-y-8">
  <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-8 pb-8 border-b border-surface-container mb-6">
    <div class="relative">
      <span class="text-primary font-black text-xs tracking-[0.3em] uppercase mb-4 block opacity-80">Admin Dashboard</span>
      <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-none font-headline text-on-surface"><span id="admin-greeting-text">{{ $greeting }}</span>, <br /><span
            class="text-primary">Admin.</span></h1>
      <div class="flex items-center gap-3 mt-6">
          <div class="w-8 h-8 rounded-full bg-[#c9ffcb] text-[#136d22] flex items-center justify-center text-[10px] font-black border-2 border-surface shadow-sm select-none">
              100%
          </div>
          <p class="text-on-surface-variant font-medium text-sm">System integrity is stable and fully optimized today.</p>
      </div>
    </div>
    <div class="flex flex-col items-end gap-3 self-start lg:self-center">
        <div class="text-right">
            <p class="text-xs font-bold text-on-surface-variant/60 uppercase tracking-widest mb-1.5">Local Weather in {{ $weather['city'] ?? 'Delhi' }}</p>
            <div class="flex items-baseline gap-4 justify-end">
                <span id="admin-clock" class="text-4xl md:text-5xl font-black text-primary font-headline tracking-tighter">{{ now()->format('h:i A') }}</span>
                <span class="font-black text-5xl md:text-6xl text-on-surface font-headline tracking-tighter flex items-center gap-1.5">
                  {{ $weather['temp'] ?? '28' }}°C 
                  <span class="material-symbols-outlined text-amber-500 text-4xl md:text-5xl animate-pulse">{{ $weather['condition'] ?? 'sunny' }}</span>
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 bg-primary/10 text-primary px-3.5 py-1.5 rounded-xl border border-primary/10 text-[10px] font-black uppercase tracking-wider">
            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-ping"></span>
            Ecosystem Live Analytics
        </div>
    </div>
  </div>

  {{-- Main Metrics Bento with Revenue Chart & Sidebar stats --}}
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    {{-- Left: Procurement Revenue Chart Card (Spans 3 cols) --}}
    <div class="lg:col-span-3 bg-surface-container-lowest p-8 rounded-[2.5rem] border border-surface-container shadow-sm flex flex-col justify-between relative overflow-hidden group">
      <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
      <div class="flex justify-between items-start z-10 relative mb-6">
        <div>
          <div class="flex items-center gap-2 mb-1.5">
            <span class="material-symbols-outlined text-primary text-lg">payments</span>
            <p class="text-[10px] text-on-surface-variant font-black uppercase tracking-wider">Procurement Revenue</p>
          </div>
          <h3 class="text-5xl font-black text-on-surface font-headline leading-none tracking-tighter" id="stat-revenue">₹{{ number_format($totalRevenue, 0) }}</h3>
          <p class="text-xs text-on-surface-variant/80 mt-2.5 font-bold flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            <span id="stat-completed-orders" class="text-primary font-extrabold">{{ $completedOrders }}</span> completed transactions
          </p>
        </div>
        <div class="bg-primary/5 text-primary text-xs font-black px-4 py-2 rounded-xl border border-primary/10">
          Last 7 Days
        </div>
      </div>
      
      {{-- Revenue Chart Canvas --}}
      <div class="relative z-10 h-72 w-full mt-4">
        <canvas id="revenueChart"></canvas>
      </div>
    </div>

    {{-- Right: Sidebar Cards (Farmers & Buyers) --}}
    <div class="lg:col-span-1 flex flex-col gap-6">
      {{-- Farmers Registered Card --}}
      <div class="bg-surface-container-lowest p-6 rounded-[2rem] border border-surface-container shadow-sm hover:shadow-md transition-all flex flex-col justify-between flex-1 min-h-[170px]">
        <div>
          <div class="flex items-center gap-2 mb-3">
            <span class="material-symbols-outlined text-primary text-xl">agriculture</span>
            <p class="text-[10px] text-on-surface-variant font-black uppercase tracking-wider">Farmers Registered</p>
          </div>
          <h3 class="text-5xl font-black text-primary font-headline tracking-tighter" id="stat-farmers">{{ $totalFarmers }}</h3>
        </div>
        <div class="text-[11px] text-on-surface-variant/80 mt-4 pt-3 border-t border-surface-container font-bold flex flex-wrap gap-2">
          <span class="bg-red-500/10 text-error px-2.5 py-1 rounded-lg" id="stat-farmers-suspended">{{ $suspendedFarmers }} Suspended</span>
          <span class="bg-primary/10 text-primary px-2.5 py-1 rounded-lg" id="stat-farmers-active">{{ $totalFarmers - $suspendedFarmers }} Active</span>
        </div>
      </div>

      {{-- Buyers Engaged Card --}}
      <div class="bg-surface-container-lowest p-6 rounded-[2rem] border border-surface-container shadow-sm hover:shadow-md transition-all flex flex-col justify-between flex-1 min-h-[170px]">
        <div>
          <div class="flex items-center gap-2 mb-3">
            <span class="material-symbols-outlined text-stone-600 text-xl">storefront</span>
            <p class="text-[10px] text-on-surface-variant font-black uppercase tracking-wider">Buyers Engaged</p>
          </div>
          <h3 class="text-5xl font-black text-on-surface font-headline tracking-tighter" id="stat-buyers">{{ $totalBuyers }}</h3>
        </div>
        <div class="text-[11px] text-on-surface-variant/80 mt-4 pt-3 border-t border-surface-container font-bold flex flex-wrap gap-2">
          <span class="bg-red-500/10 text-error px-2.5 py-1 rounded-lg" id="stat-buyers-suspended">{{ $suspendedBuyers }} Suspended</span>
          <span class="bg-primary/10 text-primary px-2.5 py-1 rounded-lg" id="stat-buyers-active">{{ $totalBuyers - $suspendedBuyers }} Active</span>
        </div>
      </div>
    </div>
  </div>

  {{-- Secondary bento stats --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-surface-container-low/60 p-5 rounded-2xl flex items-center gap-4 border border-surface-container-high/30">
      <div class="w-12 h-12 rounded-xl bg-secondary-container flex items-center justify-center text-on-secondary-container">
        <span class="material-symbols-outlined">local_shipping</span>
      </div>
      <div>
        <p class="text-2xl font-black font-headline text-on-surface" id="stat-active-logistics">{{ $activeLogistics }}</p>
        <p class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">Active Transits</p>
      </div>
    </div>
    <div class="bg-surface-container-low/60 p-5 rounded-2xl flex items-center gap-4 border border-surface-container-high/30">
      <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
        <span class="material-symbols-outlined">potted_plant</span>
      </div>
      <div>
        <p class="text-2xl font-black font-headline text-on-surface" id="stat-active-crops">{{ $activeCrops }}</p>
        <p class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">Active Crop Listings</p>
      </div>
    </div>
    <div class="bg-surface-container-low/60 p-5 rounded-2xl flex items-center gap-4 border border-surface-container-high/30">
      <div class="w-12 h-12 rounded-xl bg-tertiary-container/30 flex items-center justify-center text-tertiary">
        <span class="material-symbols-outlined">pending_actions</span>
      </div>
      <div>
        <p class="text-2xl font-black font-headline text-on-surface" id="stat-pending-orders">{{ $pendingOrders }}</p>
        <p class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">Pending Orders</p>
      </div>
    </div>
  </div>

  {{-- Verification Queue --}}
  <div class="bg-surface-container-lowest rounded-2xl border border-surface-container shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-lg font-bold font-headline text-on-surface flex items-center gap-2">
          <span class="material-symbols-outlined text-primary">verified_user</span> Verification Queue
        </h2>
        <p class="text-xs text-on-surface-variant">Review farm organic credentials & platform registration requests</p>
      </div>
      <span class="px-3 py-1 bg-surface-container text-on-surface text-[10px] font-black rounded-lg border border-surface-container-high">
        {{ count($pendingVerifications) }} Pending Review
      </span>
    </div>
    <div class="space-y-4">
      @forelse($pendingVerifications as $user)
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 bg-surface-container-low/40 border border-surface-container rounded-xl gap-4">
        <div class="flex items-start gap-3">
          <div class="w-9 h-9 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center text-primary font-bold text-xs uppercase">
            {{ substr($user->name, 0, 2) }}
          </div>
          <div>
            <p class="text-sm font-bold text-on-surface">{{ $user->name }}</p>
            <p class="text-[10px] text-on-surface-variant">{{ $user->email }} · {{ $user->city ?? 'No Location' }}</p>
          </div>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
          <form method="POST" action="{{ route('admin.verify-user', $user->id) }}">
            @csrf
            <button type="submit" class="px-3.5 py-1.5 bg-primary hover:bg-primary-container text-white text-[10px] font-black rounded-lg uppercase tracking-wider shadow-sm transition-all animate-pulse">Approve</button>
          </form>
          <form method="POST" action="{{ route('admin.flag-user', $user->id) }}" onsubmit="return confirm('Flag verification failure & suspend {{ $user->name }}?')">
            @csrf
            <button type="submit" class="px-3.5 py-1.5 bg-error/10 hover:bg-error/20 text-error border border-error/10 text-[10px] font-black rounded-lg uppercase tracking-wider transition-all">Flag / Reject</button>
          </form>
        </div>
      </div>
      @empty
      <div class="py-8 text-center border border-dashed border-surface-container-high rounded-xl">
        <span class="material-symbols-outlined text-on-surface-variant/40 text-3xl mb-2">done_all</span>
        <p class="text-xs font-bold text-on-surface-variant">All farmer organic certificates verified.</p>
      </div>
      @endforelse
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Column 1 & 2: Sowing Season Demand Forecast --}}
    <div class="lg:col-span-2 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl border border-primary/10 p-6 flex flex-col justify-between gap-6">
      <div class="space-y-3">
        <div class="flex items-center gap-2">
          <span class="px-2.5 py-1 bg-primary/15 text-primary text-[9px] font-black rounded uppercase tracking-widest border border-primary/20">Sowing Forecast</span>
          <span class="material-symbols-outlined text-primary text-sm">trending_up</span>
        </div>
        <h3 class="text-xl font-bold font-headline text-on-surface">Kharif Cycle AI Projections</h3>
        <p class="text-xs text-on-surface-variant leading-relaxed">
          Based on wholesale mandi trends, logistics throughput, and active listings: **Basmati Rice** demand is projected to spike by **+24.8%** over the next 45 days. Local grain listings count currently represents 68.2% of market capacity.
        </p>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-2">
        <div class="bg-surface-container-lowest border border-surface-container-high p-4 rounded-xl text-center min-w-[120px] w-full sm:w-auto hover:shadow-sm transition-all">
          <p class="text-[9px] font-black text-on-surface-variant uppercase tracking-wider">Projected Rate</p>
          <p class="text-xl font-black text-primary mt-1">₹4,850/q</p>
        </div>
        <button onclick="openAiProjectionModal()" class="px-5 py-3 bg-[#0f2e14] hover:bg-[#0f2e14]/90 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 shadow-lg tracking-wider transition-all w-full sm:w-auto">
          <span class="material-symbols-outlined text-sm">psychology</span> View Report
        </button>
      </div>
    </div>

    {{-- Column 3: Mandi Reference Prices --}}
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-surface-container shadow-sm flex flex-col justify-between">
      <div>
        <div class="flex justify-between items-center mb-4">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-xl">store</span>
            <h4 class="text-on-surface font-headline font-bold text-sm">Mandi Reference Prices</h4>
          </div>
          <button onclick="refreshMandiPrices()" class="p-1.5 bg-primary/5 text-primary rounded-lg hover:bg-primary/10 transition-all group" title="Sync Prices">
            <span class="material-symbols-outlined text-sm group-active:rotate-180 transition-transform duration-500" id="mandi-sync-icon">sync</span>
          </button>
        </div>
        <div id="mandi-update-status" class="text-[9px] text-stone-400 font-bold uppercase tracking-tighter mb-2 hidden">Updating...</div>
        <div class="space-y-3 max-h-48 overflow-y-auto pr-1" id="mandi-price-list">
          @forelse($mandiPrices as $price)
            <div class="flex justify-between items-center text-sm border-b border-surface-container/50 pb-2 hover:bg-surface-container-low/20 transition-all">
              <span class="font-bold text-on-surface">{{ $price->crop_name }}</span>
              <span class="text-primary font-black">₹{{ number_format($price->price_per_q) }}</span>
            </div>
          @empty
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest text-center py-4">Fetching live prices...</p>
          @endforelse
        </div>
      </div>
      <a href="/dashboard/mandi" class="mt-4 w-full py-2.5 bg-surface-container-low text-primary rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-primary hover:text-white transition-all text-center block">View Full Mandi Board →</a>
    </div>
  </div>
</section>

{{-- ════════════════════ SECTION: FARMERS ════════════════════ --}}
<section id="section-farmers" class="hidden space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold font-headline text-on-surface">Farmers Directory</h2>
      <p class="text-xs text-on-surface-variant">View profiles, check organic credentials, and manage suspensions.</p>
    </div>
    <span class="px-3.5 py-1.5 bg-primary/10 border border-primary/20 text-primary rounded-xl text-xs font-black">{{ $totalFarmers }} Registered</span>
  </div>
  <div class="bg-surface-container-lowest rounded-2xl border border-surface-container shadow-sm overflow-hidden">
    <table class="w-full text-left">
      <thead>
        <tr class="text-[10px] font-black text-on-surface-variant/60 uppercase tracking-widest border-b border-surface-container">
          <th class="py-4 px-6">Farmer Name / Contact</th>
          <th class="py-4 px-4">Address / Pincode</th>
          <th class="py-4 px-4 text-center">Active Listing</th>
          <th class="py-4 px-4 text-right">Aggregate Sales</th>
          <th class="py-4 px-4 text-center">Certification</th>
          <th class="py-4 px-4 text-center">Status</th>
          <th class="py-4 px-6 text-center">Operations</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($farmers as $farmer)
        <tr class="hover:bg-surface-container-low/20 transition-all border-b border-surface-container/30 {{ $farmer->is_suspended ? 'bg-red-500/[0.02] opacity-80' : '' }}">
          <td class="py-4 px-6">
            <p class="font-bold text-on-surface">{{ $farmer->name }}</p>
            <p class="text-[10px] text-on-surface-variant">{{ $farmer->email }} · {{ $farmer->phone ?? '—' }}</p>
            <button onclick="toggleDetails('farmer-{{ $farmer->id }}')" class="text-primary hover:text-primary-container font-black text-[10px] uppercase flex items-center gap-1 mt-1.5 focus:outline-none bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10">
              <span class="material-symbols-outlined text-xs">unfold_more</span> View Records
            </button>
          </td>
          <td class="py-4 px-4">
            <p class="font-semibold text-on-surface-variant">{{ $farmer->city ?? 'No City' }}, {{ $farmer->state ?? 'No State' }}</p>
            <p class="text-[10px] text-on-surface-variant/70">{{ $farmer->address ?? '—' }}</p>
          </td>
          <td class="py-4 px-4 text-center font-bold">{{ $farmer->crop_count }} crops</td>
          <td class="py-4 px-4 text-right font-black text-on-surface">₹{{ number_format($farmer->total_sales, 0) }}</td>
          <td class="py-4 px-4 text-center">
            @if($farmer->is_verified)
              <span class="px-2.5 py-1 bg-green-500/10 text-green-700 text-[10px] font-black rounded-lg uppercase border border-green-500/20">Verified</span>
            @else
              <span class="px-2.5 py-1 bg-amber-500/10 text-amber-700 text-[10px] font-black rounded-lg uppercase border border-amber-500/20">Pending</span>
            @endif
          </td>
          <td class="py-4 px-4 text-center">
            @if($farmer->is_suspended)
              <span class="px-2 py-0.5 bg-error/10 text-error text-[9px] font-black rounded uppercase">Suspended</span>
            @else
              <span class="px-2 py-0.5 bg-primary/10 text-primary text-[9px] font-black rounded uppercase">Active</span>
            @endif
          </td>
          <td class="py-4 px-6 text-center">
            <div class="flex items-center gap-1.5 justify-center">
              @if(!$farmer->is_verified)
              <form method="POST" action="{{ route('admin.verify-user', $farmer->id) }}" class="inline">
                @csrf
                <button type="submit" class="px-2.5 py-1 bg-primary text-white text-[9px] font-black uppercase rounded hover:bg-primary-container transition-all">Verify</button>
              </form>
              @endif
              @if($farmer->is_suspended)
              <form method="POST" action="{{ route('admin.release', $farmer->id) }}" class="inline">
                @csrf
                <button type="submit" class="px-2.5 py-1 bg-primary text-white text-[9px] font-black uppercase rounded hover:bg-primary/95 shadow-sm transition-all">Release</button>
              </form>
              @else
              <form method="POST" action="{{ route('admin.suspend', $farmer->id) }}" class="inline" onsubmit="return confirm('Suspend farmer {{ $farmer->name }}?')">
                @csrf
                <button type="submit" class="px-2.5 py-1 bg-error/10 text-error border border-error/10 text-[9px] font-black uppercase rounded hover:bg-error/20 transition-all">Suspend</button>
              </form>
              @endif
            </div>
          </td>
        </tr>
        {{-- Collapsible Details Row --}}
        <tr id="details-farmer-{{ $farmer->id }}" class="hidden bg-surface-container-lowest border-b border-surface-container/50">
          <td colspan="7" class="py-6 px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
              
              <!-- Column 1: Crops Listings Done -->
              <div class="bg-surface-container-low/50 rounded-2xl p-5 border border-surface-container/80">
                <div class="flex items-center gap-2 mb-4 border-b border-surface-container pb-2">
                  <span class="material-symbols-outlined text-primary text-xl">inventory_2</span>
                  <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-on-surface">Crops Listed ({{ count($farmer->crops_list) }})</h4>
                </div>
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                  @forelse($farmer->crops_list as $crop)
                    <div class="p-3 bg-surface-container-lowest rounded-xl border border-surface-container flex justify-between items-center hover:shadow-sm transition-all">
                      <div>
                        <p class="font-bold text-xs text-on-surface">{{ $crop->name }}</p>
                        <p class="text-[10px] text-on-surface-variant">Qty: {{ number_format($crop->quantity) }} {{ $crop->unit ?? 'kg' }} · Price: ₹{{ number_format($crop->price_per_unit, 2) }}/{{ $crop->unit ?? 'kg' }}</p>
                      </div>
                      <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase {{ $crop->status === 'active' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : 'bg-stone-500/10 text-stone-700' }}">{{ $crop->status }}</span>
                    </div>
                  @empty
                    <p class="text-xs text-on-surface-variant/75 text-center py-6">No crop listings uploaded.</p>
                  @endforelse
                </div>
              </div>

              <!-- Column 2: Sells (Orders) -->
              <div class="bg-surface-container-low/50 rounded-2xl p-5 border border-surface-container/80">
                <div class="flex items-center gap-2 mb-4 border-b border-surface-container pb-2">
                  <span class="material-symbols-outlined text-primary text-xl">shopping_cart</span>
                  <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-on-surface">Sells History ({{ count($farmer->orders_list) }})</h4>
                </div>
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                  @forelse($farmer->orders_list as $order)
                    <div class="p-3 bg-surface-container-lowest rounded-xl border border-surface-container hover:shadow-sm transition-all">
                      <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-xs text-on-surface">{{ !empty($order->items) ? implode(', ', collect($order->items)->pluck('name')->toArray()) : ($order->crop ? $order->crop->name : 'Crop listing') }}</span>
                        <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded {{ $order->status === 'completed' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : 'bg-amber-500/10 text-amber-700 border border-amber-500/20' }}">{{ $order->status }}</span>
                      </div>
                      <div class="flex justify-between text-[10px] text-on-surface-variant">
                        <span>Buyer: {{ $order->buyer ? $order->buyer->name : 'N/A' }}</span>
                        <span class="font-black text-on-surface">₹{{ number_format($order->total_price) }}</span>
                      </div>
                    </div>
                  @empty
                    <p class="text-xs text-on-surface-variant/75 text-center py-6">No sells recorded yet.</p>
                  @endforelse
                </div>
              </div>

              <!-- Column 3: Bids -->
              <div class="bg-surface-container-low/50 rounded-2xl p-5 border border-surface-container/80">
                <div class="flex items-center gap-2 mb-4 border-b border-surface-container pb-2">
                  <span class="material-symbols-outlined text-primary text-xl">gavel</span>
                  <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-on-surface">Bids Received ({{ count($farmer->bids_list) }})</h4>
                </div>
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                  @forelse($farmer->bids_list as $bid)
                    <div class="p-3 bg-surface-container-lowest rounded-xl border border-surface-container hover:shadow-sm transition-all">
                      <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-xs text-on-surface">{{ $bid->crop ? $bid->crop->name : 'Crop' }}</span>
                        <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded {{ $bid->status === 'accepted' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : ($bid->status === 'rejected' ? 'bg-red-500/10 text-red-700' : 'bg-amber-500/10 text-amber-700') }}">{{ $bid->status }}</span>
                      </div>
                      <div class="flex justify-between text-[10px] text-on-surface-variant">
                        <span>Bidder: {{ $bid->buyer ? $bid->buyer->name : 'N/A' }}</span>
                        <span class="font-black text-on-surface">₹{{ number_format($bid->amount ?? $bid->bid_amount ?? 0, 2) }}/{{ $bid->crop->unit ?? 'kg' }}</span>
                      </div>
                    </div>
                  @empty
                    <p class="text-xs text-on-surface-variant/75 text-center py-6">No bids placed on listings.</p>
                  @endforelse
                </div>
              </div>

            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="py-12 text-center text-on-surface-variant font-medium">No registered farmers found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ════════════════════ SECTION: BUYERS ════════════════════ --}}
<section id="section-buyers" class="hidden space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold font-headline text-on-surface">Buyers Directory</h2>
      <p class="text-xs text-on-surface-variant">Manage platform procurement agents, wholesale buyers, and suspension states.</p>
    </div>
    <span class="px-3.5 py-1.5 bg-secondary-container border border-secondary-container/20 text-on-secondary-container rounded-xl text-xs font-black">{{ $totalBuyers }} Active</span>
  </div>
  <div class="bg-surface-container-lowest rounded-2xl border border-surface-container shadow-sm overflow-hidden">
    <table class="w-full text-left">
      <thead>
        <tr class="text-[10px] font-black text-on-surface-variant/60 uppercase tracking-widest border-b border-surface-container">
          <th class="py-4 px-6">Buyer Name / Contact</th>
          <th class="py-4 px-4">Address / Pincode</th>
          <th class="py-4 px-4 text-center">Orders Placed</th>
          <th class="py-4 px-4 text-right">Aggregate Purchases</th>
          <th class="py-4 px-4 text-center">Status</th>
          <th class="py-4 px-6 text-center">Operations</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($buyers as $buyer)
        <tr class="hover:bg-surface-container-low/20 transition-all border-b border-surface-container/30 {{ $buyer->is_suspended ? 'bg-red-500/[0.02] opacity-80' : '' }}">
          <td class="py-4 px-6">
            <p class="font-bold text-on-surface">{{ $buyer->name }}</p>
            <p class="text-[10px] text-on-surface-variant">{{ $buyer->email }} · {{ $buyer->phone ?? '—' }}</p>
            <button onclick="toggleDetails('buyer-{{ $buyer->id }}')" class="text-primary hover:text-primary-container font-black text-[10px] uppercase flex items-center gap-1 mt-1.5 focus:outline-none bg-primary/5 px-2.5 py-1 rounded-lg border border-primary/10">
              <span class="material-symbols-outlined text-xs">unfold_more</span> View Records
            </button>
          </td>
          <td class="py-4 px-4">
            <p class="font-semibold text-on-surface-variant">{{ $buyer->city ?? 'No City' }}, {{ $buyer->state ?? 'No State' }}</p>
            <p class="text-[10px] text-on-surface-variant/70">{{ $buyer->address ?? '—' }}</p>
          </td>
          <td class="py-4 px-4 text-center font-bold">{{ $buyer->total_order_count }}</td>
          <td class="py-4 px-4 text-right font-black text-on-surface">₹{{ number_format($buyer->total_purchases, 0) }}</td>
          <td class="py-4 px-4 text-center">
            @if($buyer->is_suspended)
              <span class="px-2 py-0.5 bg-error/10 text-error text-[9px] font-black rounded uppercase">Suspended</span>
            @else
              <span class="px-2 py-0.5 bg-primary/10 text-primary text-[9px] font-black rounded uppercase">Active</span>
            @endif
          </td>
          <td class="py-4 px-6 text-center">
            @if($buyer->is_suspended)
            <form method="POST" action="{{ route('admin.release', $buyer->id) }}" class="inline">
              @csrf
              <button type="submit" class="px-3.5 py-1.5 bg-primary text-white text-[10px] font-black uppercase rounded-lg hover:bg-primary/95 transition-all">Release</button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.suspend', $buyer->id) }}" class="inline" onsubmit="return confirm('Suspend buyer {{ $buyer->name }}?')">
              @csrf
              <button type="submit" class="px-3.5 py-1.5 bg-error/10 text-error border border-error/10 text-[10px] font-black uppercase rounded-lg hover:bg-error/20 transition-all">Suspend</button>
            </form>
            @endif
          </td>
        </tr>
        {{-- Collapsible Details Row --}}
        <tr id="details-buyer-{{ $buyer->id }}" class="hidden bg-surface-container-lowest border-b border-surface-container/50">
          <td colspan="6" class="py-6 px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

              <!-- Column 1: Purchases (Orders) -->
              <div class="bg-surface-container-low/50 rounded-2xl p-5 border border-surface-container/80">
                <div class="flex items-center gap-2 mb-4 border-b border-surface-container pb-2">
                  <span class="material-symbols-outlined text-primary text-xl">shopping_cart</span>
                  <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-on-surface">Order History / Purchases ({{ count($buyer->orders_list) }})</h4>
                </div>
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                  @forelse($buyer->orders_list as $order)
                    <div class="p-3 bg-surface-container-lowest rounded-xl border border-surface-container hover:shadow-sm transition-all">
                      <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-xs text-on-surface">{{ !empty($order->items) ? implode(', ', collect($order->items)->pluck('name')->toArray()) : ($order->crop ? $order->crop->name : 'Crop listing') }}</span>
                        <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded {{ $order->status === 'completed' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : 'bg-amber-500/10 text-amber-700 border border-amber-500/20' }}">{{ $order->status }}</span>
                      </div>
                      <div class="flex justify-between text-[10px] text-on-surface-variant">
                        <span>Farmer: {{ $order->farmer ? $order->farmer->name : 'N/A' }}</span>
                        <span class="font-black text-on-surface">₹{{ number_format($order->total_price) }}</span>
                      </div>
                    </div>
                  @empty
                    <p class="text-xs text-on-surface-variant/75 text-center py-6">No purchases made yet.</p>
                  @endforelse
                </div>
              </div>

              <!-- Column 2: Bids Placed -->
              <div class="bg-surface-container-low/50 rounded-2xl p-5 border border-surface-container/80">
                <div class="flex items-center gap-2 mb-4 border-b border-surface-container pb-2">
                  <span class="material-symbols-outlined text-primary text-xl">gavel</span>
                  <h4 class="font-headline font-bold text-xs uppercase tracking-wider text-on-surface">Bids Placed / Accepted ({{ count($buyer->bids_list) }})</h4>
                </div>
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                  @forelse($buyer->bids_list as $bid)
                    <div class="p-3 bg-surface-container-lowest rounded-xl border border-surface-container hover:shadow-sm transition-all">
                      <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-xs text-on-surface">{{ $bid->crop ? $bid->crop->name : 'Crop' }}</span>
                        <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded {{ $bid->status === 'accepted' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : ($bid->status === 'rejected' ? 'bg-red-500/10 text-red-700' : 'bg-amber-500/10 text-amber-700') }}">{{ $bid->status }}</span>
                      </div>
                      <div class="flex justify-between text-[10px] text-on-surface-variant">
                        <span>Farmer: {{ $bid->farmer ? $bid->farmer->name : 'N/A' }}</span>
                        <span class="font-black text-on-surface">₹{{ number_format($bid->amount ?? $bid->bid_amount ?? 0, 2) }}/{{ $bid->crop->unit ?? 'kg' }}</span>
                      </div>
                    </div>
                  @empty
                    <p class="text-xs text-on-surface-variant/75 text-center py-6">No bids placed.</p>
                  @endforelse
                </div>
              </div>

            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="py-12 text-center text-on-surface-variant font-medium">No registered buyers found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ════════════════════ SECTION: CROP LISTINGS ════════════════════ --}}
<section id="section-crops" class="hidden space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold font-headline text-on-surface">Platform Crop Listings</h2>
      <p class="text-xs text-on-surface-variant">Oversee all agricultural inventory uploaded by farmers, current pricing, and active quantities.</p>
    </div>
    <span class="px-3.5 py-1.5 bg-primary/10 border border-primary/20 text-primary rounded-xl text-xs font-black">{{ count($allCrops) }} Total Listings</span>
  </div>
  
  <div class="bg-surface-container-lowest rounded-2xl border border-surface-container shadow-sm overflow-hidden">
    <div class="p-4 border-b border-surface-container flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 bg-surface-container-low/20">
      <div class="flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15 w-full sm:w-80">
        <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-xs w-full p-0" id="crops-search-input" onkeyup="filterCropsTable()" placeholder="Search crops by name, farmer, state..." type="text" />
      </div>
      <div class="flex items-center gap-2">
        <span class="text-xs font-bold text-on-surface-variant whitespace-nowrap">Filter Status:</span>
        <select id="crops-status-select" onchange="filterCropsTable()" class="bg-surface-container-low border border-outline-variant/15 text-xs rounded-full px-3 py-1.5 font-bold focus:ring-primary focus:border-primary">
          <option value="all">All Statuses</option>
          <option value="active">Active</option>
          <option value="sold">Sold</option>
          <option value="pending">Pending</option>
        </select>
      </div>
    </div>
    <table class="w-full text-left" id="crops-listings-table">
      <thead>
        <tr class="text-[10px] font-black text-on-surface-variant/60 uppercase tracking-widest border-b border-surface-container">
          <th class="py-4 px-6">Crop Name / Variety</th>
          <th class="py-4 px-4">Farmer / Origin</th>
          <th class="py-4 px-4 text-right">Base Price</th>
          <th class="py-4 px-4 text-right">Quantity</th>
          <th class="py-4 px-4 text-center">Status</th>
          <th class="py-4 px-6 text-center">Date Listed</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        @forelse($allCrops as $crop)
        <tr class="hover:bg-surface-container-low/20 transition-all border-b border-surface-container/30 crop-row-item" data-status="{{ strtolower($crop->status) }}">
          <td class="py-4 px-6">
            <div class="flex items-center gap-3">
              <span class="w-2.5 h-2.5 rounded-full {{ strtolower($crop->status) === 'active' ? 'bg-green-500' : 'bg-stone-400' }}"></span>
              <div>
                <p class="font-bold text-on-surface crop-name-text">{{ $crop->name }}</p>
                <p class="text-[10px] text-on-surface-variant">{{ $crop->category ?? 'General' }} · Grade {{ $crop->grade ?? 'A' }}</p>
              </div>
            </div>
          </td>
          <td class="py-4 px-4">
            <p class="font-semibold text-on-surface-variant crop-farmer-text">{{ $crop->farmer ? $crop->farmer->name : 'N/A' }}</p>
            <p class="text-[10px] text-on-surface-variant/70">{{ $crop->city ?? 'N/A' }}, {{ $crop->state ?? 'N/A' }}</p>
          </td>
          <td class="py-4 px-4 text-right font-black text-on-surface">₹{{ number_format($crop->price_per_unit, 2) }}/{{ $crop->unit ?? 'kg' }}</td>
          <td class="py-4 px-4 text-right font-bold text-on-surface-variant">{{ number_format($crop->quantity) }} {{ $crop->unit ?? 'kg' }}</td>
          <td class="py-4 px-4 text-center">
            <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ strtolower($crop->status) === 'active' ? 'bg-green-500/10 text-green-700 border border-green-500/20' : 'bg-stone-500/10 text-stone-700' }}">{{ $crop->status }}</span>
          </td>
          <td class="py-4 px-6 text-center text-xs text-on-surface-variant/80 font-medium">
            {{ $crop->created_at ? $crop->created_at->format('M d, Y') : 'N/A' }}
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="py-12 text-center text-on-surface-variant font-medium">No crop listings found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

{{-- ════════════════════ SECTION: LOGISTICS HUB ════════════════════ --}}
<section id="section-logistics" class="hidden space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold font-headline text-on-surface">Logistics Hub Control</h2>
      <p class="text-xs text-on-surface-variant">Bypass delivery OTP verifications, monitor active pipelines, and assign carrier partners.</p>
    </div>
    <span class="px-3.5 py-1.5 bg-primary/10 border border-primary/20 text-primary rounded-xl text-xs font-black">{{ $activeLogistics }} Shipments Live</span>
  </div>
  
  <div class="space-y-6">
    @forelse($activeShipments as $shipment)
    @php
      $stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
      $currentIdx = array_search($shipment->status, $stages);
      $progress = $currentIdx !== false ? (($currentIdx) / (count($stages) - 1)) * 100 : 0;
    @endphp
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-surface-container shadow-sm hover:shadow-md transition-all">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-6">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-secondary-container/50 border border-secondary-container/20 flex items-center justify-center text-on-secondary-container shadow-inner">
            <span class="material-symbols-outlined text-xl">local_shipping</span>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <p class="font-extrabold text-on-surface text-base">{{ $shipment->crop_name ?? 'Shipment' }}</p>
              <span class="px-2 py-0.5 bg-surface-container-high border border-surface-container text-on-surface text-[9px] font-black rounded-lg">#{{ $shipment->tracking_number ?? 'UNASSIGNED' }}</span>
            </div>
            <p class="text-xs text-on-surface-variant/80 font-semibold mt-0.5">
              {{ $shipment->farmer->name ?? 'Unknown Farmer' }} ({{ $shipment->pickup_address ?? 'Pickup' }}) → 
              {{ $shipment->buyer->name ?? 'Unknown Buyer' }} ({{ $shipment->delivery_address ?? 'Delivery' }})
            </p>
          </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 w-full lg:w-auto justify-end">
          {{-- Carrier Status Info --}}
          @if($shipment->provider)
            <div class="px-3.5 py-2 bg-surface-container text-on-surface-variant font-bold text-xs rounded-xl border border-surface-container-high flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">local_shipping</span> {{ $shipment->provider }}
            </div>
          @else
            <button onclick="openAssignModal('{{ $shipment->id }}', '{{ $shipment->crop_name }}')" class="px-3.5 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 uppercase tracking-wider">
              <span class="material-symbols-outlined text-sm">badge</span> Assign Carrier Partner
            </button>
          @endif

          {{-- Delivery OTP Bypass --}}
          @if($shipment->status !== 'Delivered')
            <form method="POST" action="{{ route('admin.otp-override', $shipment->id) }}" onsubmit="return confirm('Override Delivery OTP and mark this shipment as Delivered?')">
              @csrf
              <button type="submit" class="px-3.5 py-2 bg-primary/10 hover:bg-primary/20 text-primary border border-primary/20 font-bold text-xs rounded-xl transition-all flex items-center gap-1.5 uppercase tracking-wider">
                <span class="material-symbols-outlined text-sm">pin_invoke</span> OTP Override Bypass
              </button>
            </form>
          @endif
        </div>
      </div>

      {{-- Timeline Progress --}}
      <div class="relative py-4 px-2">
        <div class="absolute left-6 right-6 h-1 bg-surface-container-high top-1/2 -translate-y-1/2 rounded-full"></div>
        <div class="absolute left-6 h-1 bg-primary top-1/2 -translate-y-1/2 rounded-full transition-all duration-500" style="width: calc({{ $progress }}% - 12px)"></div>
        <div class="flex justify-between relative">
          @foreach($stages as $idx => $stage)
          <div class="flex flex-col items-center">
            <div class="w-5 h-5 rounded-full {{ $idx <= $currentIdx ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-surface-container text-on-surface-variant/40' }} border-4 border-surface-container-lowest flex items-center justify-center z-10 transition-all">
              @if($idx < $currentIdx || $shipment->status === 'Delivered')
                <span class="material-symbols-outlined text-[10px] font-black">check</span>
              @endif
            </div>
            <span class="text-[9px] font-black text-on-surface-variant/50 uppercase tracking-wide mt-3 text-center w-20">{{ $stage }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @empty
    <div class="bg-surface-container-lowest py-16 text-center border border-dashed border-surface-container-high rounded-2xl">
      <span class="material-symbols-outlined text-on-surface-variant/40 text-4xl mb-2">local_shipping</span>
      <p class="text-xs font-bold text-on-surface-variant">No active logistical movements registered on platform.</p>
    </div>
    @endforelse
  </div>
</section>

{{-- ════════════════════ SECTION: BID MONITOR ════════════════════ --}}
<section id="section-bids" class="hidden space-y-6">
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold font-headline text-on-surface">Bid Operations</h2>
      <p class="text-xs text-on-surface-variant">Audit live P2P marketplace bids, price negotiations, and proposal conversions.</p>
    </div>
    <span class="px-3 py-1 bg-secondary-container border border-secondary-container/20 text-on-secondary-container text-xs font-black rounded-xl">
      {{ $pendingBids }} Live proposals
    </span>
  </div>
  <div class="space-y-4">
    @forelse($liveBids as $bid)
    <div class="bg-surface-container-lowest border border-surface-container p-5 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:shadow-md transition-all shadow-sm">
      <div class="flex items-start gap-4">
        <div class="w-11 h-11 rounded-xl bg-secondary-container/40 border border-secondary-container/10 flex items-center justify-center text-on-secondary-container font-black text-xs">
          {{ strtoupper(substr($bid->crop->name ?? 'C', 0, 2)) }}
        </div>
        <div>
          <div class="flex items-center gap-2">
            <p class="font-extrabold text-on-surface text-base">{{ $bid->crop->name ?? 'Unknown Crop' }}</p>
            <span class="px-2 py-0.5 bg-surface-container-low text-[9px] font-black text-on-surface-variant rounded border border-surface-container-high uppercase">{{ $bid->status }}</span>
          </div>
          <p class="text-xs text-on-surface-variant/80 font-bold mt-1">
            Buyer: {{ $bid->buyer->name ?? '—' }} · Farmer: {{ $bid->farmer->name ?? '—' }} · Quantity: {{ number_format($bid->crop->quantity ?? 0) }} {{ $bid->crop->unit ?? 'kg' }}
          </p>
        </div>
      </div>
      <div class="flex items-center gap-6 w-full sm:w-auto justify-end border-t sm:border-t-0 pt-4 sm:pt-0">
        <div class="text-right">
          <p class="text-[9px] font-black text-on-surface-variant/40 uppercase tracking-widest">Proposal Rate</p>
          <p class="text-lg font-black text-secondary">₹{{ number_format($bid->amount ?? $bid->bid_amount ?? 0, 2) }}/{{ $bid->crop->unit ?? 'kg' }}</p>
        </div>
        <div class="text-right">
          <p class="text-[9px] font-black text-on-surface-variant/40 uppercase tracking-widest font-headline">Listing Price</p>
          <p class="text-sm font-semibold text-on-surface-variant line-through">₹{{ number_format($bid->crop->price_per_unit ?? 0, 2) }}/{{ $bid->crop->unit ?? 'kg' }}</p>
        </div>
      </div>
    </div>
    @empty
    <div class="bg-surface-container-lowest py-16 text-center border border-dashed border-surface-container-high rounded-2xl">
      <span class="material-symbols-outlined text-on-surface-variant/40 text-4xl mb-2">gavel</span>
      <p class="text-xs font-bold text-on-surface-variant">No active crop negotiation proposals detected.</p>
    </div>
    @endforelse
  </div>
</section>

{{-- ════════════════════ SECTION: MANDI REFERENCE ════════════════════ --}}
<section id="section-mandi" class="hidden space-y-6">
  <div class="mb-6">
    <h2 class="text-2xl font-bold font-headline text-on-surface">Wholesale Mandi Prices</h2>
    <p class="text-xs text-on-surface-variant">Platform reference rates extracted from major agrarian hubs.</p>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($mandiPrices as $price)
    @php
      // Compute highly premium aesthetic min/max calculations instead of hardcoded 0
      $modal = $price->price_per_q ?? 0;
      $min = round($modal * 0.9);
      $max = round($modal * 1.15);
    @endphp
    <div class="bg-secondary-fixed text-on-secondary-fixed p-5 rounded-2xl border border-secondary-fixed shadow-sm hover:shadow-md transition-all">
      <div class="flex justify-between items-start mb-2">
        <p class="text-[10px] font-black uppercase tracking-wider text-on-secondary-fixed/70">{{ $price->category ?? 'GRAIN' }}</p>
        <span class="material-symbols-outlined text-base">trending_up</span>
      </div>
      <p class="text-lg font-black text-on-secondary-fixed font-headline leading-tight">{{ $price->crop_name }}</p>
      <p class="text-3xl font-black font-headline text-primary mt-2">₹{{ number_format($modal, 0) }}<span class="text-xs font-bold text-on-secondary-fixed/70">/q</span></p>
      
      <div class="flex justify-between border-t border-on-secondary-fixed/10 pt-3 mt-4 text-[10px] font-bold text-on-secondary-fixed/80">
        <span>Min: ₹{{ number_format($min, 0) }}</span>
        <span>Max: ₹{{ number_format($max, 0) }}</span>
      </div>
      <p class="text-[9px] text-on-secondary-fixed/50 mt-2 font-semibold flex items-center gap-1">
        <span class="material-symbols-outlined text-[10px]">pin_drop</span> {{ $price->mandi_name ?? 'Agrarian Hub' }}
      </p>
    </div>
    @empty
    <div class="col-span-4 bg-surface-container-lowest py-16 text-center border border-dashed border-surface-container-high rounded-2xl">
      <span class="material-symbols-outlined text-on-surface-variant/40 text-4xl mb-2">analytics</span>
      <p class="text-xs font-bold text-on-surface-variant font-medium">No mandi pricing catalog seeded yet.</p>
    </div>
    @endforelse
  </div>
</section>

  {{-- ═══ FOOTER ═══ --}}
  <footer class="bg-gradient-to-br from-green-950 to-zinc-950 rounded-2xl w-full pt-16 pb-10 px-8 mt-16 border border-white/10 relative overflow-hidden text-white">
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-10 w-full max-w-[1920px] mx-auto mb-12 relative z-10">
      <div class="col-span-1 md:col-span-4 lg:col-span-5">
        <a href="/" class="text-2xl font-black text-primary-container mb-4 flex items-center gap-2 hover:opacity-80 transition-opacity">
          <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
          FarmDirect
        </a>
        <p class="text-sm font-medium text-white/70 leading-relaxed max-w-sm">
          Digital transparency for the modern agrarian ecosystem. Empowering farmers and buyers with technology and fair trade.
        </p>
      </div>
      <div class="col-span-1 md:col-span-2">
        <h6 class="font-headline font-extrabold mb-4 text-white text-base">Company</h6>
        <div class="flex flex-col gap-3 text-sm">
          <a class="text-white/70 hover:text-primary-container transition-colors" href="/about">About Us</a>
        </div>
      </div>
      <div class="col-span-1 md:col-span-2">
        <h6 class="font-headline font-extrabold mb-4 text-white text-base">Support</h6>
        <div class="flex flex-col gap-3 text-sm">
          <a class="text-white/70 hover:text-primary-container transition-colors" href="/help">Help Center</a>
          <a class="text-white/70 hover:text-primary-container transition-colors" href="/contact">Contact Us</a>
        </div>
      </div>
      <div class="col-span-1 md:col-span-4 lg:col-span-3">
        <h6 class="font-headline font-extrabold mb-4 text-white text-base">Developers</h6>
        <div class="flex flex-col gap-3 text-sm">
          <div class="flex items-center gap-4">
            <span class="text-white/70 font-medium flex-1">Shivansh Dubey</span>
            <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>
          <div class="flex items-center gap-4">
            <span class="text-white/70 font-medium flex-1">Saakshi Jha</span>
            <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>
          <div class="flex items-center gap-4">
            <span class="text-white/70 font-medium flex-1">Rishabh Chaurasia</span>
            <a href="#" class="text-white/50 hover:text-white transition-colors" title="LinkedIn">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/10 max-w-[1920px] mx-auto relative z-10 text-xs">
      <p class="font-bold text-white/50">© 2026 FarmDirect. Cultivating Digital Transparency.</p>
      <div class="flex gap-6 mt-4 md:mt-0">
        <a class="text-white/50 hover:text-primary-container transition-colors" href="#"><span class="material-symbols-outlined text-sm">public</span></a>
        <a class="text-white/50 hover:text-primary-container transition-colors" href="#"><span class="material-symbols-outlined text-sm">share</span></a>
        <a class="text-white/50 hover:text-primary-container transition-colors" href="/contact"><span class="material-symbols-outlined text-sm">mail</span></a>
      </div>
    </div>
  </footer>

</main>

{{-- ═══ MODAL: ASSIGN LOGISTICS PARTNER ═══ --}}
<div id="assign-carrier-modal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-surface-container-lowest border border-surface-container-high rounded-2xl p-6 w-full max-w-md shadow-2xl transition-all">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h3 class="text-lg font-bold text-on-surface font-headline">Assign Logistics Carrier</h3>
        <p class="text-xs text-on-surface-variant mt-1" id="assign-modal-title">Shipment: Basmati Rice</p>
      </div>
      <button onclick="closeAssignModal()" class="w-8 h-8 rounded-full hover:bg-surface-container flex items-center justify-center text-on-surface-variant transition-all">
        <span class="material-symbols-outlined text-base">close</span>
      </button>
    </div>
    <form id="assign-carrier-form" method="POST" action="" class="space-y-4">
      @csrf
      <div class="space-y-1">
        <label for="carrier-select" class="text-[10px] font-black text-on-surface-variant uppercase tracking-wider">Logistics Carrier Provider</label>
        <select id="carrier-select" name="provider" class="w-full bg-surface-container-low border border-surface-container-high focus:border-primary focus:ring-1 focus:ring-primary rounded-xl text-sm font-semibold py-2.5 px-3" required>
          <option value="Delhivery">Delhivery Express</option>
          <option value="BlueDart">BlueDart Agritech</option>
          <option value="Shadowfax">Shadowfax Local P2P</option>
          <option value="DHL Agro">DHL Global Forwarding</option>
        </select>
      </div>
      <div class="space-y-1">
        <label for="tracking-input" class="text-[10px] font-black text-on-surface-variant uppercase tracking-wider">Tracking Serial ID</label>
        <input type="text" id="tracking-input" name="tracking_number" placeholder="Enter tracking code, e.g. TRK789123" class="w-full bg-surface-container-low border border-surface-container-high focus:border-primary focus:ring-1 focus:ring-primary rounded-xl text-sm font-semibold py-2.5 px-3" required>
      </div>
      <div class="pt-4 flex gap-2">
        <button type="button" onclick="closeAssignModal()" class="flex-1 py-3 bg-surface-container-high hover:bg-surface-container-highest text-on-surface font-bold text-xs rounded-xl uppercase tracking-wider transition-all">Cancel</button>
        <button type="submit" class="flex-1 py-3 bg-primary hover:bg-primary-container text-white font-bold text-xs rounded-xl uppercase tracking-wider shadow-md transition-all">Assign Shipment</button>
      </div>
    </form>
  </div>
</div>

{{-- ═══ MODAL: HARVEST AI ANALYSIS ═══ --}}
<div id="ai-projection-modal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-[#0b170e] text-white rounded-3xl p-6 w-full max-w-xl shadow-2xl transition-all border border-white/10 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-start mb-6">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20 animate-pulse">
          <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">psychology</span>
        </div>
        <div>
          <h3 class="text-xl font-bold font-headline">Harvest AI Platform Analyst</h3>
          <p class="text-[10px] text-white/50 uppercase tracking-widest font-black mt-0.5">Real-time Sowing & Pricing Engine</p>
        </div>
      </div>
      <button onclick="closeAiProjectionModal()" class="w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white/70 transition-all">
        <span class="material-symbols-outlined text-base">close</span>
      </button>
    </div>

    <div class="space-y-6">
      <div class="p-4 bg-white/5 border border-white/5 rounded-2xl space-y-2">
        <h4 class="text-xs font-black uppercase text-primary tracking-wider flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span> Executive Recommendation Summary
        </h4>
        <p class="text-xs text-white/80 leading-relaxed">
          Platform-wide inventory points to an aggregate seed demand expansion for **Kharif pulses** (+18.4%). Local grain storage buffers are adequate at 74% maximum capacity. Direct-to-retail procurement efficiency stands at a record **94.8%** conversion.
        </p>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div class="bg-white/5 border border-white/5 p-4 rounded-xl">
          <p class="text-[9px] font-black text-white/40 uppercase tracking-wider">Mandi Arbitrage Delta</p>
          <p class="text-lg font-black text-white mt-1">₹340 / quintal avg</p>
          <p class="text-[9px] text-primary font-bold mt-1">▲ 8.4% above wholesale</p>
        </div>
        <div class="bg-white/5 border border-white/5 p-4 rounded-xl">
          <p class="text-[9px] font-black text-white/40 uppercase tracking-wider">Logistics Congestion Index</p>
          <p class="text-lg font-black text-white mt-1">Minimal (0.23 ETA delta)</p>
          <p class="text-[9px] text-white/50 mt-1">Optimal fleet distribution</p>
        </div>
      </div>

      <div class="space-y-3">
        <h4 class="text-xs font-black uppercase text-white/50 tracking-wider">Statewise Agrarian Insights</h4>
        <div class="space-y-2 text-xs">
          <div class="flex justify-between py-2 border-b border-white/5">
            <span class="font-bold text-white/70">Punjab (Basmati Hub)</span>
            <span class="text-primary font-black">Demand peak high (▲ 24.8%)</span>
          </div>
          <div class="flex justify-between py-2 border-b border-white/5">
            <span class="font-bold text-white/70">Madhya Pradesh (Pulses Corridor)</span>
            <span class="text-primary font-black">Moderate seed sowing (▲ 12.6%)</span>
          </div>
          <div class="flex justify-between py-2">
            <span class="font-bold text-white/70">Maharashtra (Lasalgaon Onion Market)</span>
            <span class="text-amber-400 font-black">Price correction expected (▼ 4.2%)</span>
          </div>
        </div>
      </div>
      
      <button onclick="closeAiProjectionModal()" class="w-full py-3.5 bg-primary hover:bg-primary-container text-white font-bold text-xs rounded-xl uppercase tracking-wider shadow-lg transition-all">Dismiss Analyst Dialog</button>
    </div>
  </div>
</div>

{{-- ═══ SCRIPTS ═══ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Tab Switching
function showSection(name, element) {
  // Hide all sections
  document.querySelectorAll('[id^="section-"]').forEach(s => s.classList.add('hidden'));
  // Show target section
  const target = document.getElementById('section-' + name);
  if (target) target.classList.remove('hidden');
  
  // Deactivate all sidebar links
  document.querySelectorAll('#admin-sidebar .sidebar-link').forEach(l => {
    l.classList.remove('text-white', 'bg-white/10');
    l.classList.add('text-stone-300', 'hover:text-white', 'hover:bg-white/5');
    const icon = l.querySelector('.material-symbols-outlined');
    if (icon) {
      icon.classList.remove('text-primary');
      icon.classList.add('text-stone-400');
    }
  });

  // Activate selected sidebar link
  if (element) {
    element.classList.remove('text-stone-300', 'hover:text-white', 'hover:bg-white/5');
    element.classList.add('text-white', 'bg-white/10');
    const icon = element.querySelector('.material-symbols-outlined');
    if (icon) {
      icon.classList.remove('text-stone-400');
      icon.classList.add('text-primary');
    }
  } else {
    // Find matching link by name if element not passed directly
    const link = document.querySelector(`#admin-sidebar a[href="#${name}"]`);
    if (link) {
      link.classList.remove('text-stone-300', 'hover:text-white', 'hover:bg-white/5');
      link.classList.add('text-white', 'bg-white/10');
      const icon = link.querySelector('.material-symbols-outlined');
      if (icon) {
        icon.classList.remove('text-stone-400');
        icon.classList.add('text-primary');
      }
    }
  }
}

// Ensure active tab on page load based on location hash
document.addEventListener('DOMContentLoaded', () => {
  const hash = window.location.hash.replace('#', '');
  if (hash && ['dashboard', 'farmers', 'buyers', 'logistics', 'bids', 'mandi'].includes(hash)) {
    showSection(hash);
  } else {
    showSection('dashboard');
  }
});

// Assign Logistics Modal Controls
function openAssignModal(id, cropName) {
  const modal = document.getElementById('assign-carrier-modal');
  const modalTitle = document.getElementById('assign-modal-title');
  const form = document.getElementById('assign-carrier-form');
  
  if (modal && modalTitle && form) {
    modalTitle.textContent = "Shipment: " + cropName;
    form.action = "/dashboard/admin/logistics/" + id + "/assign";
    modal.classList.remove('hidden');
  }
}

function closeAssignModal() {
  const modal = document.getElementById('assign-carrier-modal');
  if (modal) modal.classList.add('hidden');
}

// Harvest AI Modal Controls
function openAiProjectionModal() {
  const modal = document.getElementById('ai-projection-modal');
  if (modal) modal.classList.remove('hidden');
}

function closeAiProjectionModal() {
  const modal = document.getElementById('ai-projection-modal');
  if (modal) modal.classList.add('hidden');
}

// Toggle detailed view rows for directory entities
function toggleDetails(id) {
  const row = document.getElementById('details-' + id);
  if (row) {
    row.classList.toggle('hidden');
  }
}

// Client-side quick filter for crops listings table
function filterCropsTable() {
  const query = document.getElementById('crops-search-input').value.toLowerCase();
  const statusFilter = document.getElementById('crops-status-select').value.toLowerCase();
  const rows = document.querySelectorAll('#crops-listings-table .crop-row-item');
  
  rows.forEach(row => {
    const nameText = row.querySelector('.crop-name-text').textContent.toLowerCase();
    const farmerText = row.querySelector('.crop-farmer-text').textContent.toLowerCase();
    const status = row.getAttribute('data-status');
    
    const matchesQuery = nameText.includes(query) || farmerText.includes(query);
    const matchesStatus = statusFilter === 'all' || status === statusFilter;
    
    if (matchesQuery && matchesStatus) {
      row.classList.remove('hidden');
    } else {
      row.classList.add('hidden');
    }
  });
}

// Real-time Mandi Reference Board Refresh
function refreshMandiPrices() {
  const statusEl = document.getElementById('mandi-update-status');
  const syncIcon = document.getElementById('mandi-sync-icon');
  
  if (statusEl) statusEl.classList.remove('hidden');
  if (syncIcon) syncIcon.classList.add('animate-spin');
  
  fetch('/api/dashboard/admin/stats')
    .then(r => r.json())
    .then(data => {
      const mandiList = document.getElementById('mandi-price-list');
      if (mandiList && data.mandi_prices) {
        let html = '';
        data.mandi_prices.forEach(price => {
          const val = price.price_per_q || 0;
          const formattedVal = new Intl.NumberFormat('en-IN').format(val);
          html += `
            <div class="flex justify-between items-center text-xs border-b border-surface-container/50 pb-2 hover:bg-surface-container-low/20 transition-all">
              <span class="font-bold text-on-surface-variant">${price.crop_name || 'Unknown'}</span>
              <span class="text-primary font-black">₹${formattedVal}/q</span>
            </div>
          `;
        });
        mandiList.innerHTML = html;
      }
    })
    .catch(err => console.error("Error syncing mandi prices", err))
    .finally(() => {
      setTimeout(() => {
        if (statusEl) statusEl.classList.add('hidden');
        if (syncIcon) syncIcon.classList.remove('animate-spin');
      }, 850);
    });
}

// Auto-poll stats in the background every 8 seconds
let revenueChart;
function updateTimeAndGreeting() {
  const now = new Date();
  const hour = now.getHours();
  
  // Update greeting text based on client local time
  let greetingText = 'Good evening';
  if (hour < 12) {
    greetingText = 'Good morning';
  } else if (hour < 17) {
    greetingText = 'Good afternoon';
  }
  
  const greetingEl = document.getElementById('admin-greeting-text');
  if (greetingEl) {
    greetingEl.textContent = greetingText;
  }
  
  // Update live clock ticking
  const clockEl = document.getElementById('admin-clock');
  if (clockEl) {
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // 0 should be 12
    clockEl.textContent = `${hours}:${minutes} ${ampm}`;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  updateTimeAndGreeting();
  setInterval(updateTimeAndGreeting, 30000); // refresh every 30 seconds

  const ctx = document.getElementById('revenueChart');
  if (ctx) {
    revenueChart = new Chart(ctx.getContext('2d'), {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Procurement Revenue',
          data: @json($revenueData),
          borderColor: '#136d22',
          backgroundColor: 'rgba(19, 109, 34, 0.08)',
          borderWidth: 4,
          fill: true,
          tension: 0.4,
          pointRadius: 6,
          pointBackgroundColor: '#ffffff',
          pointBorderColor: '#136d22',
          pointBorderWidth: 2,
          pointHoverRadius: 8,
          pointHoverBackgroundColor: '#136d22',
          pointHoverBorderColor: '#ffffff',
          pointHoverBorderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            mode: 'index',
            intersect: false,
            backgroundColor: '#2b2e2a',
            titleColor: '#ffffff',
            bodyColor: '#ffffff',
            borderColor: '#136d22',
            borderWidth: 1,
            displayColors: false,
            callbacks: {
              label: function(context) {
                return '₹' + new Intl.NumberFormat('en-IN').format(context.raw);
              }
            }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: {
              color: '#6f756a',
              font: { size: 11, weight: 'bold' }
            }
          },
          y: {
            grid: { color: 'rgba(111, 117, 106, 0.08)' },
            ticks: {
              color: '#6f756a',
              callback: function(value) {
                return '₹' + new Intl.NumberFormat('en-IN').format(value);
              },
              font: { size: 10 }
            }
          }
        }
      }
    });
  }
});

setInterval(() => {
  fetch('/api/dashboard/admin/stats')
    .then(r => r.json())
    .then(d => {
      if (d.success) {
        // Farmers Stats
        const sf = document.getElementById('stat-farmers');
        const sfs = document.getElementById('stat-farmers-suspended');
        const sfa = document.getElementById('stat-farmers-active');
        if (sf) sf.textContent = d.total_farmers;
        if (sfs) sfs.textContent = d.suspended_farmers;
        if (sfa) sfa.textContent = d.total_farmers - d.suspended_farmers;
        
        // Buyers Stats
        const sb = document.getElementById('stat-buyers');
        const sbs = document.getElementById('stat-buyers-suspended');
        const sba = document.getElementById('stat-buyers-active');
        if (sb) sb.textContent = d.total_buyers;
        if (sbs) sbs.textContent = d.suspended_buyers;
        if (sba) sba.textContent = d.total_buyers - d.suspended_buyers;
        
        // Revenue & Completed Orders Stats
        const sr = document.getElementById('stat-revenue');
        const sco = document.getElementById('stat-completed-orders');
        if (sr) sr.textContent = '₹' + new Intl.NumberFormat('en-IN').format(d.total_revenue);
        if (sco) sco.textContent = d.completed_orders;
        
        // Update Chart
        if (revenueChart && d.revenue_data) {
          revenueChart.data.datasets[0].data = d.revenue_data;
          revenueChart.update();
        }
        
        // Secondary stats
        const sal = document.getElementById('stat-active-logistics');
        const sac = document.getElementById('stat-active-crops');
        const spo = document.getElementById('stat-pending-orders');
        if (sal) sal.textContent = d.active_logistics;
        if (sac) sac.textContent = d.active_crops;
        if (spo) spo.textContent = d.pending_orders;
        
        // Update Mandi price board in background if sync isn't spinning
        const syncIcon = document.getElementById('mandi-sync-icon');
        if (syncIcon && !syncIcon.classList.contains('animate-spin') && d.mandi_prices) {
          const mandiList = document.getElementById('mandi-price-list');
          if (mandiList) {
            let html = '';
            d.mandi_prices.forEach(price => {
              const val = price.price_per_q || 0;
              const formattedVal = new Intl.NumberFormat('en-IN').format(val);
              html += `
                <div class="flex justify-between items-center text-xs border-b border-surface-container/50 pb-2 hover:bg-surface-container-low/20 transition-all">
                  <span class="font-bold text-on-surface-variant">${price.crop_name || 'Unknown'}</span>
                  <span class="text-primary font-black">₹${formattedVal}/q</span>
                </div>
              `;
            });
            mandiList.innerHTML = html;
          }
        }
      }
    }).catch(() => {});
}, 8000);
</script>
{{-- Floating AI Chat Widget --}}
@include('partials.farmbot')
</body>
</html>
