@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-20 py-20">
    <div class="mb-16 text-center" data-aos="fade-down">
        <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">Pilihan Anda</span>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold mt-4">Keranjang <span class="italic text-soft-rose">Belanja</span></h2>
        <div class="w-24 h-1.5 bg-soft-rose mx-auto mt-8 rounded-full"></div>
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Cart Items -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[3rem] shadow-sm border border-gray-50 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50 border-b border-gray-50">
                                <tr>
                                    <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Produk</th>
                                    <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Harga</th>
                                    <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400 text-center">Jumlah</th>
                                    <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">Subtotal</th>
                                    <th class="px-8 py-6"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr class="group hover:bg-gray-50/30 transition-colors">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                                    <img src="{{ $details['image'] }}" class="w-full h-full object-cover transition-transform group-hover:scale-110 duration-500" alt="{{ $details['name'] }}">
                                                </div>
                                                <div class="min-w-0">
                                                    <h6 class="font-bold text-dark-wool truncate text-sm">{{ $details['name'] }}</h6>
                                                    <p class="text-[8px] font-bold text-soft-rose uppercase tracking-widest mt-0.5">{{ $details['category'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 font-bold text-dark-wool text-sm">
                                            Rp{{ number_format($details['price'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-8 py-4">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-center">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" inputmode="numeric" name="quantity" value="{{ $details['quantity'] }}"
                                                       class="w-12 h-8 rounded-lg bg-gray-50 border-0 text-center font-bold text-xs focus:ring-2 focus:ring-soft-rose/10 outline-none transition-all" 
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')" onchange="if (this.value !== '') this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="px-8 py-4 font-bold text-soft-rose text-sm">
                                            Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-8 py-4 text-right">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition-all">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-4">
                <div class="sticky top-32 space-y-8">
                    <div class="bg-white rounded-[3rem] p-10 shadow-2xl border border-gray-50">
                        <h5 class="text-2xl font-serif font-bold text-dark-wool mb-8">Ringkasan Belanja</h5>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase tracking-widest">
                                <span>Subtotal</span>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400 font-bold text-[10px] uppercase tracking-widest">
                                <span>Pajak</span>
                                <span>Rp0</span>
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-100 flex justify-between items-end mb-10">
                            <span class="text-lg font-serif font-bold text-dark-wool">Total Akhir</span>
                            <span class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn-premium w-full py-5 shadow-2xl shadow-soft-rose/20">
                            Lanjut ke Checkout
                        </a>
                        <a href="{{ route('home') }}" class="block text-center mt-6 text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-soft-rose transition-colors">
                            Lanjutkan Belanja →
                        </a>
                    </div>

                    <div class="bg-soft-rose/5 border border-soft-rose/20 rounded-[2rem] p-8">
                        <p class="text-xs font-bold text-soft-rose uppercase tracking-[0.2em] mb-4 flex items-center">
                            <i class="fas fa-heart mr-2"></i> Menjahit Kasih Sayang
                        </p>
                        <p class="text-xs text-gray-500 leading-relaxed">Setiap jahitan Nenek dikerjakan dengan penuh ketelitian dan doa. Terima kasih telah mendukung karya tangan lokal.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-32 flex flex-col items-center" data-aos="zoom-in">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-10 shadow-sm border border-gray-50">
                <i class="fas fa-shopping-basket text-5xl text-gray-100"></i>
            </div>
            <h4 class="text-3xl font-serif font-bold text-gray-300 mb-8">Keranjang Anda masih kosong</h4>
            <a href="{{ route('home') }}" class="btn-premium px-12 py-5">
                Mulai Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
