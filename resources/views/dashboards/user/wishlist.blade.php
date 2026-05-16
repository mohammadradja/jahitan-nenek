@extends('layouts.dashboard')

@section('role_name', 'Pelanggan')
@section('page_title', 'Wishlist Saya')

@section('dashboard_content')
<div class="space-y-10">
    <header class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-serif font-bold text-dark-wool">Koleksi Tersimpan</h3>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Produk-produk yang ingin Anda miliki nanti</p>
        </div>
        <a href="{{ route('home') }}" class="btn-primary btn-sm">Jelajahi Produk</a>
    </header>

    @if($wishlist->isEmpty())
        <div class="bg-white rounded-[4rem] p-24 text-center border border-gray-50 shadow-sm">
            <div class="w-32 h-32 bg-vintage-cream rounded-full flex items-center justify-center mx-auto mb-10 shadow-inner">
                <i class="fas fa-heart text-4xl text-soft-rose/20"></i>
            </div>
            <h4 class="text-3xl font-serif font-bold text-dark-wool/30 italic mb-6">Wishlist Anda masih kosong.</h4>
            <p class="text-gray-400 max-w-md mx-auto mb-12">Simpan produk yang Anda sukai agar lebih mudah menemukannya kembali saat Anda siap berbelanja.</p>
            <a href="{{ route('home') }}" class="btn-premium">Mulai Jelajah</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($wishlist as $item)
                <div class="group relative">
                    <x-product.product-card :product="$item->product" />
                    <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST" class="absolute top-6 right-6 z-10">
                        @csrf
                        <button type="submit" class="w-10 h-10 bg-white rounded-xl shadow-lg flex items-center justify-center text-soft-rose hover:bg-soft-rose hover:text-white transition-all transform hover:scale-110 active:scale-90">
                            <i class="fas fa-heart text-sm"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $wishlist->links() }}
        </div>
    @endif
</div>
@endsection
