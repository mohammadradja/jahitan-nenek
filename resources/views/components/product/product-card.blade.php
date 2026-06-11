@props(['product', 'delay' => 0])

<div class="group" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-50 h-full flex flex-col">
        <!-- Product Link Wrapper (Image & Info) -->
        <a href="{{ route('product.show', $product->slug) }}" class="flex flex-col flex-1">
            <!-- Image Container -->
            <div class="relative aspect-[1/1] sm:aspect-[4/5] overflow-hidden">
                <img src="{{ $product->imageUrl('https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1000&auto=format&fit=crop') }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="{{ $product->name }}">
                
                <div class="absolute top-4 left-4 flex flex-col gap-2">
                    @if($product->stock < 5)
                        <span class="bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Limit</span>
                    @endif
                    @if($product->sales_count > 10)
                        <span class="bg-soft-rose text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Hot</span>
                    @endif
                </div>

                <div class="absolute bottom-4 left-4 right-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                    <div class="bg-white/95 backdrop-blur-md px-4 py-2 rounded-xl shadow-xl flex items-center justify-between border border-white/20">
                        <div>
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Stats</p>
                            <p class="text-xs font-bold text-dark-wool">{{ $product->sales_count ?? 0 }} <span class="text-[9px] font-medium text-gray-500">SoldCount</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4 sm:p-6 pb-0">
                <div class="mb-2 sm:mb-3">
                    <p class="text-[8px] sm:text-[10px] font-bold text-soft-rose uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                    <h3 class="text-xs sm:text-lg font-serif font-bold text-dark-wool line-clamp-1 group-hover:text-soft-rose transition-colors">{{ $product->name }}</h3>
                </div>

                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div>
                        <p class="text-sm sm:text-base font-bold text-dark-wool">{{ $product->formattedEstimatedPrice() }}</p>
                    </div>
                    <div class="hidden sm:flex text-yellow-400 text-[10px] space-x-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                </div>
            </div>
        </a>

        <!-- Action Row -->
        <div class="p-4 sm:p-6 pt-0 mt-auto">
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <form action="{{ route('cart.buy-now', $product) }}" method="POST" class="flex-[2]">
                        @csrf
                        <button type="submit" class="w-full h-[40px] sm:h-[52px] flex items-center justify-center gap-1.5 sm:gap-3 rounded-xl sm:rounded-2xl bg-dark-wool text-white hover:bg-soft-rose transition-all duration-500 shadow-xl shadow-dark-wool/10 font-bold text-[9px] sm:text-[11px] uppercase tracking-wider sm:tracking-[0.2em] group/btn overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></div>
                            <i class="fas fa-bolt text-[10px] sm:text-xs animate-pulse text-soft-rose group-hover/btn:text-white"></i>
                            <span>{{ __('messages.buy_now') }}</span>
                        </button>
                    </form>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full h-[40px] sm:h-[52px] flex items-center justify-center rounded-xl sm:rounded-2xl bg-gray-50 text-dark-wool hover:bg-soft-rose/10 hover:text-soft-rose transition-all duration-300 border border-gray-100 group/cart" title="{{ __('messages.add_to_cart') }}">
                            <i class="fas fa-shopping-basket text-xs sm:text-base group-hover/cart:scale-110 transition-transform"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full h-[40px] sm:h-[52px] flex items-center justify-center bg-soft-rose text-white rounded-xl sm:rounded-2xl text-[9px] sm:text-[11px] text-center shadow-lg shadow-soft-rose/20 uppercase tracking-wider sm:tracking-[0.2em] font-bold hover:bg-dark-wool hover:-translate-y-1 transition-all duration-500">{{ __('messages.login_to_buy') ?? 'Masuk untuk Membeli' }}</a>
                @endauth
            </div>
        </div>
    </div>
</div>
