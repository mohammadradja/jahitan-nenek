@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Pengaturan Sistem')

@section('dashboard_content')
<div class="max-w-4xl">
    <form action="{{ route('superadmin.settings.update') }}" method="POST" class="space-y-8">
        @csrf
        <!-- Midtrans Section -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="p-12">
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                        <i class="fas fa-credit-card text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-dark-wool">Konfigurasi Gateway Pembayaran</h3>
                        <p class="text-sm text-gray-400">Kelola API key Midtrans untuk transaksi pelanggan.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Merchant ID</label>
                        <input type="text" name="midtrans_merchant_id" class="input-premium" value="{{ $settings['midtrans_merchant_id'] ?? '' }}" placeholder="G-xxxx">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Environment Mode</label>
                        <select name="midtrans_is_production" class="input-premium appearance-none">
                            <option value="0" {{ ($settings['midtrans_is_production'] ?? '') == '0' ? 'selected' : '' }}>Sandbox (Testing)</option>
                            <option value="1" {{ ($settings['midtrans_is_production'] ?? '') == '1' ? 'selected' : '' }}>Production (Live)</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Client Key</label>
                        <input type="text" name="midtrans_client_key" class="input-premium font-mono text-sm" value="{{ $settings['midtrans_client_key'] ?? '' }}">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Server Key</label>
                        <input type="password" name="midtrans_server_key" class="input-premium font-mono text-sm" value="{{ $settings['midtrans_server_key'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- RajaOngkir Section -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="p-12">
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500">
                        <i class="fas fa-truck text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-dark-wool">Integrasi Logistik (RajaOngkir)</h3>
                        <p class="text-sm text-gray-400">Konfigurasi API untuk kalkulasi ongkir real-time.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">RajaOngkir API Key</label>
                        <input type="password" name="rajaongkir_api_key" class="input-premium font-mono text-sm" value="{{ $settings['rajaongkir_api_key'] ?? '' }}">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">ID Kota Asal (Origin)</label>
                        <input type="text" name="rajaongkir_origin_city" class="input-premium" value="{{ $settings['rajaongkir_origin_city'] ?? '152' }}" placeholder="Contoh: 152 (Jakarta Barat)">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Tipe Akun</label>
                        <select name="rajaongkir_account_type" class="input-premium appearance-none">
                            <option value="starter" {{ ($settings['rajaongkir_account_type'] ?? '') == 'starter' ? 'selected' : '' }}>Starter</option>
                            <option value="basic" {{ ($settings['rajaongkir_account_type'] ?? '') == 'basic' ? 'selected' : '' }}>Basic</option>
                            <option value="pro" {{ ($settings['rajaongkir_account_type'] ?? '') == 'pro' ? 'selected' : '' }}>Pro</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- WhatsApp Section -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="p-12">
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-500">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-dark-wool">Notifikasi WhatsApp (Fonnte)</h3>
                        <p class="text-sm text-gray-400">Otomatis kirim pesan saat status pesanan berubah.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Fonnte API Token</label>
                        <input type="password" name="whatsapp_api_token" class="input-premium font-mono text-sm" value="{{ $settings['whatsapp_api_token'] ?? '' }}">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Status Layanan</label>
                        <select name="whatsapp_enabled" class="input-premium appearance-none">
                            <option value="0" {{ ($settings['whatsapp_enabled'] ?? '') == '0' ? 'selected' : '' }}>Nonaktif</option>
                            <option value="1" {{ ($settings['whatsapp_enabled'] ?? '') == '1' ? 'selected' : '' }}>Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                    Data konfigurasi disimpan dengan standar keamanan tinggi.
                </p>
                <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                    Simpan Semua Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
