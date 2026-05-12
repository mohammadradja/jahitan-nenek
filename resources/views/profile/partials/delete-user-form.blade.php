<section class="space-y-6">
    <div class="bg-red-50/50 p-8 rounded-3xl border border-red-100 mb-8">
        <p class="text-sm text-red-600 leading-relaxed font-medium">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap unduh data apa pun yang ingin Anda pertahankan sebelum melanjutkan.
        </p>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 text-white font-bold py-4 px-8 rounded-full hover:bg-red-600 transition-all shadow-lg shadow-red-500/20"
    >
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-12">
            @csrf
            @method('delete')

            <h2 class="text-3xl font-serif font-bold text-dark-wool mb-4">
                Apakah Anda yakin?
            </h2>

            <p class="text-gray-400 leading-relaxed mb-8">
                Sekali Anda menghapus akun, semua data akan hilang selamanya. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini.
            </p>

            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Konfirmasi Kata Sandi</label>
                <input type="password" name="password" class="input-premium" placeholder="••••••••">
                @if($errors->userDeletion->get('password'))
                    <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $errors->userDeletion->get('password')[0] }}</p>
                @endif
            </div>

            <div class="mt-12 flex space-x-4">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 bg-gray-50 font-bold py-4 rounded-full hover:bg-gray-100 transition-colors">
                    Batal
                </button>

                <button type="submit" class="flex-1 bg-red-500 text-white font-bold py-4 rounded-full hover:bg-red-600 transition-all shadow-xl shadow-red-500/20">
                    Hapus Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>
