@extends('layouts.app')

@section('title', 'Status Pesanan | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl" data-aos="fade-up">
                <!-- Header -->
                <div class="text-center mb-12">
                    <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-[10px]">Detail Transaksi</span>
                    <h2 class="text-4xl font-serif font-bold text-dark-wool mt-4">Pesanan <span class="italic text-soft-rose">#{{ $order->id }}</span></h2>
                    <p class="text-gray-400 text-sm mt-2">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>

                <!-- Status Card -->
                <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-50 overflow-hidden mb-12">
                    <div class="p-12 lg:p-16">
                        <!-- Progress Stepper -->
                        <div class="flex justify-between items-center relative mb-16 px-4 lg:px-8">
                            <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -translate-y-1/2 z-0"></div>
                            
                            <!-- Step 1: Received -->
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-500 {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'bg-green-500 text-white' : 'bg-white text-gray-300 border border-gray-100' }}">
                                    <i class="fas fa-receipt text-sm"></i>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest mt-4 {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'text-dark-wool' : 'text-gray-300' }}">Diterima</span>
                            </div>

                            <!-- Step 2: Processing -->
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-500 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-green-500 text-white' : 'bg-white text-gray-300 border border-gray-100' }}">
                                    <i class="fas fa-box-open text-sm"></i>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest mt-4 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-dark-wool' : 'text-gray-300' }}">Diproses</span>
                            </div>

                            <!-- Step 3: Delivered -->
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-500 {{ in_array($order->status, ['delivered']) ? 'bg-green-500 text-white' : 'bg-white text-gray-300 border border-gray-100' }}">
                                    <i class="fas fa-home text-sm"></i>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest mt-4 {{ in_array($order->status, ['delivered']) ? 'text-dark-wool' : 'text-gray-300' }}">Selesai</span>
                            </div>
                        </div>

                        <!-- Info Summary -->
                        <div class="bg-gray-50 rounded-[2rem] p-8 mb-12">
                            <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200/50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pembayaran</span>
                                <span class="px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pembayaran</span>
                                <span class="text-2xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Item List -->
                        <h6 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">Item yang Dipesan</h6>
                        <div class="space-y-6 mb-12">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center group">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 overflow-hidden">
                                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="">
                                        </div>
                                        <div>
                                            <p class="font-bold text-dark-wool text-sm">{{ $item->product->name }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-dark-wool text-sm">Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="pt-8 border-t border-gray-100 text-center">
                            <a href="{{ route('order.track') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-full border-2 border-dark-wool font-bold text-xs hover:bg-dark-wool hover:text-white transition-all duration-300">
                                <i class="fas fa-arrow-left mr-3"></i> Lacak Pesanan Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
