@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
        <div class="max-w-xl mx-auto" data-aos="zoom-in">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-[10px]">Langkah Terakhir</span>
            <h2 class="text-4xl font-serif font-bold text-dark-wool mt-4 mb-6">Selesaikan Pembayaran</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-12">
                Pesanan <span class="text-dark-wool font-bold">#{{ $order->id }}</span> telah berhasil dibuat. Silakan selesaikan pembayaran untuk mulai proses perajutan.
            </p>
            
            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-50 overflow-hidden">
                <div class="p-12 lg:p-16">
                    <div class="w-20 h-20 bg-soft-rose/10 text-soft-rose rounded-2xl flex items-center justify-center mx-auto mb-8 text-3xl">
                        <i class="fas fa-wallet"></i>
                    </div>
                    
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total yang Harus Dibayar</h3>
                    <div class="text-5xl font-serif font-bold text-dark-wool mb-12">
                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                    </div>

                    <button id="pay-button" class="btn-premium w-full py-6 text-xl shadow-2xl shadow-soft-rose/20">
                        Bayar Sekarang <i class="fas fa-arrow-right ml-3 text-sm"></i>
                    </button>

                    <div class="mt-10 flex items-center justify-center space-x-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Old_Visa_Logo.svg/2560px-Old_Visa_Logo.svg.png" class="h-4 opacity-30 grayscale" alt="Visa">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-6 opacity-30 grayscale" alt="Mastercard">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Central_Asia.svg/1280px-Bank_Central_Asia.svg.png" class="h-4 opacity-30 grayscale" alt="BCA">
                    </div>
                </div>
            </div>

            <p class="mt-12 text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center justify-center">
                <i class="fas fa-lock mr-2 text-green-500"></i> Pembayaran Aman & Terenkripsi oleh Midtrans
            </p>
        </div>
    </div>
</div>

@push('scripts')
@php
    $isProduction = \App\Models\SiteSetting::get('midtrans_is_production', false);
    $clientKey = \App\Models\SiteSetting::get('midtrans_client_key', config('midtrans.client_key'));
    $snapUrl = $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp
<script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                window.location.href = "{{ route('checkout.success', $order->id) }}";
            },
            onPending: function (result) {
                window.location.href = "{{ route('checkout.success', $order->id) }}";
            },
            onError: function (result) {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: { message: 'Pembayaran gagal! Silakan coba lagi.', type: 'error' }
                }));
            },
            onClose: function () {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: { message: 'Anda menutup jendela pembayaran sebelum selesai.', type: 'error' }
                }));
            }
        });
    });
</script>
@endpush
@endsection
