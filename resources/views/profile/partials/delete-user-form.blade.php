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
        class="bg-red-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-600 transition-all shadow-md shadow-red-500/10 text-xs"
    >
        Hapus Akun
    </button>

    <x-ui.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-serif font-bold text-dark-wool mb-2">
                Apakah Anda yakin?
            </h2>

            <p class="text-[11px] text-gray-400 leading-relaxed mb-6">
                Sekali Anda menghapus akun, semua data akan hilang selamanya. Silakan masukkan kata sandi Anda.
            </p>

            <div class="space-y-2">
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">Kata Sandi</label>
                <input type="password" name="password" class="input-premium py-1.5 text-xs" placeholder="••••••••">
                @if($errors->userDeletion->get('password'))
                    <p class="mt-1 text-[9px] text-red-500 font-bold uppercase tracking-wider">{{ $errors->userDeletion->get('password')[0] }}</p>
                @endif
            </div>

            <div class="mt-8 flex space-x-3">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 bg-gray-50 text-[10px] font-bold py-2 rounded-lg hover:bg-gray-100 transition-colors">
                    Batal
                </button>

                <button type="submit" class="flex-1 bg-red-500 text-white text-[10px] font-bold py-2 rounded-lg hover:bg-red-600 transition-all shadow-lg shadow-red-500/10">
                    Hapus
                </button>
            </div>
        </form>
    </x-ui.modal>
</section>
