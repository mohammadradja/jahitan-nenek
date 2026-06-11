@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Manajemen Kategori')

@section('dashboard_content')
<div x-data="{ 
    showCreateModal: false
}">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold text-dark-wool">Daftar Koleksi</h3>
        <button @click="showCreateModal = true" class="btn-premium flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Kategori</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Nama Kategori</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Slug</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Total Produk</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 font-bold text-dark-wool">{{ $category->name }}</td>
                            <td class="px-8 py-6 text-gray-400 font-mono text-sm">{{ $category->slug }}</td>
                            <td class="px-8 py-6">
                                <span class="bg-soft-rose/10 text-soft-rose px-4 py-1.5 rounded-full text-xs font-bold">
                                    {{ $category->products_count }} Produk
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm" title="Edit kategori">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada kategori yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $categories->links() }}
    </div>

    <template x-if="showCreateModal">
        <div class="fixed inset-0 z-[200000] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
            <div class="relative bg-white w-full max-w-lg rounded-5xl shadow-2xl p-10 animate__animated animate__zoomIn animate__faster">
                <h3 class="text-2xl font-serif font-bold mb-8">Tambah Kategori</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                            <input type="text" name="name" required class="input-premium" placeholder="Contoh: Cardigan Klasik">
                            @error('name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                            <input type="text" name="slug" required class="input-premium" placeholder="cardigan-klasik">
                            @error('slug') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar Kategori</label>
                            <x-ui.image-upload
                                name="image_file"
                                title="Klik atau seret gambar kategori ke area ini"
                                empty-text="Opsional, belum ada file dipilih"
                                compact
                            />
                            @error('image_file') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-10 flex space-x-4">
                        <button type="submit" class="btn-premium flex-1">Simpan Kategori</button>
                        <button type="button" @click="showCreateModal = false" class="btn-secondary flex-1">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
