@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20" x-data="checkoutHandler()">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Order Summary (Sticky on desktop) -->
        <div class="lg:col-span-5 lg:order-last">
            <div class="sticky top-32 space-y-8">
                <div class="bg-white rounded-[3rem] p-10 shadow-2xl border border-gray-50">
                    <h4 class="text-2xl font-serif font-bold text-dark-wool mb-8 flex justify-between items-center">
                        <span>Ringkasan Pesanan</span>
                        <span class="text-xs font-sans font-bold bg-soft-rose/10 text-soft-rose px-3 py-1 rounded-full uppercase tracking-widest">{{ count($cart) }} Item</span>
                    </h4>
                    
                    <div class="space-y-6 mb-10">
                        @foreach($cart as $item)
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center shrink-0 overflow-hidden border border-gray-100">
                                    <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=100' }}" class="w-full h-full object-cover" alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h6 class="font-bold text-dark-wool truncate">{{ $item['name'] }}</h6>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $item['quantity'] }} x Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-dark-wool">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-8 border-t border-gray-100 space-y-4">
                        <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase tracking-widest">
                            <span>Biaya Pengiriman</span>
                            <span x-text="shippingCost > 0 ? 'Rp' + new Intl.NumberFormat('id-ID').format(shippingCost) : 'Dihitung otomatis'"></span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-lg font-serif font-bold text-dark-wool">Total Akhir</span>
                            <span class="text-3xl font-serif font-bold text-soft-rose" x-text="'Rp' + new Intl.NumberFormat('id-ID').format(subtotal + parseInt(shippingCost))"></span>
                        </div>
                    </div>
                </div>

                <div class="bg-soft-rose/5 border border-soft-rose/20 rounded-[2rem] p-8">
                    <p class="text-xs font-bold text-soft-rose uppercase tracking-[0.2em] mb-4 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i> Pembayaran Aman
                    </p>
                    <p class="text-xs text-gray-500 leading-relaxed">Transaksi Anda dienkripsi secara aman melalui gerbang pembayaran Midtrans. Kami tidak menyimpan data kartu kredit Anda.</p>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="lg:col-span-7">
            <header class="mb-12">
                <h2 class="text-4xl font-serif font-bold text-dark-wool mb-4">Detail Pengiriman</h2>
                <p class="text-gray-400 leading-relaxed">Silakan isi informasi alamat lengkap Anda untuk pengiriman rajutan kasih sayang kami.</p>
            </header>

            @if(!auth()->user()->address || !auth()->user()->phone)
                <div class="mb-10 p-6 bg-yellow-50 border border-yellow-100 rounded-3xl flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full bg-yellow-500 text-white flex items-center justify-center shrink-0">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <p class="font-bold text-yellow-800 text-sm mb-1">Profil Belum Lengkap</p>
                        <p class="text-xs text-yellow-700 leading-relaxed mb-3">Anda belum melengkapi alamat pengiriman utama di profil Anda.</p>
                        <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-yellow-800 underline decoration-yellow-500/50 decoration-2 underline-offset-4">Lengkapi Profil Sekarang →</a>
                    </div>
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-10">
                @csrf
                <input type="hidden" name="shipping_cost" x-model="shippingCost">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Penerima</label>
                        <input type="text" name="customer_name" class="input-premium" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Email Konfirmasi</label>
                        <input type="email" name="customer_email" class="input-premium" value="{{ auth()->user()->email }}" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nomor WhatsApp</label>
                        <input type="text" name="customer_phone" class="input-premium" value="{{ auth()->user()->phone }}" placeholder="08123456789" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Lengkap (Jalan, No. Rumah, RT/RW)</label>
                        <textarea name="customer_address" rows="4" class="input-premium py-4" required>{{ auth()->user()->address }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Provinsi</label>
                        <select name="province_id" class="input-premium appearance-none" @change="loadCities($event.target.value)" required>
                            <option value="">Pilih Provinsi...</option>
                            <template x-for="province in provinces" :key="province.province_id">
                                <option :value="province.province_id" x-text="province.province"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kota / Kabupaten</label>
                        <select name="city_id" class="input-premium appearance-none" @change="calculateShipping()" x-model="selectedCity" required>
                            <option value="">Pilih Kota...</option>
                            <template x-for="city in cities" :key="city.city_id">
                                <option :value="city.city_id" x-text="city.type + ' ' + city.city_name"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Ekspedisi</label>
                        <select name="courier" class="input-premium appearance-none" @change="calculateShipping()" x-model="selectedCourier" required>
                            <option value="jne">JNE (Reguler)</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS Indonesia</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kode Pos</label>
                        <input type="text" name="postal_code" class="input-premium" value="{{ auth()->user()->postal_code }}" placeholder="40123" required>
                    </div>
                </div>

                <div class="pt-10 flex flex-col items-center border-t border-gray-50">
                    <button type="submit" class="w-full btn-premium py-6 text-xl shadow-2xl shadow-soft-rose/30" :disabled="loading">
                        <span x-show="!loading">Buat Pesanan Sekarang <i class="fas fa-arrow-right ml-2 text-sm"></i></span>
                        <span x-show="loading"><i class="fas fa-circle-notch fa-spin mr-2"></i> Memproses...</span>
                    </button>
                    <p class="mt-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] flex items-center">
                        <i class="fas fa-lock mr-2 text-green-500"></i> Pembayaran Aman oleh Midtrans
                    </p>
                </div>
            </form>

            <script>
                function checkoutHandler() {
                    return {
                        provinces: [],
                        cities: [],
                        selectedCity: '',
                        selectedCourier: 'jne',
                        shippingCost: 0,
                        loading: false,
                        subtotal: {{ $total }},

                        init() {
                            this.loadProvinces();
                        },

                        async loadProvinces() {
                            const res = await fetch('{{ route("shipping.provinces") }}');
                            this.provinces = await res.json();
                        },

                        async loadCities(provinceId) {
                            if (!provinceId) return;
                            const res = await fetch(`/shipping/cities/${provinceId}`);
                            this.cities = await res.json();
                            this.selectedCity = '';
                            this.shippingCost = 0;
                        },

                        async calculateShipping() {
                            if (!this.selectedCity || !this.selectedCourier) return;
                            
                            this.loading = true;
                            try {
                                const res = await fetch('{{ route("shipping.cost") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        city_id: this.selectedCity,
                                        courier: this.selectedCourier
                                    })
                                });
                                const data = await res.json();
                                // Assuming take the first service cost
                                if (data.length > 0 && data[0].costs.length > 0) {
                                    this.shippingCost = data[0].costs[0].cost[0].value;
                                }
                            } catch (e) {
                                console.error(e);
                            } finally {
                                this.loading = false;
                            }
                        }
                    }
                }
            </script>
        </div>
    </div>
</div>
@endsection
