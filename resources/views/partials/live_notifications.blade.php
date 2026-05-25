<!-- Live Notifications Toast Container -->
<div id="live-toast-container" class="fixed bottom-12 right-12 z-[9999] flex flex-col gap-6 pointer-events-none"></div>

<script>
// Global Toast System
window.showToast = function(data, type = 'success') {
    const container = document.getElementById('live-toast-container');
    if (!container) return;
    
    // Normalize input: handle both notification objects and simple strings
    let notification = typeof data === 'string' ? { title: data, message: '', type: type } : data;
    
    const toast = document.createElement('div');
    // We use a margin-bottom to stack toasts properly
    toast.className = `bg-white/95 backdrop-blur-xl rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-6 w-96 transform transition-all duration-500 translate-x-[120%] opacity-0 flex items-start gap-5 border border-white/20 cursor-pointer pointer-events-auto hover:scale-[1.02] active:scale-[0.98] mb-4`;
    
    let icon = notification.icon || 'notifications';
    let bgClass = notification.bg_class || 'bg-primary/10';
    let iconClass = notification.icon_class || 'text-primary';
    
    // Determine visuals based on type
    const nType = notification.type || type;
    if(nType === 'order') {
        icon = 'local_shipping';
        bgClass = 'bg-blue-100';
        iconClass = 'text-blue-600';
    } else if (nType === 'bid') {
        icon = 'gavel';
        bgClass = 'bg-orange-100';
        iconClass = 'text-orange-600';
    } else if (nType === 'success') {
        icon = 'check_circle';
        bgClass = 'bg-green-100';
        iconClass = 'text-green-600';
    } else if (nType === 'error') {
        icon = 'error';
        bgClass = 'bg-red-100';
        iconClass = 'text-red-600';
    }
    
    toast.innerHTML = `
        <div class="w-14 h-14 rounded-2xl ${bgClass} flex items-center justify-center flex-shrink-0 shadow-sm">
            <span class="material-symbols-outlined text-2xl ${iconClass}">${icon}</span>
        </div>
        <div class="flex-grow pt-1">
            <h4 class="text-base font-black text-stone-900 tracking-tight">${notification.title}</h4>
            ${notification.message ? `<p class="text-sm font-medium text-stone-500 mt-1 leading-relaxed">${notification.message}</p>` : ''}
        </div>
        <button class="w-8 h-8 rounded-full hover:bg-stone-100 flex items-center justify-center text-stone-300 hover:text-stone-600 transition-colors" onclick="event.stopPropagation(); this.closest('div').remove()">
            <span class="material-symbols-outlined text-base">close</span>
        </button>
    `;
    
    // Click behavior
    if(notification.data && notification.data.url) {
        toast.onclick = () => { window.location.href = notification.data.url; };
    }

    container.appendChild(toast);
    
    // Animate In
    setTimeout(() => {
        toast.classList.remove('translate-x-[120%]', 'opacity-0');
    }, 100);
    
    // Auto-remove after 8 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-[120%]', 'opacity-0');
        setTimeout(() => toast.remove(), 500);
    }, 8000);
};

document.addEventListener('DOMContentLoaded', function() {
    let notifiedIds = new Set();
    const sessionStartTime = new Date('{{ now()->toISOString() }}');
    
    function fetchUnreadNotifications() {
        fetch('{{ route("api.notifications.unread") }}')
            .then(res => res.json())
            .then(data => {
                const badge = document.querySelector('.notification-badge');
                const hoverList = document.getElementById('hover-notifications-list');
                
                if (data.success && data.data && data.data.length > 0) {
                    if (badge) badge.classList.remove('hidden');
                    
                    if (hoverList) {
                        let html = '';
                        data.data.forEach(notification => {
                            let icon = notification.icon || 'notifications';
                            let bgClass = notification.bg_class || 'bg-primary/10';
                            let iconClass = notification.icon_class || 'text-primary';
                            
                            const nType = notification.type || 'success';
                            if(nType === 'order') {
                                icon = 'local_shipping'; bgClass = 'bg-blue-100'; iconClass = 'text-blue-600';
                            } else if (nType === 'bid') {
                                icon = 'gavel'; bgClass = 'bg-orange-100'; iconClass = 'text-orange-600';
                            } else if (nType === 'success') {
                                icon = 'check_circle'; bgClass = 'bg-green-100'; iconClass = 'text-green-600';
                            } else if (nType === 'error') {
                                icon = 'error'; bgClass = 'bg-red-100'; iconClass = 'text-red-600';
                            }
                            
                            html += `
                                <div class="flex gap-3 items-start p-2 hover:bg-stone-50 rounded-xl transition-colors cursor-pointer" ${notification.data && notification.data.url ? `onclick="window.location.href='${notification.data.url}'"` : ''}>
                                    <div class="w-8 h-8 rounded-full ${bgClass} flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-sm ${iconClass}">${icon}</span>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-stone-900">${notification.title}</p>
                                        ${notification.message ? `<p class="text-[10px] text-stone-500 mt-0.5 line-clamp-2">${notification.message}</p>` : ''}
                                    </div>
                                </div>
                            `;
                        });
                        hoverList.innerHTML = html;
                    }
                    
                    // Check if we need to show toasts
                    data.data.forEach(notification => {
                        const notifId = notification._id || notification.id;
                        const notifTime = new Date(notification.created_at);
                        if (notifTime > sessionStartTime && !notification.is_notified && !notifiedIds.has(notifId)) {
                            notifiedIds.add(notifId);
                            showToast(notification);
                            
                            // If on the notifications page, reload to show new alerts dynamically
                            if (window.location.pathname.includes('/notifications')) {
                                setTimeout(() => window.location.reload(), 2000);
                            }
                            
                            // Mark as notified in backend so it doesn't toast again on refresh
                            fetch('{{ route("api.notifications.mark-notified") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ id: notifId })
                            }).catch(err => console.error('Error marking notified:', err));
                        }
                    });
                } else {
                    if (badge) badge.classList.add('hidden');
                    if (hoverList) {
                        hoverList.innerHTML = '<p class="text-xs text-on-surface-variant italic text-center py-4">No new notifications</p>';
                    }
                }
            })
            .catch(err => console.error('Live Notifications Error:', err));
    }

    // Polling interval
    setInterval(fetchUnreadNotifications, 5000);
    fetchUnreadNotifications();
});
</script>
