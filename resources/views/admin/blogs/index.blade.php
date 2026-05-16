@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Catatan Blog')

@section('dashboard_content')
<div x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    editData: { id: '', title: '', slug: '', content: '', image_url: '' },
    openEdit(blog) {
        this.editData = { ...blog };
        this.showEditModal = true;
    }
}">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-xl font-bold text-dark-wool">Semua Artikel</h3>
        <button @click="showCreateModal = true" class="btn-premium flex items-center space-x-2">
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
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Artikel</th>
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
                                    <img src="{{ $blog->image_url ?? 'https://via.placeholder.com/50' }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
                                    <div>
                                        <p class="font-bold text-dark-wool line-clamp-1">{{ $blog->title }}</p>
                                        <p class="text-[10px] font-mono text-gray-400">{{ $blog->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-dark-wool">{{ $blog->author->name }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $blog->published_at ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-400' }}">
                                    {{ $blog->published_at ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end space-x-3">
                                    <button @click="openEdit({{ json_encode($blog) }})" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
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
    <template x-if="showCreateModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/60 backdrop-blur-md" @click="showCreateModal = false"></div>
            <div class="relative bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl p-12 animate__animated animate__zoomIn animate__faster my-auto overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-soft-rose"></div>
                <h3 class="text-3xl font-serif font-bold mb-10 text-dark-wool">Tulis Artikel Baru</h3>
                <form action="{{ route('admin.blogs.store') }}" method="POST" x-data="{ imgUrl: '' }">
                    @csrf
                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Judul Artikel</label>
                                <input type="text" name="title" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm font-bold" placeholder="Judul yang memikat...">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug (URL)</label>
                                <input type="text" name="slug" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm font-mono" placeholder="judul-artikel-anda">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Gambar Sampul (URL)</label>
                            <div class="relative group">
                                <input type="text" name="image_url" x-model="imgUrl" class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm pr-12" placeholder="https://images.unsplash.com/...">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                    <i class="fas fa-link"></i>
                                </div>
                            </div>
                            <!-- Image Preview & Dropzone -->
                            <div class="mt-4 rounded-3xl overflow-hidden bg-gray-50 border-2 border-dashed border-gray-100 h-48 flex items-center justify-center relative transition-all hover:border-soft-rose/50 group/dropzone"
                                 @dragover.prevent="$el.classList.add('border-soft-rose', 'bg-soft-rose/5')"
                                 @dragleave.prevent="$el.classList.remove('border-soft-rose', 'bg-soft-rose/5')"
                                 @drop.prevent="$el.classList.remove('border-soft-rose', 'bg-soft-rose/5'); alert('Fitur upload langsung akan segera hadir. Gunakan URL gambar untuk saat ini.')">
                                <template x-if="imgUrl">
                                    <img :src="imgUrl" class="w-full h-full object-cover transition-all duration-700 hover:scale-105" alt="Preview">
                                </template>
                                <template x-if="!imgUrl">
                                    <div class="text-center group-hover/dropzone:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-200 mb-2 group-hover/dropzone:text-soft-rose transition-colors"></i>
                                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Klik atau Drag & Drop Gambar</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Konten Artikel</label>
                            <textarea name="content" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-3xl p-6 text-sm h-48 resize-none leading-relaxed" placeholder="Ceritakan kehangatan di balik rajutan ini..."></textarea>
                        </div>

                        <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_published" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-soft-rose"></div>
                                <span class="ml-3 text-[10px] font-bold text-dark-wool uppercase tracking-widest">Publikasikan Langsung</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-12 flex gap-4">
                        <button type="submit" class="flex-[2] bg-dark-wool text-white py-5 rounded-2xl font-bold uppercase tracking-[0.2em] text-xs hover:bg-dark-wool/90 transition-all shadow-xl shadow-dark-wool/10">Simpan Artikel</button>
                        <button type="button" @click="showCreateModal = false" class="flex-1 bg-gray-50 text-dark-wool py-5 rounded-2xl font-bold uppercase tracking-[0.2em] text-xs hover:bg-gray-100 transition-all border border-gray-100">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/60 backdrop-blur-md" @click="showEditModal = false"></div>
            <div class="relative bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl p-12 animate__animated animate__zoomIn animate__faster my-auto overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-soft-rose"></div>
                <h3 class="text-3xl font-serif font-bold mb-10 text-dark-wool">Edit Artikel</h3>
                <form :action="`/admin/blogs/${editData.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Judul Artikel</label>
                                <input type="text" name="title" x-model="editData.title" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm font-bold">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Slug (URL)</label>
                                <input type="text" name="slug" x-model="editData.slug" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm font-mono">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Gambar Sampul (URL)</label>
                            <div class="relative group">
                                <input type="text" name="image_url" x-model="editData.image" class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl p-4 text-sm pr-12">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                    <i class="fas fa-link"></i>
                                </div>
                            </div>
                            <!-- Image Preview & Dropzone -->
                            <div class="mt-4 rounded-3xl overflow-hidden bg-gray-50 border-2 border-dashed border-gray-100 h-48 flex items-center justify-center relative transition-all hover:border-soft-rose/50 group/dropzone"
                                 @dragover.prevent="$el.classList.add('border-soft-rose', 'bg-soft-rose/5')"
                                 @dragleave.prevent="$el.classList.remove('border-soft-rose', 'bg-soft-rose/5')"
                                 @drop.prevent="$el.classList.remove('border-soft-rose', 'bg-soft-rose/5'); alert('Fitur upload langsung akan segera hadir. Gunakan URL gambar untuk saat ini.')">
                                <template x-if="editData.image">
                                    <img :src="editData.image" class="w-full h-full object-cover transition-all duration-700 hover:scale-105" alt="Preview">
                                </template>
                                <template x-if="!editData.image">
                                    <div class="text-center group-hover/dropzone:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-200 mb-2 group-hover/dropzone:text-soft-rose transition-colors"></i>
                                        <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Klik atau Drag & Drop Gambar</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Konten Artikel</label>
                            <textarea name="content" x-model="editData.content" required class="input-premium w-full bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-3xl p-6 text-sm h-48 resize-none leading-relaxed"></textarea>
                        </div>

                        <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_published" value="1" class="sr-only peer" :checked="editData.published_at">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-soft-rose"></div>
                                <span class="ml-3 text-[10px] font-bold text-dark-wool uppercase tracking-widest">Publikasikan Langsung</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-12 flex gap-4">
                        <button type="submit" class="flex-[2] bg-soft-rose text-white py-5 rounded-2xl font-bold uppercase tracking-[0.2em] text-xs hover:bg-soft-rose/90 transition-all shadow-xl shadow-soft-rose/10">Perbarui Artikel</button>
                        <button type="button" @click="showEditModal = false" class="flex-1 bg-gray-50 text-dark-wool py-5 rounded-2xl font-bold uppercase tracking-[0.2em] text-xs hover:bg-gray-100 transition-all border border-gray-100">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
