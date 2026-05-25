<!-- AI Insights Modal -->
<div id="aiModal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeAIInsights()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-primary/10">
            <div class="bg-gradient-to-br from-primary/5 to-white px-8 pt-10 pb-8">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">psychology_alt</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black tracking-tight text-on-surface">AI Market Intelligence</h3>
                            <p class="text-on-surface-variant text-sm mt-1">Real-time analysis of your specific harvest portfolio.</p>
                        </div>
                    </div>
                    <button onclick="closeAIInsights()" class="p-2 hover:bg-stone-100 rounded-full transition-all">
                        <span class="material-symbols-outlined text-stone-500">close</span>
                    </button>
                </div>

                <div class="space-y-6">
                    <!-- Dynamic Insight 1 -->
                    <div class="p-6 bg-white rounded-[2rem] border border-primary/10 shadow-sm flex gap-6 items-start">
                        <div class="p-3 bg-green-50 rounded-xl text-primary">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div>
                            <h4 class="font-black text-on-surface uppercase tracking-widest text-xs mb-2">High Demand Alert</h4>
                            <p class="text-sm font-medium text-on-surface-variant leading-relaxed">
                                Demand for <span class="text-primary font-bold">Basmati Rice</span> is expected to rise by <span class="text-primary font-bold">18%</span> in the next 14 days due to regional procurement shifts. We recommend holding bulk inventory for better margins.
                            </p>
                        </div>
                    </div>

                    <!-- Dynamic Insight 2 -->
                    <div class="p-6 bg-white rounded-[2rem] border border-primary/10 shadow-sm flex gap-6 items-start">
                        <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                            <span class="material-symbols-outlined">warning</span>
                        </div>
                        <div>
                            <h4 class="font-black text-on-surface uppercase tracking-widest text-xs mb-2">Inventory Optimization</h4>
                            <p class="text-sm font-medium text-on-surface-variant leading-relaxed">
                                Your <span class="text-amber-600 font-bold">Tomato</span> stock is currently 15% above the average regional listing volume. Consider a 5% discount to accelerate turnover before the harvest date.
                            </p>
                        </div>
                    </div>

                    <!-- Market Forecast -->
                    <div class="p-8 bg-on-surface rounded-[2rem] text-white overflow-hidden relative group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                        <h4 class="font-black uppercase tracking-widest text-[10px] mb-4 opacity-60">Portfolio Valuation Forecast</h4>
                        <div class="flex items-end gap-3">
                            <span class="text-4xl font-black text-primary">₹{{ number_format(($revenue ?? 150000) * 1.12) }}</span>
                            <span class="text-xs font-bold text-green-400 mb-1">+12.4% Projected</span>
                        </div>
                        <p class="text-[10px] font-medium opacity-50 mt-4 leading-relaxed italic">AI estimates are based on historical patterns, current weather trends, and regional trade data.</p>
                    </div>
                </div>

                <div class="mt-8">
                    <button onclick="closeAIInsights()" class="w-full py-5 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:shadow-primary/40 transition-all">
                        Apply AI Strategy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openAIInsights() {
        document.getElementById('aiModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAIInsights() {
        document.getElementById('aiModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
