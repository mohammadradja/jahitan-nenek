<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div>
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" class="input-premium" autocomplete="current-password">
            @if($errors->updatePassword->get('current_password'))
                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->updatePassword->get('current_password')[0] }}</p>
            @endif
        </div>

        <div>
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kata Sandi Baru</label>
            <input type="password" name="password" class="input-premium" autocomplete="new-password">
            @if($errors->updatePassword->get('password'))
                <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->updatePassword->get('password')[0] }}</p>
            @endif
        </div>

        <div>
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" class="input-premium" autocomplete="new-password">
        </div>

        <div class="flex items-center space-x-6 pt-4">
            <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-500 flex items-center"
                >
                    <i class="fas fa-check-circle mr-2"></i> Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>
