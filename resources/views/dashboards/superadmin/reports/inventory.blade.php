<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Low Stock Alerts Box -->
        <div class="bg-red-50/30 p-5 rounded-xl border border-red-100">
            <h4 class="text-[10px] font-bold text-red-500 uppercase tracking-widest mb-4">Peringatan Stok Menipis</h4>
            <div class="space-y-3">
                @php
                    $lowStock = \App\Models\Product::where('stock', '<', 10)->take(3)->get();
                @endphp
                @forelse($lowStock as $product)
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-dark-wool">{{ $product->name }}</span>
                    <span class="px-2 py-0.5 rounded-md bg-red-500 text-white text-[8px] font-bold uppercase tracking-widest">Sisa {{ $product->stock }}</span>
                </div>
                @empty
                <p class="text-[10px] text-gray-400 italic">Semua stok terpantau aman.</p>
                @endforelse
            </div>
        </div>

        <!-- Inventory Download Box -->
        <div class="bg-gray-50/50 p-5 rounded-xl border border-gray-100 flex flex-col justify-center">
            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500 mb-3">
                <i class="fas fa-boxes text-[10px]"></i>
            </div>
            <h4 class="text-sm font-bold text-dark-wool mb-1 uppercase tracking-widest">Ekspor Laporan Inventaris</h4>
            <p class="text-[10px] text-gray-400 mb-4">Unduh status ketersediaan barang dan nilai aset stok.</p>
            <div class="flex gap-2">
                <button class="flex-1 py-2 bg-green-50 text-green-600 border border-green-100 font-bold rounded-xl hover:bg-green-600 hover:text-white transition-all text-[10px] uppercase tracking-widest flex items-center justify-center space-x-2 shadow-sm">
                    <i class="fas fa-file-excel"></i>
                    <span>Excel</span>
                </button>
                <button class="flex-1 py-2 bg-red-50 text-red-600 border border-red-100 font-bold rounded-xl hover:bg-red-500 hover:text-white transition-all text-[10px] uppercase tracking-widest flex items-center justify-center space-x-2 shadow-sm">
                    <i class="fas fa-file-pdf"></i>
                    <span>PDF</span>
                </button>
            </div>
        </div>
    </div>
</div>
