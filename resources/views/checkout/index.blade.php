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
                            <span x-text="'Rp' + new Intl.NumberFormat('id-ID').format(shippingCost)"></span>
                        </div>
                        <div class="flex justify-between items-end pt-4 border-t border-gray-50 mt-4">
                            <span class="text-lg font-serif font-bold text-dark-wool">Total Akhir</span>
                            <span class="text-3xl font-serif font-bold text-soft-rose" x-text="'Rp' + new Intl.NumberFormat('id-ID').format(subtotal + parseInt(shippingCost))"></span>
                        </div>
                    </div>
                </div>

                <div class="bg-soft-rose/5 border border-soft-rose/20 rounded-[2rem] p-8">
                    <p class="text-xs font-bold text-soft-rose uppercase tracking-[0.2em] mb-4 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i> Transfer Bank Manual
                    </p>
                    <p class="text-xs text-gray-500 leading-relaxed">Lakukan pembayaran via transfer ke rekening bank resmi Jahitan Nenek. Unggah bukti pembayaran setelah pesanan dibuat untuk verifikasi cepat oleh admin.</p>
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
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Pengiriman Lengkap</label>
                        <textarea name="customer_address" rows="4" class="input-premium py-4" placeholder="Jalan, RT/RW, Kecamatan, Kota, Provinsi" required>{{ auth()->user()->address }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Pilihan Kurir & Layanan</label>
                        <select name="courier" class="input-premium appearance-none" x-model="selectedCourier" required>
                            <option value="jne">JNE Standard (Rp 15.000)</option>
                            <option value="tiki">TIKI Reguler (Rp 14.000)</option>
                            <option value="pos">POS Indonesia (Rp 12.000)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-10 flex flex-col items-center border-t border-gray-50">
                    <button type="submit" class="w-full btn-premium py-6 text-xl shadow-2xl shadow-soft-rose/30">
                        <span>Buat Pesanan Sekarang <i class="fas fa-arrow-right ml-2 text-sm"></i></span>
                    </button>
                    <p class="mt-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] flex items-center">
                        <i class="fas fa-lock mr-2 text-green-500"></i> Pembayaran Transfer Bank Manual
                    </p>
                </div>
            </form>

            <script>
                function checkoutHandler() {
                    return {
                        selectedCourier: 'jne',
                        shippingCost: 15000,
                        subtotal: {{ $total }},

                        init() {
                            this.$watch('selectedCourier', value => {
                                if (value === 'jne') {
                                    this.shippingCost = 15000;
                                } else if (value === 'tiki') {
                                    this.shippingCost = 14000;
                                } else if (value === 'pos') {
                                    this.shippingCost = 12000;
                                }
                            });
                        }
                    }
                }
            </script>
        </div>
    </div>
</div>
@endsection
