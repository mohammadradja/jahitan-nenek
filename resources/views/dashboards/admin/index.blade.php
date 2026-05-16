@extends('layouts.dashboard')

@section('role_name', 'Administrator')
@section('page_title', 'Dashboard Overview')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Top KPI Grid: Financial & Orders -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Revenue Card (Large) -->
        <div class="lg:col-span-2 bg-dark-wool p-8 rounded-[2.5rem] shadow-2xl text-white relative overflow-hidden group border border-white/10">
            <div class="relative z-10 flex justify-between items-start h-full">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <p class="text-[10px] font-bold text-white/50 uppercase tracking-[0.4em] mb-4">Total Revenue (Paid)</p>
                        <h2 class="text-5xl font-serif font-bold tracking-tight mb-2">Rp{{ number_format($stats['revenue'], 0, ',', '.') }}</h2>
                        <p class="text-white/30 text-[9px] font-bold uppercase tracking-widest">Confirmed & Completed Transactions</p>
                    </div>
                    <div class="mt-10 flex items-center space-x-4">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-white/40 uppercase tracking-widest mb-1">Pending Revenue</span>
                            <span class="text-sm font-bold text-soft-rose">Rp{{ number_format($stats['revenue_pending'], 0, ',', '.') }}</span>
                        </div>
                        <div class="w-px h-8 bg-white/10"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-white/40 uppercase tracking-widest mb-1">Average Order</span>
                            <span class="text-sm font-bold">Rp{{ number_format($stats['revenue'] / (max($stats['total_orders'], 1)), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-20 h-20 bg-white/10 rounded-[2rem] flex items-center justify-center backdrop-blur-md border border-white/5 shadow-2xl">
                    <i class="fas fa-coins text-3xl text-soft-rose"></i>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-soft-rose/10 rounded-full blur-[80px] group-hover:bg-soft-rose/20 transition-all duration-1000"></div>
            <div class="absolute -left-16 -bottom-16 w-48 h-48 bg-blue-500/10 rounded-full blur-[60px]"></div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-soft-rose transition-all duration-500 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="w-14 h-14 bg-soft-rose/10 rounded-2xl flex items-center justify-center text-soft-rose group-hover:bg-soft-rose group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-shopping-bag text-lg"></i>
                </div>
                <span class="text-[10px] font-bold text-green-500 bg-green-50 px-3 py-1 rounded-full">+{{ $stats['pending_orders'] }} New</span>
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Orders</p>
                <h3 class="text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_orders'], 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:border-dark-wool transition-all duration-500 flex flex-col justify-between text-left">
            <div class="flex justify-between items-start">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:bg-dark-wool group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-user-friends text-lg"></i>
                </div>
                @if($stats['new_customers_today'] > 0)
                    <span class="text-[10px] font-bold text-blue-500 bg-blue-50 px-3 py-1 rounded-full">+{{ $stats['new_customers_today'] }} Today</span>
                @endif
            </div>
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Customers</p>
                <h3 class="text-3xl font-bold text-dark-wool tracking-tight">{{ number_format($stats['total_customers'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Middle KPI Grid: Inventory & Stock -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6 hover:shadow-lg transition-all duration-500">
            <div class="w-16 h-16 bg-blue-50 rounded-[1.5rem] flex items-center justify-center text-blue-500">
                <i class="fas fa-box-open text-2xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Products</p>
                <h4 class="text-xl font-bold text-dark-wool">{{ number_format($stats['total_products'], 0, ',', '.') }} SKU</h4>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6 hover:shadow-lg transition-all duration-500">
            <div class="w-16 h-16 bg-amber-50 rounded-[1.5rem] flex items-center justify-center text-amber-500">
                <i class="fas fa-warehouse text-2xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Inventory Value</p>
                <h4 class="text-xl font-bold text-dark-wool">Rp{{ number_format($stats['inventory_value'], 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center space-x-6 hover:shadow-lg transition-all duration-500 {{ $stats['low_stock'] > 0 ? 'border-red-100 bg-red-50/10' : '' }}">
            <div class="w-16 h-16 {{ $stats['low_stock'] > 0 ? 'bg-red-50 text-red-500' : 'bg-green-50 text-green-500' }} rounded-[1.5rem] flex items-center justify-center">
                <i class="fas fa-triangle-exclamation text-2xl"></i>
            </div>
            <div>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Low Stock Alert</p>
                <h4 class="text-xl font-bold {{ $stats['low_stock'] > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $stats['low_stock'] }} Items</h4>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Chart -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h4 class="text-2xl font-serif font-bold text-dark-wool mb-1">Order Analytics</h4>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">7-Day performance trends</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-soft-rose"></div>
                            <span class="text-[10px] font-bold text-dark-wool uppercase tracking-widest">Transactions</span>
                        </div>
                    </div>
                </div>
                <div class="h-[350px] relative">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="text-xl font-bold text-dark-wool">Latest Transactions</h4>
                    <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-bold text-soft-rose uppercase tracking-widest hover:underline decoration-2 underline-offset-8">View All Orders</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer</th>
                                <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Amount</th>
                                <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-8 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($latest_orders as $order)
                                <tr class="hover:bg-gray-50/30 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 rounded-2xl bg-vintage-cream flex items-center justify-center text-dark-wool font-bold border border-gray-100">
                                                {{ substr($order->user->name ?? 'G', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-dark-wool">{{ $order->user->name ?? 'Guest' }}</p>
                                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $order->user->email ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 font-bold text-dark-wool">
                                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex justify-center">
                                            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-yellow-50 text-yellow-600' }}">
                                                {{ $order->payment_status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gray-50 text-dark-wool hover:bg-dark-wool hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-chevron-right text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Section: Top Products -->
        <div class="space-y-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h4 class="text-xl font-bold text-dark-wool mb-8">Best Selling</h4>
                <div class="space-y-6">
                    @foreach($top_products as $product)
                        <div class="flex items-center space-x-4 group">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex-shrink-0">
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-dark-wool line-clamp-1 group-hover:text-soft-rose transition-colors">{{ $product->name }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $product->sales_count }} Sold</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-dark-wool">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10 pt-8 border-t border-gray-50">
                    <a href="{{ route('admin.products.index') }}" class="w-full inline-flex items-center justify-center py-4 px-8 rounded-2xl bg-dark-wool text-white text-[11px] font-bold uppercase tracking-widest hover:bg-dark-wool/90 transition-all shadow-xl shadow-dark-wool/10">
                        Manage Catalog
                    </a>
                </div>
            </div>

            <!-- Quick Action Card -->
            <div class="bg-soft-rose p-8 rounded-[2.5rem] shadow-2xl text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <h5 class="text-2xl font-serif font-bold mb-4">Need Help?</h5>
                    <p class="text-white/80 text-sm mb-8 leading-relaxed">Check our system documentation for managing production stages and tailor measurements.</p>
                    <a href="#" class="inline-flex items-center justify-center py-3.5 px-8 rounded-2xl bg-white text-soft-rose text-[10px] font-bold uppercase tracking-widest hover:bg-vintage-cream transition-all">
                        View Guides
                    </a>
                </div>
                <i class="fas fa-question-circle absolute -right-6 -bottom-6 text-9xl text-white/10 group-hover:rotate-12 transition-all duration-700"></i>
            </div>
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
                label: 'Orders',
                data: {!! json_encode($chart_data['orders']) !!},
                borderColor: '#D8A7B1',
                backgroundColor: (context) => {
                    const ctx = context.chart.ctx;
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(216, 167, 177, 0.4)');
                    gradient.addColorStop(1, 'rgba(216, 167, 177, 0)');
                    return gradient;
                },
                fill: true,
                tension: 0.45,
                borderWidth: 4,
                pointRadius: 0,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#D8A7B1',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 4,
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
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Transactions';
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 12, stepSize: 1 }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af', padding: 12 }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            }
        }
    });
</script>
@endpush
@endsection
