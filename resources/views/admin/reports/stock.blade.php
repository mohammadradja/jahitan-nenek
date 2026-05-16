@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Laporan Inventaris')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 shadow-inner">
                <i class="fas fa-boxes-stacked text-xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Item</p>
                <h4 class="text-2xl font-bold text-dark-wool">{{ number_format($stats['total_items'], 0, ',', '.') }} <span class="text-xs font-normal text-gray-300 ml-1">Unit</span></h4>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6">
            <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 shadow-inner">
                <i class="fas fa-vault text-xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nilai Inventaris</p>
                <h4 class="text-2xl font-bold text-dark-wool">Rp{{ number_format($stats['total_value'], 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6 {{ $stats['low_stock_count'] > 0 ? 'border-red-100' : '' }}">
            <div class="w-16 h-16 {{ $stats['low_stock_count'] > 0 ? 'bg-red-50 text-red-500' : 'bg-green-50 text-green-500' }} rounded-2xl flex items-center justify-center shadow-inner">
                <i class="fas fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stok Menipis</p>
                <h4 class="text-2xl font-bold {{ $stats['low_stock_count'] > 0 ? 'text-red-500' : 'text-green-500' }}">{{ $stats['low_stock_count'] }} <span class="text-xs font-normal text-gray-300 ml-1">Produk</span></h4>
            </div>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50">
            <h4 class="text-xl font-bold text-dark-wool">Status Stok Produk</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Produk</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Stok</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Nilai Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden border border-gray-100">
                                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/50' }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-bold text-dark-wool">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-10 py-6 text-center">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $product->stock < 5 ? 'bg-red-50 text-red-500' : 'bg-gray-100 text-dark-wool' }}">
                                    {{ $product->stock }} Unit
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right font-bold text-dark-wool">
                                Rp{{ number_format($product->price * $product->stock, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
