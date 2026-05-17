@extends('layouts.dashboard')

@section('role_name', 'Super Admin')
@section('page_title', 'Data Pelanggan Terdaftar')

@section('dashboard_content')
<div class="space-y-8">
    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10">
        <form action="{{ route('superadmin.customers.index') }}" method="GET">
            <div class="flex flex-col lg:flex-row gap-6 items-end">
                <div class="flex-1 w-full">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2.5">Cari Pelanggan</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="text" name="search" value="{{ request('search') }}" class="input-premium pl-12 py-3 text-sm w-full animate-none" placeholder="Cari berdasarkan nama atau email...">
                    </div>
                </div>
                <div class="flex flex-wrap gap-2.5 shrink-0 w-full lg:w-auto justify-end">
                    <button type="submit" class="btn-primary btn-sm flex items-center gap-2">
                        <i class="fas fa-search text-[10px]"></i>
                        <span>Cari</span>
                    </button>
                    <a href="{{ route('superadmin.customers.index') }}" class="btn-secondary btn-sm flex items-center gap-2">
                        <i class="fas fa-sync text-[10px]"></i>
                        <span>Reset</span>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn-success btn-sm flex items-center gap-2">
                        <i class="fas fa-file-excel text-[10px]"></i>
                        <span>Excel</span>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" target="_blank" class="btn-danger btn-sm flex items-center gap-2">
                        <i class="fas fa-file-pdf text-[10px]"></i>
                        <span>PDF</span>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center bg-white">
            <h4 class="text-xl font-bold text-dark-wool">Daftar Pelanggan Terdaftar</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Pesanan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kontak</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bergabung</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-vintage-cream flex items-center justify-center font-bold text-soft-rose shadow-sm border border-white">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-dark-wool text-sm">{{ $customer->name }}</p>
                                        <p class="text-[10px] font-mono text-gray-400 tracking-wider">ID: #{{ $customer->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex flex-col items-center">
                                    <span class="px-4 py-1.5 rounded-xl bg-gray-50 text-dark-wool font-bold text-[10px] border border-gray-100">
                                        {{ $customer->orders_count ?? 0 }} Pesanan
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <p class="text-xs font-bold text-dark-wool">{{ $customer->email }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $customer->phone ?? 'Belum ada nomor' }}</p>
                            </td>
                            <td class="px-10 py-6">
                                <p class="text-xs font-bold text-dark-wool">{{ $customer->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $customer->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-end space-x-2">
                                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </button>
                                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-dark-wool hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-ellipsis-h text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-10 py-20 text-center">
                                <div class="flex flex-col items-center opacity-30">
                                    <i class="fas fa-user-slash text-5xl mb-4"></i>
                                    <p class="font-serif font-bold text-xl italic">Belum ada pelanggan terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-10 py-6 bg-gray-50/50 border-t border-gray-50">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
