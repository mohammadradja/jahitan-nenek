@extends('layouts.dashboard')

@section('role_name', 'Super Admin')
@section('page_title', 'Global System Overview')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Top KPI Grid: Row 1 & Row 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Global Revenue Card -->
        <div class="lg:col-span-2 bg-dark-wool p-8 rounded-[2.5rem] shadow-2xl text-white relative overflow-hidden group border border-white/10">
            <div class="relative z-10 flex justify-between items-start h-full">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <p class="text-[10px] font-bold text-white/50 uppercase tracking-[0.4em] mb-4">Global Revenue</p>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold tracking-tight mb-2 break-all">Rp{{ number_format($stats['revenue'], 0, ',', '.') }}</h2>
                        <div class="mt-6 flex items-center space-x-3">
                            <span class="flex items-center space-x-1.5 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-[10px] font-bold">
                                <i class="fas fa-arrow-trend-up"></i>
                                <span>+12.5%</span>
                            </span>
                            <span class="text-white/30 text-[9px] font-bold uppercase tracking-widest">Growth vs Last Month</span>
                        </div>
                    </div>
                    <div class="mt-10 grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-[9px] font-bold text-white/40 uppercase tracking-widest mb-1">Average Order</p>
                            <p class="text-sm font-bold text-soft-rose">Rp{{ number_format($stats['avg_order_value'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-white/40 uppercase tracking-widest mb-1">Unpaid Amount</p>
                            <p class="text-sm font-bold">Rp{{ number_format($stats['revenue_pending'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-20 h-20 bg-white/10 rounded-[2rem] flex items-center justify-center backdrop-blur-md border border-white/5 shadow-2xl">
                    <i class="fas fa-wallet text-3xl text-soft-rose"></i>
                </div>
            </div>
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-soft-rose/10 rounded-full blur-[80px]"></div>
        </div>

        <!-- Visitor Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-blue-500 transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-globe text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Visitors</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_visitors'], 0, ',', '.') }}</h3>
                <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Across All Platforms</p>
            </div>
        </div>

        <!-- Customer Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-soft-rose transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose group-hover:bg-soft-rose group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-user-tag text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Customers</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_customers'], 0, ',', '.') }}</h3>
                <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">{{ number_format(($stats['total_customers'] / max($stats['total_users'], 1)) * 100, 1) }}% Conversion Rate</p>
            </div>
        </div>

        <!-- Total Orders Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-purple-500 transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-shopping-cart text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Orders</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_orders'], 0, ',', '.') }}</h3>
                <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Transactions processed</p>
            </div>
        </div>

        <!-- Inventory Health Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-amber-500 transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-boxes text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Inventory Health</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_products'], 0, ',', '.') }} SKU</h3>
                <p class="text-[9px] {{ $stats['low_stock'] > 0 ? 'text-red-500' : 'text-gray-400' }} mt-2 font-bold uppercase tracking-widest">
                    {{ $stats['low_stock'] }} Items Low Stock
                </p>
            </div>
        </div>

        <!-- Inventory Asset Valuation Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-emerald-500 transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-coins text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Asset Valuation</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight break-all">Rp{{ number_format($stats['inventory_value'], 0, ',', '.') }}</h3>
                <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Total Inventory Value</p>
            </div>
        </div>

        <!-- Blog & CMS Activity Stats -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-rose-500 transition-all duration-500 flex flex-col justify-between">
            <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all duration-500 shadow-inner">
                <i class="fas fa-newspaper text-lg"></i>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Active Content</p>
                <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-dark-wool tracking-tight">{{ $stats['total_blogs'] }} Posts</h3>
                <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">{{ $stats['total_categories'] }} Product Categories</p>
            </div>
        </div>
    </div>

    <!-- Charts & Settings -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-10">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h4 class="text-2xl font-serif font-bold text-dark-wool mb-1">Traffic & Engagement</h4>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Visitor counts in last 7 days</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-soft-rose"></div>
                    <span class="text-[10px] font-bold text-dark-wool uppercase tracking-widest">Active Visitors</span>
                </div>
            </div>
            <div class="h-[350px] relative">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-vintage-cream rounded-[2rem] flex items-center justify-center text-dark-wool mb-8 border border-gray-100">
                    <i class="fas fa-cog text-2xl"></i>
                </div>
                <h4 class="text-xl font-serif font-bold text-dark-wool mb-4">Core Settings</h4>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed px-4">Update API keys, SEO metadata, and primary system configurations for the entire platform.</p>
                <a href="{{ route('superadmin.settings.index') }}" class="w-full py-4.5 px-8 rounded-2xl bg-dark-wool text-white text-[11px] font-bold uppercase tracking-widest hover:bg-dark-wool/90 transition-all shadow-xl shadow-dark-wool/10">
                    Manage System
                </a>
            </div>

            <div class="bg-gray-50 p-8 rounded-[2.5rem] border border-gray-100">
                <h5 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Database Health</h5>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-dark-wool">Total Products</span>
                        <span class="text-xs font-bold text-gray-400">{{ $stats['total_products'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-dark-wool">Total Categories</span>
                        <span class="text-xs font-bold text-gray-400">{{ $stats['total_categories'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-dark-wool">Total Blogs</span>
                        <span class="text-xs font-bold text-gray-400">{{ $stats['total_blogs'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Transactions -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-xl font-bold text-dark-wool">Recent Global Transactions</h4>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-[10px] font-bold text-soft-rose uppercase tracking-widest hover:underline decoration-2 underline-offset-8">Generate Report</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order ID</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Amount</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Payment Status</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($latest_orders as $order)
                        <tr class="hover:bg-gray-50/30 transition-colors">
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
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">
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
                label: 'Visitors',
                data: {!! json_encode($chart_data['visitors']) !!},
                backgroundColor: '#D8A7B1',
                hoverBackgroundColor: '#C98F9F',
                borderRadius: 16,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#2E2A27',
                    titleFont: { size: 12, family: 'serif', weight: 'bold' },
                    bodyFont: { size: 11, weight: 'bold' },
                    padding: 16,
                    cornerRadius: 12,
                    displayColors: false
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 12 }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 12 }
                }
            }
        }
    });
</script>
@endpush
@endsection
