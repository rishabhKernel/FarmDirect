<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Contact Us | FarmDirect</title>
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="/js/tailwind.min.js"></script>
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
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-shadow {
            box-shadow: 0 12px 24px rgba(26, 28, 27, 0.06);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8f5e9] via-white to-[#fff3e0] min-h-screen font-body text-on-surface antialiased relative">

<!-- Dark Premium Hero Background for White Nav Contrast -->
<div class="absolute top-0 left-0 w-full h-[60vh] bg-gradient-to-b from-green-950 via-green-900/90 to-transparent -z-10"></div>

<!-- Top Navigation Shell (Mirrored from Landing Page) -->
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
            <span class="text-white font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-white text-lg hidden md:block">Contact Us</span>
        </div>
        <div class="w-24"></div> <!-- Spacer for perfect centering -->
    </nav>
</header>

<main class="pt-32 pb-24 px-8 max-w-7xl mx-auto">
<!-- Hero Header -->
<header class="mb-16 text-center lg:text-left">
<h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-6 max-w-3xl leading-[1.1] drop-shadow-md">
                Bridging the Gap from Soil to Screen.
            </h1>
<p class="font-label text-lg text-green-100/90 max-w-2xl leading-relaxed">
                Whether you're a producer looking to list your harvest or a curated buyer seeking premium agrarian insights, our team is here to cultivate the connection. Reach out to our stewards today.
            </p>
</header>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Contact Info Column -->
<div class="lg:col-span-4 space-y-8">
<!-- Info Card 1 -->
<div class="bg-white/80 backdrop-blur-2xl p-8 rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(13,99,27,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(13,99,27,0.25)] transform transition-all hover:-translate-y-2 border border-white/60 space-y-6">
<div class="flex flex-col gap-1">
<span class="font-label text-xs uppercase tracking-widest text-primary font-bold">Direct Channels</span>
<h3 class="font-headline text-2xl font-bold tracking-tight">Our Homestead</h3>
</div>
<div class="space-y-4">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm">
<span class="material-symbols-outlined">alternate_email</span>
</div>
<div>
<p class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Email Us</p>
<p class="font-bold text-on-surface">hello@farmdirect.com</p>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm">
<span class="material-symbols-outlined">call</span>
</div>
<div>
<p class="text-xs font-label text-on-surface-variant uppercase tracking-wider">Speak with us</p>
<p class="font-bold text-on-surface">+1 (800) GROW-NOW</p>
</div>
</div>
</div>
</div>
<!-- Map Card -->
<div class="bg-white/80 backdrop-blur-2xl rounded-[2rem] overflow-hidden shadow-[0_20px_50px_-12px_rgba(13,99,27,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(13,99,27,0.25)] transform transition-all hover:-translate-y-2 border border-white/60 h-64 relative group">
<img alt="Scenic Farm Aerial" class="w-full h-full object-cover" data-alt="Breathtaking aerial view of geometric crop fields in various shades of green and gold at sunrise with long shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTdRDbDSow33aPG356mU-1MJHOaCavu_kOipn_APRBHKuVLQSBgoOaZLjATpRTHLNDCM-iA7gXelKA_GjFkSui8zp2Y-qnngJnaY8Sxy_xn_-dmdK8y2eBu25lcd7fUWP7HvckvvHr_ok3CAWtRrqyMxjSx-nFE48uxX81JVe1Dkg_6KQQr7I5K36a7axpUw6ErjVWnY9Jm-DkTKabFFgeiICCOsdzjJb9_w9mBoP7xbzdQYXHdOc8XOmnfZicOOaEOocxS_QeOHOz"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent flex items-end p-6">
<div class="bg-white/70 backdrop-blur-md p-4 rounded-lg w-full flex justify-between items-center">
<div>
<p class="text-xs font-bold text-primary uppercase">Headquarters</p>
<p class="text-sm font-headline font-extrabold text-on-surface">Punjab, India</p>
</div>
<span class="material-symbols-outlined text-primary">location_on</span>
</div>
</div>
</div>
</div>
<!-- Form Column -->
<div class="lg:col-span-8">
<div class="bg-white/80 backdrop-blur-2xl rounded-[2rem] p-10 md:p-12 shadow-[0_20px_50px_-12px_rgba(13,99,27,0.15)] hover:shadow-[0_30px_60px_-12px_rgba(13,99,27,0.25)] transition-all border border-white/60 relative overflow-hidden">
<div class="absolute -top-32 -right-32 w-64 h-64 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

@if(session('success'))
<div class="mb-8 p-4 rounded-xl bg-primary-container/20 border border-primary-container/30 text-primary-container font-label text-sm flex items-center gap-3 relative z-10">
<span class="material-symbols-outlined">check_circle</span>
{{ session('success') }}
</div>
@endif

<form class="space-y-8 relative z-10" method="POST" action="/contact">
@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="space-y-2">
<label class="font-label text-xs uppercase tracking-widest text-green-900 font-bold px-1" for="name">Your Name</label>
<input class="w-full bg-white border border-green-100/80 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl p-4 font-label text-on-surface placeholder:text-zinc-400 transition-all shadow-inner" id="name" name="name" placeholder="Name" type="text" required/>
</div>
<div class="space-y-2">
<label class="font-label text-xs uppercase tracking-widest text-green-900 font-bold px-1" for="email">Email</label>
<input class="w-full bg-white border border-green-100/80 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl p-4 font-label text-on-surface placeholder:text-zinc-400 transition-all shadow-inner" id="email" name="email" placeholder="Email" type="email" required/>
</div>
</div>
<div class="space-y-2">
<label class="font-label text-xs uppercase tracking-widest text-green-900 font-bold px-1" for="subject">Nature of Inquiry</label>
<select class="w-full bg-white border border-green-100/80 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl p-4 font-label text-on-surface appearance-none transition-all shadow-inner" id="subject" name="subject" required>
<option>Marketplace Listing</option>
<option>Yield Insights &amp; Analytics</option>
<option>Producer Verification</option>
<option>Other Inquiry</option>
</select>
</div>
<div class="space-y-2">
<label class="font-label text-xs uppercase tracking-widest text-green-900 font-bold px-1" for="message">Your Message</label>
<textarea class="w-full bg-white border border-green-100/80 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl p-4 font-label text-on-surface placeholder:text-zinc-400 transition-all resize-none shadow-inner" id="message" name="message" placeholder="How can we help cultivate your success?" rows="5" required></textarea>
</div>
<div class="pt-4">
<button class="w-full md:w-auto px-10 py-4 bg-gradient-to-br from-primary to-primary-container text-white font-label font-bold text-sm rounded-xl hover:opacity-90 transition-opacity flex items-center justify-center gap-3 shadow-lg shadow-primary/20" type="submit">
                                Send Message
                                <span class="material-symbols-outlined text-[18px]">send</span>
</button>
</div>
</form>
</div>
</div>
</div>
<!-- Featured Section (Asymmetric) -->
<section class="mt-24 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
<div class="rounded-2xl overflow-hidden h-96 relative">
<img alt="Hands holding soil" class="w-full h-full object-cover" data-alt="Extreme close-up of weathered hands holding a pile of rich dark organic soil with a tiny green seedling emerging" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh7a7Fpz0qAf4y9te1JNpKAzw3284RTufGkcnAp8eFzX71NxTv1EJImUuOG-slrMiu5_4dU45cXVL65qk_i0igkfCC7kFeZa_K6V4Jy5IFMGd8P_uSds2xiVrMbxLTEZAhk30SXUira9d43vWpjmzvcPhfi48n1RgAU-GA3SoLjuI1Y_4rLpjWzC2dMzLuM9l5-rFD_oq4zcwCqoONM6I2Kxhd0PXdZt52nkAlCgl9T3e6jkIi7hdJm8xRLJRyJkZOLeBsO1IV2fLc"/>
<div class="absolute inset-0 bg-on-background/10"></div>
</div>
<div class="space-y-6">
<div class="w-12 h-1 bg-primary"></div>
<h2 class="font-headline text-4xl font-extrabold tracking-tighter leading-tight">Grounded in Integrity, Driven by Intelligence.</h2>
<p class="font-label text-on-surface-variant leading-relaxed">
                    Our platform isn't just about transactions; it's about transparency. If you have questions about our AI-verified yield reports or how we curate our seasonal marketplace, we're here to provide clarity.
                </p>
<div class="flex gap-4">
<div class="flex flex-col">
<span class="font-headline text-2xl font-black text-primary">2.4k+</span>
<span class="font-label text-xs uppercase tracking-widest text-on-surface-variant">Active Producers</span>
</div>
<div class="w-px h-10 bg-outline-variant/30"></div>
<div class="flex flex-col">
<span class="font-headline text-2xl font-black text-primary">98%</span>
<span class="font-label text-xs uppercase tracking-widest text-on-surface-variant">Satisfaction</span>
</div>
</div>
</div>
</section>
</main>
<!-- Footer Shell -->
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