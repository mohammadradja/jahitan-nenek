@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Tambah Kategori')

@section('dashboard_content')
<div class="max-w-2xl">
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-10 lg:p-16">
            <div class="flex items-center space-x-4 mb-12">
                <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Kategori Baru</h3>
                    <p class="text-sm text-gray-400">Klasifikasikan koleksi rajutan Anda agar mudah ditemukan pelanggan.</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="input-premium" placeholder="Contoh: Cardigan Vintage" value="{{ old('name') }}" required autofocus>
                        @error('name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" class="input-premium" placeholder="cardigan-vintage" value="{{ old('slug') }}" required>
                        <p class="mt-2 text-[10px] text-gray-400 font-medium italic">Slug akan otomatis terisi dan digunakan untuk alamat URL kategori.</p>
                        @error('slug') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Gambar Kategori</label>
                        <x-ui.image-upload
                            name="image_file"
                            title="Klik atau seret gambar kategori ke area ini"
                            empty-text="Opsional, belum ada file dipilih"
                        />
                        @error('image_file') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-10 flex items-center space-x-4 border-t border-gray-50">
                    <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                        Simpan Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="px-8 py-4 font-bold text-gray-400 hover:text-dark-wool transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('name').addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
@endsection
