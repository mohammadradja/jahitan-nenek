@extends('layouts.app')

@section('title', $product->name . ' | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream/30 min-h-screen py-20" x-data="productHandler()">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-4 text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-12" data-aos="fade-down">
            <a href="{{ route('home') }}" class="hover:text-soft-rose transition-colors">Beranda</a>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
            <a href="{{ route('home') }}?category={{ $product->category->slug }}" class="hover:text-soft-rose transition-colors">{{ $product->category->name }}</a>
            <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
            <span class="text-dark-wool">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Image Section -->
            <div class="lg:col-span-7" data-aos="fade-right">
                <div class="relative rounded-[3.5rem] overflow-hidden bg-white shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] group p-4 border border-white">
                    <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden">
                        <img src="{{ $product->imageUrl('https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=1000&auto=format&fit=crop') }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" 
                             alt="{{ $product->name }}">
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="lg:col-span-5" data-aos="fade-left">
                <div class="sticky top-32">
                    <span class="text-soft-rose font-bold uppercase tracking-[0.4em] text-[10px] mb-4 block">{{ $product->category->name }}</span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-dark-wool mb-6 leading-[1.1]">{{ $product->name }}</h1>
                    
                    <div class="flex items-center space-x-6 mb-10">
                        <p class="text-3xl font-serif font-bold text-dark-wool">{{ $product->formattedEstimatedPrice() }}</p>
                        <div class="flex items-center bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-50">
                            <div class="flex text-yellow-400 text-[10px] mr-3">
                                @for($i=1; $i<=5; $i++) <i class="fas fa-star"></i> @endfor
                            </div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $product->sales_count ?? 0 }} Terjual</span>
                        </div>
                    </div>

                    <div class="prose prose-stone max-w-none text-gray-500 text-sm leading-relaxed mb-12">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    <!-- Custom Measurement Form -->
                    @if($product->is_customizable)
                        <div class="bg-white rounded-[2.5rem] p-8 mb-10 border border-gray-50 shadow-sm overflow-hidden relative">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-soft-rose/5 rounded-full blur-2xl"></div>
                            
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-6 flex items-center">
                                <i class="fas fa-ruler-combined mr-3 text-soft-rose"></i> Custom Ukuran (Tailoring)
                            </h4>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1.5">Lingkar Dada (cm)</label>
                                    <input type="text" inputmode="decimal" x-model="measurements.chest" class="input-premium py-2 text-xs" placeholder="0" @input="$event.target.value = $event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); measurements.chest = $event.target.value">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1.5">Lingkar Pinggang (cm)</label>
                                    <input type="text" inputmode="decimal" x-model="measurements.waist" class="input-premium py-2 text-xs" placeholder="0" @input="$event.target.value = $event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); measurements.waist = $event.target.value">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1.5">Lingkar Pinggul (cm)</label>
                                    <input type="text" inputmode="decimal" x-model="measurements.hip" class="input-premium py-2 text-xs" placeholder="0" @input="$event.target.value = $event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); measurements.hip = $event.target.value">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1.5">Lebar Bahu (cm)</label>
                                    <input type="text" inputmode="decimal" x-model="measurements.shoulder" class="input-premium py-2 text-xs" placeholder="0" @input="$event.target.value = $event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'); measurements.shoulder = $event.target.value">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1.5">Catatan Tambahan</label>
                                <textarea x-model="measurements.notes" rows="2" class="input-premium py-2 text-xs resize-none" placeholder="Contoh: Panjang lengan minta ditambah 2cm..."></textarea>
                            </div>
                            <p class="mt-4 text-[9px] text-gray-400 italic">*) Kosongkan jika ingin menggunakan ukuran standar (All Size).</p>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex items-center gap-4">
                        @auth
                            <button @click="addToCart(true)" class="btn-premium flex-1 py-5 text-sm">
                                <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                            </button>
                            <button @click="addToCart(false)" class="w-16 h-16 rounded-[1.5rem] border border-gray-100 bg-white flex items-center justify-center text-soft-rose hover:bg-soft-rose hover:text-white transition-all shadow-sm group">
                                <i class="fas fa-cart-plus text-xl group-hover:scale-110 transition-transform"></i>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn-premium w-full py-5 text-center">
                                Masuk untuk Membeli
                            </a>
                        @endauth
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-3 gap-4 mt-12 pt-10 border-t border-gray-100">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-3">
                                <i class="fas fa-hands text-sm"></i>
                            </div>
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Handmade with Love</p>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-3">
                                <i class="fas fa-leaf text-sm"></i>
                            </div>
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Eco-Friendly Material</p>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-2xl bg-soft-rose/10 text-soft-rose flex items-center justify-center mb-3">
                                <i class="fas fa-shield-alt text-sm"></i>
                            </div>
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest leading-tight">Authentic Heritage</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($related->count() > 0)
            <div class="mt-32">
                <div class="text-center mb-16">
                    <span class="text-soft-rose font-bold uppercase tracking-[0.4em] text-[10px]">Pilihan Lainnya</span>
                    <h2 class="text-4xl font-serif font-bold text-dark-wool mt-4">Mungkin Anda Suka</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                    @foreach($related as $prod)
                        <x-product.product-card :product="$prod" :delay="$loop->index * 100" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function productHandler() {
        return {
            measurements: {
                chest: '',
                waist: '',
                hip: '',
                shoulder: '',
                notes: ''
            },
            async addToCart(buyNow = false) {
                try {
                    const url = buyNow ? '{{ route("cart.buy-now", $product->id) }}' : '{{ route("cart.add", $product->id) }}';
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.measurements)
                    });

                    if (buyNow) {
                        window.location.href = '{{ route("checkout.index") }}';
                        return;
                    }

                    const data = await res.json();
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: data.message, type: 'success' }
                    }));
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'Gagal menambahkan ke keranjang.', type: 'error' }
                    }));
                }
            }
        }
    }
</script>
@endpush
@endsection
