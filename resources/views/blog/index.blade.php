@extends('layouts.app')

@section('content')
<div class="bg-vintage-cream min-h-screen">
    <!-- Premium Header -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-soft-rose/5 blur-3xl rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-20 relative text-center" data-aos="fade-down">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">Jendela Cerita</span>
            <h1 class="text-6xl md:text-7xl font-serif font-bold text-dark-wool mt-6 mb-8">Catatan <span class="italic text-soft-rose">Nenek</span></h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Menyulam kata demi kata, berbagi cerita di balik setiap rajutan kasih sayang dan tips merawat karya tangan agar tetap abadi.
            </p>
            <div class="w-32 h-1.5 bg-soft-rose mx-auto mt-12 rounded-full"></div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($blogs as $blog)
                    <x-blog.blog-card :blog="$blog" :delay="$loop->index * 100" />
                @empty
                    <div class="col-span-full text-center py-32">
                        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm">
                            <i class="fas fa-feather-alt text-3xl text-gray-200"></i>
                        </div>
                        <h4 class="text-2xl font-serif font-bold text-gray-400 italic">Belum ada catatan saat ini. Nenek sedang merajut kata...</h4>
                        <a href="{{ route('home') }}" class="btn-premium mt-12">Kembali Beranda</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-24 flex justify-center">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
