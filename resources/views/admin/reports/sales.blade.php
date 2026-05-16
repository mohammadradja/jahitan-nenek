@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Laporan Penjualan')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Filters -->
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 mb-10">
        <form action="{{ route(auth()->user()->role . '.reports.sales') }}" method="GET" class="flex flex-wrap gap-6 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="input-premium">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="input-premium">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Filter Laporan</button>
                <a href="{{ route(auth()->user()->role . '.reports.sales') }}" class="btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose mb-6 shadow-inner">
                <i class="fas fa-shopping-cart text-sm"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Total Transaksi</p>
                <h3 class="text-3xl font-bold text-dark-wool">{{ number_format($stats['total_sales'], 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-dark-wool p-8 rounded-[2.5rem] shadow-2xl text-white flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-soft-rose mb-6 backdrop-blur-md">
                    <i class="fas fa-coins text-sm"></i>
                </div>
                <p class="text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Total Pendapatan</p>
                <h3 class="text-3xl font-serif font-bold tracking-tight">Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            </div>
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-soft-rose/10 rounded-full blur-3xl"></div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 mb-6 shadow-inner">
                <i class="fas fa-chart-line text-sm"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Rata-rata Penjualan</p>
                <h3 class="text-3xl font-bold text-dark-wool">Rp{{ number_format($stats['avg_ticket'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Report Table Placeholder / Export Section -->
    <div class="bg-gray-50 p-12 rounded-[4rem] border border-dashed border-gray-200 text-center">
        <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-dark-wool mx-auto mb-6 shadow-sm">
            <i class="fas fa-file-pdf text-2xl"></i>
        </div>
        <h4 class="text-xl font-bold text-dark-wool mb-2">Ekspor Laporan Penjualan</h4>
        <p class="text-gray-400 text-sm mb-8 max-w-md mx-auto">Unduh rincian transaksi lengkap untuk periode ini dalam format PDF atau Excel.</p>
        <div class="flex justify-center gap-4">
            <button class="btn-primary">Download PDF</button>
            <button class="btn-secondary">Download Excel</button>
        </div>
    </div>
</div>
@endsection
