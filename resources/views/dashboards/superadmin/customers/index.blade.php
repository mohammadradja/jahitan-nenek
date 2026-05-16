@extends('layouts.dashboard')

@section('role_name', 'Super Admin')
@section('page_title', 'Data Pelanggan Terdaftar')

@section('dashboard_content')
<div class="space-y-8">
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10">
        <form action="{{ route('superadmin.customers.index') }}" method="GET" class="space-y-6">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Cari Pelanggan</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-soft-rose/20 transition-all" placeholder="Nama atau alamat email...">
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-premium px-8 py-4 text-xs">Cari</button>
                    <a href="{{ route('superadmin.customers.index') }}" class="px-8 py-4 bg-gray-100 text-dark-wool font-bold text-xs rounded-2xl hover:bg-gray-200 transition-all">Reset</a>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Export Data Pelanggan</p>
                <div class="flex gap-3">
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="flex items-center px-6 py-2.5 bg-green-50 text-green-600 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-green-600 hover:text-white transition-all border border-green-100">
                        <i class="fas fa-file-excel mr-2"></i> Excel (CSV)
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" target="_blank" class="flex items-center px-6 py-2.5 bg-red-50 text-red-600 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all border border-red-100">
                        <i class="fas fa-file-pdf mr-2"></i> PDF (Print)
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
