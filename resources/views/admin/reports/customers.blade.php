@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Analisis Pelanggan')

@section('dashboard_content')
<div class="space-y-8">
    <!-- Analysis Info -->
    <div class="bg-dark-wool p-12 rounded-[3.5rem] shadow-2xl text-white relative overflow-hidden group mb-10">
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-4xl font-serif font-bold mb-6">Loyalty & Retention</h3>
                <p class="text-white/60 text-lg leading-relaxed mb-10">Berikut adalah daftar pelanggan dengan kontribusi terbesar pada bisnis Anda. Fokuskan strategi pemasaran Anda pada profil-profil ini untuk pertumbuhan berkelanjutan.</p>
                <div class="flex gap-4">
                    <button class="btn-accent btn-sm">Email Campaign</button>
                    <button class="btn-secondary btn-sm bg-white/10 hover:bg-white/20 text-white hover:text-dark-wool border-none">Download Data</button>
                </div>
            </div>
            <div class="hidden lg:flex justify-center">
                <div class="w-48 h-48 bg-white/5 rounded-full flex items-center justify-center border border-white/10 shadow-3xl">
                    <i class="fas fa-crown text-7xl text-soft-rose opacity-40"></i>
                </div>
            </div>
        </div>
        <!-- Decorative blob -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-soft-rose/10 rounded-full blur-[100px]"></div>
    </div>



    <!-- Customers List -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 flex justify-between items-center">
            <h4 class="text-xl font-bold text-dark-wool">Top Tier Customers</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Total Pesanan</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Total Investasi</th>
                        <th class="px-10 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Tingkatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($customers as $customer)
                        <tr class="hover:bg-gray-50/30 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-vintage-cream flex items-center justify-center text-dark-wool font-bold border border-gray-100">
                                        {{ substr($customer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-dark-wool">{{ $customer->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $customer->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-center">
                                <span class="font-bold text-dark-wool">{{ $customer->orders_count }} Transaksi</span>
                            </td>
                            <td class="px-10 py-6 text-right font-bold text-dark-wool">
                                Rp{{ number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-center">
                                    @php
                                        $revenue = $customer->orders_sum_total_price ?? 0;
                                        $tier = $revenue > 1000000 ? 'Platinum' : ($revenue > 500000 ? 'Gold' : 'Silver');
                                        $color = $revenue > 1000000 ? 'bg-indigo-50 text-indigo-600' : ($revenue > 500000 ? 'bg-amber-50 text-amber-600' : 'bg-gray-100 text-gray-400');
                                    @endphp
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $color }}">
                                        {{ $tier }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $customers->withQueryString()->links() }}
    </div>
</div>
@endsection
