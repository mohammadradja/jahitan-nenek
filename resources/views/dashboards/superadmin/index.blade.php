@extends('layouts.dashboard')

@section('role_name', 'Super Admin')
@section('page_title', 'Laporan Sistem Global')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="lg:col-span-2 bg-dark-wool p-5 rounded-xl shadow-xl text-white relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[8px] font-bold text-white/50 uppercase tracking-[0.2em] mb-1">Total Pendapatan Global</p>
                <h2 class="text-2xl font-serif font-bold">Rp{{ number_format($stats['revenue'], 0, ',', '.') }}</h2>
                <div class="mt-2 flex items-center space-x-2">
                    <span class="flex items-center space-x-1 text-green-400 text-[9px] font-bold">
                        <i class="fas fa-arrow-trend-up"></i>
                        <span>+12.5%</span>
                    </span>
                    <span class="text-white/30 text-[8px] font-bold uppercase tracking-widest">Bulan ini</span>
                </div>
            </div>
            <i class="fas fa-coins absolute -right-4 -bottom-4 text-5xl text-white/5 group-hover:scale-105 transition-transform duration-700"></i>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 group hover:border-soft-rose transition-all duration-300">
            <div class="w-8 h-8 bg-soft-rose/10 rounded-lg flex items-center justify-center text-soft-rose mb-3 group-hover:scale-105 transition-transform">
                <i class="fas fa-users text-[10px]"></i>
            </div>
            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pengguna</p>
            <h3 class="text-xl font-bold text-dark-wool">{{ $stats['total_users'] }}</h3>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 group hover:border-blue-500 transition-all duration-300">
            <div class="w-8 h-8 bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-500 mb-3 group-hover:scale-105 transition-transform">
                <i class="fas fa-newspaper text-[10px]"></i>
            </div>
            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Artikel Blog</p>
            <h3 class="text-xl font-bold text-dark-wool">{{ $stats['total_blogs'] }}</h3>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-10">
                <h4 class="text-xl font-bold text-dark-wool">Pengunjung & Traffic</h4>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-soft-rose"></div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pengunjung</span>
                    </div>
                </div>
            </div>
            <div class="h-[350px] relative">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 bg-vintage-cream rounded-full flex items-center justify-center text-dark-wool mb-8">
                <i class="fas fa-globe text-3xl"></i>
            </div>
            <h4 class="text-xl font-serif font-bold text-dark-wool mb-4">Pengaturan Global</h4>
            <p class="text-gray-400 text-sm mb-8">Kelola integrasi API, metadata SEO, dan konfigurasi sistem utama.</p>
            <a href="{{ route('superadmin.settings.index') }}" class="w-full py-4 rounded-2xl bg-dark-wool text-white font-bold hover:bg-dark-wool/90 transition-all shadow-xl shadow-dark-wool/10">
                Akses Pengaturan
            </a>
        </div>
    </div>

    <!-- Latest Transactions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-xl font-bold text-dark-wool">Transaksi Global Terbaru</h4>
            <a href="#" class="text-[10px] font-bold text-soft-rose uppercase tracking-widest hover:underline">Download Laporan</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order ID</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nominal</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status Pembayaran</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($latest_orders as $order)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6 font-mono font-bold text-dark-wool">#{{ $order->id }}</td>
                            <td class="px-10 py-6">
                                <p class="font-bold text-dark-wool">{{ $order->user->name ?? 'Guest' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $order->user->email ?? '-' }}</p>
                            </td>
                            <td class="px-10 py-6 font-bold text-soft-rose">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">
                                {{ $order->created_at->diffForHumans() }}
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
    const ctx = document.getElementById('visitorChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chart_data['labels']) !!},
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($chart_data['visitors']) !!},
                backgroundColor: '#E8A0BF',
                hoverBackgroundColor: '#d488a8',
                borderRadius: 12,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E1E1E',
                    titleFont: { size: 12, weight: 'bold', family: 'serif' },
                    bodyFont: { size: 10, weight: 'bold' },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
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
