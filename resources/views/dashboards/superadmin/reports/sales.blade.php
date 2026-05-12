<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Sales Overview Box -->
        <div class="bg-gray-50/50 p-5 rounded-xl border border-gray-100">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Top Products by Revenue</h4>
            <div class="space-y-3">
                @foreach(\App\Models\Product::orderBy('sales_count', 'desc')->take(3)->get() as $product)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[10px] font-bold text-dark-wool">
                            {{ $loop->iteration }}
                        </div>
                        <span class="text-xs font-bold text-dark-wool">{{ $product->name }}</span>
                    </div>
                    <span class="text-xs font-bold text-soft-rose">Rp{{ number_format($product->price * $product->sales_count, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Download Section -->
        <div class="bg-gray-50/50 p-5 rounded-xl border border-gray-100 flex flex-col justify-center">
            <div class="w-8 h-8 bg-soft-rose/10 rounded-lg flex items-center justify-center text-soft-rose mb-3">
                <i class="fas fa-shopping-cart text-[10px]"></i>
            </div>
            <h4 class="text-sm font-bold text-dark-wool mb-1 uppercase tracking-widest">Ekspor Laporan Penjualan</h4>
            <p class="text-[10px] text-gray-400 mb-4">Unduh data transaksi lengkap untuk periode terpilih.</p>
            <div class="flex gap-2">
                <button class="flex-1 py-1.5 bg-white border border-gray-100 text-gray-400 font-bold rounded-lg hover:bg-soft-rose hover:text-white transition-all text-[9px] uppercase tracking-widest flex items-center justify-center space-x-1 shadow-sm">
                    <i class="fas fa-download"></i>
                    <span>Excel</span>
                </button>
                <button class="flex-1 py-1.5 bg-white border border-gray-100 text-gray-400 font-bold rounded-lg hover:bg-red-500 hover:text-white transition-all text-[9px] uppercase tracking-widest flex items-center justify-center space-x-1 shadow-sm">
                    <i class="fas fa-download"></i>
                    <span>PDF</span>
                </button>
            </div>
        </div>
    </div>
</div>
