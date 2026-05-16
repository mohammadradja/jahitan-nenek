@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Konfigurasi Sistem')

@section('dashboard_content')
<div class="max-w-5xl space-y-12 pb-20" x-data="settingsHandler()">
    <!-- General Settings -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="general">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 shadow-inner">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Pengaturan Umum</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Identitas Situs & Mode Transaksi</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan Perubahan</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Situs</label>
                    <input type="text" name="site_name" class="input-premium py-3 text-sm" value="{{ $settings['site_name'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tagline</label>
                    <input type="text" name="site_tagline" class="input-premium py-3 text-sm" value="{{ $settings['site_tagline'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Mode Transaksi</label>
                    <select name="transaction_mode" class="input-premium py-3 text-sm appearance-none">
                        <option value="dev" {{ ($settings['transaction_mode'] ?? '') == 'dev' ? 'selected' : '' }}>Development (Bypass Pembayaran)</option>
                        <option value="prod" {{ ($settings['transaction_mode'] ?? '') == 'prod' ? 'selected' : '' }}>Production (Pembayaran Riil)</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Payment Gateway (Midtrans) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="payment">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose shadow-inner">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Midtrans Gateway</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Konfigurasi Snap & Pembayaran Online</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" @click="testConnection('midtrans')" class="btn-secondary btn-sm" :disabled="testing === 'midtrans'">
                        <i class="fas fa-vial mr-2" x-show="testing !== 'midtrans'"></i>
                        <i class="fas fa-circle-notch fa-spin mr-2" x-show="testing === 'midtrans'"></i>
                        Uji Koneksi
                    </button>
                    <button type="submit" class="btn-primary btn-sm">Simpan</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div x-data="{ show: false }" class="relative">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Server Key</label>
                    <input :type="show ? 'text' : 'password'" name="midtrans_server_key" class="input-premium py-3 text-sm pr-12" value="{{ $settings['midtrans_server_key'] ?? '' }}">
                    <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                        <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Client Key</label>
                    <input type="text" name="midtrans_client_key" class="input-premium py-3 text-sm" value="{{ $settings['midtrans_client_key'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Environment</label>
                    <select name="midtrans_is_production" class="input-premium py-3 text-sm appearance-none">
                        <option value="0" {{ ($settings['midtrans_is_production'] ?? '') == '0' ? 'selected' : '' }}>Sandbox</option>
                        <option value="1" {{ ($settings['midtrans_is_production'] ?? '') == '1' ? 'selected' : '' }}>Production</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Base URL</label>
                    <input type="text" name="midtrans_base_url" class="input-premium py-3 text-sm" value="{{ $settings['midtrans_base_url'] ?? '' }}">
                </div>
            </div>
        </form>
    </div>

    <!-- Logistics (RajaOngkir) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="logistics">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 shadow-inner">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">RajaOngkir Logistics</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Cek Ongkir & Pengiriman Otomatis</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" @click="testConnection('rajaongkir')" class="btn-secondary btn-sm" :disabled="testing === 'rajaongkir'">
                        <i class="fas fa-vial mr-2" x-show="testing !== 'rajaongkir'"></i>
                        <i class="fas fa-circle-notch fa-spin mr-2" x-show="testing === 'rajaongkir'"></i>
                        Uji Koneksi
                    </button>
                    <button type="submit" class="btn-primary btn-sm">Simpan</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2" x-data="{ show: false }">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">API Key</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="rajaongkir_api_key" class="input-premium py-3 text-sm pr-12" value="{{ $settings['rajaongkir_api_key'] ?? '' }}">
                        <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tipe Akun</label>
                    <select name="rajaongkir_type" class="input-premium py-3 text-sm appearance-none">
                        <option value="starter" {{ ($settings['rajaongkir_type'] ?? '') == 'starter' ? 'selected' : '' }}>Starter</option>
                        <option value="basic" {{ ($settings['rajaongkir_type'] ?? '') == 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="pro" {{ ($settings['rajaongkir_type'] ?? '') == 'pro' ? 'selected' : '' }}>Pro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">ID Kota Asal (Origin)</label>
                    <input type="text" name="rajaongkir_origin_city" class="input-premium py-3 text-sm" value="{{ $settings['rajaongkir_origin_city'] ?? '' }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Base URL</label>
                    <input type="text" name="rajaongkir_base_url" class="input-premium py-3 text-sm" value="{{ $settings['rajaongkir_base_url'] ?? '' }}">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Kurir Aktif (Pisahkan dengan koma)</label>
                    <input type="text" name="rajaongkir_couriers" class="input-premium py-3 text-sm" value="{{ $settings['rajaongkir_couriers'] ?? '' }}" placeholder="jne,tiki,pos">
                </div>
            </div>
        </form>
    </div>

    <!-- WhatsApp (Fonnte) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="whatsapp">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-500 shadow-inner">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Notifikasi WhatsApp</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Integrasi Fonnte untuk Status Pesanan</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" @click="testConnection('whatsapp')" class="btn-secondary btn-sm" :disabled="testing === 'whatsapp'">
                        <i class="fas fa-vial mr-2" x-show="testing !== 'whatsapp'"></i>
                        <i class="fas fa-circle-notch fa-spin mr-2" x-show="testing === 'whatsapp'"></i>
                        Uji Kirim
                    </button>
                    <button type="submit" class="btn-primary btn-sm">Simpan</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2" x-data="{ show: false }">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">API Token (Fonnte)</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="whatsapp_api_token" class="input-premium py-3 text-sm pr-12" value="{{ $settings['whatsapp_api_token'] ?? '' }}">
                        <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">WhatsApp Center</label>
                    <input type="text" name="whatsapp_number" class="input-premium py-3 text-sm" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="628xxx">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Status Layanan</label>
                    <select name="whatsapp_enabled" class="input-premium py-3 text-sm appearance-none">
                        <option value="0" {{ ($settings['whatsapp_enabled'] ?? '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="1" {{ ($settings['whatsapp_enabled'] ?? '0') == '1' ? 'selected' : '' }}>Aktif</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Base URL API</label>
                    <input type="text" name="whatsapp_base_url" class="input-premium py-3 text-sm" value="{{ $settings['whatsapp_base_url'] ?? '' }}">
                </div>
            </div>
        </form>
    </div>

    <!-- Email (SMTP) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="mail">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 shadow-inner">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Email (SMTP)</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Konfigurasi Pengiriman Email Receipt</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Mail Host</label>
                    <input type="text" name="mail_host" class="input-premium py-3 text-sm" value="{{ $settings['mail_host'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Port</label>
                    <input type="text" name="mail_port" class="input-premium py-3 text-sm" value="{{ $settings['mail_port'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Username</label>
                    <input type="text" name="mail_username" class="input-premium py-3 text-sm" value="{{ $settings['mail_username'] ?? '' }}">
                </div>
                <div x-data="{ show: false }">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="mail_password" class="input-premium py-3 text-sm pr-12" value="{{ $settings['mail_password'] ?? '' }}">
                        <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Encryption</label>
                    <select name="mail_encryption" class="input-premium py-3 text-sm appearance-none">
                        <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="null" {{ ($settings['mail_encryption'] ?? '') == 'null' ? 'selected' : '' }}>None</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">From Address</label>
                    <input type="text" name="mail_from_address" class="input-premium py-3 text-sm" value="{{ $settings['mail_from_address'] ?? '' }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">From Name</label>
                    <input type="text" name="mail_from_name" class="input-premium py-3 text-sm" value="{{ $settings['mail_from_name'] ?? '' }}">
                </div>
            </div>
        </form>
    </div>

    <!-- Localization Settings -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-10">
            @csrf
            <input type="hidden" name="section" value="localization">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 shadow-inner">
                        <i class="fas fa-language"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Localization</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Bahasa & Pengaturan Wilayah</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Default Language</label>
                    <select name="default_language" class="input-premium py-3 text-sm appearance-none">
                        <option value="id" {{ ($settings['default_language'] ?? '') == 'id' ? 'selected' : '' }}>Indonesian (ID)</option>
                        <option value="en" {{ ($settings['default_language'] ?? '') == 'en' ? 'selected' : '' }}>English (EN)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Available Languages (Comma separated)</label>
                    <input type="text" name="available_languages" class="input-premium py-3 text-sm" value="{{ $settings['available_languages'] ?? '' }}" placeholder="id,en">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function settingsHandler() {
        return {
            testing: null,
            async testConnection(type) {
                this.testing = type;
                try {
                    const res = await fetch('{{ route("superadmin.settings.test") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ type: type })
                    });
                    const data = await res.json();
                    
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { 
                            message: data.message, 
                            type: data.success ? 'success' : 'error' 
                        }
                    }));
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'Terjadi kesalahan sistem saat mencoba koneksi.', type: 'error' }
                    }));
                } finally {
                    this.testing = null;
                }
            }
        }
    }
</script>
@endsection
