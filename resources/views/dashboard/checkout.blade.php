<!DOCTYPE html>

<html lang="en"><head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Checkout | FarmDirect</title>
<script src="/js/tailwind.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#ffb1c7",
                        "on-surface": "#1a1c1b",
                        "error-container": "#ffdad6",
                        "on-background": "#1a1c1b",
                        "secondary-container": "#fed7ca",
                        "primary-fixed-dim": "#88d982",
                        "on-secondary-container": "#795c51",
                        "on-tertiary-fixed": "#3f001c",
                        "outline": "#707a6c",
                        "surface-dim": "#dadad7",
                        "secondary-fixed-dim": "#e4beb2",
                        "error": "#ba1a1a",
                        "background": "#f9f9f6",
                        "on-secondary-fixed-variant": "#5b4137",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#cbffc2",
                        "primary": "#0d631b",
                        "tertiary-fixed": "#ffd9e2",
                        "on-surface-variant": "#40493d",
                        "on-error": "#ffffff",
                        "primary-fixed": "#a3f69c",
                        "inverse-surface": "#2f312f",
                        "surface-bright": "#f9f9f6",
                        "on-tertiary-container": "#ffedf0",
                        "primary-container": "#2e7d32",
                        "surface-tint": "#1b6d24",
                        "tertiary": "#923357",
                        "tertiary-container": "#b14b6f",
                        "surface-variant": "#e2e3e0",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#2b160f",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#88d982",
                        "secondary-fixed": "#ffdbce",
                        "secondary": "#75584d",
                        "on-primary-fixed": "#002204",
                        "outline-variant": "#bfcaba",
                        "surface-container": "#eeeeeb",
                        "surface-container-low": "#f4f4f1",
                        "on-tertiary-fixed-variant": "#7f2448",
                        "surface-container-high": "#e8e8e5",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#f1f1ee",
                        "on-primary-fixed-variant": "#005312",
                        "surface-container-highest": "#e2e3e0",
                        "surface": "#f9f9f6"
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen">
@php
    $total = 0;
    foreach($cart as $id => $item) {
        $total += $item['price'] * $item['quantity'];
    }
@endphp
<!-- TopNavBar (Suppressed for focused checkout) -->
<header class="fixed top-0 w-full z-50 bg-stone-50/70 dark:bg-stone-900/70 backdrop-blur-xl">
<div class="flex justify-between items-center px-8 h-20 max-w-[1920px] mx-auto">
<div class="flex items-center gap-4">
<a class="material-symbols-outlined text-stone-600 hover:text-green-800 transition-colors" href="{{ route('buyer.dashboard') }}">arrow_back</a>
<span class="text-2xl font-bold tracking-tighter text-green-900 dark:text-green-50">FarmDirect</span>
</div>
<div class="hidden md:flex items-center gap-2 text-stone-500 font-medium label-sm">
<span class="material-symbols-outlined text-green-700" style="font-variation-settings: 'FILL' 1;">verified_user</span>
<span>SECURE CHECKOUT</span>
</div>
</div>
</header>
<main class="pt-32 pb-24 px-6 md:px-12 max-w-[1440px] mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
<!-- Left Column: Delivery & Payment -->
<div class="lg:col-span-7 space-y-12">
<!-- Section Header -->
<section>
<h1 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">Review &amp; Pay</h1>
<p class="text-on-surface-variant font-medium">Step 2 of 2: Finalize your direct-from-farm procurement.</p>
</section>
<!-- Shipping Details (Asymmetric Layout) -->
<section class="bg-surface-container-low rounded-xl p-8 transition-all hover:shadow-xl hover:shadow-stone-200/50">
<div class="flex justify-between items-start mb-6">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">local_shipping</span>
<h2 class="text-xl font-bold text-on-surface">Delivery Address</h2>
</div>
<button onclick="editAddress()" class="text-primary font-bold text-sm hover:underline">Change</button>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="space-y-1">
<p class="font-bold text-on-surface">{{ $user->name }}</p>
<p class="text-on-surface-variant leading-relaxed" id="address-text">
                                H.No 452, Green Valley Estate<br/>
                                Sector 14, Gurugram<br/>
                                Haryana, 122001
                            </p>
</div>
<div class="bg-surface-container-lowest p-4 rounded-lg border border-outline-variant/15">
<p class="text-xs font-bold text-primary mb-2">ESTIMATED DELIVERY</p>
<p class="text-on-surface font-semibold">Thursday, Oct 24</p>
<p class="text-sm text-on-surface-variant">Via FarmDirect Express Logistics</p>
</div>
</div>
</section>
<!-- Payment Methods -->
<section class="space-y-6">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-primary">payments</span>
<h2 class="text-xl font-bold text-on-surface">Payment Method</h2>
</div>
<!-- Payment Options Grid -->
<div class="grid grid-cols-1 gap-4">
<!-- UPI Option -->
<div class="relative group cursor-pointer">
<input checked="" class="hidden peer" id="upi" name="payment" type="radio"/>
<label class="block bg-surface-container-lowest border-2 border-transparent peer-checked:border-primary p-6 rounded-xl transition-all group-hover:bg-surface-container-low" for="upi">
<div class="flex items-center justify-between">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center">
<span class="material-symbols-outlined text-on-surface-variant">qr_code_2</span>
</div>
<div>
<p class="font-bold text-on-surface">UPI / QR Code</p>
<p class="text-sm text-on-surface-variant">GPay, PhonePe, Paytm</p>
</div>
</div>
<div class="w-6 h-6 rounded-full border-2 border-outline group-hover:border-primary peer-checked:bg-primary flex items-center justify-center">
<div class="w-2.5 h-2.5 bg-white rounded-full"></div>
</div>
</div>
</label>
<div class="hidden peer-checked:block mt-4 bg-white p-6 rounded-xl border border-outline-variant/30 shadow-soft">
    <div class="space-y-4">
        <div>
            <label class="text-sm font-bold text-on-surface-variant block mb-2">Enter UPI ID</label>
            <input type="text" placeholder="username@upi" class="w-full bg-surface-container-low border-0 rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary"/>
        </div>
        <div class="flex flex-col items-center gap-3 pt-2">
            <p class="text-xs font-bold text-primary uppercase tracking-wider">Scan to Pay</p>
            <div class="p-4 bg-white border-2 border-dashed border-outline-variant rounded-2xl">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=farmdirect@upi&pn=FarmDirect&am={{ $total > 0 ? $total + 120 - 150 : 0 }}" class="w-36 h-36"/>
            </div>
            <p class="text-xs text-on-surface-variant font-medium">Payable: ₹{{ number_format($total > 0 ? $total + 120 - 150 : 0, 2) }}</p>
        </div>
    </div>
</div>
</div>
<!-- Card Option -->
<div class="relative group cursor-pointer">
<input class="hidden peer" id="card" name="payment" type="radio"/>
<label class="block bg-surface-container-lowest border-2 border-transparent peer-checked:border-primary p-6 rounded-xl transition-all group-hover:bg-surface-container-low" for="card">
<div class="flex items-center justify-between mb-4">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center">
<span class="material-symbols-outlined text-on-surface-variant">credit_card</span>
</div>
<div>
<p class="font-bold text-on-surface">Credit / Debit Card</p>
<p class="text-sm text-on-surface-variant">All major providers supported</p>
</div>
</div>
<div class="w-6 h-6 rounded-full border-2 border-outline peer-checked:border-primary flex items-center justify-center"></div>
</div>
<div class="grid grid-cols-2 gap-4 mt-4">
<div class="col-span-2">
<input class="w-full bg-surface-container-low border-0 rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary" placeholder="Card Number" type="text"/>
</div>
<input class="bg-surface-container-low border-0 rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary" placeholder="MM/YY" type="text"/>
<input class="bg-surface-container-low border-0 rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary" placeholder="CVV" type="password"/>
</div>
</label>
</div>
<!-- Net Banking -->
<div class="relative group cursor-pointer">
<input class="hidden peer" id="netbanking" name="payment" type="radio"/>
<label class="block bg-surface-container-lowest border-2 border-transparent peer-checked:border-primary p-6 rounded-xl transition-all group-hover:bg-surface-container-low" for="netbanking">
<div class="flex items-center justify-between">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center">
<span class="material-symbols-outlined text-on-surface-variant">account_balance</span>
</div>
<div>
<p class="font-bold text-on-surface">Net Banking</p>
<p class="text-sm text-on-surface-variant">Secure login to your bank</p>
</div>
</div>
<div class="w-6 h-6 rounded-full border-2 border-outline peer-checked:border-primary flex items-center justify-center"></div>
</div>
</label>
</div>
</div>
</section>
</div>
<!-- Right Column: Order Summary (Glass Sticky) -->
<div class="lg:col-span-5">
<aside class="sticky top-32 space-y-6">
<div class="bg-white/80 backdrop-blur-xl rounded-2xl p-8 shadow-xl shadow-stone-200/40 border border-outline-variant/10">
<h2 class="text-2xl font-extrabold text-on-surface mb-8 tracking-tight">Order Summary</h2>
<!-- Order Items -->
<div class="space-y-6 mb-8">
@php $total = 0; @endphp
@forelse($cart as $id => $item)
@php $total += $item['price'] * $item['quantity']; @endphp
<div class="flex gap-4">
<div class="w-20 h-20 rounded-xl overflow-hidden bg-stone-100 flex-shrink-0">
<img class="w-full h-full object-cover" src="{{ $item['image'] ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAI51axu0BK_qhWYWKPOUBrqrmSiP710nIPKXmGMAOuIjhvn1rrTqWajWahWBmLPyK_LjTiHmq0ok2jArFyTO9gzbqwxzyCqtAeuLkb7zGwTEDEx110Fx9RKcng37__6MRai6Hj9OvluHnheNYlqinKkXHkh8Ch37ktHtLIUi6eDvlbquNkdeBL1QbwudTRfpVrBRs2jNofCcTt27aJtY8sPCqnaifS8GxLT5Sjnn4nTgwoYv3OeG9-Ou-HNzlPT1eD6rx2FMUr0KMQ' }}"/>
</div>
<div class="flex-grow">
<div class="flex justify-between">
<p class="font-bold text-on-surface">{{ $item['name'] }}</p>
<p class="font-bold text-on-surface">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
</div>
@if(($item['quantity'] ?? 0) < 15)
    <p class="text-[10px] font-black text-red-500 uppercase tracking-tighter mb-1 flex items-center gap-1">
        <span class="material-symbols-outlined text-[10px]">warning</span>
        MIN 15KG REQUIRED
    </p>
@endif
<div class="flex items-center justify-between mt-1">
    <div class="flex items-center gap-2">
        <button onclick="updateCartQuantity('{{ $id }}', 'decrease')" class="w-6 h-6 rounded-full bg-stone-100 flex items-center justify-center text-on-surface-variant hover:bg-stone-200">-</button>
        <span class="text-sm font-bold">{{ $item['quantity'] }}</span>
        <button onclick="updateCartQuantity('{{ $id }}', 'increase')" class="w-6 h-6 rounded-full bg-stone-100 flex items-center justify-center text-on-surface-variant hover:bg-stone-200">+</button>
    </div>
    <button onclick="removeFromCart('{{ $id }}')" class="text-xs text-red-500 font-bold hover:underline">Remove</button>
</div>
</div>
</div>
@empty
<div class="text-center py-8 text-on-surface-variant">
    Your cart is empty.
</div>
@endforelse
</div>
<!-- Calculations -->
<div class="space-y-4 pt-6 border-t border-stone-100">
<div class="flex justify-between text-on-surface-variant font-medium">
<span>Subtotal</span>
<span>₹{{ number_format($total, 2) }}</span>
</div>
<div class="flex justify-between text-on-surface-variant font-medium">
<span>Logistics Fee</span>
<span>₹{{ $total > 0 ? '120.00' : '0.00' }}</span>
</div>
<div class="flex justify-between text-green-700 font-bold">
<span>Direct-to-Buyer Discount</span>
<span>-₹{{ $total > 0 ? '150.00' : '0.00' }}</span>
</div>
<div class="flex justify-between items-end pt-4">
<div>
<p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Total Amount</p>
<p class="text-3xl font-black text-on-surface tracking-tighter">₹{{ number_format($total > 0 ? $total + 120 - 150 : 0, 2) }}</p>
</div>
<div class="text-right">
<p class="text-xs text-on-surface-variant">Inc. all taxes</p>
</div>
</div>
</div>
<!-- CTA -->
<form id="checkout-form" action="{{ route('orders.place') }}" method="POST">
    @csrf
    <button type="button" onclick="startMockPayment()" class="w-full mt-10 bg-gradient-to-br from-primary to-primary-container text-white py-5 rounded-xl font-bold text-lg shadow-lg shadow-green-900/20 active:scale-95 transition-transform" {{ $total == 0 ? 'disabled' : '' }}>
        Complete Transaction
    </button>
</form>
<p class="text-center mt-6 text-xs text-on-surface-variant leading-relaxed">
                            By placing this order, you agree to FarmDirect's <br/>
<a class="underline font-bold" href="#">Farmer Terms</a> and <a class="underline font-bold" href="#">Buyer Privacy Policy</a>.
                        </p>
</div>
<!-- Trust Signals -->
<div class="grid grid-cols-2 gap-4">
<div class="bg-stone-100/50 p-4 rounded-xl flex items-center gap-3">
<span class="material-symbols-outlined text-green-800">verified</span>
<span class="text-xs font-bold text-on-surface-variant">Authenticity Guaranteed</span>
</div>
<div class="bg-stone-100/50 p-4 rounded-xl flex items-center gap-3">
<span class="material-symbols-outlined text-green-800">lock</span>
<span class="text-xs font-bold text-on-surface-variant">256-bit SSL Secure</span>
</div>
</div>
</aside>
</div>
</div>
</main>
<!-- Simple Footer for Checkout -->
<footer class="w-full pt-16 pb-8 px-12 bg-stone-100 dark:bg-stone-950">
<div class="max-w-[1440px] mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
<div class="text-lg font-black text-green-900 dark:text-green-50">FarmDirect</div>
<div class="flex flex-wrap justify-center gap-8 text-sm font-medium text-stone-500 dark:text-stone-400">
<a class="hover:text-green-800 transition-colors" href="#">Help Center</a>
<a class="hover:text-green-800 transition-colors" href="#">Buyer Policy</a>
<a class="hover:text-green-800 transition-colors" href="#">Sustainability Report</a>
</div>
<div class="text-sm font-medium text-stone-500 dark:text-stone-400">
                © 2024 FarmDirect. Cultivating Digital Transparency.
            </div>
</div>
</footer>
<!-- Modals -->
<div id="payment-modal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden items-center justify-center p-4">
    <div id="payment-modal-content" class="bg-white rounded-[2.5rem] max-w-md w-full p-10 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
        <div id="payment-input">
            <div class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mb-8 mx-auto">
                <span class="material-symbols-outlined text-4xl fill-icon">account_balance_wallet</span>
            </div>
            <h3 class="text-3xl font-black text-on-surface text-center mb-2">Secure Payment</h3>
            <p class="text-on-surface-variant text-center mb-8 font-medium">Please confirm your transaction to proceed with the order.</p>
            <div class="space-y-4">
                <button onclick="processMockPayment()" class="w-full bg-primary text-white py-4 rounded-2xl font-bold text-lg hover:shadow-lg hover:shadow-primary/20 transition-all">Authorize ₹{{ number_format($total > 0 ? $total + 120 - 150 : 0, 2) }}</button>
                <button onclick="closePaymentModal()" class="w-full bg-surface-container text-on-surface-variant py-4 rounded-2xl font-bold">Cancel</button>
            </div>
        </div>
        <div id="payment-processing" class="hidden text-center py-12">
            <div class="w-20 h-20 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-8"></div>
            <h3 class="text-2xl font-black text-on-surface mb-2">Processing...</h3>
            <p class="text-on-surface-variant font-medium">Verifying with your bank</p>
        </div>
        <div id="payment-success" class="hidden text-center py-12">
            <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
                <span class="material-symbols-outlined text-4xl">check</span>
            </div>
            <h3 class="text-3xl font-black text-on-surface mb-2">Payment Successful!</h3>
            <p class="text-on-surface-variant font-medium">Redirecting to your orders...</p>
        </div>
    </div>
</div>

<div id="address-modal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl">
        <h3 class="text-2xl font-black text-on-surface mb-6">Edit Delivery Address</h3>
        <textarea id="modal-address" rows="4" class="w-full bg-surface-container border-none rounded-2xl p-4 text-on-surface font-medium focus:ring-2 focus:ring-primary/20 mb-6" placeholder="Enter your full address...">H.No 452, Green Valley Estate&#10;Sector 14, Gurugram&#10;Haryana, 122001</textarea>
        <div class="flex gap-4">
            <button onclick="saveAddress()" class="flex-1 bg-primary text-white py-4 rounded-xl font-bold">Save Address</button>
            <button onclick="closeAddressModal()" class="flex-1 bg-surface-container text-on-surface-variant py-4 rounded-xl font-bold">Cancel</button>
        </div>
    </div>
</div>

<script>
    // Cart Operations
    function updateCartQuantity(cropId, action) {
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ crop_id: cropId, action: action })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                window.showToast(data.message || 'Failed to update quantity', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.showToast('An error occurred. Please try again.', 'error');
        });
    }

    function removeFromCart(cropId) {
        if (!confirm('Are you sure you want to remove this item?')) return;
        
        fetch('{{ route("cart.remove") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ crop_id: cropId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                window.showToast(data.message || 'Failed to remove item', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.showToast('An error occurred. Please try again.', 'error');
        });
    }

    // Address Management
    function editAddress() {
        document.getElementById('address-modal').classList.remove('hidden');
    }
    
    function closeAddressModal() {
        document.getElementById('address-modal').classList.add('hidden');
    }
    
    function saveAddress() {
        const address = document.getElementById('modal-address').value;
        document.getElementById('address-text').innerHTML = address.replace(/\n/g, '<br/>');
        closeAddressModal();
    }

    // Mock Payment Gateway Logic
    const paymentModal = document.getElementById('payment-modal');
    const modalContent = document.getElementById('payment-modal-content');
    
    function startMockPayment() {
        // Show modal
        paymentModal.classList.remove('hidden');
        // Animate in
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        // Reset states
        document.getElementById('payment-input').classList.remove('hidden');
        document.getElementById('payment-processing').classList.add('hidden');
        document.getElementById('payment-success').classList.add('hidden');
    }

    function closePaymentModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            paymentModal.classList.add('hidden');
        }, 300);
    }

    function processMockPayment() {
        document.getElementById('payment-input').classList.add('hidden');
        document.getElementById('payment-processing').classList.remove('hidden');
        
        // Simulate network delay for processing
        setTimeout(() => {
            document.getElementById('payment-processing').classList.add('hidden');
            document.getElementById('payment-success').classList.remove('hidden');
            
            // Wait 1.5s then submit actual form
            setTimeout(() => {
                const form = document.getElementById('checkout-form');
                if (form) {
                    form.submit();
                } else {
                    console.error('Checkout form not found');
                    window.showToast('An error occurred during order placement. Please try again.', 'error');
                }
            }, 1500);
        }, 2000);
    }

    // Toast Notification System
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-8 left-1/2 -translate-x-1/2 z-[200] px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 transition-all duration-500 translate-y-20 opacity-0 ${
            type === 'error' ? 'bg-red-600 text-white' : 'bg-on-surface text-white'
        }`;
        
        toast.innerHTML = `
            <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-xs">${type === 'error' ? 'close' : 'check'}</span>
            </div>
            <p class="text-xs font-black uppercase tracking-widest">${message}</p>
        `;
        
        document.body.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => {
            toast.classList.remove('translate-y-20', 'opacity-0');
        }, 10);
        
        // Remove toast
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    };

</script>
</body></html>
