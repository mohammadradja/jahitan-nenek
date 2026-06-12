@extends('layouts.dashboard')

@section('role_name', 'Superadmin')
@section('page_title', 'Laporan & Statistik Global')

@section('dashboard_content')
<div class="space-y-8">
    @php
        $type = request('type', 'all');
    @endphp

    <!-- Report Header & Controls -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">
                Laporan: <span class="text-soft-rose">{{ ucfirst($type) }}</span>
            </h3>
            <p class="text-[10px] text-gray-400 mt-1">Rentang: {{ date('01 M Y') }} - {{ date('d M Y') }}</p>
        </div>
        <div class="flex gap-2">
            <button class="bg-green-50 text-green-600 px-5 py-2.5 rounded-xl text-[10px] font-bold flex items-center gap-2 hover:bg-green-600 hover:text-white transition-all border border-green-100">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button class="bg-red-50 text-red-600 px-5 py-2.5 rounded-xl text-[10px] font-bold flex items-center gap-2 hover:bg-red-600 hover:text-white transition-all border border-red-100">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-dark-wool p-8 rounded-[2.5rem] shadow-xl text-white relative overflow-hidden group border border-white/10">
            <div class="relative z-10">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-6 backdrop-blur-md">
                    <i class="fas fa-dollar-sign text-soft-rose"></i>
                </div>
                <p class="text-[9px] font-bold text-white/50 uppercase tracking-[0.2em] mb-2">Pendapatan Dibayar</p>
                <h3 class="text-2xl font-bold tracking-tight">Rp{{ number_format(\App\Models\Order::where('payment_status', 'paid')->sum('total_price'), 0, ',', '.') }}</h3>
            </div>
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-soft-rose/5 rounded-full blur-2xl group-hover:bg-soft-rose/10 transition-all duration-700"></div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-soft-rose transition-all duration-500">
            <div class="w-10 h-10 bg-soft-rose/10 rounded-xl flex items-center justify-center text-soft-rose mb-6 group-hover:bg-soft-rose group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-shopping-bag text-xs"></i>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Jumlah Pesanan</p>
            <h3 class="text-2xl font-bold text-dark-wool tracking-tight">{{ number_format(\App\Models\Order::count(), 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-blue-500 transition-all duration-500">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-receipt text-xs"></i>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Rata-rata Transaksi</p>
            <h3 class="text-2xl font-bold text-dark-wool tracking-tight">Rp{{ number_format(\App\Models\Order::where('payment_status', 'paid')->avg('total_price') ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-emerald-500 transition-all duration-500">
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-boxes text-xs"></i>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Level Stok</p>
            <h3 class="text-2xl font-bold text-dark-wool tracking-tight">{{ number_format(\App\Models\Product::sum('stock'), 0, ',', '.') }} <span class="text-[10px] font-bold text-gray-300 ml-1">ITEM</span></h3>
        </div>
    </div>

    <!-- Dynamic Modular Reports -->
    <div class="space-y-8">
        @if($type === 'all' || $type === 'sales')
            <div class="bg-white p-6 rounded-2xl border border-gray-50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Penjualan & Pendapatan</h3>
                </div>
                @include('dashboards.superadmin.reports.sales')
            </div>
        @endif

        @if($type === 'all' || $type === 'stock')
            <div class="bg-white p-6 rounded-2xl border border-gray-50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Inventaris & Stok</h3>
                </div>
                @include('dashboards.superadmin.reports.inventory')
            </div>
        @endif
    </div>
</div>
</div>
@endsection
