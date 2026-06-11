@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32" x-data="paymentHandler()">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
        <div class="max-w-2xl mx-auto" data-aos="zoom-in">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-[10px]">Langkah Terakhir</span>
            <h2 class="text-4xl font-serif font-bold text-dark-wool mt-4 mb-6">Selesaikan Pembayaran</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-12">
                Pesanan <span class="text-dark-wool font-bold">#{{ $order->invoice_number }}</span> telah berhasil dibuat. Silakan transfer pembayaran dan unggah bukti transfer di bawah ini.
            </p>
            
            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-50 overflow-hidden text-left mb-8">
                <div class="p-10 lg:p-14">
                    <!-- Total Bill -->
                    <div class="text-center pb-8 border-b border-gray-100">
                        <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total yang Harus Ditransfer</h3>
                        <div class="text-4xl lg:text-5xl font-serif font-bold text-soft-rose flex items-center justify-center gap-2">
                            <span id="total-price-text">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            <button @click="copyText('{{ $order->total_price }}', 'Jumlah transfer berhasil disalin!')" 
                                    class="text-gray-300 hover:text-soft-rose transition-colors text-lg" title="Salin Jumlah">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Bank Account Info -->
                    <div class="py-8 border-b border-gray-100">
                        <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-4 flex items-center">
                            <i class="fas fa-university mr-2 text-soft-rose"></i> Rekening Bank Tujuan
                        </h4>
                        <div class="space-y-4">
                            @foreach(explode("\n", $bankTransferInfo) as $bank)
                                @if(trim($bank) !== '')
                                    @php
                                        // Parse bank format like "BCA: 123-456-7890 a/n Jahitan Nenek"
                                        $parts = explode(':', $bank, 2);
                                        $bankName = trim($parts[0] ?? 'BANK');
                                        $bankDetails = trim($parts[1] ?? $bank);
                                        
                                        // Extract account number for easy copy
                                        preg_match('/[0-9\-]+/', $bankDetails, $matches);
                                        $accNumber = $matches[0] ?? '';
                                    @endphp
                                    <div class="bg-vintage-cream/30 p-6 rounded-2xl border border-gray-100 flex justify-between items-center hover:border-soft-rose/25 transition-all">
                                        <div>
                                            <span class="text-xs font-bold bg-soft-rose/10 text-soft-rose px-3 py-1 rounded-full uppercase tracking-wider">{{ $bankName }}</span>
                                            <p class="text-base font-bold text-dark-wool mt-2 font-mono">{{ $bankDetails }}</p>
                                        </div>
                                        @if($accNumber)
                                            <button @click="copyText('{{ $accNumber }}', 'Nomor rekening {{ $bankName }} berhasil disalin!')" 
                                                    class="w-10 h-10 rounded-xl bg-white text-gray-400 hover:text-soft-rose hover:bg-soft-rose/5 border border-gray-100 flex items-center justify-center transition-all shadow-sm active:scale-95">
                                                <i class="far fa-copy"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Upload Proof Form -->
                    <div class="pt-8">
                        <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-4 flex items-center">
                            <i class="fas fa-camera mr-2 text-soft-rose"></i> Unggah Bukti Transaksi
                        </h4>

                        <form action="{{ route('checkout.upload-payment-proof', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- File Upload Area -->
                            <div class="relative border-2 border-dashed border-gray-200 rounded-[2rem] p-8 text-center hover:border-soft-rose/40 transition-colors cursor-pointer group"
                                 :class="imagePreview ? 'border-soft-rose/30 bg-soft-rose/5' : 'bg-gray-50/50'">
                                <input type="file" name="payment_proof" id="payment_proof" @change="previewImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".png,.jpg,.jpeg,.webp,.gif,.avif,image/png,image/jpeg,image/webp,image/gif,image/avif" required>
                                
                                <div x-show="!imagePreview" class="space-y-4">
                                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto text-gray-400 shadow-sm group-hover:scale-105 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-dark-wool">Pilih foto atau seret bukti transfer ke sini</p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG, WEBP, GIF, atau AVIF. Maksimal 5 MB.</p>
                                    </div>
                                </div>

                                <div x-show="imagePreview" x-cloak class="space-y-4 relative z-20">
                                    <div class="relative max-w-xs mx-auto rounded-2xl overflow-hidden border border-gray-100 shadow-md">
                                        <img :src="imagePreview" class="w-full object-cover max-h-60" alt="Preview Bukti">
                                        <button type="button" @click.prevent="clearImage" class="absolute top-2 right-2 w-8 h-8 rounded-full bg-dark-wool/70 text-white flex items-center justify-center hover:bg-red-500 transition-colors text-xs">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <p class="text-xs font-bold text-soft-rose flex items-center justify-center gap-2">
                                        <i class="fas fa-check-circle"></i> Foto Bukti Siap Diunggah
                                    </p>
                                </div>
                            </div>

                            <button type="submit" class="btn-premium w-full py-6 text-xl shadow-2xl shadow-soft-rose/20 flex items-center justify-center gap-3">
                                <span>Konfirmasi & Kirim Bukti <i class="fas fa-paper-plane text-sm ml-2"></i></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center justify-center">
                <i class="fas fa-shield-alt mr-2 text-green-500"></i> Verifikasi Manual Aman oleh Admin Jahitan Nenek
            </p>
        </div>
    </div>
</div>

<script>
    function paymentHandler() {
        return {
            imagePreview: null,
            previewImage(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            clearImage() {
                this.imagePreview = null;
                document.getElementById('payment_proof').value = '';
            },
            copyText(text, successMsg) {
                navigator.clipboard.writeText(text).then(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: successMsg, type: 'success' }
                    }));
                }).catch(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'Gagal menyalin teks.', type: 'error' }
                    }));
                });
            }
        }
    }
</script>
@endsection
