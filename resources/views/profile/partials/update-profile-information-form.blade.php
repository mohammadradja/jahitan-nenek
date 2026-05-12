<section class="max-w-4xl">
    <header class="mb-10">
        <h2 class="text-2xl font-serif font-bold text-dark-wool">
            Informasi Profil & Pengiriman
        </h2>
        <p class="mt-2 text-sm text-gray-400">
            Lengkapi data diri dan alamat pengiriman Anda untuk memudahkan proses transaksi.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Basic Info -->
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Lengkap</label>
                    <input type="text" name="name" class="input-premium" value="{{ old('name', $user->name) }}" required autofocus>
                    @if($errors->get('name'))
                        <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->get('name')[0] }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Email</label>
                    <input type="email" name="email" class="input-premium" value="{{ old('email', $user->email) }}" required>
                    @if($errors->get('email'))
                        <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->get('email')[0] }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">No. WhatsApp / Telepon</label>
                    <input type="text" name="phone" class="input-premium" value="{{ old('phone', $user->phone) }}" placeholder="08123456789">
                    @if($errors->get('phone'))
                        <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->get('phone')[0] }}</p>
                    @endif
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Lengkap</label>
                    <textarea name="address" rows="4" class="input-premium py-4" placeholder="Jl. Benang No. 123...">{{ old('address', $user->address) }}</textarea>
                    @if($errors->get('address'))
                        <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->get('address')[0] }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kota (RajaOngkir ID)</label>
                        <input type="number" name="city_id" class="input-premium" value="{{ old('city_id', $user->city_id) }}" placeholder="152">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kode Pos</label>
                        <input type="text" name="postal_code" class="input-premium" value="{{ old('postal_code', $user->postal_code) }}" placeholder="40123">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-10 flex items-center justify-between border-t border-gray-50">
            <p class="text-xs text-gray-400 flex items-center">
                <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                Data Anda aman bersama Jahitan Nenek.
            </p>
            <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
