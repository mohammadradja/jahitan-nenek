@extends('layouts.app')

@section('title', $product->name . ' | Jahitan Nenek')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-[8px] font-bold uppercase tracking-widest text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-soft-rose">Beranda</a>
            <i class="fas fa-chevron-right text-[6px]"></i>
            <a href="{{ route('home') }}?category={{ $product->category->slug }}" class="hover:text-soft-rose">{{ $product->category->name }}</a>
            <i class="fas fa-chevron-right text-[6px]"></i>
            <span class="text-dark-wool">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Image Section -->
                <div class="p-6 lg:p-8 bg-gray-50/50">
                    <div class="aspect-square rounded-xl overflow-hidden bg-white border border-gray-100 shadow-inner group">
                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633' }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                             alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Info Section -->
                <div class="p-6 lg:p-12 flex flex-col justify-center">
                    <span class="text-soft-rose font-bold uppercase tracking-[0.2em] text-[9px] mb-2 block">{{ $product->category->name }}</span>
                    <h1 class="text-3xl font-serif font-bold text-dark-wool mb-4 leading-tight">{{ $product->name }}</h1>
                    
                    <div class="flex items-center space-x-4 mb-6">
                        <p class="text-2xl font-bold text-soft-rose">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="h-4 w-px bg-gray-200"></div>
                        <div class="flex items-center">
                            <div class="flex text-yellow-400 text-[8px] mr-2">
                                @for($i=1; $i<=5; $i++) <i class="fas fa-star"></i> @endfor
                            </div>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $product->sales_count }} Terjual</span>
                        </div>
                    </div>

                    <div class="text-gray-500 text-xs mb-8 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        @auth
                            <form action="{{ route('cart.buy-now', $product) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-soft-rose text-white font-bold py-3 rounded-lg hover:bg-soft-rose/90 transition-all shadow-md shadow-soft-rose/20 text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                                    <i class="fas fa-bolt"></i> Beli Sekarang
                                </button>
                            </form>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-12 h-12 rounded-lg border border-gray-100 bg-white flex items-center justify-center text-soft-rose hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-cart-plus text-sm"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-dark-wool text-white font-bold py-3 rounded-lg text-center text-xs uppercase tracking-widest hover:bg-dark-wool/90 transition-all">
                                Masuk untuk Membeli
                            </a>
                        @endauth
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-3 gap-2 mt-8 pt-8 border-t border-gray-50">
                        <div class="text-center">
                            <i class="fas fa-hands text-soft-rose text-xs mb-1"></i>
                            <p class="text-[7px] font-bold text-gray-400 uppercase tracking-widest">Handmade</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-shield-alt text-soft-rose text-xs mb-1"></i>
                            <p class="text-[7px] font-bold text-gray-400 uppercase tracking-widest">Safe Payment</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-truck text-soft-rose text-xs mb-1"></i>
                            <p class="text-[7px] font-bold text-gray-400 uppercase tracking-widest">Fast Delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($related->count() > 0)
            <div class="mt-20">
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <span class="text-soft-rose font-bold uppercase tracking-widest text-[8px]">Rekomendasi</span>
                        <h2 class="text-xl font-serif font-bold text-dark-wool mt-1">Produk Serupa</h2>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($related as $prod)
                        <x-product.product-card :product="$prod" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
