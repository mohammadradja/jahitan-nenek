@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Manajemen Staf & Admin')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold text-dark-wool">Daftar Pengguna Sistem</h3>
        <button class="btn-premium px-4 py-1.5 text-[10px]">
            <i class="fas fa-plus mr-2"></i> Tambah Admin Baru
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Role</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach(\App\Models\User::whereIn('role', ['admin', 'superadmin'])->get() as $user)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=E8A0BF&color=fff" class="w-10 h-10 rounded-xl" alt="">
                                    <span class="font-bold text-dark-wool">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-gray-500 text-sm">{{ $user->email }}</td>
                            <td class="px-10 py-6">
                                <span class="px-4 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-widest {{ $user->role === 'superadmin' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-10 py-6">
                                <span class="flex items-center text-xs font-bold text-green-500">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    Aktif
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button class="text-gray-400 hover:text-soft-rose transition-colors"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
