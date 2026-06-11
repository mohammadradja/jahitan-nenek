@extends('layouts.app')

@section('content')
<div class="bg-vintage-cream min-h-screen">
    <!-- Premium Header -->
    <section class="relative pt-40 pb-24 overflow-hidden">
        <!-- Floating decorative elements -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-soft-rose/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-soft-rose/10 rounded-full blur-3xl animate-pulse delay-700"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-20 relative text-center" data-aos="fade-down">
            <div class="inline-flex items-center space-x-4 mb-8">
                <span class="h-[1px] w-12 bg-soft-rose/30"></span>
                <span class="text-soft-rose font-bold uppercase tracking-[0.4em] text-[10px]">Jendela Cerita Nenek</span>
                <span class="h-[1px] w-12 bg-soft-rose/30"></span>
            </div>
            <h1 class="text-6xl md:text-8xl font-serif font-bold text-dark-wool mt-4 mb-10 leading-tight">
                Catatan <span class="italic text-soft-rose font-light">Menjahit</span> Cerita
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed font-medium">
                Berbagi inspirasi, tips perawatan pemakaian, dan kisah di balik setiap potongan yang kami jalin menjadi karya abadi.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="pb-40">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($blogs as $blog)
                    <x-blog.blog-card :blog="$blog" :delay="$loop->index * 100" />
                @empty
                    <div class="col-span-full text-center py-40 bg-white rounded-[4rem] border border-gray-50 shadow-sm">
                        <div class="w-32 h-32 bg-vintage-cream rounded-full flex items-center justify-center mx-auto mb-10 shadow-inner">
                            <i class="fas fa-feather-alt text-4xl text-soft-rose/30"></i>
                        </div>
                        <h4 class="text-3xl font-serif font-bold text-dark-wool/30 italic">Nenek sedang menyiapkan cerita jahitan baru...</h4>
                        <div class="mt-12">
                            <a href="{{ route('home') }}" class="btn-primary">Kembali Beranda</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-32">
                {{ $blogs->links('vendor.pagination.premium') }}
            </div>
        </div>
    </section>
</div>
@endsection
