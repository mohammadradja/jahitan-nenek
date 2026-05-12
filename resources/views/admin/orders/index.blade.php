@extends('layouts.dashboard')

@section('role_name', 'Admin')
@section('page_title', 'Daftar Pesanan')

@section('dashboard_content')
<div class="space-y-8">
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Search Order</label>
                <input type="text" name="search" value="{{ request('search') }}" class="input-premium py-1.5 text-xs" placeholder="ID or Customer Name">
            </div>
            <div class="w-40">
                <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Status</label>
                <select name="status" class="input-premium py-1.5 text-xs appearance-none">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-premium px-6 py-2 text-[10px]">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 rounded-lg bg-gray-50 text-dark-wool text-[10px] font-bold border border-gray-100 hover:bg-gray-100 transition-all flex items-center">Reset</a>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-5xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Order ID</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Total</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Status Pembayaran</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-center">Status Pesanan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
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
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-yellow-50 text-yellow-600' }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-blue-50 text-blue-600">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end space-x-2">
                                    @if($order->status === 'pending' || $order->payment_status === 'unpaid')
                                        <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition-all shadow-sm" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-dark-wool hover:bg-dark-wool hover:text-white transition-all shadow-sm" title="View Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-400 italic">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
@endsection
