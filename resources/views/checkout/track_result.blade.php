@extends('layouts.app')

@section('title', 'Status Pesanan | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream/30 min-h-screen py-32">
    <div class="max-w-4xl mx-auto px-6 lg:px-20" data-aos="fade-up">
        <!-- Header -->
        <div class="text-center mb-16">
            <nav class="mb-8">
                <ol class="flex items-center justify-center space-x-4 text-[10px] font-bold uppercase tracking-[0.3em] text-soft-rose">
                    <li>Lacak</li>
                    <li><span class="w-1.5 h-1.5 rounded-full bg-soft-rose/30"></span></li>
                    <li class="text-dark-wool">Status Pesanan</li>
                </ol>
            </nav>
            <h2 class="text-5xl font-serif font-bold text-dark-wool">Detail Pesanan <span class="italic text-soft-rose">#{{ $order->invoice_number }}</span></h2>
            <p class="text-gray-400 text-sm mt-4 font-bold uppercase tracking-widest">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
        </div>

        <div class="grid grid-cols-1 gap-12">
            <!-- Order Status & Progress -->
            <div class="bg-white rounded-[4rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-50">
                <div class="p-12 lg:p-20">
                    <!-- Progress Tracker -->
                    <div class="relative flex justify-between items-center mb-24 before:absolute before:inset-x-0 before:top-1/2 before:-translate-y-1/2 before:h-1 before:bg-gray-100">
                        @php
                            $statuses = ['pending', 'processing', 'shipped', 'completed'];
                            $currentStatusIndex = array_search($order->status, $statuses);
                        @endphp
                        @foreach($statuses as $index => $status)
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-700 {{ $index <= $currentStatusIndex ? 'bg-soft-rose text-white' : 'bg-white text-gray-200 border border-gray-100' }}">
                                    @if($status == 'pending') <i class="fas fa-wallet text-sm"></i> @endif
                                    @if($status == 'processing') <i class="fas fa-magic text-sm"></i> @endif
                                    @if($status == 'shipped') <i class="fas fa-truck text-sm"></i> @endif
                                    @if($status == 'completed') <i class="fas fa-check-double text-sm"></i> @endif
                                </div>
                                <span class="absolute -bottom-10 whitespace-nowrap text-[9px] font-bold uppercase tracking-widest {{ $index <= $currentStatusIndex ? 'text-dark-wool' : 'text-gray-300' }}">
                                    {{ $status == 'pending' ? 'Menunggu' : ($status == 'processing' ? 'Diproses' : ($status == 'shipped' ? 'Dikirim' : 'Selesai')) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Production Timeline Section -->
                    @if($order->productionStages->count() > 0)
                        <div class="mb-20">
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-10 flex items-center">
                                <i class="fas fa-history mr-3 text-soft-rose"></i> Progress Pengerjaan Handmade
                            </h4>
                            <div class="space-y-8 relative before:absolute before:left-5 before:top-0 before:h-full before:w-0.5 before:bg-gray-50">
                                @foreach($order->productionStages as $stage)
                                    <div class="relative pl-12">
                                        <div class="absolute left-3 top-1 w-4 h-4 rounded-full border-2 border-white {{ $loop->first ? 'bg-soft-rose animate-pulse' : 'bg-gray-200' }} shadow-sm"></div>
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                            <h5 class="text-sm font-bold text-dark-wool">{{ $stage->stage }}</h5>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $stage->started_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">{{ $stage->notes ?? 'Bagian dari proses perajutan kasih sayang.' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tracking Info -->
                    @if($order->tracking_number)
                        <div class="bg-dark-wool rounded-[2.5rem] p-10 text-white mb-20 relative overflow-hidden">
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div>
                                    <p class="text-[10px] text-white/40 font-bold uppercase tracking-widest mb-2">Nomor Resi Pengiriman ({{ strtoupper($order->courier) }})</p>
                                    <h3 class="text-2xl font-mono font-bold text-soft-rose">{{ $order->tracking_number }}</h3>
                                </div>
                                <a href="https://check-resi.com" target="_blank" class="btn-primary bg-white text-dark-wool hover:bg-soft-rose hover:text-white border-none whitespace-nowrap">Cek Keberangkatan</a>
                            </div>
                            <i class="fas fa-box-open absolute -right-10 -bottom-10 text-9xl text-white/5"></i>
                        </div>
                    @endif

                    <!-- Order Details Summary -->
                    <div class="bg-vintage-cream/30 rounded-[3rem] p-10 border border-gray-50">
                        <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-8">Informasi Pesanan</h4>
                        <div class="space-y-8">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-6">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden border border-white shadow-sm">
                                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-dark-wool">{{ $item->product_name }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $item->quantity }} x Rp{{ number_format($item->product_price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-dark-wool">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-10 pt-8 border-t border-gray-100 space-y-4">
                            <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                                <span class="text-gray-400">Ongkos Kirim</span>
                                <span class="text-dark-wool">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <span class="text-sm font-bold text-dark-wool uppercase tracking-widest">Total Akhir</span>
                                <span class="text-2xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-20 text-center">
                        <a href="{{ route('order.track') }}" class="btn-secondary">Lacak Pesanan Lain</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
