@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Promo & Pemberitahuan')

@section('dashboard_content')
@php
    $promoOriginalDisplay = ($settings['promo_original_price'] ?? false)
        ? 'Rp ' . number_format((int) $settings['promo_original_price'], 0, ',', '.')
        : '';
    $promoRealDisplay = ($settings['promo_real_price'] ?? false)
        ? 'Rp ' . number_format((int) $settings['promo_real_price'], 0, ',', '.')
        : '';
@endphp

<div class="max-w-5xl space-y-8 pb-20" x-data="promoHandler()">
    <form action="{{ route(auth()->user()->role . '.promo.update') }}" method="POST" class="space-y-8" @submit="syncPromoCurrency()">
        @csrf

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-10 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose shadow-inner">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Banner Promo Storefront</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Kontrol promo yang tampil di area produk</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan Promo</button>
            </div>

            <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Status Promo</label>
                    <select name="promo_enabled" class="input-premium py-3 text-sm appearance-none">
                        <option value="0" {{ ($settings['promo_enabled'] ?? '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="1" {{ ($settings['promo_enabled'] ?? '0') == '1' ? 'selected' : '' }}>Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Label Promo</label>
                    <input type="text" name="promo_label" class="input-premium py-3 text-sm" value="{{ $settings['promo_label'] ?? 'Promo Spesial' }}" placeholder="Contoh: Promo Spesial">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Estimasi Harga Awal</label>
                    <input type="hidden" name="promo_original_price" x-ref="promoOriginalPrice" value="{{ $settings['promo_original_price'] ?? '' }}">
                    <input type="text" inputmode="numeric" class="input-premium py-3 text-sm" x-model="promoOriginalDisplay" @input="promoOriginalDisplay = formatRupiah(promoOriginalDisplay)" placeholder="Rp 150.000">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Estimasi Harga Promo</label>
                    <input type="hidden" name="promo_real_price" x-ref="promoRealPrice" value="{{ $settings['promo_real_price'] ?? '' }}">
                    <input type="text" inputmode="numeric" class="input-premium py-3 text-sm" x-model="promoRealDisplay" @input="promoRealDisplay = formatRupiah(promoRealDisplay)" placeholder="Rp 100.000">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi Singkat</label>
                    <input type="text" name="promo_description" class="input-premium py-3 text-sm" value="{{ $settings['promo_description'] ?? 'Harga spesial untuk koleksi pilihan Jahitan Nenek.' }}" placeholder="Contoh: Harga spesial untuk koleksi pilihan.">
                </div>
                <div class="md:col-span-2 rounded-[2rem] bg-dark-wool text-white p-6">
                    <p class="text-[10px] font-bold text-soft-rose uppercase tracking-widest mb-2">{{ $settings['promo_label'] ?? 'Promo Spesial' }}</p>
                    <p class="text-xl font-serif font-bold mb-4">{{ $settings['promo_description'] ?? 'Harga spesial untuk koleksi pilihan Jahitan Nenek.' }}</p>
                    <div class="flex flex-wrap items-end gap-4">
                        @if($settings['promo_original_price'] ?? false)
                            <span class="text-lg font-bold text-white/40 line-through">Rp{{ number_format((int) $settings['promo_original_price'], 0, ',', '.') }}</span>
                        @endif
                        @if($settings['promo_real_price'] ?? false)
                            <span class="text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format((int) $settings['promo_real_price'], 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-10 border-b border-gray-100 flex items-center space-x-4">
                <div class="w-12 h-12 bg-vintage-cream rounded-2xl flex items-center justify-center text-soft-rose shadow-inner">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Popup Awal</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Modal yang muncul saat pelanggan membuka storefront</p>
                </div>
            </div>

            <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Status Popup Promo</label>
                    <select name="promo_popup_enabled" class="input-premium py-3 text-sm appearance-none">
                        <option value="0" {{ ($settings['promo_popup_enabled'] ?? '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="1" {{ ($settings['promo_popup_enabled'] ?? '0') == '1' ? 'selected' : '' }}>Aktif Saat Promo Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Teks Tombol</label>
                    <input type="text" name="promo_popup_cta_label" class="input-premium py-3 text-sm" value="{{ $settings['promo_popup_cta_label'] ?? 'Lihat Koleksi' }}" placeholder="Lihat Koleksi">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul Popup Promo</label>
                    <input type="text" name="promo_popup_title" class="input-premium py-3 text-sm" value="{{ $settings['promo_popup_title'] ?? 'Promo Spesial Jahitan Nenek' }}" placeholder="Promo Spesial Jahitan Nenek">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">URL Tombol</label>
                    <input type="text" name="promo_popup_cta_url" class="input-premium py-3 text-sm" value="{{ $settings['promo_popup_cta_url'] ?? route('home') . '#produk' }}" placeholder="{{ route('home') }}#produk">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Pesan Popup Promo</label>
                    <textarea name="promo_popup_message" rows="4" class="input-premium py-3 text-sm">{{ $settings['promo_popup_message'] ?? 'Ada harga spesial untuk koleksi pilihan. Cek produk terbaru sebelum promonya selesai.' }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-10 border-b border-gray-100 flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 shadow-inner">
                    <i class="fas fa-circle-info"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Pemberitahuan Storefront</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Pengumuman singkat yang ikut tampil di popup awal</p>
                </div>
            </div>

            <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Status Pemberitahuan</label>
                    <select name="notification_enabled" class="input-premium py-3 text-sm appearance-none">
                        <option value="0" {{ ($settings['notification_enabled'] ?? '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="1" {{ ($settings['notification_enabled'] ?? '0') == '1' ? 'selected' : '' }}>Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Judul Pemberitahuan</label>
                    <input type="text" name="notification_title" class="input-premium py-3 text-sm" value="{{ $settings['notification_title'] ?? '' }}" placeholder="Contoh: Info Pengiriman">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Isi Pemberitahuan</label>
                    <textarea name="notification_message" rows="4" class="input-premium py-3 text-sm" placeholder="Tulis pemberitahuan singkat untuk pelanggan...">{{ $settings['notification_message'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function promoHandler() {
        return {
            promoOriginalDisplay: @json($promoOriginalDisplay),
            promoRealDisplay: @json($promoRealDisplay),
            formatRupiah(value) {
                const digits = String(value ?? '').replace(/[^0-9]/g, '');

                if (!digits) {
                    return '';
                }

                return 'Rp ' + new Intl.NumberFormat('id-ID').format(Number(digits));
            },
            parseRupiah(value) {
                return String(value ?? '').replace(/[^0-9]/g, '');
            },
            syncPromoCurrency() {
                this.$refs.promoOriginalPrice.value = this.parseRupiah(this.promoOriginalDisplay);
                this.$refs.promoRealPrice.value = this.parseRupiah(this.promoRealDisplay);
            },
        }
    }
</script>
@endsection
