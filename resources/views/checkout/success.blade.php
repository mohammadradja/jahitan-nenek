@extends('layouts.app')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32">
    <div class="max-w-4xl mx-auto px-6" data-aos="zoom-in">
        <div class="bg-white rounded-[4rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-50">
            <!-- Success Header -->
            <div class="bg-dark-wool p-16 text-center relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-soft-rose/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-soft-rose/5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-soft-rose text-white rounded-[2rem] flex items-center justify-center mx-auto mb-10 text-4xl shadow-2xl shadow-soft-rose/30 animate__animated animate__bounceIn">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">Terima Kasih Atas Kepercayaannya</h2>
                    <p class="text-white/60 text-sm font-bold uppercase tracking-[0.3em]">Pesanan #{{ $order->invoice_number }} Berhasil Dibuat</p>
                </div>
            </div>

            <!-- Order Details Card -->
            <div class="p-12 lg:p-20">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                    <!-- Customer Info -->
                    <div>
                        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">Detail Pengiriman</h4>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-1">Nama Penerima</p>
                                <p class="text-dark-wool font-bold">{{ $order->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-1">Alamat Tujuan</p>
                                <p class="text-dark-wool font-medium text-sm leading-relaxed">{{ $order->customer_address }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-1">Nomor Kontak</p>
                                <p class="text-dark-wool font-bold">{{ $order->customer_phone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Info -->
                    <div>
                        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">Ringkasan Pembayaran</h4>
                        <div class="space-y-4 bg-vintage-cream/30 p-8 rounded-[2rem] border border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Total Bayar</span>
                                <span class="text-xl font-serif font-bold text-dark-wool">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Status</span>
                                <span class="px-4 py-1.5 rounded-full bg-soft-rose/10 text-soft-rose text-[9px] font-bold uppercase tracking-widest">
                                    {{ $order->payment_status === 'paid' ? 'Lunas' : ($order->payment_status === 'pending_manual_approval' ? 'Menunggu Persetujuan' : 'Pending') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100 mt-4">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Metode</span>
                                <span class="text-dark-wool font-bold text-[10px] uppercase tracking-widest">Online Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="mt-20 pt-12 border-t border-gray-50 text-center">
                    <p class="text-gray-400 text-sm mb-10 max-w-lg mx-auto leading-relaxed">
                        Nenek akan segera mulai merajut pesanan Anda. Anda dapat memantau status pengerjaan melalui halaman lacak pesanan.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ route('checkout.track') }}?order_id={{ $order->id }}&email={{ $order->customer_email }}" class="btn-premium">
                            <i class="fas fa-search-location mr-2 text-xs"></i> Lacak Pesanan
                        </a>
                        <a href="{{ route('home') }}" class="btn-secondary">
                            Kembali Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Next Steps -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-50 shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-2">Konfirmasi Email</h5>
                <p class="text-[10px] text-gray-400 leading-relaxed">Rincian pesanan telah kami kirimkan ke email Anda.</p>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-50 shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h5 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-2">Update WhatsApp</h5>
                <p class="text-[10px] text-gray-400 leading-relaxed">Dapatkan notifikasi status pengiriman langsung ke HP Anda.</p>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-50 shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-2xl bg-soft-rose/10 text-soft-rose flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-heart"></i>
                </div>
                <h5 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-2">Handcrafted Love</h5>
                <p class="text-[10px] text-gray-400 leading-relaxed">Setiap rajutan dibuat dengan penuh ketelitian dan cinta.</p>
            </div>
        </div>
    </div>
</div>
@endsection
