@extends('layouts.app')

@section('title', 'Status Pesanan | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream/30 min-h-screen py-32" x-data="paymentHandler()">
    <div class="max-w-4xl mx-auto px-6 lg:px-20" data-aos="fade-up">
        <!-- Header -->
        <div class="text-center mb-16">
            <nav class="mb-8">
                <ol class="flex items-center justify-center space-x-4 text-[10px] font-bold uppercase tracking-[0.3em] text-soft-rose">
                    <li>Lacak</li>
                    <li><span class="w-1.5 h-1.5 rounded-full bg-soft-rose/30"></span></li>
                    <li class="text-dark-wool">Status Pesanan</li>
                </ol>
            </nav>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-dark-wool">Detail Pesanan <span class="italic text-soft-rose">#{{ $order->invoice_number }}</span></h2>
            <div class="flex flex-col items-center justify-center space-y-2 mt-4">
                <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-0">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                <div class="inline-flex items-center space-x-2 bg-vintage-cream px-4 py-1.5 rounded-full text-[10px] text-dark-wool/80 font-bold uppercase tracking-wider border border-gray-200 shadow-sm">
                    <span>ID PESANAN:</span>
                    <span class="text-white font-serif text-xs bg-soft-rose px-2.5 py-0.5 rounded shadow-sm font-black">{{ $order->id }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-12">
            <!-- Order Status & Progress -->
            <div class="bg-white rounded-[4rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-50">
                <div class="p-12 lg:p-20">
                    <!-- Progress Tracker -->
                    <div class="relative flex justify-between items-center mb-24 before:absolute before:inset-x-0 before:top-1/2 before:-translate-y-1/2 before:h-1 before:bg-gray-100">
                        @php
                            $statuses = ['pending', 'processing', 'shipped', 'completed'];
                            $currentStatusIndex = array_search($order->status, $statuses);
                        @endphp
                        @foreach($statuses as $index => $status)
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-700 {{ $index <= $currentStatusIndex ? 'bg-soft-rose text-white' : 'bg-white text-gray-200 border border-gray-100' }}">
                                    @if($status == 'pending') <i class="fas fa-wallet text-sm"></i> @endif
                                    @if($status == 'processing') <i class="fas fa-magic text-sm"></i> @endif
                                    @if($status == 'shipped') <i class="fas fa-truck text-sm"></i> @endif
                                    @if($status == 'completed') <i class="fas fa-check-double text-sm"></i> @endif
                                </div>
                                <span class="absolute -bottom-10 whitespace-nowrap text-[9px] font-bold uppercase tracking-widest {{ $index <= $currentStatusIndex ? 'text-dark-wool' : 'text-gray-300' }}">
                                    {{ $status == 'pending' ? 'Menunggu' : ($status == 'processing' ? 'Diproses' : ($status == 'shipped' ? 'Dikirim' : 'Selesai')) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Production Timeline Section -->
                    @if($order->productionStages->count() > 0)
                        <div class="mb-20">
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-10 flex items-center">
                                <i class="fas fa-history mr-3 text-soft-rose"></i> Progress Pengerjaan Handmade
                            </h4>
                            <div class="space-y-8 relative before:absolute before:left-5 before:top-0 before:h-full before:w-0.5 before:bg-gray-50">
                                @foreach($order->productionStages as $stage)
                                    <div class="relative pl-12">
                                        <div class="absolute left-3 top-1 w-4 h-4 rounded-full border-2 border-white {{ $loop->first ? 'bg-soft-rose animate-pulse' : 'bg-gray-200' }} shadow-sm"></div>
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                            <h5 class="text-sm font-bold text-dark-wool">{{ $stage->stage }}</h5>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $stage->started_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">{{ $stage->notes ?? 'Bagian dari proses perajutan kasih sayang.' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tracking Info -->
                    @if($order->tracking_number)
                        <div class="bg-dark-wool rounded-[2.5rem] p-10 text-white mb-20 relative overflow-hidden">
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div>
                                    <p class="text-[10px] text-white/40 font-bold uppercase tracking-widest mb-2">Nomor Resi Pengiriman ({{ strtoupper($order->courier) }})</p>
                                    <h3 class="text-2xl font-mono font-bold text-soft-rose">{{ $order->tracking_number }}</h3>
                                </div>
                                <a href="https://check-resi.com" target="_blank" class="btn-primary bg-white text-dark-wool hover:bg-soft-rose hover:text-white border-none whitespace-nowrap">Cek Keberangkatan</a>
                            </div>
                            <i class="fas fa-box-open absolute -right-10 -bottom-10 text-9xl text-white/5"></i>
                        </div>
                    @endif

                    <!-- Order Details Summary -->
                    <div class="bg-vintage-cream/30 rounded-[3rem] p-10 border border-gray-50">
                        <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-8">Informasi Pesanan</h4>
                        <div class="space-y-8">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-6">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden border border-white shadow-sm">
                                            <img src="{{ $item->product?->imageUrl('https://via.placeholder.com/100') ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-dark-wool">{{ $item->product_name }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $item->quantity }} x Rp{{ number_format($item->product_price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-dark-wool">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-10 pt-8 border-t border-gray-100 space-y-4">
                            <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                                <span class="text-gray-400">Ongkos Kirim</span>
                                <span class="text-dark-wool">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <span class="text-sm font-bold text-dark-wool uppercase tracking-widest">Total Akhir</span>
                                <span class="text-2xl font-serif font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($order->payment_proof)
                        <!-- Bukti Pembayaran -->
                        <div class="mt-8 bg-white rounded-[3rem] p-10 border border-gray-50">
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-6 flex items-center">
                                <i class="fas fa-receipt mr-3 text-soft-rose"></i> Bukti Pembayaran Anda
                            </h4>
                            <div class="relative rounded-2xl overflow-hidden border border-gray-100 shadow-inner group max-w-xs bg-gray-50 p-2 mx-auto">
                                <img src="{{ asset($order->payment_proof) }}" class="w-full h-auto max-h-60 object-contain rounded-xl hover:scale-105 transition-transform duration-300" alt="Bukti Pembayaran">
                            </div>
                            <div class="mt-6 text-center">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center justify-center">
                                    <i class="fas fa-clock mr-2 text-yellow-500"></i> Status Verifikasi: 
                                    <span class="ml-2 px-3 py-1 rounded-full text-[10px] {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $order->payment_status === 'paid' ? 'Disetujui' : 'Menunggu Verifikasi Admin' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Form Upload Bukti Pembayaran untuk Pesanan Unpaid -->
                        <div class="mt-8 bg-white rounded-[3rem] p-10 border border-gray-100 shadow-lg">
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-4 flex items-center">
                                <i class="fas fa-university mr-2 text-soft-rose"></i> Instruksi Pembayaran Transfer Bank
                            </h4>
                            <p class="text-xs text-gray-400 leading-relaxed mb-6">
                                Silakan transfer total tagihan Anda sebesar <span class="font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span> ke salah satu rekening bank tujuan berikut, lalu unggah bukti transfer Anda untuk verifikasi.
                            </p>
                            
                            <!-- Bank Accounts -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                @php
                                    $bankInfo = \App\Models\SiteSetting::get('bank_transfer_info', "BCA: 123-456-7890 a/n Jahitan Nenek\nMandiri: 987-654-3210 a/n Jahitan Nenek");
                                @endphp
                                @foreach(explode("\n", $bankInfo) as $bank)
                                    @if(trim($bank) !== '')
                                        @php
                                            $parts = explode(':', $bank, 2);
                                            $bankName = trim($parts[0] ?? 'BANK');
                                            $bankDetails = trim($parts[1] ?? $bank);
                                            preg_match('/[0-9\-]+/', $bankDetails, $matches);
                                            $accNumber = $matches[0] ?? '';
                                        @endphp
                                        <div class="bg-gray-50/50 p-4 rounded-2xl border border-gray-100 flex justify-between items-center text-left">
                                            <div>
                                                <span class="text-[9px] font-bold bg-soft-rose/10 text-soft-rose px-2.5 py-0.5 rounded-full uppercase tracking-wider">{{ $bankName }}</span>
                                                <p class="text-xs font-bold text-dark-wool mt-1.5 font-mono">{{ $bankDetails }}</p>
                                            </div>
                                            @if($accNumber)
                                                <button @click="copyText('{{ $accNumber }}', 'Nomor rekening {{ $bankName }} berhasil disalin!')" 
                                                        class="w-8 h-8 rounded-lg bg-white text-gray-400 hover:text-soft-rose border border-gray-100 flex items-center justify-center transition-all shadow-sm active:scale-95">
                                                    <i class="far fa-copy text-xs"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Upload Form -->
                            <h4 class="text-xs font-bold text-dark-wool uppercase tracking-widest mb-4 flex items-center">
                                <i class="fas fa-camera mr-2 text-soft-rose"></i> Unggah Bukti Transaksi
                            </h4>
                            <form action="{{ route('checkout.upload-payment-proof', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-left">
                                @csrf
                                <div class="relative border-2 border-dashed border-gray-200 rounded-[2rem] p-6 text-center hover:border-soft-rose/40 transition-colors cursor-pointer"
                                     :class="imagePreview ? 'border-soft-rose/30 bg-soft-rose/5' : 'bg-gray-50/50'">
                                    <input type="file" name="payment_proof" id="payment_proof" @change="previewImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".png,.jpg,.jpeg,.webp,.gif,.avif,image/png,image/jpeg,image/webp,image/gif,image/avif" required>
                                    
                                    <div x-show="!imagePreview" class="space-y-3">
                                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mx-auto text-gray-400 shadow-sm">
                                            <i class="fas fa-cloud-upload-alt text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-dark-wool">Pilih foto atau seret bukti transfer ke sini</p>
                                            <p class="text-[9px] text-gray-400 mt-1">PNG, JPG, JPEG, WEBP, GIF, atau AVIF. Maksimal 5 MB.</p>
                                        </div>
                                    </div>

                                    <div x-show="imagePreview" x-cloak class="space-y-3 relative z-20">
                                        <div class="relative max-w-xs mx-auto rounded-xl overflow-hidden border border-gray-100 shadow-md">
                                            <img :src="imagePreview" class="w-full object-cover max-h-40" alt="Preview Bukti">
                                            <button type="button" @click.prevent="clearImage" class="absolute top-1.5 right-1.5 w-6 h-6 rounded-full bg-dark-wool/70 text-white flex items-center justify-center hover:bg-red-500 transition-colors text-[10px]">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <p class="text-[10px] font-bold text-soft-rose flex items-center justify-center gap-2">
                                            <i class="fas fa-check-circle"></i> Foto Bukti Siap Diunggah
                                        </p>
                                    </div>
                                </div>

                                <button type="submit" class="btn-premium w-full py-3.5 text-xs tracking-wider shadow-lg shadow-soft-rose/15">
                                    Kirim Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-20 text-center">
                        <a href="{{ route('order.track') }}" class="btn-secondary">Lacak Pesanan Lain</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function paymentHandler() {
        return {
            imagePreview: null,
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                }
            },
            clearImage() {
                this.imagePreview = null;
                document.getElementById('payment_proof').value = '';
            },
            copyText(text, message) {
                navigator.clipboard.writeText(text).then(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: message, type: 'success' }
                    }));
                });
            }
        }
    }
</script>
@endsection
