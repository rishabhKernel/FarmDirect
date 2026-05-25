<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>About Us | FarmDirect</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;family=Plus+Jakarta+Sans:wght@200..800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                "primary": "#0d631b",
                "on-error": "#ffffff",
                "primary-fixed": "#a3f69c",
                "error-container": "#ffdad6"
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
          }
        }
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8f5e9] via-white to-[#fff3e0] min-h-screen text-on-surface antialiased relative">
<!-- Dark Premium Hero Background for White Nav Contrast -->
<div class="absolute top-0 left-0 w-full h-[60vh] bg-gradient-to-b from-green-950 via-green-900/90 to-transparent -z-10"></div>

<!-- Top Navigation Shell (Mirrored from Landing Page / Contact) -->
<header id="main-header" class="fixed top-0 w-full z-50 bg-white/10 backdrop-blur-xl border-b border-white/10 transition-colors duration-300">
    <nav class="flex justify-between items-center px-6 lg:px-12 h-20 max-w-[1920px] mx-auto">
        <a href="javascript:void(0)" onclick="window.history.length > 1 ? window.history.back() : (window.location.href = '{{ auth()->check() ? '/dashboard/' . auth()->user()->role : '/' }}')" class="text-white/80 font-semibold hover:text-white transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span> Back
        </a>
        <div class="flex items-center gap-6">
            <a href="@auth @if(auth()->user()->role === 'admin') /dashboard/admin @elseif(auth()->user()->role === 'farmer') /dashboard/farmer @elseif(auth()->user()->role === 'buyer') /dashboard/buyer @else / @endif @else / @endauth" class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-2 hover:opacity-80 transition-opacity">
                <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                Farm<span class="text-primary-fixed">Direct</span>
            </a>
            <span class="text-white font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-white text-lg hidden md:block">About Us</span>
        </div>
        <div class="w-24"></div> <!-- Spacer for perfect centering -->
</nav>
</header>
<main class="pt-24 pb-16 px-6 lg:px-12 max-w-7xl mx-auto">
<!-- Hero Search Section -->
<section class="mt-12 mb-20 text-center lg:text-left">
<h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-8 drop-shadow-md">About <span class="text-primary-fixed">FarmDirect</span></h1>
<p class="max-w-3xl text-xl md:text-2xl text-green-100/90 font-body leading-relaxed mx-auto lg:mx-0">
                The definitive ecosystem connecting elite growers with global buyers through radical transparency and cutting-edge technology.
            </p>
</section>
<!-- Category Bento Grid -->
<section class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-20">
<!-- Large Main Card: Selling -->
<div class="md:col-span-8 bg-surface-container-lowest rounded-[2rem] p-10 flex flex-col justify-between group cursor-pointer hover:shadow-2xl hover:shadow-on-surface/5 transition-all duration-300">
<div>
<div class="w-14 h-14 bg-primary-container/10 rounded-2xl flex items-center justify-center mb-6 text-primary">
<span class="material-symbols-outlined text-3xl">eco</span>
</div>
<h3 class="text-3xl font-headline font-bold mb-4">Our Mission</h3>
<p class="text-on-surface-variant leading-relaxed max-w-md">To empower the world's most dedicated growers by providing direct access to global markets, ensuring every harvest reaches its full potential through fair commerce.</p>
</div>
<div class="mt-12 flex flex-wrap gap-4">
<div class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-xl">
<span class="font-label text-sm font-semibold text-primary">Empowering Growers</span>
</div>
<div class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-xl">
<span class="font-label text-sm font-semibold text-primary">Global Connectivity</span>
</div>
</div>
</div>
<!-- Vertical Card: Payments -->
<div class="md:col-span-4 bg-secondary-container rounded-[2rem] p-10 flex flex-col transition-transform hover:-translate-y-2 duration-300">
<div class="w-14 h-14 bg-white/40 rounded-2xl flex items-center justify-center mb-6 text-on-secondary-container">
<span class="material-symbols-outlined text-3xl">visibility</span>
</div>
<h3 class="text-2xl font-headline font-bold mb-4 text-on-secondary-container">Our Vision</h3>
<p class="text-on-secondary-container/80 text-sm leading-relaxed mb-10">A future where agricultural trade is decentralized, sustainable, and defined by the quality of the soil and the integrity of the grower.</p>
<div class="mt-auto">
<span class="font-label text-xs uppercase tracking-widest text-on-secondary-container font-bold">Pioneering Agri-Tech 2030</span>
</div>
</div>
<div class="md:col-span-12 bg-surface-container-low rounded-[2rem] p-10 lg:p-16">
<div class="grid md:grid-cols-2 gap-12 items-center">
<div>
<h2 class="text-4xl font-headline font-black tracking-tight mb-6">The AgriCore Difference</h2>
<div class="space-y-8">
<div class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center font-bold">01</div>
<div>
<h4 class="font-headline font-bold text-xl mb-2">AI-Verified Origins</h4>
<p class="text-on-surface-variant text-sm">Every batch is cross-referenced with satellite imagery and soil sensor data to guarantee 100% authentic provenance.</p>
</div>
</div>
<div class="flex gap-4">
<div class="flex-shrink-0 w-12 h-12 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center font-bold">02</div>
<div>
<h4 class="font-headline font-bold text-xl mb-2">Secure Escrow Protocols</h4>
<p class="text-on-surface-variant text-sm">Automated smart contracts ensure funds are only released when quality standards and delivery logs are validated.</p>
</div>
</div>
</div>
</div>
<div class="rounded-3xl overflow-hidden shadow-2xl h-80">
<img alt="Advanced Agricultural Technology" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJ1qGqzYhb8M_-WObBTc2KQ6lkzAsMOyi4mWP2hFWBaep4r5-fBamNAqN2M-ntbM1eFRW0Q4kIA0mPm3iPA4pjCgFeC0WpGU6SIS-9HOLqLiRqC6_bYW7MobvEBX7hnJ65Vz2cy2Wv9p1_YfwOMUugR2aqrZjRbVX1BxnAI9yELdWtjfeNIZluG-MzUReSMQQiVf76PD8Fg4FjVFSY24ayPKlNL174Wkc52dmm7LEQka2USz3OVrxFTQApKScHoJRoSNUiI4Dd0_WJ"/>
</div>
</div>
</div>
</section>
<!-- FAQ Quick Links -->
<section class="bg-surface-container-low rounded-[3rem] p-12 lg:p-16 mb-20">
<div class="text-center mb-16">
<h2 class="text-4xl font-headline font-black tracking-tight mb-4">Our Journey</h2>
<p class="text-on-surface-variant font-label max-w-2xl mx-auto">From a small local cooperative to a global tech-driven marketplace.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
<div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-outline-variant/20">
<div class="text-primary text-3xl font-black mb-2">2018</div>
<p class="font-bold font-headline mb-2">Founded</p>
<p class="text-xs text-on-surface-variant">Started with 50 local organic farms in the Pacific Northwest.</p>
</div>
<div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-outline-variant/20">
<div class="text-primary text-3xl font-black mb-2">2020</div>
<p class="font-bold font-headline mb-2">AgriCore Launch</p>
<p class="text-xs text-on-surface-variant">Introduced our proprietary AI-verification engine.</p>
</div>
<div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-outline-variant/20">
<div class="text-primary text-3xl font-black mb-2">2022</div>
<p class="font-bold font-headline mb-2">Going Global</p>
<p class="text-xs text-on-surface-variant">Expanded operations to 12 countries across three continents.</p>
</div>
<div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-outline-variant/20">
<div class="text-primary text-3xl font-black mb-2">Today</div>
<p class="font-bold font-headline mb-2">$1B+ Traded</p>
<p class="text-xs text-on-surface-variant">Empowering over 10,000 elite growers worldwide.</p>
</div>
</div>
</section>

<!-- Meet the Developers -->
<section class="mb-20">
<div class="text-center mb-16">
<h2 class="text-4xl font-headline font-black tracking-tight mb-4">Meet the Developers</h2>
<p class="text-on-surface-variant font-label max-w-2xl mx-auto">The engineering team cultivating the digital transparency of FarmDirect.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Developer 1 -->
    <div class="bg-surface-container-low rounded-[2rem] p-8 text-center border border-outline-variant/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
        <div class="w-24 h-24 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 overflow-hidden">
            <span class="material-symbols-outlined text-4xl text-primary">person</span>
        </div>
        <h3 class="text-xl font-headline font-bold mb-2">Shivansh Dubey</h3>
        <p class="text-sm font-label text-on-surface-variant mb-6">Full Stack Developer</p>
        <div class="flex justify-center gap-4">
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-[#0A66C2] transition-colors" title="LinkedIn">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-black transition-colors" title="GitHub">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            </a>
        </div>
    </div>
    <!-- Developer 2 -->
    <div class="bg-surface-container-low rounded-[2rem] p-8 text-center border border-outline-variant/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
        <div class="w-24 h-24 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 overflow-hidden">
            <span class="material-symbols-outlined text-4xl text-primary">person</span>
        </div>
        <h3 class="text-xl font-headline font-bold mb-2">Saakshi Jha</h3>
        <p class="text-sm font-label text-on-surface-variant mb-6">Frontend Engineer</p>
        <div class="flex justify-center gap-4">
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-[#0A66C2] transition-colors" title="LinkedIn">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-black transition-colors" title="GitHub">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            </a>
        </div>
    </div>
    <!-- Developer 3 -->
    <div class="bg-surface-container-low rounded-[2rem] p-8 text-center border border-outline-variant/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
        <div class="w-24 h-24 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 overflow-hidden">
            <span class="material-symbols-outlined text-4xl text-primary">person</span>
        </div>
        <h3 class="text-xl font-headline font-bold mb-2">Rishabh Chaurasia</h3>
        <p class="text-sm font-label text-on-surface-variant mb-6">Backend Engineer</p>
        <div class="flex justify-center gap-4">
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-[#0A66C2] transition-colors" title="LinkedIn">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-zinc-500 hover:text-black transition-colors" title="GitHub">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
            </a>
        </div>
    </div>
</div>
</section>
<!-- Contact Support -->
<section class="flex flex-col md:flex-row gap-8 items-center bg-zinc-950 rounded-[3rem] p-12 overflow-hidden relative">
<div class="relative z-10 flex-1">
<h2 class="text-3xl md:text-5xl font-headline font-bold text-white mb-4">Need assistance?</h2>
<p class="text-zinc-400 font-label mb-8">Our support team is available 24/7 to help you keep your farm running smoothly. For corporate inquiries, visit our headquarters.</p>
<div class="mb-8 space-y-2">
<h4 class="text-white font-bold font-headline text-lg">Headquarters</h4>
<p class="text-zinc-400 text-sm">Agricultural Hub<br/>Punjab, India</p>
</div>
<div class="flex flex-wrap gap-4">
<a href="/help" class="px-8 py-4 bg-white text-zinc-950 font-label font-bold rounded-xl flex items-center gap-3">
<span class="material-symbols-outlined">chat_bubble</span>
                        Live Chat
                    </a>
<a href="/contact" class="px-8 py-4 bg-zinc-800 hover:bg-zinc-700 transition-colors text-white font-label font-bold rounded-xl flex items-center gap-3 w-fit">
<span class="material-symbols-outlined">mail</span>
                        Email Us
                    </a>
</div>
</div>
<div class="relative w-full md:w-1/3 aspect-square rounded-2xl overflow-hidden shadow-2xl">
<img alt="AgriCore Professional Team" class="w-full h-full object-cover" data-alt="Modern high-tech workspace with greenery and warm ambient lighting, suggesting a helpful and professional environment" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlBVXUNkGKvT3vjTTBQLlMs-D8crlUW45eojJB4xM8SVGJoY7KhTyL7DKJNCHB4UTEPOaEOb04lzLM4TZhDlbU1a3RNbvvOpQnkDltCmz4lac8IG7lnx6yzrK4qsK0BLmODKzgdHpHCrlABcbZnMEl29hprrgsoboPFOLPN0Fyhcn-AZFI5trGlee4GoE0fJBWxVAywd4y719MfscJRd7-wXBRrZBUOWyALey-E5Ol7ogqtla5JjzftdDRazePqtPXW0FToOrXo_zm"/>
</div>
</section>
</main>
<footer class="bg-gradient-to-br from-green-950 to-zinc-950 w-full pt-24 pb-12 px-6 lg:px-12 mt-auto border-t border-white/10 relative overflow-hidden text-white">
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
<script>
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
</script>
</body></html>