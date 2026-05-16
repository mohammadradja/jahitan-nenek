@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Detail Pesanan #' . $order->invoice_number)

@section('dashboard_content')
<div class="space-y-8 animate__animated animate__fadeIn">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-2 text-gray-400 hover:text-dark-wool transition-colors group">
            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:bg-soft-rose group-hover:text-white transition-all">
                <i class="fas fa-arrow-left text-xs"></i>
            </div>
            <span class="font-bold text-sm">Kembali ke Daftar</span>
        </a>
        <div class="flex space-x-4">
            <button class="btn-premium px-8 py-3 text-sm flex items-center space-x-2">
                <i class="fas fa-print"></i>
                <span>Cetak Invoice</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Order Status & Management -->
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap items-end gap-6">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Status Pesanan</label>
                            <select name="status" class="input-premium py-2 text-xs">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Sedang Diproses (Dirajut)</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nomor Resi</label>
                            <input type="text" name="tracking_number" class="input-premium py-2 text-xs" value="{{ $order->tracking_number }}" placeholder="Masukkan No. Resi">
                        </div>
                        <button type="submit" class="btn-primary btn-sm h-10 px-8">Update Status</button>
                    </div>
                </form>
            </div>

            <!-- Production Timeline -->
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-soft-rose/5 rounded-full blur-2xl"></div>
                
                <div class="flex justify-between items-center mb-10">
                    <h4 class="text-xl font-serif font-bold text-dark-wool">Linimasa Produksi</h4>
                    <button @click="$dispatch('open-modal', 'add-stage-modal')" class="btn-secondary btn-sm">
                        <i class="fas fa-plus mr-2"></i> Tambah Tahap
                    </button>
                </div>

                <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-100 before:to-transparent">
                    @forelse($order->productionStages as $stage)
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-soft-rose text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                <i class="fas fa-check text-[10px]"></i>
                            </div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-3xl border border-gray-50 shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <h5 class="font-bold text-dark-wool">{{ $stage->stage }}</h5>
                                    <time class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $stage->started_at->format('d M, H:i') }}</time>
                                </div>
                                <p class="text-xs text-gray-500 mb-4">{{ $stage->notes ?? 'Pengerjaan dimulai.' }}</p>
                                <form action="{{ route('admin.orders.stages.delete', $stage->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[9px] font-bold text-red-400 uppercase tracking-widest hover:text-red-600 transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest italic">Belum ada linimasa produksi yang dicatat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Order Items & Measurements -->
            <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <h4 class="text-xl font-serif font-bold text-dark-wool">Rincian Produk</h4>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $order->items->count() }} Item</span>
                </div>
                <div class="p-10 divide-y divide-gray-50">
                    @foreach($order->items as $item)
                        <div class="py-8 first:pt-0 last:pb-0">
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center space-x-6">
                                    <div class="w-24 h-24 rounded-[2rem] bg-vintage-cream overflow-hidden shadow-inner group-hover:scale-105 transition-transform duration-500 border border-white p-2">
                                        <img src="{{ $item->product->image_url ?? 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1072&auto=format&fit=crop' }}" class="w-full h-full object-cover rounded-[1.5rem]">
                                    </div>
                                    <div>
                                        <h5 class="text-lg font-bold text-dark-wool mb-1">{{ $item->product_name }}</h5>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Harga Satuan: Rp{{ number_format($item->product_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-dark-wool mb-1">x{{ $item->quantity }}</p>
                                    <p class="text-xl font-serif font-bold text-soft-rose">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            @if($item->measurements)
                                <div class="mt-6 bg-vintage-cream/30 rounded-3xl p-6 border border-gray-100">
                                    <h6 class="text-[10px] font-bold text-dark-wool uppercase tracking-widest mb-4 flex items-center">
                                        <i class="fas fa-ruler-combined mr-2 text-soft-rose"></i> Custom Ukuran (Tailoring)
                                    </h6>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                        @foreach($item->measurements as $key => $val)
                                            @if($val && $key !== 'notes')
                                                <div>
                                                    <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">{{ str_replace('_', ' ', $key) }}</p>
                                                    <p class="text-xs font-bold text-dark-wool">{{ $val }} cm</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if($item->measurements['notes'] ?? false)
                                        <div class="mt-4 pt-4 border-t border-gray-100">
                                            <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest mb-1">Catatan Tambahan</p>
                                            <p class="text-xs text-gray-600 italic">"{{ $item->measurements['notes'] }}"</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Order Summary Card -->
            <div class="bg-dark-wool p-10 rounded-[3rem] shadow-2xl text-white relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest mb-8">Ringkasan Pembayaran</p>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-white/30 font-bold uppercase tracking-widest">Subtotal</span>
                            <span class="font-bold">Rp{{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-white/30 font-bold uppercase tracking-widest">Ongkos Kirim</span>
                            <span class="font-bold">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="pt-6 border-t border-white/10 flex justify-between items-center">
                            <span class="text-lg font-serif font-bold text-white">Total</span>
                            <span class="text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-10 pt-8 border-t border-white/10">
                        <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest mb-4">Status Transaksi</p>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-400' : 'bg-yellow-400' }} shadow-[0_0_10px_rgba(255,255,255,0.2)]"></div>
                            <span class="text-xl font-serif font-bold uppercase tracking-widest">{{ $order->payment_status }}</span>
                        </div>
                        
                        @if($order->payment_status !== 'paid')
                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="mt-8">
                                @csrf
                                <button class="btn-premium w-full py-4 rounded-2xl bg-white text-dark-wool hover:bg-soft-rose hover:text-white border-none">
                                    Setujui Pembayaran
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <i class="fas fa-coins absolute -right-8 -bottom-8 text-9xl text-white/5 opacity-10"></i>
            </div>

            <!-- Customer Card -->
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                <h4 class="text-lg font-serif font-bold text-dark-wool mb-8">Informasi Pemesan</h4>
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-16 h-16 rounded-[1.5rem] bg-vintage-cream flex items-center justify-center text-soft-rose text-2xl shadow-inner">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-dark-wool">{{ $order->customer_name }}</h5>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $order->customer_phone }}</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                        <p class="text-xs font-bold text-dark-wool">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Tujuan Pengiriman</label>
                        <p class="text-xs font-medium text-gray-600 leading-relaxed">{{ $order->customer_address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Stage Modal -->
<x-ui.modal name="add-stage-modal" title="Tambah Tahap Produksi">
    <form action="{{ route('admin.orders.stages.add', $order->id) }}" method="POST" class="p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Tahap</label>
                <select name="stage" class="input-premium py-2 text-xs">
                    <option value="Pemilihan Bahan">Pemilihan Bahan</option>
                    <option value="Pemotongan Pola">Pemotongan Pola</option>
                    <option value="Proses Perajutan">Proses Perajutan</option>
                    <option value="Penyambungan Bagian">Penyambungan Bagian</option>
                    <option value="Finishing & QC">Finishing & QC</option>
                    <option value="Pengemasan Premium">Pengemasan Premium</option>
                    <option value="Siap Dikirim">Siap Dikirim</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Catatan (Opsional)</label>
                <textarea name="notes" rows="3" class="input-premium py-2 text-xs resize-none" placeholder="Detail progress atau kendala..."></textarea>
            </div>
        </div>
        <div class="mt-8 flex justify-end space-x-3">
            <button type="button" @click="$dispatch('close-modal', 'add-stage-modal')" class="btn-secondary btn-sm">Batal</button>
            <button type="submit" class="btn-primary btn-sm">Tambah Progress</button>
        </div>
    </form>
</x-ui.modal>
@endsection
