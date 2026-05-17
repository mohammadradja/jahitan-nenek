@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Laporan Inventaris')

@section('dashboard_content')
<div class="space-y-8">


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
