@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Tambah Produk Baru')

@section('dashboard_content')
<div class="max-w-4xl">
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-10 lg:p-16">
            <div class="flex items-center space-x-4 mb-12">
                <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                    <i class="fas fa-box-open text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Informasi Produk Baru</h3>
                    <p class="text-sm text-gray-400">Tambahkan mahakarya rajutan terbaru ke dalam koleksi Anda.</p>
                </div>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Produk</label>
                        <input type="text" name="name" id="name" class="input-premium" placeholder="Contoh: Cardigan Klasik" value="{{ old('name') }}" required autofocus>
                        @error('name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" class="input-premium" placeholder="cardigan-klasik" value="{{ old('slug') }}" required>
                        @error('slug') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Kategori Koleksi</label>
                        <select name="category_id" class="input-premium appearance-none" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1 flex space-x-4">
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Harga (Rp)</label>
                            <input type="number" name="price" class="input-premium" placeholder="150000" value="{{ old('price') }}" required>
                            @error('price') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div class="w-32">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Stok Awal</label>
                            <input type="number" name="stock" class="input-premium" placeholder="10" value="{{ old('stock') }}" required>
                            @error('stock') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">URL Gambar</label>
                        <input type="text" name="image_url" class="input-premium" placeholder="https://unsplash.com/..." value="{{ old('image_url') }}">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Deskripsi Produk</label>
                        <textarea name="description" class="input-premium h-40 py-4 resize-none" placeholder="Tuliskan detail keajaiban rajutan ini...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="pt-10 flex items-center space-x-4 border-t border-gray-50">
                    <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                        Simpan Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="px-8 py-4 font-bold text-gray-400 hover:text-dark-wool transition-colors">
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
