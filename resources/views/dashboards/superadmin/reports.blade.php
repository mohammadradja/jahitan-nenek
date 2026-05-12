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
            <button class="bg-green-50 text-green-600 px-4 py-1.5 rounded-lg text-[10px] font-bold flex items-center gap-2 hover:bg-green-600 hover:text-white transition-all">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button class="bg-red-50 text-red-600 px-4 py-1.5 rounded-lg text-[10px] font-bold flex items-center gap-2 hover:bg-red-600 hover:text-white transition-all">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-dark-wool p-5 rounded-xl text-white shadow-lg">
            <p class="text-[8px] font-bold text-white/50 uppercase tracking-widest mb-1">Paid Revenue</p>
            <h3 class="text-xl font-bold">Rp{{ number_format(\App\Models\Order::where('payment_status', 'paid')->sum('total_price'), 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Orders Count</p>
            <h3 class="text-xl font-bold text-dark-wool">{{ \App\Models\Order::count() }}</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Avg. Ticket</p>
            <h3 class="text-xl font-bold text-dark-wool">Rp{{ number_format(\App\Models\Order::where('payment_status', 'paid')->avg('total_price') ?? 0, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stock Level</p>
            <h3 class="text-xl font-bold text-dark-wool">{{ \App\Models\Product::sum('stock') }} <span class="text-[10px] font-medium">Items</span></h3>
        </div>
    </div>

    <!-- Dynamic Modular Reports -->
    <div class="space-y-8">
        @if($type === 'all' || $type === 'sales')
            <div class="bg-white p-6 rounded-2xl border border-gray-50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-dark-wool uppercase tracking-widest">Penjualan & Revenue</h3>
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
