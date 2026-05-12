@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Daftar Pesanan')

@section('dashboard_content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold text-dark-wool">Riwayat Transaksi</h3>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-100 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all flex items-center space-x-2 shadow-sm">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
            <button class="bg-white border border-gray-100 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all flex items-center space-x-2 shadow-sm">
                <i class="fas fa-file-export"></i>
                <span>Ekspor</span>
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-5xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Order ID</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Total</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Status Pembayaran</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Status Pesanan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 font-mono font-bold text-dark-wool">#{{ $order->id }}</td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-dark-wool">{{ $order->user->name ?? 'Guest' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $order->user->email ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6 font-bold text-soft-rose">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-yellow-50 text-yellow-600' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-blue-50 text-blue-600">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-dark-wool hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-400 italic">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
@endsection
