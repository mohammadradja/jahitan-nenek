@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Content Management System (CMS) & Pengaturan')

@section('dashboard_content')
<div class="max-w-5xl space-y-12 pb-20" x-data="settingsHandler()">

    <!-- General Settings -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10">
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
                    <input type="text" name="site_name" class="input-premium py-3 text-sm" value="{{ $settings['site_name'] ?? 'Jahitan Nenek' }}" placeholder="Contoh: Jahitan Nenek">
                    <p class="mt-2 text-[10px] text-gray-400">Nama brand yang tampil pada identitas situs.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tagline</label>
                    <input type="text" name="site_tagline" class="input-premium py-3 text-sm" value="{{ $settings['site_tagline'] ?? 'Jahitan Kasih Sayang Premium' }}" placeholder="Contoh: Jahitan Kasih Sayang Premium">
                    <p class="mt-2 text-[10px] text-gray-400">Tagline pendek untuk menjelaskan karakter brand.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Promo Settings -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10" @submit="syncPromoCurrency()">
            @csrf
            <input type="hidden" name="section" value="promo">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose shadow-inner">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Pengaturan Promo</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Estimasi harga untuk Banner Promo</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan Promo</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                    <p class="mt-2 text-[10px] text-gray-400">Label kecil yang muncul di banner promo storefront.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Estimasi Harga Awal</label>
                    <input type="hidden" name="promo_original_price" x-ref="promoOriginalPrice" value="{{ $settings['promo_original_price'] ?? '' }}">
                    <input type="text" inputmode="numeric" class="input-premium py-3 text-sm" x-model="promoOriginalDisplay" @input="promoOriginalDisplay = formatRupiah(promoOriginalDisplay)" placeholder="Rp 150.000">
                    <p class="mt-2 text-[10px] text-gray-400">Angka estimasi sebelum promo, otomatis diformat Rupiah.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Estimasi Harga Promo</label>
                    <input type="hidden" name="promo_real_price" x-ref="promoRealPrice" value="{{ $settings['promo_real_price'] ?? '' }}">
                    <input type="text" inputmode="numeric" class="input-premium py-3 text-sm" x-model="promoRealDisplay" @input="promoRealDisplay = formatRupiah(promoRealDisplay)" placeholder="Rp 100.000">
                    <p class="mt-2 text-[10px] text-gray-400">Harga estimasi yang ingin ditonjolkan di banner promo.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi Singkat</label>
                    <input type="text" name="promo_description" class="input-premium py-3 text-sm" value="{{ $settings['promo_description'] ?? 'Harga spesial untuk koleksi pilihan Jahitan Nenek.' }}" placeholder="Contoh: Harga spesial untuk koleksi pilihan.">
                    <p class="mt-2 text-[10px] text-gray-400">Kalimat pendek yang menjelaskan promo kepada pelanggan.</p>
                </div>
                <div class="md:col-span-2 rounded-[2rem] bg-vintage-cream/30 border border-gray-100 p-6">
                    <p class="text-[10px] font-bold text-soft-rose uppercase tracking-widest mb-2">{{ $settings['promo_label'] ?? 'Promo Spesial' }}</p>
                    <div class="flex flex-wrap items-end gap-4">
                        @if($settings['promo_original_price'] ?? false)
                            <span class="text-lg font-bold text-gray-400 line-through">Rp{{ number_format((int) $settings['promo_original_price'], 0, ',', '.') }}</span>
                        @endif
                        @if($settings['promo_real_price'] ?? false)
                            <span class="text-3xl font-serif font-bold text-dark-wool">Rp{{ number_format((int) $settings['promo_real_price'], 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bank Transfer Settings (Manual Payment) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        @php
            $bankTransferRaw = $settings['bank_transfer_info'] ?? "BCA: 123-456-7890 a/n Jahitan Nenek\nMandiri: 987-654-3210 a/n Jahitan Nenek";
            
            $banksList = [
                'BCA' => ['label' => 'BCA (Bank Central Asia)', 'enabled' => false, 'number' => '', 'name' => ''],
                'MANDIRI' => ['label' => 'Bank Mandiri', 'enabled' => false, 'number' => '', 'name' => ''],
                'BNI' => ['label' => 'BNI (Bank Negara Indonesia)', 'enabled' => false, 'number' => '', 'name' => ''],
                'BRI' => ['label' => 'BRI (Bank Rakyat Indonesia)', 'enabled' => false, 'number' => '', 'name' => ''],
                'BSI' => ['label' => 'BSI (Bank Syariah Indonesia)', 'enabled' => false, 'number' => '', 'name' => ''],
            ];

            foreach (explode("\n", $bankTransferRaw) as $line) {
                $line = trim($line);
                if (!$line) continue;
                
                $parts = explode(':', $line, 2);
                if (count($parts) === 2) {
                    $bankKey = strtoupper(trim($parts[0]));
                    $details = trim($parts[1]);
                    
                    $name = '';
                    $number = $details;
                    if (str_contains($details, ' a/n ')) {
                        $subparts = explode(' a/n ', $details, 2);
                        $number = trim($subparts[0]);
                        $name = trim($subparts[1]);
                    }
                    
                    if (array_key_exists($bankKey, $banksList)) {
                        $banksList[$bankKey]['enabled'] = true;
                        $banksList[$bankKey]['number'] = $number;
                        $banksList[$bankKey]['name'] = $name;
                    }
                }
            }
        @endphp

        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10" id="bank-settings-form" onsubmit="compileBankInfo(event)">
            @csrf
            <input type="hidden" name="section" value="payment_bank">
            <!-- Hidden input to store compiled newline text for database compatibility -->
            <input type="hidden" name="bank_transfer_info" id="bank_transfer_info_compiled">

            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose shadow-inner">
                        <i class="fas fa-university"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Rekening Transfer Bank</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Daftar Rekening Bank untuk Pembayaran Manual</p>
                    </div>
                </div>
                <button type="submit" class="btn-primary btn-sm">Simpan</button>
            </div>

            <div class="space-y-6">
                @foreach($banksList as $code => $data)
                    <div class="p-6 rounded-[2rem] border border-gray-150 transition-all flex flex-col lg:flex-row lg:items-center justify-between gap-6"
                         x-data="{ isEnabled: {{ $data['enabled'] ? 'true' : 'false' }} }"
                         :class="isEnabled ? 'bg-vintage-cream/10 border-soft-rose/25' : 'bg-gray-50/50 opacity-60'">
                        
                        <!-- Toggle and Bank Code info -->
                        <div class="flex items-center space-x-4 min-w-[220px]">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer bank-enable-toggle" data-bank-code="{{ $code }}" x-model="isEnabled">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-soft-rose"></div>
                            </label>
                            <div>
                                <span class="text-xs font-serif font-black text-dark-wool block">{{ $code }}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $data['label'] }}</span>
                            </div>
                        </div>

                        <!-- Account Number & Account Name Input Fields -->
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4" x-show="isEnabled" x-transition>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nomor Rekening</label>
                                <input type="text" class="input-premium py-2 text-xs font-mono bank-account-number" 
                                       data-bank-code="{{ $code }}"
                                       value="{{ $data['number'] }}" 
                                       placeholder="Masukkan nomor rekening..."
                                       :required="isEnabled">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nama Pemilik (a/n)</label>
                                <input type="text" class="input-premium py-2 text-xs bank-account-name" 
                                       data-bank-code="{{ $code }}"
                                       value="{{ $data['name'] }}" 
                                       placeholder="Contoh: Jahitan Nenek"
                                       :required="isEnabled">
                            </div>
                        </div>
                        <div class="flex-1 flex items-center justify-center py-4 text-xs text-gray-400 font-bold uppercase tracking-widest" x-show="!isEnabled">
                            <i class="fas fa-ban mr-2 text-gray-300"></i> Rekening {{ $code }} Dinonaktifkan
                        </div>
                    </div>
                @endforeach
            </div>
        </form>

        <script>
            function compileBankInfo(event) {
                event.preventDefault();
                const form = document.getElementById('bank-settings-form');
                const compiledInput = document.getElementById('bank_transfer_info_compiled');
                
                let lines = [];
                const toggles = document.querySelectorAll('.bank-enable-toggle');
                
                toggles.forEach(toggle => {
                    const code = toggle.getAttribute('data-bank-code');
                    const isChecked = toggle.checked;
                    
                    if (isChecked) {
                        const numInput = document.querySelector(`.bank-account-number[data-bank-code="${code}"]`);
                        const nameInput = document.querySelector(`.bank-account-name[data-bank-code="${code}"]`);
                        
                        const number = numInput.value.trim();
                        const name = nameInput.value.trim();
                        
                        if (number && name) {
                            lines.push(`${code}: ${number} a/n ${name}`);
                        }
                    }
                });
                
                compiledInput.value = lines.join('\n');
                form.submit();
            }
        </script>
    </div>

    <!-- WhatsApp (Fonnte) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10">
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
                    <button type="submit" class="btn-primary btn-sm">Simpan</button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2" x-data="{ show: false }">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">API Token (Fonnte)</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="whatsapp_api_token" class="input-premium py-3 text-sm pr-12" value="{{ $settings['whatsapp_api_token'] ?? '' }}" placeholder="Token API Fonnte">
                        <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <p class="mt-2 text-[10px] text-gray-400">Token dari dashboard Fonnte untuk mengirim notifikasi WhatsApp.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">WhatsApp Center</label>
                    <input type="text" name="whatsapp_number" class="input-premium py-3 text-sm" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="62812xxxx">
                    <p class="mt-2 text-[10px] text-gray-400">Gunakan format nomor Indonesia tanpa tanda plus.</p>
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
                    <input type="text" name="whatsapp_base_url" class="input-premium py-3 text-sm" value="{{ $settings['whatsapp_base_url'] ?? '' }}" placeholder="https://api.fonnte.com">
                    <p class="mt-2 text-[10px] text-gray-400">Base URL API penyedia WhatsApp, tanpa path endpoint tambahan.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Email (SMTP) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10">
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
                    <input type="text" name="mail_host" class="input-premium py-3 text-sm" value="{{ $settings['mail_host'] ?? '' }}" placeholder="smtp.mailtrap.io">
                    <p class="mt-2 text-[10px] text-gray-400">Host SMTP dari penyedia email transaksi.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Port</label>
                    <input type="text" name="mail_port" class="input-premium py-3 text-sm" value="{{ $settings['mail_port'] ?? '' }}" placeholder="587">
                    <p class="mt-2 text-[10px] text-gray-400">Port umum: 587 untuk TLS atau 465 untuk SSL.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Username</label>
                    <input type="text" name="mail_username" class="input-premium py-3 text-sm" value="{{ $settings['mail_username'] ?? '' }}" placeholder="Username SMTP">
                    <p class="mt-2 text-[10px] text-gray-400">Username autentikasi dari penyedia SMTP.</p>
                </div>
                <div x-data="{ show: false }">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="mail_password" class="input-premium py-3 text-sm pr-12" value="{{ $settings['mail_password'] ?? '' }}" placeholder="Password SMTP">
                        <button type="button" @click="show = !show" class="absolute right-4 bottom-3 text-gray-300 hover:text-soft-rose transition-colors">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <p class="mt-2 text-[10px] text-gray-400">Password atau app password untuk akun SMTP.</p>
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
                    <input type="text" name="mail_from_address" class="input-premium py-3 text-sm" value="{{ $settings['mail_from_address'] ?? '' }}" placeholder="hello@jahitannenek.com">
                    <p class="mt-2 text-[10px] text-gray-400">Alamat pengirim yang muncul di email pelanggan.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">From Name</label>
                    <input type="text" name="mail_from_name" class="input-premium py-3 text-sm" value="{{ $settings['mail_from_name'] ?? '' }}" placeholder="Jahitan Nenek">
                    <p class="mt-2 text-[10px] text-gray-400">Nama pengirim yang muncul di inbox pelanggan.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Localization Settings -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route(auth()->user()->role . '.settings.update') }}" method="POST" class="p-10">
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
                    <input type="text" name="available_languages" class="input-premium py-3 text-sm" value="{{ $settings['available_languages'] ?? 'id,en' }}" placeholder="id,en">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function settingsHandler() {
        return {
            testing: null,
            promoOriginalDisplay: @json(($settings['promo_original_price'] ?? false) ? 'Rp ' . number_format((int) $settings['promo_original_price'], 0, ',', '.') : ''),
            promoRealDisplay: @json(($settings['promo_real_price'] ?? false) ? 'Rp ' . number_format((int) $settings['promo_real_price'], 0, ',', '.') : ''),
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
            async testConnection(type) {
                this.testing = type;
                try {
                    const res = await fetch('{{ route(auth()->user()->role . ".settings.test") }}', {
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
