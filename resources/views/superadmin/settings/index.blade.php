@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Settings')

@section('dashboard_content')
<div class="max-w-5xl space-y-6">
    <!-- Payment Settings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="section" value="payment">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-soft-rose/10 rounded-lg flex items-center justify-center text-soft-rose">
                        <i class="fas fa-credit-card text-xs"></i>
                    </div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Payment Gateway</h3>
                </div>
                <button type="submit" class="btn-premium px-4 py-1.5 text-[10px]">Save Changes</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Merchant ID</label>
                    <input type="text" name="midtrans_merchant_id" class="input-premium py-1.5 text-xs" value="{{ $settings['midtrans_merchant_id'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Environment</label>
                    <select name="midtrans_is_production" class="input-premium py-1.5 text-xs appearance-none">
                        <option value="0" {{ ($settings['midtrans_is_production'] ?? '') == '0' ? 'selected' : '' }}>Sandbox</option>
                        <option value="1" {{ ($settings['midtrans_is_production'] ?? '') == '1' ? 'selected' : '' }}>Production</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Server Key</label>
                    <input type="password" name="midtrans_server_key" class="input-premium py-1.5 text-xs" value="{{ $settings['midtrans_server_key'] ?? '' }}">
                </div>
            </div>
        </form>
    </div>

    <!-- Logistics Settings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="section" value="logistics">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                        <i class="fas fa-truck text-xs"></i>
                    </div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Logistics (RajaOngkir)</h3>
                </div>
                <button type="submit" class="btn-premium px-4 py-1.5 text-[10px]">Save Changes</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">API Key</label>
                    <input type="password" name="rajaongkir_api_key" class="input-premium py-1.5 text-xs" value="{{ $settings['rajaongkir_api_key'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Origin City ID</label>
                    <input type="text" name="rajaongkir_origin_city" class="input-premium py-1.5 text-xs" value="{{ $settings['rajaongkir_origin_city'] ?? '' }}">
                </div>
            </div>
        </form>
    </div>

    <!-- WhatsApp Settings (Fonnte) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="section" value="whatsapp">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-500">
                        <i class="fab fa-whatsapp text-xs"></i>
                    </div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">WhatsApp (Fonnte)</h3>
                </div>
                <button type="submit" class="btn-premium px-4 py-1.5 text-[10px]">Save Changes</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">API Token</label>
                    <input type="password" name="whatsapp_api_token" class="input-premium py-1.5 text-xs" value="{{ $settings['whatsapp_api_token'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">WhatsApp Center</label>
                    <input type="text" name="whatsapp_number" class="input-premium py-1.5 text-xs" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="628xxx">
                </div>
            </div>
        </form>
    </div>

    <!-- Email Settings (SMTP) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="section" value="email">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                        <i class="fas fa-envelope text-xs"></i>
                    </div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Email (SMTP)</h3>
                </div>
                <button type="submit" class="btn-premium px-4 py-1.5 text-[10px]">Save Changes</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Host</label>
                    <input type="text" name="mail_host" class="input-premium py-1.5 text-xs" value="{{ $settings['mail_host'] ?? '' }}" placeholder="smtp.mailtrap.io">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Port</label>
                    <input type="text" name="mail_port" class="input-premium py-1.5 text-xs" value="{{ $settings['mail_port'] ?? '' }}" placeholder="2525">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Encryption</label>
                    <select name="mail_encryption" class="input-premium py-1.5 text-xs appearance-none">
                        <option value="null" {{ ($settings['mail_encryption'] ?? '') == 'null' ? 'selected' : '' }}>None</option>
                        <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Username</label>
                    <input type="text" name="mail_username" class="input-premium py-1.5 text-xs" value="{{ $settings['mail_username'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password</label>
                    <input type="password" name="mail_password" class="input-premium py-1.5 text-xs" value="{{ $settings['mail_password'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">From Name</label>
                    <input type="text" name="mail_from_name" class="input-premium py-1.5 text-xs" value="{{ $settings['mail_from_name'] ?? '' }}" placeholder="Jahitan Nenek">
                </div>
            </div>
        </form>
    </div>

    <!-- SEO & Metadata -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="p-6">
            @csrf
            <input type="hidden" name="section" value="seo">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center text-purple-500">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">SEO & Metadata</h3>
                </div>
                <button type="submit" class="btn-premium px-4 py-1.5 text-[10px]">Save Changes</button>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Meta Title</label>
                    <input type="text" name="meta_title" class="input-premium py-1.5 text-xs" value="{{ $settings['meta_title'] ?? '' }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="input-premium py-1.5 text-xs" value="{{ $settings['meta_keywords'] ?? '' }}" placeholder="keyword1, keyword2...">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="2" class="input-premium py-1.5 text-xs resize-none">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
