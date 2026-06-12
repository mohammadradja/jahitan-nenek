@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Manajemen Kategori')

@section('dashboard_content')
<div x-data="{
    showCreateModal: false,
    showEditModal: false,
    editData: { id: '', name: '', slug: '', image_url: '', description: '', meta_title: '', meta_description: '' },
    openCreate() {
        this.closeModals();
        this.showCreateModal = true;
    },
    openEdit(category) {
        this.closeModals();
        this.editData = { ...this.editData, ...category };
        this.showEditModal = true;
    },
    closeModals() {
        this.showCreateModal = false;
        this.showEditModal = false;
    },
    imagePreview(path) {
        if (!path) {
            return '';
        }

        return String(path).startsWith('http') || String(path).startsWith('//') ? path : `/${path}`;
    }
}" @keydown.escape.window="closeModals()">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold text-dark-wool">Daftar Koleksi</h3>
        <button @click="openCreate()" class="btn-primary btn-sm">
            <i class="fas fa-plus mr-2 text-[8px]"></i>
            <span>Tambah Kategori</span>
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Kategori</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Slug</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Total Produk</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $category->imageUrl('https://via.placeholder.com/50') }}"
                                        class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
                                    <div>
                                        <p class="font-bold text-dark-wool line-clamp-1">{{ $category->name }}</p>
                                        <p class="text-[10px] text-gray-400 line-clamp-1">
                                            {{ $category->description ?: 'Belum ada deskripsi kategori.' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-gray-400 font-mono text-sm">{{ $category->slug }}</td>
                            <td class="px-8 py-6">
                                <span class="bg-soft-rose/10 text-soft-rose px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                    {{ $category->products_count }} Produk
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end space-x-3">
                                    <button type="button" @click="openEdit({{ json_encode($category) }})"
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm"
                                        title="Edit kategori">
                                        <i class="fas fa-edit"></i>
                                    </button>
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

    <div class="mt-8">
        {{ $categories->links() }}
    </div>

    <template x-teleport="body">
        <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-[200000] overflow-y-auto px-3 pb-6 pt-24 sm:px-6 sm:pb-8 sm:pt-28 lg:pt-32">
            <div class="fixed inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="closeModals()"></div>
            <div class="relative mx-auto mb-6 bg-white w-full max-w-3xl rounded-[2.5rem] shadow-2xl animate__animated animate__zoomIn animate__faster max-h-[calc(100dvh-7rem)] sm:max-h-[calc(100dvh-8rem)] lg:max-h-[calc(100dvh-9rem)] overflow-hidden flex flex-col">
                <div class="px-6 sm:px-10 py-6 border-b border-gray-100 flex items-center justify-between shrink-0">
                    <h3 class="text-2xl font-serif font-bold">Tambah Kategori</h3>
                    <button type="button" @click="closeModals()" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-soft-rose hover:text-white transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1 min-h-0 overflow-y-auto px-6 sm:px-10 py-8">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                            <input type="text" name="name" required class="input-premium" placeholder="Contoh: Cardigan Klasik">
                            <p class="mt-2 text-[11px] text-gray-400">Nama koleksi yang akan dilihat pelanggan.</p>
                            @error('name') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                            <input type="text" name="slug" required class="input-premium" placeholder="cardigan-klasik">
                            <p class="mt-2 text-[11px] text-gray-400">Gunakan huruf kecil dan tanda hubung untuk URL.</p>
                            @error('slug') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar Kategori</label>
                            <x-ui.image-upload
                                name="image_file"
                                title="Klik atau seret gambar kategori ke area ini"
                                empty-text="Opsional, belum ada file dipilih"
                            />
                            @error('image_file') <p class="mt-2 text-xs text-red-500 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="description" class="input-premium h-32 resize-none" placeholder="Tuliskan deskripsi singkat kategori..."></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Meta Title</label>
                            <input type="text" name="meta_title" class="input-premium" placeholder="Judul SEO kategori">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Meta Description</label>
                            <textarea name="meta_description" class="input-premium h-24 resize-none" placeholder="Ringkasan SEO untuk mesin pencari..."></textarea>
                        </div>
                    </div>
                    <div class="px-6 sm:px-10 py-6 flex justify-end space-x-4 border-t border-gray-100 shrink-0">
                        <button type="submit" class="btn-primary btn-sm">Simpan Kategori</button>
                        <button type="button" @click="closeModals()" class="btn-secondary btn-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <template x-teleport="body">
        <div x-show="showEditModal" x-cloak class="fixed inset-0 z-[200000] overflow-y-auto px-3 pb-6 pt-24 sm:px-6 sm:pb-8 sm:pt-28 lg:pt-32">
            <div class="fixed inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="closeModals()"></div>
            <div class="relative mx-auto mb-6 bg-white w-full max-w-3xl rounded-[2.5rem] shadow-2xl animate__animated animate__zoomIn animate__faster max-h-[calc(100dvh-7rem)] sm:max-h-[calc(100dvh-8rem)] lg:max-h-[calc(100dvh-9rem)] overflow-hidden flex flex-col">
                <div class="px-6 sm:px-10 py-6 border-b border-gray-100 flex items-center justify-between shrink-0">
                    <h3 class="text-2xl font-serif font-bold">Edit Kategori</h3>
                    <button type="button" @click="closeModals()" class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-soft-rose hover:text-white transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form :action="`/admin/categories/${editData.id}`" method="POST" enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1 min-h-0 overflow-y-auto px-6 sm:px-10 py-8">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                            <input type="text" name="name" x-model="editData.name" required class="input-premium" placeholder="Contoh: Cardigan Klasik">
                            <p class="mt-2 text-[11px] text-gray-400">Nama koleksi yang akan dilihat pelanggan.</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                            <input type="text" name="slug" x-model="editData.slug" required class="input-premium" placeholder="cardigan-klasik">
                            <p class="mt-2 text-[11px] text-gray-400">Gunakan huruf kecil dan tanda hubung untuk URL.</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Gambar Kategori</label>
                            <template x-if="editData.image_url">
                                <div class="mb-4 w-24 h-24 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100">
                                    <img :src="imagePreview(editData.image_url)" class="w-full h-full object-cover" alt="Preview kategori">
                                </div>
                            </template>
                            <x-ui.image-upload
                                name="image_file"
                                title="Klik atau seret gambar baru untuk mengganti kategori"
                                empty-text="Ganti hanya jika ingin memperbarui gambar"
                            />
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="description" x-model="editData.description" class="input-premium h-32 resize-none" placeholder="Tuliskan deskripsi singkat kategori..."></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Meta Title</label>
                            <input type="text" name="meta_title" x-model="editData.meta_title" class="input-premium" placeholder="Judul SEO kategori">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Meta Description</label>
                            <textarea name="meta_description" x-model="editData.meta_description" class="input-premium h-24 resize-none" placeholder="Ringkasan SEO untuk mesin pencari..."></textarea>
                        </div>
                    </div>
                    <div class="px-6 sm:px-10 py-6 flex justify-end space-x-4 border-t border-gray-100 shrink-0">
                        <button type="submit" class="btn-accent btn-sm">Perbarui Kategori</button>
                        <button type="button" @click="closeModals()" class="btn-secondary btn-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
