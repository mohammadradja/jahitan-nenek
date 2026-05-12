@extends('layouts.app')

@section('content')
    <x-hero />

    <!-- Product Showcase -->
    <section class="py-32 bg-white" id="produk">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="text-center mb-20" data-aos="fade-down">
                <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">Koleksi Terbaru</span>
                <h2 class="text-5xl font-serif font-bold mt-4 mb-6">Pilih Kehangatanmu</h2>
                <div class="w-24 h-1.5 bg-soft-rose mx-auto rounded-full mb-12"></div>
                
                <!-- Search Bar -->
                <form action="{{ route('home') }}#produk" method="GET" class="max-w-2xl mx-auto mb-16 relative group">
                    <input type="text" name="search" 
                           class="w-full bg-gray-50 border border-gray-100 rounded-full py-5 px-10 focus:ring-4 focus:ring-soft-rose/10 focus:bg-white outline-none transition-all shadow-sm hover:shadow-md pr-32" 
                           placeholder="Cari rajutan impianmu..." 
                           value="{{ request('search') }}">
                    <button class="absolute right-2 top-2 btn-premium py-3 px-8 text-sm" type="submit">Cari</button>
                </form>

                <!-- Categories -->
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('home') }}" 
                       class="px-8 py-3 rounded-full font-bold transition-all {{ !request('category') ? 'btn-premium' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                        Semua
                    </a>
                    @foreach(\App\Models\Category::all() as $cat)
                        <a href="{{ route('home', ['category' => $cat->slug]) }}" 
                           class="px-8 py-3 rounded-full font-bold transition-all {{ request('category') == $cat->slug ? 'btn-premium' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($products as $product)
                    <x-product-card :product="$product" :delay="$loop->index * 100" />
                @empty
                    <div class="col-span-full text-center py-24 flex flex-col items-center">
                        <img src="https://illustrations.popsy.co/gray/searching.svg" alt="Not Found" class="w-64 mb-8 opacity-50">
                        <h4 class="text-2xl font-serif font-bold text-gray-400">Oops! Produk tidak ditemukan.</h4>
                        <a href="{{ route('home') }}" class="btn-premium mt-8">Reset Pencarian</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $products->links() }}
            </div>
        </div>
    </section>

    <x-features />

    <!-- Special Recommendations -->
    <section class="py-32 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8" data-aos="fade-up">
                <div>
                    <span class="text-soft-rose font-bold uppercase tracking-widest text-xs">Dikurasi Nenek</span>
                    <h2 class="text-4xl font-serif font-bold mt-2">Rekomendasi Spesial</h2>
                </div>
                <a href="#produk" class="px-8 py-3 rounded-full border-2 border-dark-wool font-bold hover:bg-dark-wool hover:text-white transition-all">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach(\App\Models\Product::inRandomOrder()->take(3)->get() as $product)
                    <x-product-card :product="$product" :delay="$loop->index * 150" />
                @endforeach
            </div>
        </div>
    </section>

    <x-blog-preview />

    <x-gallery />

    <!-- Premium Newsletter -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="bg-dark-wool rounded-[4rem] overflow-hidden shadow-2xl relative" data-aos="zoom-in">
                <!-- Background Accents -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-soft-rose/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-soft-rose/5 rounded-full blur-3xl"></div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="h-[400px] lg:h-full relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544967082-d9d25d867d66?q=80&w=1000&auto=format&fit=crop" 
                             class="absolute inset-0 w-full h-full object-cover grayscale opacity-60 hover:grayscale-0 transition-all duration-700">
                    </div>
                    <div class="p-16 lg:p-24 flex flex-col justify-center text-white">
                        <h2 class="text-4xl lg:text-5xl font-serif font-bold mb-8 leading-tight">Ingin Koleksi <br><span class="text-soft-rose underline decoration-2 underline-offset-8">Terbatas?</span></h2>
                        <p class="text-white/60 text-lg mb-12 leading-relaxed">Dapatkan update koleksi terbaru, promo eksklusif, dan cerita hangat di balik setiap rajutan langsung ke email Anda.</p>
                        <form action="#" class="relative group">
                            <input type="email" placeholder="Alamat email Anda" 
                                   class="w-full bg-white/5 border border-white/10 rounded-full py-5 px-10 outline-none focus:bg-white/10 focus:border-soft-rose transition-all pr-40">
                            <button class="absolute right-2 top-2 btn-premium py-3 px-8 text-sm">Berlangganan</button>
                        </form>
                        <p class="mt-6 text-xs text-white/40 flex items-center">
                            <i class="fas fa-lock mr-2 text-soft-rose"></i>
                            Kami menghargai privasi Anda dan janji tidak ada spam.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
