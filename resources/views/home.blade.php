@extends('layouts.app')

@section('content')
<div x-data="{ 
    category: '{{ request('category') }}', 
    search: '{{ request('search') }}'
}">
    @if(\App\Models\SiteSetting::get('cms_section_hero_active', '1') == '1')
        <x-home.hero />
    @endif

    <!-- Product Showcase -->
    @if(\App\Models\SiteSetting::get('cms_section_products_active', '1') == '1')
        <section class="py-20 lg:py-24 bg-white" id="produk">
            <div class="max-w-7xl mx-auto px-6 lg:px-20">
                <div class="text-center mb-20" data-aos="fade-down">
                    <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">{{ __('messages.latest_collection') }}</span>
                    <h2 class="text-4xl font-serif font-bold mt-4 mb-6">{{ __('messages.pick_warmth') }}</h2>
                    <div class="w-20 h-1.5 bg-soft-rose mx-auto rounded-full mb-12"></div>
                    
                    <!-- Search Bar -->
                    <form action="{{ route('home') }}#produk" method="GET" class="max-w-lg mx-auto mb-10 relative group">
                        <input type="hidden" name="category" :value="category">
                        <input type="text" name="search" x-model="search"
                               class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-6 focus:ring-4 focus:ring-soft-rose/5 focus:bg-white outline-none transition-all shadow-sm text-xs pr-24" 
                               placeholder="{{ __('messages.search_placeholder') ?? 'Cari rajutan impianmu...' }}">
                        <button type="submit" class="absolute right-1 top-1 bg-dark-wool text-white py-2 px-6 rounded-lg text-xs font-bold uppercase tracking-widest">{{ __('messages.search') ?? 'Cari' }}</button>
                    </form>

                    <!-- Categories -->
                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="{{ route('home', ['search' => request('search')]) }}#produk" 
                           class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all"
                           :class="!category ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'bg-gray-50 text-dark-wool hover:bg-gray-100'">
                            {{ __('messages.all') }}
                        </a>
                        @foreach(\App\Models\Category::all() as $cat)
                            <a href="{{ route('home', ['category' => $cat->slug, 'search' => request('search')]) }}#produk" 
                               class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all"
                               :class="category === '{{ $cat->slug }}' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'bg-gray-50 text-dark-wool hover:bg-gray-100'">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                @if(\App\Models\SiteSetting::get('promo_enabled', '0') == '1')
                    <div class="mb-12 rounded-[2rem] bg-dark-wool text-white p-8 lg:p-10 shadow-2xl shadow-dark-wool/10 border border-white/10" data-aos="fade-up">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                            <div>
                                <p class="text-[10px] font-bold text-soft-rose uppercase tracking-[0.3em] mb-3">{{ \App\Models\SiteSetting::get('promo_label', 'Promo Spesial') }}</p>
                                <h3 class="text-2xl font-serif font-bold">{{ \App\Models\SiteSetting::get('promo_description', 'Harga spesial untuk koleksi pilihan Jahitan Nenek.') }}</h3>
                            </div>
                            <div class="flex flex-wrap items-end gap-4">
                                @if(\App\Models\SiteSetting::get('promo_original_price'))
                                    <span class="text-lg font-bold text-white/40 line-through">Rp{{ number_format((int) \App\Models\SiteSetting::get('promo_original_price'), 0, ',', '.') }}</span>
                                @endif
                                @if(\App\Models\SiteSetting::get('promo_real_price'))
                                    <span class="text-3xl lg:text-4xl font-serif font-bold text-soft-rose">Rp{{ number_format((int) \App\Models\SiteSetting::get('promo_real_price'), 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Product Grid -->
                <div class="relative min-h-[600px]">
                    <div id="product-grid-container" class="animate__animated animate__fadeIn">
                        @include('partials.product-grid', ['products' => $products])
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(\App\Models\SiteSetting::get('cms_section_features_active', '1') == '1')
        <x-home.features />
    @endif

    <!-- Special Recommendations -->
    @if(\App\Models\SiteSetting::get('cms_section_recommendations_active', '1') == '1')
        <section class="py-20 lg:py-24 bg-gray-50/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-20">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8" data-aos="fade-up">
                    <div>
                        <span class="text-soft-rose font-bold uppercase tracking-widest text-[10px]">{{ __('messages.most_wanted') }}</span>
                        <h2 class="text-2xl font-serif font-bold mt-1">{{ __('messages.knit_favorites') }}</h2>
                    </div>
                    <a href="#produk" class="px-6 py-2 rounded-lg border border-dark-wool font-bold hover:bg-dark-wool hover:text-white transition-all text-[10px] uppercase tracking-widest">{{ __('messages.view_more_collection') }}</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach(\App\Models\Product::orderBy('sales_count', 'desc')->take(3)->get() as $product)
                        <x-product.product-card :product="$product" :delay="$loop->index * 150" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(\App\Models\SiteSetting::get('cms_section_blog_active', '1') == '1')
        <x-blog.blog-preview />
    @endif

    @if(\App\Models\SiteSetting::get('cms_section_gallery_active', '1') == '1')
        <x-home.gallery />
    @endif

</div>
@endsection
