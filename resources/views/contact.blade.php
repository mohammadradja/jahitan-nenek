@extends('layouts.app')

@section('title', 'Hubungi Kami | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream">
    <!-- Premium Header -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-soft-rose/5 blur-3xl rounded-full translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-20 relative text-center" data-aos="fade-down">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">Hubungi Kami</span>
            <h1 class="text-6xl md:text-7xl font-serif font-bold text-dark-wool mt-6 mb-8 leading-tight">Mari Bertukar <br><span class="italic text-soft-rose">Cerita & Rajutan</span></h1>
            <div class="w-32 h-1.5 bg-soft-rose mx-auto mt-12 rounded-full"></div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <!-- Row 1: Info & FAQ -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                <!-- Info Column -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="bg-dark-wool text-white rounded-3xl p-8 shadow-xl h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-soft-rose/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                        
                        <h3 class="text-xl font-serif font-bold mb-6">Informasi Kontak</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-location-dot text-sm"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-[9px] uppercase tracking-widest text-white/40 mb-1">Workshop</h6>
                                    <p class="text-sm">Jl. Benang No. 123, Bandung</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-envelope text-sm"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-[9px] uppercase tracking-widest text-white/40 mb-1">Email</h6>
                                    <p class="text-sm">halo@jahitannenek.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white hover:bg-soft-rose transition-all border border-white/10"><i class="fab fa-instagram text-sm"></i></a>
                                <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white hover:bg-green-500 transition-all border border-white/10"><i class="fab fa-whatsapp text-sm"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Column -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-50 h-full">
                        <h3 class="text-xl font-serif font-bold text-dark-wool mb-6">Sering Ditanyakan</h3>
                        <div class="space-y-3" x-data="{ active: 1 }">
                            <div class="group bg-gray-50 rounded-2xl overflow-hidden border border-transparent" :class="active === 1 ? 'border-soft-rose/20 bg-white shadow-sm' : ''">
                                <button @click="active = active === 1 ? null : 1" class="w-full px-6 py-4 flex items-center justify-between text-left">
                                    <span class="text-xs font-bold text-dark-wool">Cara pesan kustom?</span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform" :class="active === 1 ? 'rotate-180 text-soft-rose' : ''"></i>
                                </button>
                                <div x-show="active === 1" class="px-6 pb-4 text-[11px] text-gray-500 leading-relaxed">
                                    Hubungi kami via WhatsApp atau form di bawah untuk diskusi desain & ukuran.
                                </div>
                            </div>
                            <div class="group bg-gray-50 rounded-2xl overflow-hidden border border-transparent" :class="active === 2 ? 'border-soft-rose/20 bg-white shadow-sm' : ''">
                                <button @click="active = active === 2 ? null : 2" class="w-full px-6 py-4 flex items-center justify-between text-left">
                                    <span class="text-xs font-bold text-dark-wool">Lama pengerjaan?</span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform" :class="active === 2 ? 'rotate-180 text-soft-rose' : ''"></i>
                                </button>
                                <div x-show="active === 2" class="px-6 pb-4 text-[11px] text-gray-500 leading-relaxed">
                                    3-14 hari kerja tergantung kerumitan dan antrian.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Form Below -->
            <div class="max-w-3xl mx-auto" data-aos="fade-up">
                <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-serif font-bold text-dark-wool mb-8 text-center">Kirim Pesan</h3>
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama</label>
                                <input type="text" class="input-premium py-2 text-sm" placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                                <input type="email" class="input-premium py-2 text-sm" placeholder="email@anda.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-2">Pesan</label>
                            <textarea rows="4" class="input-premium py-3 text-sm resize-none" placeholder="Tuliskan pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn-premium w-full py-3 text-sm shadow-xl shadow-soft-rose/20">
                            Kirim Pesan <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@endsection
