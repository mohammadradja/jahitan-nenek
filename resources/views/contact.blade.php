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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Info Column -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="bg-dark-wool text-white rounded-[3rem] p-12 lg:p-16 shadow-2xl h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-soft-rose/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                        
                        <h3 class="text-3xl font-serif font-bold mb-8">Informasi Kontak</h3>
                        <p class="text-white/60 leading-relaxed mb-12">
                            Ada pertanyaan tentang koleksi kami atau ingin memesan rajutan kustom yang spesial? Kami siap membantu Anda dengan sepenuh hati.
                        </p>
                        
                        <div class="space-y-10">
                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-sm uppercase tracking-widest text-white/40 mb-1">Workshop</h6>
                                    <p class="text-lg">Jl. Benang No. 123, Bandung, Jawa Barat</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-sm uppercase tracking-widest text-white/40 mb-1">Telepon</h6>
                                    <p class="text-lg">+62 812 3456 7890</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-sm uppercase tracking-widest text-white/40 mb-1">Email</h6>
                                    <p class="text-lg">halo@jahitannenek.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-20">
                            <h5 class="text-xs font-bold uppercase tracking-[0.3em] text-white/30 mb-8">Ikuti Jejak Kami</h5>
                            <div class="flex space-x-4">
                                <a href="#" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-soft-rose transition-all border border-white/10"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-soft-rose transition-all border border-white/10"><i class="fab fa-tiktok"></i></a>
                                <a href="#" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-green-500 transition-all border border-white/10"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="bg-white rounded-[3rem] p-12 lg:p-16 shadow-sm border border-gray-50 h-full">
                        <h3 class="text-3xl font-serif font-bold text-dark-wool mb-10">Kirim Pesan</h3>
                        <form action="#" method="POST" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                                    <input type="text" class="input-premium" placeholder="Contoh: Budi Santoso">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Email</label>
                                    <input type="email" class="input-premium" placeholder="budi@email.com">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Subjek</label>
                                <input type="text" class="input-premium" placeholder="Apa yang ingin Anda tanyakan?">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Pesan Anda</label>
                                <textarea rows="5" class="input-premium py-5 resize-none" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="btn-premium w-full py-5 text-lg shadow-2xl shadow-soft-rose/20">
                                Kirim Pesan Sekarang <i class="fas fa-paper-plane ml-3 text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section class="h-[500px] w-full relative">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311640925292!3d-6.903444341688536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146077167e76979!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1715150000000!5m2!1sen!2sid" 
                class="absolute inset-0 w-full h-full grayscale opacity-80" 
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <div class="absolute inset-0 pointer-events-none shadow-[inset_0_0_100px_rgba(0,0,0,0.1)]"></div>
    </section>
</div>
@endsection
