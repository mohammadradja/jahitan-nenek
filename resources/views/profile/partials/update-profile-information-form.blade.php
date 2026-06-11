<section class="max-w-4xl">
    <header class="mb-10">
        <h2 class="text-2xl font-serif font-bold text-dark-wool">
            {{ auth()->user()->role === 'user' ? 'Informasi Profil & Pengiriman' : 'Informasi Profil' }}
        </h2>
        <p class="mt-2 text-sm text-gray-400">
            {{ auth()->user()->role === 'user' ? 'Lengkapi data diri dan alamat pengiriman Anda untuk memudahkan proses transaksi.' : 'Lengkapi data diri Anda.' }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="input-premium py-2 text-xs" value="{{ old('name', $user->name) }}" placeholder="Contoh: Siti Aminah" required>
                <p class="mt-1.5 text-[10px] text-gray-400">Gunakan nama yang sesuai untuk pengiriman.</p>
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                <input type="email" name="email" class="input-premium py-2 text-xs" value="{{ old('email', $user->email) }}" placeholder="nama@email.com" required>
                <p class="mt-1.5 text-[10px] text-gray-400">Email dipakai untuk notifikasi pesanan.</p>
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">No. WhatsApp</label>
                <input type="text" name="phone" class="input-premium py-2 text-xs" value="{{ old('phone', $user->phone) }}" placeholder="62812xxxx">
                <p class="mt-1.5 text-[10px] text-gray-400">Nomor WhatsApp aktif untuk konfirmasi pesanan.</p>
            </div>
        </div>

        @if(auth()->user()->role === 'user')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat Pengiriman</label>
                    <textarea name="address" rows="2" class="input-premium py-2 text-xs" placeholder="Jl. Benang No. 123, Kecamatan, Kota...">{{ old('address', $user->address) }}</textarea>
                    <p class="mt-1.5 text-[10px] text-gray-400">Tulis alamat lengkap agar pesanan mudah dikirim.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kota ID</label>
                        <input type="text" inputmode="numeric" name="city_id" class="input-premium py-2 text-xs" value="{{ old('city_id', $user->city_id) }}" placeholder="Contoh: 152" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <p class="mt-1.5 text-[10px] text-gray-400">ID kota dari layanan ongkir bila tersedia.</p>
                    </div>
                    <div>
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kode Pos</label>
                        <input type="text" name="postal_code" class="input-premium py-2 text-xs" value="{{ old('postal_code', $user->postal_code) }}" placeholder="Contoh: 40123">
                        <p class="mt-1.5 text-[10px] text-gray-400">Kode pos tujuan pengiriman.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="pt-8 flex items-center justify-between border-t border-gray-50 mt-8">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest flex items-center">
                <i class="fas fa-shield-halved mr-2 text-soft-rose"></i> Data is encrypted and secure.
            </p>
            <button type="submit" class="btn-premium btn-sm">
                Save Changes
            </button>
        </div>
    </form>
</section>
