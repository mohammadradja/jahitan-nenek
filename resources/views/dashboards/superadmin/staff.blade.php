@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Manajemen Staf & Admin')

@section('dashboard_content')
<div class="space-y-8" x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    editData: { id: '', name: '', email: '', role: '' },
    openEdit(user) {
        this.editData = { ...user };
        this.showEditModal = true;
    }
}">
    <!-- Header Action -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-dark-wool">Daftar Pengguna Sistem</h3>
        </div>
        <button @click="showCreateModal = true" class="btn-primary">
            <i class="fas fa-plus mr-2 text-[8px]"></i>
            <span>Tambah Admin Baru</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Role</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($staff as $user)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-xl bg-soft-rose/10 flex items-center justify-center text-soft-rose font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-dark-wool">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-gray-500 text-sm">{{ $user->email }}</td>
                            <td class="px-10 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-widest {{ $user->role === 'superadmin' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $user->role }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-center">
                                    <span class="flex items-center text-[10px] font-bold text-green-500 uppercase tracking-widest">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>
                                        Aktif
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button @click="openEdit({{ json_encode($user) }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:text-soft-rose hover:bg-soft-rose/5 transition-all">
                                        <i class="fas fa-edit text-xs"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('superadmin.staff.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akun staf ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:text-red-600 hover:bg-red-100 transition-all">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-10 py-12 text-center text-gray-400 italic">Data staf tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $staff->withQueryString()->links() }}
    </div>

    <!-- Create Modal -->
    <template x-if="showCreateModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="showCreateModal = false"></div>
            <div class="relative bg-white w-full max-w-lg rounded-5xl shadow-2xl p-10 animate__animated animate__zoomIn animate__faster my-auto">
                <div class="mb-8">
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Tambah Staf Baru</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Berikan akses administratif sistem</p>
                </div>
                
                <form action="{{ route('superadmin.staff.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="input-premium py-3 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                        <input type="email" name="email" required class="input-premium py-3 text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                            <input type="password" name="password" required class="input-premium py-3 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required class="input-premium py-3 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Role Akses</label>
                        <select name="role" required class="input-premium py-3 text-sm appearance-none">
                            <option value="admin">Admin (Operasional)</option>
                            <option value="superadmin">Superadmin (Global)</option>
                        </select>
                    </div>

                    <div class="pt-6 flex justify-center space-x-4">
                        <button type="submit" class="btn-primary">Simpan Staf</button>
                        <button type="button" @click="showCreateModal = false" class="btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 overflow-y-auto">
            <div class="absolute inset-0 bg-dark-wool/40 backdrop-blur-sm" @click="showEditModal = false"></div>
            <div class="relative bg-white w-full max-w-lg rounded-5xl shadow-2xl p-10 animate__animated animate__zoomIn animate__faster my-auto">
                <div class="mb-8">
                    <h3 class="text-2xl font-serif font-bold text-dark-wool">Edit Data Staf</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Perbarui informasi atau akses pengguna</p>
                </div>
                
                <form :action="`/superadmin/staff/${editData.id}`" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" x-model="editData.name" required class="input-premium py-3 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                        <input type="email" name="email" x-model="editData.email" required class="input-premium py-3 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Role Akses</label>
                        <select name="role" x-model="editData.role" required class="input-premium py-3 text-sm appearance-none">
                            <option value="admin">Admin (Operasional)</option>
                            <option value="superadmin">Superadmin (Global)</option>
                        </select>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-3xl space-y-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ganti Password (Opsional)</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password Baru</label>
                                <input type="password" name="password" class="input-premium py-2 text-xs">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Konfirmasi</label>
                                <input type="password" name="password_confirmation" class="input-premium py-2 text-xs">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-center space-x-4">
                        <button type="submit" class="btn-accent">Perbarui Staf</button>
                        <button type="button" @click="showEditModal = false" class="btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
