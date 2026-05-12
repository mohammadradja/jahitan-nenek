@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[3rem] p-8 shadow-2xl border border-gray-50 flex flex-col items-center text-center">
                <div class="relative mb-6">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=E8A0BF&color=fff&size=200" 
                         class="w-32 h-32 rounded-[2.5rem] shadow-xl shadow-soft-rose/20 border-4 border-white" alt="">
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 border-4 border-white rounded-full flex items-center justify-center text-white text-xs">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                
                <h2 class="text-2xl font-serif font-bold text-dark-wool">{{ auth()->user()->name }}</h2>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ auth()->user()->email }}</p>

                <nav class="w-full mt-12 space-y-3">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-4 p-4 rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-gray-400 hover:bg-gray-50 hover:text-dark-wool' }}">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="font-bold text-sm">Pesanan Saya</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center space-x-4 p-4 rounded-2xl text-gray-400 hover:bg-gray-50 hover:text-dark-wool transition-all">
                        <i class="fas fa-user-edit"></i>
                        <span class="font-bold text-sm">Pengaturan Profil</span>
                    </a>
                    <div class="pt-6 mt-6 border-t border-gray-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-4 p-4 rounded-2xl text-red-400 hover:bg-red-50 transition-all group">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="font-bold text-sm">Keluar Akun</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-[4rem] shadow-2xl border border-gray-50 overflow-hidden">
                <div class="p-10 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-3xl font-serif font-bold text-dark-wool">Riwayat Pesanan</h3>
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        Total {{ $orders->count() }} Transaksi
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Order ID</th>
                                <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Tanggal</th>
                                <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Total</th>
                                <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Status</th>
                                <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                                <tr class="group hover:bg-gray-50/30 transition-colors">
                                    <td class="px-10 py-8 font-mono font-bold text-dark-wool">#{{ $order->id }}</td>
                                    <td class="px-10 py-8 text-gray-500 font-medium">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-10 py-8 font-bold text-soft-rose">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-10 py-8">
                                        <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest 
                                            {{ $order->payment_status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-yellow-50 text-yellow-600' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <a href="{{ route('order.track', ['order_id' => $order->id]) }}" 
                                           class="inline-flex items-center space-x-2 text-xs font-bold text-dark-wool hover:text-soft-rose transition-colors">
                                            <span>Lacak</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-10 py-32 text-center">
                                        <div class="mb-8 flex justify-center">
                                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-200">
                                                <i class="fas fa-shopping-basket text-4xl"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-xl font-serif font-bold text-gray-400 mb-4">Belum ada pesanan Anda</h5>
                                        <a href="{{ route('home') }}" class="btn-premium px-12 py-4">Mulai Belanja Sekarang</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
