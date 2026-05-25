<!-- Floating AI Chat Widget -->
<div id="ai-chat-widget" class="fixed bottom-24 right-8 w-96 bg-white rounded-3xl shadow-2xl overflow-hidden z-50 hidden flex flex-col h-[600px]">
    <!-- Header (Dark Gradient) -->
    <div class="bg-gradient-to-br from-[#001e2b] to-[#00684a] p-6 text-white relative">
        <div class="flex justify-between items-center mb-4">
            <div class="flex">
                <div class="w-8 h-8 rounded-full overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=AI&background=0d631b&color=fff" class="w-full h-full object-cover"/>
                </div>
            </div>
            <button onclick="toggleAIChat()" class="text-white/70 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <h2 class="text-2xl font-headline font-bold mb-1">Hello {{ auth()->user() ? auth()->user()->name : 'User' }}!</h2>
        <p class="text-xl font-headline font-bold">How can we help?</p>
    </div>

    <!-- Content Area -->
    <div class="flex-grow overflow-y-auto p-4 space-y-4 bg-surface-container-low" id="ai-chat-content">
        <!-- Home Content -->
        <div id="ai-home-content" class="space-y-4">
            <!-- Status Card -->
            <div class="bg-white p-4 rounded-xl shadow-sm flex items-center space-x-3">
                <span class="material-symbols-outlined text-green-500 fill-1">check_circle</span>
                <div>
                    <div class="font-bold text-sm">Status: All Systems Operational</div>
                    <div class="text-xs text-outline">Updated Just now</div>
                </div>
            </div>

            <!-- Search Box -->
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <div class="relative">
                    <input type="text" placeholder="Search for help" class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary-container"/>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-xl shadow-sm divide-y divide-outline-variant/10">
                <button onclick="askSampleQuestion('How do I reset my password?')" class="w-full flex justify-between items-center p-4 hover:bg-surface-container-low transition-colors text-left">
                    <span class="text-sm font-medium">Reset Your Password</span>
                    <span class="material-symbols-outlined text-outline">chevron_right</span>
                </button>
                <button onclick="askSampleQuestion('How do I add a new crop?')" class="w-full flex justify-between items-center p-4 hover:bg-surface-container-low transition-colors text-left">
                    <span class="text-sm font-medium">How to add a crop?</span>
                    <span class="material-symbols-outlined text-outline">chevron_right</span>
                </button>
                <button onclick="askSampleQuestion('How do I view my bids?')" class="w-full flex justify-between items-center p-4 hover:bg-surface-container-low transition-colors text-left">
                    <span class="text-sm font-medium">Viewing my bids</span>
                    <span class="material-symbols-outlined text-outline">chevron_right</span>
                </button>
            </div>
        </div>

        <!-- Messages List (Hidden by default) -->
        <div id="ai-messages-list" class="hidden space-y-4">
            <div class="flex justify-start">
                <div class="bg-white p-3 rounded-xl shadow-sm max-w-[80%]">
                    <p class="text-sm">Hi! I am FarmBot. Ask me anything about the dashboard or your crops.</p>
                    <span class="text-[10px] text-outline mt-1 block text-right">Just now</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Input (Only shown in Messages tab) -->
    <div id="ai-input-container" class="border-t border-outline-variant/10 bg-white p-4 hidden">
        <form id="ai-chat-form" class="flex items-center space-x-2">
            @csrf
            <input type="text" id="ai-message-input" placeholder="Ask a question..." class="flex-grow bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary-container"/>
            <button type="submit" class="p-3 bg-primary text-on-primary rounded-xl hover:bg-primary-container transition-colors">
                <span class="material-symbols-outlined">send</span>
            </button>
        </form>
    </div>

    <!-- Bottom Navigation -->
    <div class="border-t border-outline-variant/10 bg-white p-2 flex justify-around text-center">
        <button id="ai-nav-home" onclick="showAIHome()" class="flex flex-col items-center p-2 text-primary">
            <span class="material-symbols-outlined fill-1">home</span>
            <span class="text-xs font-medium">Home</span>
        </button>
        <button id="ai-nav-messages" onclick="showAIMessages()" class="flex flex-col items-center p-2 text-outline hover:text-primary">
            <span class="material-symbols-outlined">chat</span>
            <span class="text-xs font-medium">Messages</span>
        </button>
        <button id="ai-nav-help" onclick="showAIHelp()" class="flex flex-col items-center p-2 text-outline hover:text-primary">
            <span class="material-symbols-outlined">help</span>
            <span class="text-xs font-medium">Help</span>
        </button>
    </div>
</div>

@if($showButton ?? true)
<!-- Toggle Button (FAB) -->
<button onclick="toggleAIChat()" class="fixed bottom-8 right-8 w-14 h-14 bg-[#00684a] text-white rounded-full flex items-center justify-center shadow-2xl active:scale-90 transition-transform z-50">
    <span class="material-symbols-outlined text-2xl">chat</span>
</button>
@endif

<script>
    function toggleAIChat() {
        const widget = document.getElementById('ai-chat-widget');
        widget.classList.toggle('hidden');
    }

    function showAIHome() {
        document.getElementById('ai-home-content').classList.remove('hidden');
        document.getElementById('ai-messages-list').classList.add('hidden');
        document.getElementById('ai-input-container').classList.add('hidden');
        
        document.getElementById('ai-nav-home').classList.add('text-primary');
        document.getElementById('ai-nav-home').classList.remove('text-outline');
        document.getElementById('ai-nav-messages').classList.remove('text-primary');
        document.getElementById('ai-nav-messages').classList.add('text-outline');
    }

    function showAIMessages() {
        document.getElementById('ai-home-content').classList.add('hidden');
        document.getElementById('ai-messages-list').classList.remove('hidden');
        document.getElementById('ai-input-container').classList.remove('hidden');
        
        document.getElementById('ai-nav-home').classList.remove('text-primary');
        document.getElementById('ai-nav-home').classList.add('text-outline');
        document.getElementById('ai-nav-messages').classList.add('text-primary');
        document.getElementById('ai-nav-messages').classList.remove('text-outline');
    }

    function askSampleQuestion(question) {
        const widget = document.getElementById('ai-chat-widget');
        if (widget.classList.contains('hidden')) {
            widget.classList.remove('hidden');
        }
        showAIMessages(); // Switch to messages tab
        const input = document.getElementById('ai-message-input');
        input.value = question;
        document.getElementById('ai-chat-form').dispatchEvent(new Event('submit'));
    }

    function showAIHelp() {
        showAIHome();
    }

    function saveMessage(sender, text, time) {
        let history = JSON.parse(localStorage.getItem('farmbot_chat')) || [];
        history.push({ sender, text, time });
        localStorage.setItem('farmbot_chat', JSON.stringify(history));
    }

    function loadMessages() {
        let history = JSON.parse(localStorage.getItem('farmbot_chat')) || [];
        const container = document.getElementById('ai-messages-list');
        
        history.forEach(msg => {
            const msgDiv = document.createElement('div');
            msgDiv.className = msg.sender === 'user' ? 'flex justify-end' : 'flex justify-start';
            msgDiv.innerHTML = msg.sender === 'user' ? `
                <div class="bg-primary text-on-primary p-3 rounded-xl max-w-[80%] shadow-sm">
                    <p class="text-sm">${msg.text}</p>
                    <span class="text-[10px] text-on-primary/70 mt-1 block text-right">${msg.time}</span>
                </div>
            ` : `
                <div class="bg-white p-3 rounded-xl shadow-sm max-w-[80%]">
                    <p class="text-sm">${msg.text}</p>
                    <span class="text-[10px] text-outline mt-1 block text-right">${msg.time}</span>
                </div>
            `;
            container.appendChild(msgDiv);
        });
        container.scrollTop = container.scrollHeight;
    }

    document.addEventListener('DOMContentLoaded', loadMessages);

    // Clear chat on logout
    document.addEventListener('submit', function(e) {
        if (e.target && e.target.id === 'logout-form') {
            localStorage.removeItem('farmbot_chat');
        }
    });

    document.getElementById('ai-chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const input = document.getElementById('ai-message-input');
        const submitBtn = this.querySelector('button[type="submit"]');
        const message = input.value;
        if (!message) return;

        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        
        const container = document.getElementById('ai-messages-list');
        const userMsgDiv = document.createElement('div');
        userMsgDiv.className = 'flex justify-end';
        userMsgDiv.innerHTML = `
            <div class="bg-primary text-on-primary p-3 rounded-xl max-w-[80%] shadow-sm">
                <p class="text-sm">${message}</p>
                <span class="text-[10px] text-on-primary/70 mt-1 block text-right">${time}</span>
            </div>
        `;
        container.appendChild(userMsgDiv);
        input.value = '';
        container.scrollTop = container.scrollHeight;

        saveMessage('user', message, time);

        // Disable input and button
        input.disabled = true;
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50');

        // Show loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'flex justify-start';
        loadingDiv.id = 'ai-loading';
        loadingDiv.innerHTML = `
            <div class="bg-white p-3 rounded-xl shadow-sm max-w-[80%] flex items-center space-x-2">
                <div class="w-2 h-2 bg-stone-400 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-stone-400 rounded-full animate-bounce [animation-delay:0.2s]"></div>
                <div class="w-2 h-2 bg-stone-400 rounded-full animate-bounce [animation-delay:0.4s]"></div>
            </div>
        `;
        container.appendChild(loadingDiv);
        container.scrollTop = container.scrollHeight;

        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading indicator
            const loading = document.getElementById('ai-loading');
            if (loading) loading.remove();

            // Enable input and button
            input.disabled = false;
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50');
            input.focus();

            const botMsgDiv = document.createElement('div');
            botMsgDiv.className = 'flex justify-start';
            let replyHtml = data.reply.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            const botTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            botMsgDiv.innerHTML = `
                <div class="bg-white p-3 rounded-xl shadow-sm max-w-[80%]">
                    <p class="text-sm">${replyHtml}</p>
                    <span class="text-[10px] text-outline mt-1 block text-right">${botTime}</span>
                </div>
            `;
            container.appendChild(botMsgDiv);
            container.scrollTop = container.scrollHeight;
            
            saveMessage('bot', replyHtml, botTime);
        })
        .catch(error => {
            // Remove loading indicator
            const loading = document.getElementById('ai-loading');
            if (loading) loading.remove();

            // Enable input and button
            input.disabled = false;
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50');

            console.error('Error:', error);
        });
    });

    // Compatibility wrappers for help.blade.php
    function toggleFarmBot() {
        toggleAIChat();
    }
    window.openFarmBot = function(event) {
        if (event) event.preventDefault();
        const widget = document.getElementById('ai-chat-widget');
        if (widget.classList.contains('hidden')) {
            toggleAIChat();
        }
    }
</script>
