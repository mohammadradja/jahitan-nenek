@extends('layouts.app')

@section('title', 'Terima Kasih | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
        <!-- Success Animation/Icon -->
        <div class="mb-12" data-aos="zoom-in">
            <div class="w-32 h-32 bg-green-500 text-white rounded-[2.5rem] flex items-center justify-center mx-auto shadow-2xl shadow-green-200 animate-bounce">
                <i class="fas fa-check text-5xl"></i>
            </div>
        </div>

        <h1 class="text-6xl font-serif font-bold text-dark-wool mb-4" data-aos="fade-up">Terima Kasih!</h1>
        <p class="text-xl text-gray-400 mb-16" data-aos="fade-up" data-aos-delay="100">
            Pesanan Anda <span class="text-soft-rose font-bold">#{{ $order->id }}</span> telah kami terima dan sedang dirajut dengan penuh kasih sayang.
        </p>
        
        <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-50 overflow-hidden text-left">
                <div class="bg-dark-wool p-10 flex justify-between items-center">
                    <h5 class="text-xl font-serif font-bold text-white">Ringkasan Pesanan</h5>
                    <span class="px-4 py-1.5 rounded-full bg-green-500/10 text-green-400 text-[10px] font-bold uppercase tracking-widest border border-green-500/20">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
                
                <div class="p-10 space-y-8">
                    <div class="flex justify-between items-end pb-8 border-b border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pembayaran</span>
                        <span class="text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div>
                        <h6 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Alamat Pengiriman</h6>
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <p class="text-sm text-dark-wool leading-relaxed">{{ $order->customer_address }}</p>
                        </div>
                    </div>

                    <div class="bg-soft-rose/5 rounded-2xl p-6 flex items-start space-x-4">
                        <i class="fas fa-info-circle text-soft-rose mt-1"></i>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Kami akan mengirimkan update status pengiriman secara berkala ke email <span class="font-bold text-dark-wool">{{ $order->customer_email }}</span>.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 flex flex-col md:flex-row justify-center gap-6">
                <a href="{{ route('home') }}" class="btn-premium px-12 py-5 shadow-2xl shadow-soft-rose/20">
                    Kembali Beranda
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-12 py-5 rounded-2xl border-2 border-dark-wool font-bold text-dark-wool hover:bg-dark-wool hover:text-white transition-all duration-300">
                    Lihat Status Pesanan <i class="fas fa-arrow-right ml-3 text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
