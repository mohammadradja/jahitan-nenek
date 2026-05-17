@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Manajemen Produk')

@section('dashboard_content')
<div x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    editData: { id: '', name: '', slug: '', category_id: '', price: '', stock: '', description: '', image_url: '' },
    openEdit(product) {
        this.editData = { ...product };
        this.showEditModal = true;
    }
}">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold text-dark-wool">Semua Koleksi Produk</h3>
        <button @click="showCreateModal = true" class="btn-primary btn-sm">
            <i class="fas fa-plus mr-2 text-[8px]"></i>
            <span>Tambah Produk</span>
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-8">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Cari Produk</label>
                <input type="text" name="search" value="{{ request('search') }}" class="input-premium py-1.5 text-xs" placeholder="Nama Produk atau SKU">
            </div>
            <div class="w-48">
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori</label>
                <select name="category" class="input-premium py-1.5 text-xs appearance-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-premium btn-sm">Filter</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Produk</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Kategori</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Harga</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Stok</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/50' }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
                                    <div>
                                        <p class="font-bold text-dark-wool line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-[10px] font-mono text-gray-400">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-soft-rose/10 text-soft-rose px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="px-8 py-6 font-bold text-dark-wool">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-bold {{ $product->stock < 5 ? 'text-red-500' : 'text-dark-wool' }}">
                                    {{ $product->stock }} Unit
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end space-x-3">
                                    <button @click="openEdit({{ json_encode($product) }})" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
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
                            <td colspan="5" class="px-8 py-12 text-center text-gray-400 italic">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->withQueryString()->links() }}
    </div>

    <!-- Create Modal -->
    <template x-if="showCreateModal">
        <div class="fixed inset-0 z-[200000] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
            <div class="relative bg-white w-full max-w-2xl rounded-5xl shadow-2xl p-10 animate__animated animate__zoomIn animate__faster my-auto">
                <h3 class="text-2xl font-serif font-bold mb-8">Tambah Produk Baru</h3>
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Produk</label>
                            <input type="text" name="name" required class="input-premium">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                            <input type="text" name="slug" required class="input-premium">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                            <select name="category_id" required class="input-premium appearance-none">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 md:col-span-1 flex space-x-4">
                            <div class="flex-1">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Harga</label>
                                <input type="number" name="price" required class="input-premium">
                            </div>
                            <div class="w-24">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Stok</label>
                                <input type="number" name="stock" required class="input-premium">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">URL Gambar</label>
                            <input type="text" name="image_url" class="input-premium" placeholder="https://...">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="description" class="input-premium h-32 resize-none"></textarea>
                        </div>
                    </div>
                    <div class="mt-10 flex justify-center space-x-4">
                        <button type="submit" class="btn-primary btn-sm">Simpan Produk</button>
                        <button type="button" @click="showCreateModal = false" class="btn-secondary btn-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-[200000] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="showEditModal = false"></div>
            <div class="relative bg-white w-full max-w-2xl rounded-5xl shadow-2xl p-10 animate__animated animate__zoomIn animate__faster my-auto">
                <h3 class="text-2xl font-serif font-bold mb-8">Edit Produk</h3>
                <form :action="`/admin/products/${editData.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Produk</label>
                            <input type="text" name="name" x-model="editData.name" required class="input-premium">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                            <input type="text" name="slug" x-model="editData.slug" required class="input-premium">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                            <select name="category_id" x-model="editData.category_id" required class="input-premium appearance-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 md:col-span-1 flex space-x-4">
                            <div class="flex-1">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Harga</label>
                                <input type="number" name="price" x-model="editData.price" required class="input-premium">
                            </div>
                            <div class="w-24">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Stok</label>
                                <input type="number" name="stock" x-model="editData.stock" required class="input-premium">
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">URL Gambar</label>
                            <input type="text" name="image_url" x-model="editData.image_url" class="input-premium">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="description" x-model="editData.description" class="input-premium h-32 resize-none"></textarea>
                        </div>
                    </div>
                    <div class="mt-10 flex justify-center space-x-4">
                        <button type="submit" class="btn-accent btn-sm">Perbarui Data</button>
                        <button type="button" @click="showEditModal = false" class="btn-secondary btn-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
