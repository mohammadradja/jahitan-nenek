<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password Saat Ini</label>
                <input type="password" name="current_password" class="input-premium py-2 text-xs" autocomplete="current-password">
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password Baru</label>
                <input type="password" name="password" class="input-premium py-2 text-xs" autocomplete="new-password">
            </div>
            <div>
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Konfirmasi</label>
                <input type="password" name="password_confirmation" class="input-premium py-2 text-xs" autocomplete="new-password">
            </div>
        </div>

        <div class="flex items-center space-x-6 pt-8 border-t border-gray-50 mt-8">
            <button type="submit" class="btn-premium">
                Update Password
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
