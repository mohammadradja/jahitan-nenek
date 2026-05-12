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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Items -->
            <div class="bg-white rounded-5xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="text-xl font-bold text-dark-wool">Rincian Produk</h4>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $order->items->count() }} Item</span>
                </div>
                <div class="p-10">
                    <div class="space-y-6">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center space-x-6">
                                <div class="w-20 h-20 rounded-3xl bg-vintage-cream overflow-hidden shadow-inner group-hover:scale-105 transition-transform duration-500">
                                    <img src="{{ $item->product->image_url ?? 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1072&auto=format&fit=crop' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="font-bold text-dark-wool">{{ $item->product_name }}</h5>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Rp{{ number_format($item->product_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-dark-wool">x{{ $item->quantity }}</p>
                                <p class="text-soft-rose font-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="mt-12 pt-8 border-t border-gray-50 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-bold uppercase tracking-widest">Subtotal</span>
                            <span class="text-dark-wool font-bold">Rp{{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400 font-bold uppercase tracking-widest">Ongkos Kirim</span>
                            <span class="text-dark-wool font-bold">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-lg font-serif font-bold text-dark-wool">Total Akhir</span>
                            <span class="text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                    <h4 class="text-lg font-serif font-bold text-dark-wool mb-8 flex items-center">
                        <i class="fas fa-user-circle mr-3 text-soft-rose"></i>
                        Informasi Pelanggan
                    </h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                            <p class="font-bold text-dark-wool">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kontak</label>
                            <p class="font-bold text-dark-wool">{{ $order->customer_email }}</p>
                            <p class="text-sm font-bold text-gray-400">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                    <h4 class="text-lg font-serif font-bold text-dark-wool mb-8 flex items-center">
                        <i class="fas fa-truck mr-3 text-soft-rose"></i>
                        Alamat Pengiriman
                    </h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kurir</label>
                            <span class="px-3 py-1 bg-dark-wool text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                                {{ $order->courier ?? 'Standard' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat Lengkap</label>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-8">
            <!-- Payment Status Card -->
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Status Pembayaran</p>
                    <div class="inline-flex items-center justify-center space-x-3 mb-8">
                        <div class="w-3 h-3 rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-500 shadow-[0_0_15px_rgba(34,197,94,0.4)]' : 'bg-yellow-500 shadow-[0_0_15px_rgba(234,179,8,0.4)]' }}"></div>
                        <span class="text-2xl font-serif font-bold text-dark-wool uppercase tracking-widest">{{ $order->payment_status }}</span>
                    </div>
                    @if($order->payment_status !== 'paid')
                    <div class="flex flex-col space-y-3">
                        <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                            @csrf
                            <button class="w-full py-4 rounded-2xl bg-green-500 text-white font-bold hover:bg-green-600 transition-all shadow-xl shadow-green-500/20">
                                Konfirmasi Manual
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                <i class="fas fa-credit-card absolute -right-6 -bottom-6 text-7xl text-gray-50/50"></i>
            </div>

            <!-- Order Status Info -->
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Status Pesanan</p>
                <div class="flex items-center space-x-3">
                    <span class="text-xl font-serif font-bold text-dark-wool uppercase tracking-widest">{{ $order->status }}</span>
                </div>
                @if($order->tracking_number)
                <div class="mt-6 pt-6 border-t border-gray-50">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nomor Resi</p>
                    <p class="font-mono font-bold text-soft-rose">{{ $order->tracking_number }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
