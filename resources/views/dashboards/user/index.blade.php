@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation (Left) -->
        <div class="lg:col-span-1">
            @include('dashboards.user.partials.sidebar')
        </div>

        <!-- Main Content (Right) -->
        <div class="lg:col-span-3">
            <!-- Extreme Compact Summary Stats -->
            <div class="flex items-center gap-3 mb-6">
                <div class="flex-1 bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-6 h-6 bg-soft-rose/10 rounded-lg flex items-center justify-center text-soft-rose mb-1">
                        <i class="fas fa-shopping-bag text-[8px]"></i>
                    </div>
                    <p class="text-[6px] font-bold text-gray-300 uppercase tracking-widest mb-0.5">Total</p>
                    <h4 class="text-xs font-bold text-dark-wool">{{ $orders->count() }}</h4>
                </div>
                <div class="flex-1 bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-6 h-6 bg-yellow-500/10 rounded-lg flex items-center justify-center text-yellow-500 mb-1">
                        <i class="fas fa-clock text-[8px]"></i>
                    </div>
                    <p class="text-[6px] font-bold text-gray-300 uppercase tracking-widest mb-0.5">Proses</p>
                    <h4 class="text-xs font-bold text-dark-wool">{{ $orders->where('status', 'processing')->count() }}</h4>
                </div>
                <div class="flex-1 bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-6 h-6 bg-green-500/10 rounded-lg flex items-center justify-center text-green-500 mb-1">
                        <i class="fas fa-check-circle text-[8px]"></i>
                    </div>
                    <p class="text-[6px] font-bold text-gray-300 uppercase tracking-widest mb-0.5">Selesai</p>
                    <h4 class="text-xs font-bold text-dark-wool">{{ $orders->where('status', 'completed')->count() }}</h4>
                </div>
                <div class="flex-1 bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-6 h-6 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-500 mb-1">
                        <i class="fas fa-star text-[8px]"></i>
                    </div>
                    <p class="text-[6px] font-bold text-gray-300 uppercase tracking-widest mb-0.5">Points</p>
                    <h4 class="text-xs font-bold text-dark-wool">{{ number_format(auth()->user()->loyalty_points) }}</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-serif font-bold text-dark-wool">Rekomendasi Untukmu</h3>
                    <div class="text-[9px] font-bold text-soft-rose uppercase tracking-widest">
                        Pilihan Spesial
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recommendations as $rec)
                        <div class="group">
                            <div class="aspect-square rounded-2xl overflow-hidden mb-3 relative">
                                <img src="{{ $rec->imageUrl('https://via.placeholder.com/300') }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                                <div class="absolute inset-0 bg-dark-wool/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <a href="{{ route('product.show', $rec->slug) }}" class="btn-premium px-4 py-2 text-[8px]">Lihat Detail</a>
                                </div>
                            </div>
                            <h5 class="text-xs font-bold text-dark-wool line-clamp-1">{{ $rec->name }}</h5>
                            <p class="text-[10px] text-soft-rose font-bold">{{ $rec->formattedEstimatedPrice() }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-serif font-bold text-dark-wool">Riwayat Pesanan</h3>
                    <div class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">
                        Total {{ $orders->count() }}
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-4 text-[9px] font-bold uppercase tracking-widest text-gray-400">Order ID</th>
                                <th class="px-8 py-4 text-[9px] font-bold uppercase tracking-widest text-gray-400">Tanggal</th>
                                <th class="px-8 py-4 text-[9px] font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                                <tr class="group hover:bg-gray-50/30 transition-colors">
                                    <td class="px-8 py-5 font-mono font-bold text-dark-wool text-sm">#{{ $order->id }}</td>
                                    <td class="px-8 py-5 text-gray-400 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-8 py-5 text-right">
                                        <a href="{{ route('order.track', ['order_id' => $order->id, 'email' => $order->customer_email]) }}" 
                                           class="inline-flex items-center space-x-2 text-[10px] font-bold text-dark-wool hover:text-soft-rose transition-colors">
                                            <span>Lacak</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-20 text-center">
                                        <p class="text-sm font-bold text-gray-300">Belum ada pesanan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-4 border-t border-gray-50 bg-gray-50/30">
                    <div class="flex items-center justify-between">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            Showing {{ $orders->firstItem() }}-{{ $orders->lastItem() }} of {{ $orders->total() }}
                        </div>
                        <div class="flex space-x-1">
                            {{ $orders->links('vendor.pagination.premium') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
