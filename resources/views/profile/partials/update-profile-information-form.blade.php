<section class="max-w-4xl">
    <header class="mb-10">
        <h2 class="text-2xl font-serif font-bold text-dark-wool">
            Informasi Profil & Pengiriman
        </h2>
        <p class="mt-2 text-sm text-gray-400">
            Lengkapi data diri dan alamat pengiriman Anda untuk memudahkan proses transaksi.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="input-premium py-2 text-xs" value="{{ old('name', $user->name) }}" required>
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                <input type="email" name="email" class="input-premium py-2 text-xs" value="{{ old('email', $user->email) }}" required>
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">No. WhatsApp</label>
                <input type="text" name="phone" class="input-premium py-2 text-xs" value="{{ old('phone', $user->phone) }}">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat Pengiriman</label>
                <textarea name="address" rows="2" class="input-premium py-2 text-xs" placeholder="Jl. Benang No. 123...">{{ old('address', $user->address) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kota ID</label>
                    <input type="number" name="city_id" class="input-premium py-2 text-xs" value="{{ old('city_id', $user->city_id) }}">
                </div>
                <div>
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kode Pos</label>
                    <input type="text" name="postal_code" class="input-premium py-2 text-xs" value="{{ old('postal_code', $user->postal_code) }}">
                </div>
            </div>
        </div>

        <div class="pt-6 flex items-center justify-between border-t border-gray-50">
            <p class="text-[9px] text-gray-400">
                <i class="fas fa-shield-alt mr-1 text-green-500"></i> Data Anda aman.
            </p>
            <button type="submit" class="btn-premium px-8 py-2 text-[10px] shadow-lg shadow-soft-rose/10">
                Simpan
            </button>
        </div>
    </form>
</section>
