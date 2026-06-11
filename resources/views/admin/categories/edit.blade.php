@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Edit Kategori')

@section('dashboard_content')
<div class="max-w-3xl">
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-10 lg:p-16">
            <div class="flex items-center space-x-4 mb-12">
                <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Edit Kategori</h3>
                    <p class="text-sm text-gray-400">Perbarui nama, slug, deskripsi, gambar, dan metadata kategori.</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Nama Kategori</label>
                        <input type="text" name="name" class="input-premium" value="{{ old('name', $category->name) }}" placeholder="Contoh: Cardigan Vintage" required autofocus>
                        @error('name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug (URL)</label>
                        <input type="text" name="slug" class="input-premium" value="{{ old('slug', $category->slug) }}" placeholder="cardigan-vintage" required>
                        @error('slug') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Gambar Kategori</label>
                        <x-ui.image-upload
                            name="image_file"
                            :current="$category->imageUrl()"
                            title="Klik atau seret gambar baru untuk mengganti gambar"
                            empty-text="Ganti hanya jika ingin memperbarui gambar"
                        />
                        @error('image_file') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Deskripsi</label>
                        <textarea name="description" class="input-premium h-32 resize-none" placeholder="Tuliskan deskripsi singkat kategori...">{{ old('description', $category->description) }}</textarea>
                        @error('description') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Meta Title</label>
                        <input type="text" name="meta_title" class="input-premium" value="{{ old('meta_title', $category->meta_title) }}" placeholder="Judul SEO kategori">
                        @error('meta_title') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Meta Description</label>
                        <textarea name="meta_description" class="input-premium h-24 resize-none" placeholder="Ringkasan SEO untuk mesin pencari...">{{ old('meta_description', $category->meta_description) }}</textarea>
                        @error('meta_description') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-10 flex items-center space-x-4 border-t border-gray-50">
                    <button type="submit" class="btn-premium px-12 py-4 shadow-xl shadow-soft-rose/20">
                        Perbarui Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="px-8 py-4 font-bold text-gray-400 hover:text-dark-wool transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
