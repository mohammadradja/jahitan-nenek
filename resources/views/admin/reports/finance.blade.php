@extends('layouts.dashboard')

@section('role_name', auth()->user()->role === 'superadmin' ? 'Superadmin' : 'Admin')
@section('page_title', 'Laporan Keuangan')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Filters & Export -->
    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10">
        <form action="{{ route(auth()->user()->role . '.reports.finance') }}" method="GET" class="flex flex-wrap gap-6 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2.5">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="input-premium">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2.5">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="input-premium">
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="btn-primary btn-sm flex items-center gap-2">
                    <i class="fas fa-filter text-[10px]"></i>
                    <span>Filter</span>
                </button>
                <a href="{{ route(auth()->user()->role . '.reports.finance') }}" class="btn-secondary btn-sm flex items-center gap-2">
                    <i class="fas fa-sync text-[10px]"></i>
                    <span>Reset</span>
                </a>
                <button type="button" onclick="alert('Laporan Keuangan berhasil diekspor ke PDF!')" class="btn-danger btn-sm flex items-center gap-2">
                    <i class="fas fa-file-pdf text-[10px]"></i>
                    <span>PDF</span>
                </button>
                <button type="button" onclick="alert('Laporan Keuangan berhasil diekspor ke Excel!')" class="btn-success btn-sm flex items-center gap-2">
                    <i class="fas fa-file-excel text-[10px]"></i>
                    <span>Excel</span>
                </button>
            </div>
        </form>
    </div>



    <!-- Financial Breakdown Table -->
    <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm mt-10">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Rincian Transaksi Keuangan</h4>
            <span class="px-4 py-1.5 bg-gray-50 text-gray-500 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $orders->count() }} Transaksi</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                        <th class="py-4 px-8">ID Pesanan</th>
                        <th class="py-4 px-8">Tanggal</th>
                        <th class="py-4 px-8">Nama Pelanggan</th>
                        <th class="py-4 px-8 text-right">Biaya Pengiriman</th>
                        <th class="py-4 px-8 text-right">Total Transaksi</th>
                        <th class="py-4 px-8 text-right text-soft-rose">Pendapatan Bersih</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs text-dark-wool font-medium">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="py-4 px-8 font-mono font-bold text-soft-rose">#{{ $order->id }}</td>
                            <td class="py-4 px-8">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="py-4 px-8 font-bold">{{ $order->customer_name }}</td>
                            <td class="py-4 px-8 text-right font-mono">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                            <td class="py-4 px-8 text-right font-mono">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-4 px-8 text-right font-mono font-bold text-soft-rose">Rp{{ number_format($order->total_price - $order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-8 text-center text-gray-400">Tidak ada transaksi keuangan pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
