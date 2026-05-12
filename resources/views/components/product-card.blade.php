@props(['product', 'delay' => 0])

<div class="group" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="bg-white rounded-5xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-50">
        <!-- Image Container -->
        <div class="relative aspect-[4/5] overflow-hidden">
            <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1000&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                 alt="{{ $product->name }}">
            
            @if($product->stock < 5)
                <div class="absolute top-6 left-6">
                    <span class="bg-red-500 text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Stok Terbatas</span>
                </div>
            @endif

            <!-- Overlay for Quick Actions (Optional) -->
            <div class="absolute inset-0 bg-dark-wool/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center space-x-4">
                {{-- Quick actions can go here --}}
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-[10px] font-bold text-soft-rose uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                    <h3 class="text-xl font-serif font-bold text-dark-wool line-clamp-1">{{ $product->name }}</h3>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-dark-wool">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <p class="text-gray-400 text-sm leading-relaxed line-clamp-2 mb-6">
                {{ $product->description }}
            </p>

            <div class="flex items-center space-x-2 mb-8">
                <div class="flex text-yellow-400 text-xs">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Premium Choice</span>
            </div>

            <!-- Auth Protected Actions -->
            <div class="flex space-x-3">
                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full btn-premium py-3 text-sm">Beli Sekarang</button>
                    </form>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-soft-rose text-soft-rose hover:bg-soft-rose hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-shopping-basket"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full btn-premium py-3 text-sm">Masuk untuk Membeli</a>
                @endauth
            </div>
        </div>
    </div>
</div>
