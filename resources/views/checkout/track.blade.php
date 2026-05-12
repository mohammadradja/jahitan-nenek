@extends('layouts.app')

@section('title', 'Lacak Pesanan | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="flex justify-center">
            <div class="w-full max-w-xl" data-aos="zoom-in">
                <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-50 overflow-hidden">
                    <div class="bg-dark-wool p-12 lg:p-16 text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-soft-rose/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                        <h2 class="text-4xl font-serif font-bold text-white mb-4">Lacak Pesanan</h2>
                        <p class="text-white/60 text-sm leading-relaxed">
                            Masukkan ID Pesanan dan Email Anda untuk melihat status terbaru rajutan kasih sayang Anda.
                        </p>
                    </div>
                    
                    <div class="p-12 lg:p-16">
                        @if(session('error'))
                            <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-sm font-bold flex items-center">
                                <i class="fas fa-exclamation-circle mr-3"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('order.track.post') }}" method="POST" class="space-y-8">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">ID Pesanan</label>
                                <input type="text" name="order_id" class="input-premium" placeholder="Contoh: 12345" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Email</label>
                                <input type="email" name="email" class="input-premium" placeholder="email@anda.com" required>
                            </div>
                            <button type="submit" class="btn-premium w-full py-5 text-lg shadow-2xl shadow-soft-rose/20 mt-4">
                                Cek Status Sekarang <i class="fas fa-search ml-3 text-sm"></i>
                            </button>
                        </form>

                        <div class="mt-12 text-center">
                            <p class="text-xs text-gray-400">Butuh bantuan lebih lanjut? <a href="{{ route('contact') }}" class="text-soft-rose font-bold hover:underline">Hubungi Nenek</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
