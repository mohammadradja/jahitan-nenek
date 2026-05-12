@extends('layouts.app')

@section('content')
<div x-data="{ 
    category: '{{ request('category') }}', 
    search: '{{ request('search') }}', 
    loading: false,
    async updateProducts() {
        this.loading = true;
        const url = new URL(window.location.href);
        url.searchParams.set('category', this.category || '');
        url.searchParams.set('search', this.search || '');
        
        const response = await fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const html = await response.text();
        document.getElementById('product-grid-container').innerHTML = html;
        this.loading = false;
        
        // Update URL without refresh
        window.history.pushState({}, '', url.toString());
    },
    filterCategory(slug) {
        this.category = slug;
        this.updateProducts();
    },
    resetFilters() {
        this.category = '';
        this.search = '';
        this.updateProducts();
    }
}">
    <x-home.hero />

    <!-- Product Showcase -->
    <section class="py-32 bg-white" id="produk">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="text-center mb-20" data-aos="fade-down">
                <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-[10px]">Koleksi Terbaru</span>
                <h2 class="text-3xl font-serif font-bold mt-2 mb-4">Pilih Kehangatanmu</h2>
                <div class="w-16 h-1 bg-soft-rose mx-auto rounded-full mb-8"></div>
                
                <!-- Search Bar -->
                <div class="max-w-lg mx-auto mb-10 relative group">
                    <input type="text" x-model.debounce.500ms="search" @input="updateProducts()"
                           class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-6 focus:ring-4 focus:ring-soft-rose/5 focus:bg-white outline-none transition-all shadow-sm text-xs pr-24" 
                           placeholder="Cari rajutan impianmu...">
                    <button class="absolute right-1 top-1 bg-dark-wool text-white py-2 px-6 rounded-lg text-[10px] font-bold uppercase tracking-widest" @click="updateProducts()">Cari</button>
                </div>

                <!-- Categories -->
                <div class="flex flex-wrap justify-center gap-2">
                    <button @click="filterCategory('')" 
                       class="px-5 py-1.5 rounded-lg font-bold text-[10px] uppercase tracking-widest transition-all"
                       :class="!category ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/10' : 'bg-gray-50 text-dark-wool hover:bg-gray-100'">
                        Semua
                    </button>
                    @foreach(\App\Models\Category::all() as $cat)
                        <button @click="filterCategory('{{ $cat->slug }}')" 
                           class="px-5 py-1.5 rounded-lg font-bold text-[10px] uppercase tracking-widest transition-all"
                           :class="category === '{{ $cat->slug }}' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/10' : 'bg-gray-50 text-dark-wool hover:bg-gray-100'">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Grid -->
            <div id="product-grid-container" class="relative">
                <div x-show="loading" class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center rounded-[3rem]">
                    <i class="fas fa-circle-notch fa-spin text-4xl text-soft-rose"></i>
                </div>
                @include('partials.product-grid', ['products' => $products])
            </div>
        </div>
    </section>

    <x-home.features />

    <!-- Special Recommendations -->
    <section class="py-32 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8" data-aos="fade-up">
                <div>
                    <span class="text-soft-rose font-bold uppercase tracking-widest text-[10px]">Paling Banyak Dicari</span>
                    <h2 class="text-2xl font-serif font-bold mt-1">Favorit Pecinta Rajut</h2>
                </div>
                <a href="#produk" class="px-6 py-2 rounded-lg border border-dark-wool font-bold hover:bg-dark-wool hover:text-white transition-all text-[10px] uppercase tracking-widest">Lihat Koleksi Lainnya</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach(\App\Models\Product::orderBy('sales_count', 'desc')->take(3)->get() as $product)
                    <x-product.product-card :product="$product" :delay="$loop->index * 150" />
                @endforeach
            </div>
        </div>
    </section>

    <x-blog.blog-preview />

    <x-home.gallery />

</div>
@endsection
