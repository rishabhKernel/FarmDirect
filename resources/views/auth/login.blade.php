<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FarmDirect Landing Page</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-tertiary-container": "#ffedf0",
                "on-background": "#1a1c1b",
                "on-tertiary-fixed-variant": "#7f2448",
                "on-secondary-fixed-variant": "#5b4137",
                "surface-tint": "#1b6d24",
                "primary-fixed-dim": "#88d982",
                "surface-container-lowest": "#ffffff",
                "on-error-container": "#93000a",
                "surface": "#f9f9f6",
                "surface-container-highest": "#e2e3e0",
                "secondary-container": "#fed7ca",
                "surface-dim": "#dadad7",
                "inverse-on-surface": "#f1f1ee",
                "error": "#ba1a1a",
                "tertiary-fixed-dim": "#ffb1c7",
                "on-surface": "#1a1c1b",
                "on-tertiary": "#ffffff",
                "on-primary": "#ffffff",
                "secondary": "#75584d",
                "primary-container": "#2e7d32",
                "on-primary-fixed": "#002204",
                "tertiary": "#923357",
                "on-tertiary-fixed": "#3f001c",
                "on-secondary-fixed": "#2b160f",
                "surface-variant": "#e2e3e0",
                "surface-container-high": "#e8e8e5",
                "on-primary-fixed-variant": "#005312",
                "surface-container-low": "#f4f4f1",
                "secondary-fixed": "#ffdbce",
                "on-secondary": "#ffffff",
                "background": "#f9f9f6",
                "outline": "#707a6c",
                "on-secondary-container": "#795c51",
                "on-surface-variant": "#40493d",
                "surface-bright": "#f9f9f6",
                "on-primary-container": "#cbffc2",
                "secondary-fixed-dim": "#e4beb2",
                "inverse-primary": "#88d982",
                "tertiary-container": "#b14b6f",
                "surface-container": "#eeeeeb",
                "outline-variant": "#bfcaba",
                "inverse-surface": "#2f312f",
                "tertiary-fixed": "#ffd9e2",
                "primary": "#10B981",
                "primary-hover": "#059669",
                "on-error": "#ffffff",
                "primary-fixed": "#a3f69c",
                "error-container": "#ffdad6"
            },
            "borderRadius": {
                "DEFAULT": "0.75rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "fontFamily": {
                "sans": ["Manrope", "sans-serif"],
                "display": ["Manrope", "sans-serif"],
                "headline": ["Manrope", "sans-serif"],
                "body": ["Manrope", "sans-serif"],
                "label": ["Plus Jakarta Sans", "sans-serif"],
            }
          }
        }
      }
    </script>
<style>
        body { font-family: 'Manrope', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8f5e9] via-white to-[#fff3e0] min-h-screen text-on-surface antialiased relative flex flex-col">
<!-- Dark Premium Hero Background -->
<div class="absolute top-0 left-0 w-full h-[60vh] bg-gradient-to-b from-green-950 via-green-900/90 to-transparent -z-10"></div>

<header id="main-header" class="fixed top-0 w-full z-50 bg-white/10 backdrop-blur-xl border-b border-white/10 transition-colors duration-300">
    <nav class="flex justify-center items-center px-6 lg:px-12 h-20 max-w-[1920px] mx-auto">
        <div class="flex items-center gap-6">
            <a href="/" class="text-4xl md:text-5xl font-extrabold tracking-tight text-white flex items-center gap-3 hover:opacity-80 transition-opacity">
                <span class="material-symbols-outlined text-4xl md:text-5xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                Farm<span class="text-primary">Direct</span>
            </a>
            <span class="text-white font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-white text-lg hidden md:block">Login</span>
        </div>
    </nav>
</header>
<main class="flex-grow container mx-auto px-4 md:px-8 pt-32 pb-8 flex flex-col lg:flex-row gap-8 items-stretch">
<!-- Hero Visual Section -->
<section class="flex-1 w-full relative overflow-hidden rounded-[2.5rem] min-h-[600px] lg:h-auto">
<img alt="Tractor in a farm field" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDK6BM7uFqyyF0dRyDAIFqUwxaccJ0GNq0eFBAs092MYuq_6a_wACpxL1i3yb08Ls4FV6zlNCPBcNjB1C882Y2WTWe6xqKiEEhsOmdmTNqOuDp99l2Nn6mnOre_9eID-Vd_ivn38ufP3a1JiVYsJytucsoBsVsRSjkXQT5lW2LQsoElAzN7qdq4Lp5osuYlbR7RQcCh7TMIwnnCmwT-0T6mKygBla0lttW9OqvWmOs7OcYX6jEMAbx8V1n9RQrAXQ3PzuqyN8QcGJpa"/>
<div class="absolute inset-0 bg-gradient-to-b from-blue-900/60 via-green-900/40 to-green-900/90 mix-blend-multiply"></div>
<div class="relative h-full p-10 flex flex-col justify-between z-10 text-white">
<div>
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold tracking-wider mb-6 border border-white/30">
<span class="material-symbols-outlined text-[16px]">verified_user</span>
                    INSTITUTIONAL GRADE EXCHANGE
                </div>
<h1 class="text-6xl md:text-7xl font-extrabold tracking-tighter leading-[1.05] mb-6 drop-shadow-lg">
                    Cultivating<br/>
<span class="text-primary drop-shadow-md">Digital</span><br/>
                    Transparency
                </h1>
<p class="text-lg md:text-xl text-green-50 max-w-xl leading-relaxed drop-shadow-md font-medium">
                    The definitive ecosystem connecting elite growers with global buyers through real-time, blockchain-verified trade protocols.
                </p>
</div>
<div class="flex gap-12 mt-auto">
<div>
<div class="text-[10px] uppercase tracking-[0.15em] text-green-200 font-extrabold mb-1">TRADE VOLUME</div>
<div class="text-3xl font-extrabold flex items-baseline gap-2">
    ₹10,420 Cr <span class="text-sm font-bold text-primary bg-primary/20 px-2 py-0.5 rounded">+14.2%</span>
</div>
</div>
<div>
<div class="text-[10px] uppercase tracking-[0.15em] text-green-200 font-extrabold mb-1">LIVE TRANSACTIONS</div>
<div class="text-3xl font-extrabold flex items-center gap-2">
                        1,842 <span class="w-3 h-3 rounded-full bg-primary animate-pulse shadow-[0_0_10px_rgba(110,231,183,0.8)]"></span>
</div>
</div>
</div>
</div>
</section>
<!-- Auth Sidebar Section -->
<section class="w-full lg:w-[420px] flex-shrink-0 flex items-stretch">
<div class="w-full bg-[#111827] rounded-[2.5rem] p-8 md:p-10 text-white shadow-2xl relative overflow-hidden border border-gray-800 flex flex-col justify-center">
<div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>

@if(session('success'))
<div class="relative z-10 mb-6 flex items-start gap-3 bg-green-500/10 border border-green-500/30 rounded-xl px-4 py-3">
    <span class="material-symbols-outlined text-green-400 text-xl mt-0.5">check_circle</span>
    <p class="text-sm font-medium text-green-300 leading-snug">{{ session('success') }}</p>
</div>
@endif

<div class="mb-8 relative z-10">
    <div class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center border border-gray-700 shadow-inner mb-8">
        <span class="material-symbols-outlined text-primary text-2xl">fingerprint</span>
    </div>
    <h2 class="text-4xl font-extrabold mb-3 tracking-tight">Welcome<br/>back</h2>
    <p class="text-gray-400 text-sm leading-relaxed max-w-[90%] font-medium">Please enter your credentials to access the terminal.</p>
</div>

<form method="POST" action="/login" class="space-y-5 relative z-10">
    @csrf

    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3">
        <span class="material-symbols-outlined text-red-400 text-xl mt-0.5">error</span>
        <p class="text-sm font-medium text-red-300">{{ $errors->first() }}</p>
    </div>
    @endif

    <div>
        <label class="block text-[10px] font-extrabold tracking-[0.15em] text-gray-400 mb-3 uppercase">Login as</label>
        <div class="grid grid-cols-2 gap-3">
            <label id="login-label-farmer" for="login-role-farmer" class="login-role-card cursor-pointer flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-gray-700 bg-gray-800 text-sm font-bold transition-all hover:border-primary/50">
                <input type="radio" name="role" id="login-role-farmer" value="farmer" class="sr-only" {{ old('role')==='farmer' ? 'checked' : '' }} />
                <span class="material-symbols-outlined text-primary text-base">grass</span>
                <span class="text-white">Farmer</span>
            </label>
            <label id="login-label-buyer" for="login-role-buyer" class="login-role-card cursor-pointer flex items-center justify-center gap-2 py-3 rounded-xl border-2 border-gray-700 bg-gray-800 text-sm font-bold transition-all hover:border-amber-500/50">
                <input type="radio" name="role" id="login-role-buyer" value="buyer" class="sr-only" {{ old('role')==='buyer' ? 'checked' : '' }} />
                <span class="material-symbols-outlined text-amber-400 text-base">storefront</span>
                <span class="text-white">Buyer</span>
            </label>
        </div>
    </div>

    <div>
        <label class="block text-[10px] font-extrabold tracking-[0.15em] text-gray-400 mb-2 uppercase">Email / ID</label>
        <input
            name="email"
            type="email"
            value="{{ old('email') }}"
            required
            class="w-full bg-[#1F2937] border border-gray-700 text-white rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-inner text-sm font-medium placeholder-gray-600"
            placeholder="Enter your email"
        />
    </div>

    <div>
        <div class="flex justify-between items-center mb-2">
            <label class="block text-[10px] font-extrabold tracking-[0.15em] text-gray-400 uppercase">Password</label>
        </div>
        <input
            name="password"
            type="password"
            required
            class="w-full bg-[#1F2937] border border-gray-700 text-white rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-inner text-sm font-medium placeholder-gray-600"
            placeholder="••••••••"
        />
    </div>

    <button type="submit" class="w-full bg-[#6EE7B7] hover:bg-[#34D399] text-gray-900 font-extrabold py-4 rounded-xl flex items-center justify-center gap-2 transition-all mt-2 shadow-[0_0_20px_rgba(110,231,183,0.3)] hover:shadow-[0_0_25px_rgba(110,231,183,0.5)] transform hover:-translate-y-0.5">
        Let's Grow <span class="material-symbols-outlined text-lg">arrow_forward</span>
    </button>
</form>

<div class="mt-8 pt-8 border-t border-gray-800 relative z-10">
    <div class="text-center text-xs font-bold text-gray-400">
        New here? <a href="/register" class="text-primary hover:text-primary-hover ml-1 transition-colors border-b border-transparent hover:border-primary">Create Account</a>
    </div>
</div>
</div>
</section>
</main>
<!-- Premium Selection Plates -->
<section class="container mx-auto px-4 md:px-8 py-12 flex flex-col md:flex-row gap-8">
<!-- Farmer Card -->
<div class="flex-1 bg-white dark:bg-gray-800/40 p-10 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-2xl shadow-gray-200/50 dark:shadow-none relative overflow-hidden group transition-all hover:scale-[1.02] glass-card">
<div class="absolute -right-12 -bottom-12 opacity-[0.03] dark:opacity-[0.05] pointer-events-none transition-transform group-hover:scale-110">
<span class="material-symbols-outlined" style="font-size: 240px;">agriculture</span>
</div>
<div class="w-16 h-16 bg-gradient-to-br from-green-600 to-green-800 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-green-700/20">
<span class="material-symbols-outlined text-3xl">grass</span>
</div>
<div class="text-[10px] font-extrabold text-gray-400 dark:text-gray-500 mb-2 uppercase tracking-[0.2em]">ENTRY POINT 01</div>
<h3 class="text-4xl font-extrabold mb-4 text-gray-900 dark:text-white leading-tight">I am a<br/><span class="bg-gradient-to-r from-green-600 to-green-400 bg-clip-text text-transparent">Farmer</span></h3>
<p class="text-gray-500 dark:text-gray-400 mb-10 max-w-sm leading-relaxed font-medium">Scale your operations with institutional tools, price forecasting, and direct market access.</p>
<button onclick="scrollToLogin('farmer')" class="inline-flex items-center gap-3 text-sm font-extrabold text-gray-900 dark:text-white hover:text-green-700 dark:hover:text-green-400 transition-colors uppercase tracking-widest group/link">
            ACCESS PRODUCER SUITE 
            <span class="material-symbols-outlined text-lg transition-transform group-hover/link:translate-x-1">arrow_forward</span>
</button>
</div>
<!-- Buyer Card -->
<div class="flex-1 bg-white dark:bg-gray-800/40 p-10 rounded-[2.5rem] border border-gray-100 dark:border-white/5 shadow-2xl shadow-gray-200/50 dark:shadow-none relative overflow-hidden group transition-all hover:scale-[1.02] glass-card">
<div class="absolute -right-12 -bottom-12 opacity-[0.03] dark:opacity-[0.05] pointer-events-none transition-transform group-hover:scale-110">
<span class="material-symbols-outlined" style="font-size: 240px;">storefront</span>
</div>
<div class="w-16 h-16 bg-gradient-to-br from-amber-700 to-amber-900 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-amber-800/20">
<span class="material-symbols-outlined text-3xl">storefront</span>
</div>
<div class="text-[10px] font-extrabold text-gray-400 dark:text-gray-500 mb-2 uppercase tracking-[0.2em]">ENTRY POINT 02</div>
<h3 class="text-4xl font-extrabold mb-4 text-gray-900 dark:text-white leading-tight">I am a<br/><span class="bg-gradient-to-r from-amber-700 to-amber-500 bg-clip-text text-transparent">Buyer</span></h3>
<p class="text-gray-500 dark:text-gray-400 mb-10 max-w-sm leading-relaxed font-medium">Secure high-volume produce with immutable provenance and automated supply chain logistics.</p>
<button onclick="scrollToLogin('buyer')" class="inline-flex items-center gap-3 text-sm font-extrabold text-gray-900 dark:text-white hover:text-amber-800 dark:hover:text-amber-600 transition-colors uppercase tracking-widest group/link">
            ACCESS BUYER PORTAL 
            <span class="material-symbols-outlined text-lg transition-transform group-hover/link:translate-x-1">arrow_forward</span>
</button>
</div>
</section>
<footer class="bg-gray-50 dark:bg-gray-900/50 w-full py-12 px-8 border-t border-gray-100 dark:border-gray-800">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center max-w-7xl mx-auto">
<div>
<span class="font-extrabold text-gray-900 dark:text-gray-100 text-lg">FarmDirect</span>
<p class="text-[11px] font-bold text-gray-500 dark:text-gray-400 mt-2 uppercase tracking-wider">© 2026 FarmDirect Ecosystem. AI-Verified Agriculture.</p>
</div>
<div class="flex flex-wrap gap-8 md:justify-end">
<a class="text-[11px] font-extrabold text-gray-500 hover:text-primary transition-all uppercase tracking-widest" href="/about">About</a>
<a class="text-[11px] font-extrabold text-gray-500 hover:text-primary transition-all uppercase tracking-widest" href="/contact">Contact</a>
<a class="text-[11px] font-extrabold text-gray-500 hover:text-primary transition-all uppercase tracking-widest" href="/help">Help Center</a>
</div>
</div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const farmerRadio = document.getElementById('login-role-farmer');
        const buyerRadio  = document.getElementById('login-role-buyer');
        const farmerLabel = document.getElementById('login-label-farmer');
        const buyerLabel  = document.getElementById('login-label-buyer');

        function updateLoginCards() {
            // Reset both to unselected state
            farmerLabel.classList.remove('border-primary', 'bg-primary/10', 'ring-1', 'ring-primary');
            farmerLabel.classList.add('border-gray-700', 'bg-gray-800');
            buyerLabel.classList.remove('border-amber-500', 'bg-amber-900/20', 'ring-1', 'ring-amber-500');
            buyerLabel.classList.add('border-gray-700', 'bg-gray-800');

            // Highlight whichever is selected
            if (farmerRadio && farmerRadio.checked) {
                farmerLabel.classList.remove('border-gray-700', 'bg-gray-800');
                farmerLabel.classList.add('border-primary', 'bg-primary/10', 'ring-1', 'ring-primary');
            } else if (buyerRadio && buyerRadio.checked) {
                buyerLabel.classList.remove('border-gray-700', 'bg-gray-800');
                buyerLabel.classList.add('border-amber-500', 'bg-amber-900/20', 'ring-1', 'ring-amber-500');
            }
            // If neither is selected, both stay gray (admin login mode)
        }

        if (farmerRadio) farmerRadio.addEventListener('change', updateLoginCards);
        if (buyerRadio)  buyerRadio.addEventListener('change', updateLoginCards);

        // Set initial state
        updateLoginCards();

        // Navbar scroll effect
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.remove('bg-white/10', 'border-white/10');
                header.classList.add('bg-green-950/90', 'border-white/5', 'shadow-lg');
            } else {
                header.classList.add('bg-white/10', 'border-white/10');
                header.classList.remove('bg-green-950/90', 'border-white/5', 'shadow-lg');
            }
        });

        // Global function for card clicking
        window.scrollToLogin = (role) => {
            const radio = document.getElementById(`login-role-${role}`);
            if (radio) {
                radio.checked = true;
                updateLoginCards();
                // Scroll to top/login form smoothly
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        };
    });
</script>
</body></html>