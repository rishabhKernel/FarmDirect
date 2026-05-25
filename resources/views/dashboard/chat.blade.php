<!DOCTYPE html>
<html class="{{ $user->dark_mode ? 'dark' : 'light' }}" lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Chat - FarmDirect</title>
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
        
        /* Dark Mode Overrides */
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
</head>
<body class="font-body text-on-surface">
    <!-- Top Navigation Bar -->
    <nav class="fixed top-0 left-64 right-0 z-50 bg-blur backdrop-blur-md flex justify-between items-center px-8 h-20 border-b border-outline-variant/10 shadow-sm bg-white/80">
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/15">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Search chats..." type="text" />
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
                <a class="bg-primary/10 text-primary rounded-xl flex items-center gap-3 px-4 py-3 font-bold transition-all border border-primary/20 shadow-inner"
                    href="{{ route('farmer.chat') }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">chat_bubble</span>
                    <span class="font-label text-sm">Messages</span>
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
            <div class="max-w-6xl mx-auto">
                <!-- Header Section -->
                <header class="mb-8">
                    <h1 class="text-5xl font-black text-on-surface tracking-tighter mb-4">Messages</h1>
                    <p class="text-on-surface-variant font-medium max-w-2xl">Stay connected with buyers about transport, quality, and orders.</p>
                </header>

                <!-- Chat Interface -->
                <!-- Chat Interface -->
                <div class="flex-grow flex flex-row overflow-hidden bg-surface h-[700px] rounded-3xl shadow-xl border border-stone-200/50">
                    <!-- Conversation List Sidebar (WhatsApp Style) -->
                    <div class="w-full md:w-80 lg:w-96 flex flex-col border-r border-stone-200/50 bg-surface-container-low/50">
                        <div class="p-6">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-stone-400">search</span>
                                <input class="w-full pl-10 pr-4 py-3 bg-surface-container-lowest rounded-xl border-none focus:ring-2 focus:ring-primary/20 font-label text-sm shadow-sm" placeholder="Search conversations..." type="text" id="search-contacts"/>
                            </div>
                        </div>
                        
                        <div class="flex-grow overflow-y-auto px-2 pb-6 space-y-1" id="chat-list-container">
                            @forelse($chats as $chat)
                                @php
                                    $otherParticipantId = collect($chat->participants)->first(fn($id) => $id !== $user->id);
                                    $otherParticipant = \App\Models\User::find($otherParticipantId);
                                    $lastMessage = $chat->messages()->orderBy('created_at', 'desc')->first();
                                    $isActive = $chat->id === $chats->first()->id;
                                @endphp
                                <div class="p-4 {{ $isActive ? 'bg-surface-container-lowest rounded-2xl shadow-sm border border-primary/10' : 'hover:bg-stone-100 rounded-2xl' }} flex items-center gap-4 cursor-pointer transition-colors group" onclick="loadChat('{{ $chat->id }}', '{{ $otherParticipant ? $otherParticipant->name : 'Unknown' }}', '{{ ($otherParticipant && $otherParticipant->profile_picture) ? asset('storage/' . $otherParticipant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($otherParticipant ? $otherParticipant->name : 'Mock') . '&background=0d631b&color=fff&size=128' }}')">
                                    <div class="relative">
                                        <img class="w-12 h-12 rounded-full object-cover" src="{{ ($otherParticipant && $otherParticipant->profile_picture) ? asset('storage/' . $otherParticipant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($otherParticipant ? $otherParticipant->name : 'Mock') . '&background=0d631b&color=fff&size=128' }}"/>
                                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <div class="flex-grow overflow-hidden">
                                        <div class="flex justify-between items-baseline">
                                            <h4 class="font-headline font-bold text-sm {{ $isActive ? 'text-green-900' : 'text-on-surface' }} truncate">{{ $otherParticipant ? $otherParticipant->name : 'Mock Buyer' }}</h4>
                                            <span class="text-[10px] font-label font-bold text-primary">{{ $lastMessage ? $lastMessage->created_at->diffForHumans() : '' }}</span>
                                        </div>
                                        <p class="font-label text-xs {{ $isActive ? 'text-green-700 font-semibold' : 'text-stone-500' }} truncate">{{ $lastMessage->content ?? 'No messages yet' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-on-surface-variant text-sm">
                                    No chats available.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Chat Canvas -->
                    <div class="flex-grow flex flex-col bg-surface-container-lowest/40 relative">
                        <!-- Chat Header -->
                        <div class="h-20 px-8 flex items-center justify-between border-b border-stone-200/30 backdrop-blur-md bg-surface/80">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img class="w-10 h-10 rounded-full object-cover" id="active-chat-avatar" src="https://ui-avatars.com/api/?name=Mock&background=0d631b&color=fff&size=128" />
                                </div>
                                <div>
                                    <h3 class="font-headline font-bold text-on-surface" id="active-chat-name">Mock Buyer</h3>
                                    <div class="flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        <p class="font-label text-[10px] text-stone-400 uppercase font-bold tracking-widest">Online</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button class="w-10 h-10 rounded-xl bg-stone-100 text-stone-600 flex items-center justify-center hover:bg-stone-200 transition-all">
                                    <span class="material-symbols-outlined">call</span>
                                </button>
                                <button class="w-10 h-10 rounded-xl bg-stone-100 text-stone-600 flex items-center justify-center hover:bg-stone-200 transition-all">
                                    <span class="material-symbols-outlined">videocam</span>
                                </button>
                                <button class="w-10 h-10 rounded-xl bg-stone-100 text-stone-600 flex items-center justify-center hover:bg-stone-200 transition-all">
                                    <span class="material-symbols-outlined">info</span>
                                </button>
                            </div>
                        </div>

                        <!-- Messages Container -->
                        <div class="flex-grow overflow-y-auto p-8 space-y-6 flex flex-col" id="messages-container">
                            <!-- Messages will be loaded here -->
                        </div>

                        <!-- AI Quick Replies -->
                        <div class="px-8 pb-4 flex gap-2 overflow-x-auto no-scrollbar">
                            <button onclick="document.getElementById('message-content').value = 'Confirm Tuesday'; document.getElementById('send-message-form').dispatchEvent(new Event('submit'));" class="whitespace-nowrap px-4 py-2 bg-white border border-stone-200 rounded-full font-label text-xs font-bold text-stone-600 hover:border-primary hover:text-primary transition-all">Confirm Tuesday</button>
                            <button onclick="document.getElementById('message-content').value = 'Request Inspection Details'; document.getElementById('send-message-form').dispatchEvent(new Event('submit'));" class="whitespace-nowrap px-4 py-2 bg-white border border-stone-200 rounded-full font-label text-xs font-bold text-stone-600 hover:border-primary hover:text-primary transition-all">Request Inspection Details</button>
                            <button onclick="document.getElementById('message-content').value = 'Send New Crop Photos'; document.getElementById('send-message-form').dispatchEvent(new Event('submit'));" class="whitespace-nowrap px-4 py-2 bg-white border border-stone-200 rounded-full font-label text-xs font-bold text-stone-600 hover:border-primary hover:text-primary transition-all">Send New Crop Photos</button>
                        </div>

                        <!-- Chat Input Area -->
                        <div class="p-6 bg-white border-t border-stone-200/50">
                            <div class="max-w-4xl mx-auto flex items-end gap-4">
                                <button class="w-12 h-12 flex-shrink-0 flex items-center justify-center rounded-full bg-stone-100 text-stone-600 hover:bg-stone-200 transition-all">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                                <form id="send-message-form" class="flex-grow bg-stone-50 rounded-2xl border border-transparent focus-within:border-primary/20 focus-within:bg-white focus-within:shadow-inner transition-all flex items-end px-4 py-2">
                                    @csrf
                                    <input type="hidden" name="chat_id" id="current-chat-id" value="{{ $chats->first()->id ?? '' }}" />
                                    <textarea class="w-full bg-transparent border-none focus:ring-0 font-body text-sm py-2 resize-none max-h-32" name="content" id="message-content" placeholder="Type your message to buyer..." rows="1"></textarea>
                                    <button type="submit" class="p-2 text-stone-400 hover:text-primary"><span class="material-symbols-outlined">send</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="lg:ml-64 bg-gradient-to-br from-green-950 to-zinc-950 w-full pt-24 pb-12 px-6 lg:px-12 mt-24 border-t border-white/10 relative overflow-hidden text-white">
        <!-- Footer content (same as bids) -->
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

    <script>
        function loadChat(chatId, name = 'Mock Buyer', avatar = 'https://ui-avatars.com/api/?name=Mock&background=0d631b&color=fff&size=128') {
            document.getElementById('current-chat-id').value = chatId;
            
            // Update header if elements exist
            const nameEl = document.getElementById('active-chat-name');
            const avatarEl = document.getElementById('active-chat-avatar');
            if (nameEl) nameEl.innerText = name;
            if (avatarEl) avatarEl.src = avatar;
            
            fetch(`/dashboard/chat/${chatId}/messages`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('messages-container');
                    container.innerHTML = ''; // Clear current messages
                    
                    data.messages.forEach(msg => {
                        const isMine = msg.sender_id === data.user_id;
                        const msgDiv = document.createElement('div');
                        msgDiv.className = `flex gap-4 max-w-[80%] items-end ${isMine ? 'ml-auto justify-end' : ''}`;
                        msgDiv.innerHTML = isMine ? `
                            <div class="flex flex-col gap-1 items-end">
                                <div class="p-4 bg-primary text-on-primary shadow-lg shadow-primary/10 rounded-2xl rounded-br-none text-sm leading-relaxed">
                                    ${msg.content}
                                </div>
                                <div class="flex items-center gap-1 mr-1">
                                    <span class="text-[10px] font-label text-stone-400">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                                    <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">done_all</span>
                                </div>
                            </div>
                        ` : `
                            <div class="flex flex-col gap-1">
                                <div class="p-4 bg-white shadow-sm border border-stone-100 rounded-2xl rounded-bl-none text-on-surface font-body text-sm leading-relaxed">
                                    ${msg.content}
                                </div>
                                <span class="text-[10px] font-label text-stone-400 ml-1">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                            </div>
                        `;
                        container.appendChild(msgDiv);
                    });
                    
                    container.scrollTop = container.scrollHeight;
                });
        }

        document.getElementById('send-message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const content = document.getElementById('message-content').value;
            const chatId = document.getElementById('current-chat-id').value;

            if (!content) return;

            fetch('{{ route('chat.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    chat_id: chatId,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Append message to container
                    const container = document.getElementById('messages-container');
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'flex gap-4 max-w-[80%] ml-auto items-end justify-end';
                    msgDiv.innerHTML = `
                        <div class="flex flex-col gap-1 items-end">
                            <div class="p-4 bg-primary text-on-primary shadow-lg shadow-primary/10 rounded-2xl rounded-br-none text-sm leading-relaxed">
                                ${data.message.content}
                            </div>
                            <div class="flex items-center gap-1 mr-1">
                                <span class="text-[10px] font-label text-stone-400">Just now</span>
                                <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">done_all</span>
                            </div>
                        </div>
                    `;
                    container.appendChild(msgDiv);
                    document.getElementById('message-content').value = '';
                    container.scrollTop = container.scrollHeight;
                }
            });
        });

        @php
            $firstChat = $chats->first();
            $firstOtherParticipant = null;
            if ($firstChat) {
                $firstOtherParticipantId = collect($firstChat->participants)->first(fn($id) => $id !== $user->id);
                $firstOtherParticipant = \App\Models\User::find($firstOtherParticipantId);
            }
        @endphp
        const firstChatId = '{{ $firstChat ? $firstChat->id : '' }}';
        if (firstChatId) {
            loadChat(firstChatId, '{{ $firstOtherParticipant ? $firstOtherParticipant->name : 'Mock Buyer' }}', '{{ ($firstOtherParticipant && $firstOtherParticipant->profile_picture) ? asset('storage/' . $firstOtherParticipant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($firstOtherParticipant ? $firstOtherParticipant->name : 'Mock') . '&background=0d631b&color=fff&size=128' }}');
        }

        document.getElementById('search-contacts').addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            const contacts = document.querySelectorAll('#chat-list-container > div');
            contacts.forEach(contact => {
                const nameElement = contact.querySelector('h4');
                if (nameElement) {
                    const name = nameElement.textContent.toLowerCase();
                    if (name.includes(search)) {
                        contact.classList.remove('hidden');
                    } else {
                        contact.classList.add('hidden');
                    }
                }
            });
        });
    </script>
    @include('partials.aimodal')
    @include('partials.farmbot')
</body>
</html>
