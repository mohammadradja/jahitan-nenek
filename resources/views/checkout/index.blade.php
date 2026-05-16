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
                    
                    <div class="space-y-6 mb-10 overflow-y-auto max-h-[400px] pr-2 custom-scrollbar">
                        @foreach($cart as $item)
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center shrink-0 overflow-hidden border border-gray-100">
                                    <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=100' }}" class="w-full h-full object-cover" alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h6 class="font-bold text-dark-wool truncate text-sm">{{ $item['name'] }}</h6>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $item['quantity'] }} x Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-dark-wool text-sm">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
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
                        <div class="flex justify-between items-end pt-4 border-t border-gray-50 mt-4">
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
                    
                    <!-- Provinces (Searchable Dropdown Alternative) -->
                    <div class="relative" x-data="{ open: false, search: '' }">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Provinsi</label>
                        <div @click="open = !open" class="input-premium flex justify-between items-center cursor-pointer min-h-[58px]">
                            <span x-text="selectedProvinceName || 'Pilih Provinsi...'" :class="selectedProvinceName ? 'text-dark-wool' : 'text-gray-300'"></span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </div>
                        <input type="hidden" name="province_id" x-model="selectedProvince">

                        <div x-show="open" @click.away="open = false" class="absolute z-50 w-full mt-2 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden animate__animated animate__fadeInUp animate__faster">
                            <div class="p-4 border-b border-gray-50">
                                <input type="text" x-model="search" placeholder="Cari provinsi..." class="w-full bg-gray-50 rounded-xl px-4 py-2 text-xs font-bold outline-none border border-transparent focus:border-soft-rose/30 transition-all">
                            </div>
                            <div class="max-h-60 overflow-y-auto custom-scrollbar">
                                <template x-for="province in filteredProvinces(search)" :key="province.province_id">
                                    <div @click="selectProvince(province); open = false" class="px-6 py-3 text-xs font-bold text-dark-wool hover:bg-soft-rose/5 hover:text-soft-rose cursor-pointer transition-colors" x-text="province.province"></div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Cities (Searchable Dropdown Alternative) -->
                    <div class="relative" x-data="{ open: false, search: '' }">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kota / Kabupaten</label>
                        <div @click="if(selectedProvince) open = !open" class="input-premium flex justify-between items-center cursor-pointer min-h-[58px]" :class="!selectedProvince ? 'opacity-50 cursor-not-allowed bg-gray-50' : ''">
                            <span x-text="selectedCityName || 'Pilih Kota...'" :class="selectedCityName ? 'text-dark-wool' : 'text-gray-300'"></span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </div>
                        <input type="hidden" name="city_id" x-model="selectedCity">

                        <div x-show="open && selectedProvince" @click.away="open = false" class="absolute z-50 w-full mt-2 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden animate__animated animate__fadeInUp animate__faster">
                            <div class="p-4 border-b border-gray-50">
                                <input type="text" x-model="search" placeholder="Cari kota..." class="w-full bg-gray-50 rounded-xl px-4 py-2 text-xs font-bold outline-none border border-transparent focus:border-soft-rose/30 transition-all">
                            </div>
                            <div class="max-h-60 overflow-y-auto custom-scrollbar">
                                <template x-for="city in filteredCities(search)" :key="city.city_id">
                                    <div @click="selectCity(city); open = false" class="px-6 py-3 text-xs font-bold text-dark-wool hover:bg-soft-rose/5 hover:text-soft-rose cursor-pointer transition-colors" x-text="city.type + ' ' + city.city_name"></div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Ekspedisi</label>
                        <select name="courier" class="input-premium appearance-none" x-model="selectedCourier" required>
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
                    <button type="submit" class="w-full btn-premium py-6 text-xl shadow-2xl shadow-soft-rose/30" :disabled="loading || !shippingCost">
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
                        selectedProvince: '',
                        selectedProvinceName: '',
                        selectedCity: '',
                        selectedCityName: '',
                        selectedCourier: 'jne',
                        shippingCost: 0,
                        loading: false,
                        subtotal: {{ $total }},

                        init() {
                            this.loadProvinces();
                            
                            // Instant shipping cost update when city or courier changes
                            this.$watch('selectedCity', () => this.calculateShipping());
                            this.$watch('selectedCourier', () => this.calculateShipping());
                        },

                        async loadProvinces() {
                            const res = await fetch('{{ route("shipping.provinces") }}');
                            this.provinces = await res.json();
                        },

                        async selectProvince(province) {
                            this.selectedProvince = province.province_id;
                            this.selectedProvinceName = province.province;
                            this.selectedCity = '';
                            this.selectedCityName = '';
                            this.shippingCost = 0;
                            this.loadCities(province.province_id);
                        },

                        async loadCities(provinceId) {
                            if (!provinceId) return;
                            const res = await fetch(`/shipping/cities/${provinceId}`);
                            this.cities = await res.json();
                        },

                        async selectCity(city) {
                            this.selectedCity = city.city_id;
                            this.selectedCityName = city.type + ' ' + city.city_name;
                        },

                        filteredProvinces(search) {
                            if (!search) return this.provinces;
                            return this.provinces.filter(p => p.province.toLowerCase().includes(search.toLowerCase()));
                        },

                        filteredCities(search) {
                            if (!search) return this.cities;
                            return this.cities.filter(c => c.city_name.toLowerCase().includes(search.toLowerCase()));
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
