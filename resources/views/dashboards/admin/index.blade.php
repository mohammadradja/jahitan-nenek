@extends('layouts.dashboard')

@section('role_name', 'Administrator')
@section('page_title', 'Ringkasan Operasional')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-soft-rose transition-all duration-300">
            <div class="w-12 h-12 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose mb-6 group-hover:scale-110 transition-transform">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pesanan</p>
            <h3 class="text-3xl font-bold text-dark-wool">{{ $stats['total_orders'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-yellow-500 transition-all duration-300">
            <div class="w-12 h-12 bg-yellow-500/10 rounded-2xl flex items-center justify-center text-yellow-500 mb-6 group-hover:scale-110 transition-transform">
                <i class="fas fa-clock"></i>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Menunggu</p>
            <h3 class="text-3xl font-bold text-dark-wool">{{ $stats['pending_orders'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-blue-500 transition-all duration-300">
            <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                <i class="fas fa-box"></i>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Produk Aktif</p>
            <h3 class="text-3xl font-bold text-dark-wool">{{ $stats['total_products'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-red-500 transition-all duration-300">
            <div class="w-12 h-12 bg-red-500/10 rounded-2xl flex items-center justify-center text-red-500 mb-6 group-hover:scale-110 transition-transform">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Stok Menipis</p>
            <h3 class="text-3xl font-bold text-dark-wool">{{ $stats['low_stock'] }}</h3>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-10">
                <h4 class="text-xl font-bold text-dark-wool">Tren Pesanan 7 Hari</h4>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-soft-rose"></div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pesanan</span>
                    </div>
                </div>
            </div>
            <div class="h-[300px] relative">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 flex flex-col justify-center text-center">
            <div class="mb-8">
                <i class="fas fa-chart-pie text-5xl text-dark-wool/10"></i>
            </div>
            <h4 class="text-xl font-serif font-bold text-dark-wool mb-4">Efisiensi Stok</h4>
            <p class="text-gray-400 text-sm mb-8 px-4">Periksa kembali inventori produk yang memiliki stok di bawah batas minimal.</p>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center justify-center py-4 px-8 rounded-2xl bg-dark-wool text-white font-bold hover:bg-dark-wool/90 transition-all">
                Kelola Produk
            </a>
        </div>
    </div>

    <!-- Latest Orders -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-xl font-bold text-dark-wool">Pesanan Terbaru</h4>
            <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-bold text-soft-rose uppercase tracking-widest hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($latest_orders as $order)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold">
                                        {{ substr($order->user->name ?? 'G', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-dark-wool">{{ $order->user->name ?? 'Guest' }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $order->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6 font-bold text-dark-wool">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-yellow-50 text-yellow-600' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <a href="#" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-dark-wool hover:bg-dark-wool hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chart_data['labels']) !!},
            datasets: [{
                label: 'Pesanan',
                data: {!! json_encode($chart_data['orders']) !!},
                borderColor: '#E8A0BF',
                backgroundColor: (context) => {
                    const ctx = context.chart.ctx;
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(232, 160, 191, 0.4)');
                    gradient.addColorStop(1, 'rgba(232, 160, 191, 0)');
                    return gradient;
                },
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 6,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#E8A0BF',
                pointBorderWidth: 3,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#E8A0BF',
                pointHoverBorderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 10 }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 10 }
                }
            }
        }
    });
</script>
@endpush
@endsection
