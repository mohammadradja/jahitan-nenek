@props(['product', 'delay' => 0])

<div class="group" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-50 h-full flex flex-col">
        <!-- Image Container -->
        <div class="relative aspect-[1/1] sm:aspect-[4/5] overflow-hidden">
            <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1000&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                 alt="{{ $product->name }}">
            
            <div class="absolute top-4 left-4 flex flex-col gap-2">
                @if($product->stock < 5)
                    <span class="bg-red-500 text-white text-[8px] font-bold px-2 py-0.5 rounded-full uppercase tracking-widest shadow-lg">Limit</span>
                @endif
                @if($product->sales_count > 10)
                    <span class="bg-soft-rose text-white text-[8px] font-bold px-2 py-0.5 rounded-full uppercase tracking-widest shadow-lg">Hot</span>
                @endif
            </div>

            <div class="absolute bottom-4 left-4 right-4">
                <div class="bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-xl flex items-center justify-between border border-white/20">
                    <div>
                        <p class="text-[6px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-0.5">Stats</p>
                        <p class="text-[9px] font-bold text-dark-wool">{{ $product->sales_count ?? 0 }} <span class="text-[7px] font-medium text-gray-500">SoldCount</span></p>
                    </div>
                    <div class="w-6 h-6 rounded-full bg-soft-rose/10 flex items-center justify-center text-soft-rose">
                        <i class="fas fa-heart text-[8px]"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4 flex-1 flex flex-col">
            <div class="mb-2">
                <p class="text-[7px] font-bold text-soft-rose uppercase tracking-widest mb-0.5">{{ $product->category->name }}</p>
                <h3 class="text-sm font-serif font-bold text-dark-wool line-clamp-1 group-hover:text-soft-rose transition-colors">{{ $product->name }}</h3>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-bold text-dark-wool">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="flex text-yellow-400 text-[7px] space-x-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
            </div>

            <!-- Action Icons Row -->
            <div class="mt-auto pt-3 flex items-center gap-2">
                @auth
                    <form action="{{ route('cart.buy-now', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-soft-rose text-white hover:bg-soft-rose/90 transition-all shadow-sm shadow-soft-rose/20" title="Beli Sekarang">
                            <i class="fas fa-bolt text-[10px]"></i>
                        </button>
                    </form>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg border border-soft-rose text-soft-rose hover:bg-soft-rose hover:text-white transition-all shadow-sm" title="Tambah ke Keranjang">
                            <i class="fas fa-shopping-basket text-[10px]"></i>
                        </button>
                    </form>
                    <a href="{{ route('product.show', $product->slug) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-dark-wool hover:bg-gray-100 transition-all border border-gray-100 shadow-sm" title="Lihat Detail">
                        <i class="fas fa-eye text-[10px]"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full btn-premium py-1.5 text-[9px] text-center shadow-sm">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</div>
