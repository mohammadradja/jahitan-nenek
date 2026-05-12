@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Manajemen Ukuran Pelanggan')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold text-dark-wool">Database Ukuran</h3>
        <a href="{{ route('admin.measurements.create') }}" class="btn-premium flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Ukuran Baru</span>
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-5xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Chest</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Waist</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Hip</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Shoulder</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($measurements as $measurement)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-bold text-dark-wool">{{ $measurement->user->name }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $measurement->user->email }}</p>
                            </td>
                            <td class="px-8 py-6 text-center font-bold text-dark-wool">{{ $measurement->chest ?? '-' }} cm</td>
                            <td class="px-8 py-6 text-center font-bold text-dark-wool">{{ $measurement->waist ?? '-' }} cm</td>
                            <td class="px-8 py-6 text-center font-bold text-dark-wool">{{ $measurement->hip ?? '-' }} cm</td>
                            <td class="px-8 py-6 text-center font-bold text-dark-wool">{{ $measurement->shoulder ?? '-' }} cm</td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('admin.measurements.edit', $measurement->id) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.measurements.destroy', $measurement->id) }}" method="POST" onsubmit="return confirm('Hapus data ukuran ini?')">
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
                            <td colspan="6" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data ukuran pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $measurements->links() }}
    </div>
</div>
@endsection
