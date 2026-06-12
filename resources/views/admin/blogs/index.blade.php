@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Catatan Blog')

@section('dashboard_content')
<div x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    editData: { id: '', title: '', title_en: '', slug: '', content: '', content_en: '', image: '', status: 'draft' },
    openCreate() {
        this.showEditModal = false;
        this.showCreateModal = true;
    },
    openEdit(blog) {
        this.showCreateModal = false;
        this.editData = { ...blog };
        this.showEditModal = true;
    }
}">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold text-dark-wool">Semua Artikel</h3>
        <button @click="openCreate()" class="btn-premium flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tulis Artikel</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-5xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Artikel (ID / EN)</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Penulis</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Status</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($blogs as $blog)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $blog->imageUrl('https://via.placeholder.com/50') }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
                                <div>
                                    <p class="font-bold text-dark-wool line-clamp-1">{{ $blog->title }}</p>
                                    <p class="text-[10px] text-gray-400 line-clamp-1 italic font-medium">EN: {{ $blog->title_en ?? '-' }}</p>
                                    <p class="text-[9px] font-mono text-gray-300 mt-1">{{ $blog->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-bold text-dark-wool">{{ $blog->author->name }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $blog->status === 'published' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end space-x-3">
                                <button @click="openEdit({{ json_encode($blog) }})" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada artikel blog yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $blogs->links() }}
    </div>

    <!-- Create Modal -->
    <template x-teleport="body">
        <div x-show="showCreateModal" class="fixed inset-0 z-[200000] flex items-start sm:items-center justify-center p-4 sm:p-6 overflow-y-auto">

            <div class="absolute inset-0 bg-dark-wool/60 backdrop-blur-md" @click="showCreateModal = false"></div>

            <div class="relative bg-white w-full max-w-5xl rounded-[2rem] sm:rounded-[3rem] shadow-2xl p-6 sm:p-10 animate__animated animate__zoomIn animate__faster my-auto max-h-[95vh] sm:max-h-[90vh] overflow-hidden flex flex-col">

                <div class="absolute top-0 left-0 w-full h-2 bg-soft-rose"></div>

                <div class="flex justify-between items-center mb-6 shrink-0">
                    <h3 class="text-xl sm:text-2xl font-serif font-bold text-dark-wool flex items-center">
                        <i class="fas fa-pen-nib mr-3 text-soft-rose"></i> Tulis Artikel Baru
                    </h3>
                    <button @click="showCreateModal = false" class="text-gray-400 hover:text-dark-wool transition-colors p-2">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col min-h-0 flex-1">
                    @csrf

                    <div class="flex-1 overflow-y-auto pr-1 sm:pr-2 space-y-6 content-area">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Judul Artikel (ID)</label>
                                    <input type="text" name="title" required class="input-premium py-2.5 text-xs" placeholder="Judul bahasa Indonesia...">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Judul Artikel (EN)</label>
                                    <input type="text" name="title_en" required class="input-premium py-2.5 text-xs" placeholder="English title...">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Slug (URL)</label>
                                        <input type="text" name="slug" required class="input-premium py-2.5 text-xs font-mono" placeholder="judul-artikel-anda">
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Status Publikasi</label>
                                        <select name="status" required class="input-premium py-2.5 text-xs">
                                            <option value="draft">Draft (Simpan sebagai Draf)</option>
                                            <option value="published">Published (Publikasikan)</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Gambar Sampul</label>
                                    <x-ui.image-upload
                                        name="image_file"
                                        title="Klik atau seret gambar sampul"
                                        empty-text="Opsional"
                                        compact />
                                </div>
                            </div>

                            <div class="space-y-5 flex flex-col">
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Konten Artikel (ID)</label>
                                    <textarea name="content" required class="input-premium py-3 px-5 text-xs h-[140px] lg:h-[160px] resize-none leading-relaxed" placeholder="Ceritakan kehangatan di balik rajutan ini..."></textarea>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Konten Artikel (EN)</label>
                                    <textarea name="content_en" required class="input-premium py-3 px-5 text-xs h-[140px] lg:h-[160px] resize-none leading-relaxed" placeholder="Tell the story of this knit in English..."></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-6 flex gap-4 border-t border-gray-100 pt-4 shrink-0">
                        <button type="submit" class="flex-[2] btn-primary py-3 text-sm font-medium">Simpan Artikel</button>
                        <button type="button" @click="showCreateModal = false" class="flex-1 btn-secondary py-3 text-sm font-medium">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-[200000] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/60 backdrop-blur-md" @click="showEditModal = false"></div>
            <div class="relative bg-white w-full max-w-5xl rounded-[3rem] shadow-2xl p-10 animate__animated animate__zoomIn animate__faster my-auto overflow-y-auto max-h-[90vh]">
                <div class="absolute top-0 left-0 w-full h-2 bg-soft-rose"></div>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-serif font-bold text-dark-wool flex items-center">
                        <i class="fas fa-edit mr-3 text-soft-rose"></i> Edit Artikel
                    </h3>
                    <button @click="showEditModal = false" class="text-gray-400 hover:text-dark-wool transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form :action="`/admin/blogs/${editData.id}`" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column: Details & Cover -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Judul Artikel (ID)</label>
                                <input type="text" name="title" x-model="editData.title" required class="input-premium py-2.5 text-xs" placeholder="Judul bahasa Indonesia...">
                                <p class="mt-2 text-[10px] text-gray-400">Judul utama artikel untuk pembaca Indonesia.</p>
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Judul Artikel (EN)</label>
                                <input type="text" name="title_en" x-model="editData.title_en" required class="input-premium py-2.5 text-xs" placeholder="English title...">
                                <p class="mt-2 text-[10px] text-gray-400">Versi judul untuk tampilan bahasa Inggris.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Slug (URL)</label>
                                    <input type="text" name="slug" x-model="editData.slug" required class="input-premium py-2.5 text-xs font-mono" placeholder="judul-artikel-anda">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Status Publikasi</label>
                                    <select name="status" x-model="editData.status" required class="input-premium py-2.5 text-xs">
                                        <option value="draft">Draft (Simpan sebagai Draf)</option>
                                        <option value="published">Published (Publikasikan)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Gambar Sampul</label>
                                <div class="mb-3 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 h-28 flex items-center justify-center relative">
                                    <template x-if="editData.image">
                                        <img :src="editData.image.startsWith('http') ? editData.image : `/${editData.image}`" class="w-full h-full object-cover" alt="Preview">
                                    </template>
                                    <template x-if="!editData.image">
                                        <p class="text-[8px] font-bold text-gray-300 uppercase tracking-widest">Belum ada gambar sampul</p>
                                    </template>
                                </div>
                                <x-ui.image-upload
                                    name="image_file"
                                    title="Klik atau seret gambar baru untuk mengganti sampul"
                                    empty-text="Ganti hanya jika ingin memperbarui gambar"
                                    compact />
                            </div>
                        </div>

                        <!-- Right Column: Dual Content -->
                        <div class="space-y-5 flex flex-col h-full">
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Konten Artikel (ID)</label>
                                <textarea name="content" x-model="editData.content" required class="input-premium py-3 px-5 text-xs h-[138px] resize-none leading-relaxed" placeholder="Ceritakan detail, karakter, dan cerita di balik pakaian ini..."></textarea>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Konten Artikel (EN)</label>
                                <textarea name="content_en" x-model="editData.content_en" required class="input-premium py-3 px-5 text-xs h-[138px] resize-none leading-relaxed" placeholder="Tell the story of this garment in English..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-4 border-t border-gray-50 pt-6">
                        <button type="submit" class="flex-[2] btn-primary py-3">Perbarui Artikel</button>
                        <button type="button" @click="showEditModal = false" class="flex-1 btn-secondary py-3">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection