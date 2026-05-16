@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Article Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1.5 z-[110] pointer-events-none">
        <div id="scrollProgress" class="h-full bg-soft-rose transition-all duration-300" style="width: 0%"></div>
    </div>

    <!-- Hero Header -->
    <header class="relative pt-32 pb-20 overflow-hidden bg-vintage-cream/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-32" data-aos="fade-up">
            <nav class="mb-12">
                <ol class="flex items-center space-x-4 text-[10px] font-bold uppercase tracking-[0.3em] text-soft-rose">
                    <li><a href="{{ route('home') }}" class="hover:opacity-70 transition-opacity">Beranda</a></li>
                    <li><span class="w-1.5 h-1.5 rounded-full bg-soft-rose/30"></span></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:opacity-70 transition-opacity">Catatan Nenek</a></li>
                </ol>
            </nav>

            <h1 class="text-6xl md:text-7xl lg:text-8xl font-serif font-bold text-dark-wool leading-[1.1] mb-12">
                {{ $blog->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-10 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-user-edit text-sm"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">Penulis</p>
                        <p class="text-dark-wool">{{ $blog->author->name ?? 'Admin Jahitan' }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-calendar-day text-sm"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">Terbit</p>
                        <p class="text-dark-wool">{{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-eye text-sm"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">Dilihat</p>
                        <p class="text-dark-wool">{{ number_format($blog->views) }} Kali</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-5xl mx-auto px-6 py-24">
        <!-- Featured Image -->
        <div class="relative -mt-32 mb-24 rounded-[4rem] overflow-hidden shadow-[0_40px_100px_-20px_rgba(0,0,0,0.15)] bg-white p-4" data-aos="zoom-in">
            <img src="{{ $blog->image ?? 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1200' }}" 
                 class="w-full h-auto rounded-[3.5rem] object-cover aspect-[21/9]" 
                 alt="{{ $blog->title }}">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <!-- Sidebar / Social -->
            <div class="lg:col-span-1">
                <div class="sticky top-40 flex lg:flex-col items-center justify-center space-x-4 lg:space-x-0 lg:space-y-6">
                    <p class="hidden lg:block text-[9px] font-bold text-gray-300 uppercase vertical-text tracking-[0.4em] mb-4">Bagikan</p>
                    <a href="#" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="lg:col-span-9 lg:col-start-3 prose prose-xl prose-stone max-w-none" data-aos="fade-up">
                <div class="text-dark-wool/80 leading-[1.8] font-sans text-xl space-y-12">
                    {!! nl2br($blog->content) !!}
                </div>

                <!-- Tags / Category -->
                <div class="mt-20 pt-12 border-t border-gray-100 flex flex-wrap gap-4">
                    <span class="bg-vintage-cream px-6 py-2 rounded-full text-xs font-bold text-dark-wool/50 uppercase tracking-widest">Handmade</span>
                    <span class="bg-vintage-cream px-6 py-2 rounded-full text-xs font-bold text-dark-wool/50 uppercase tracking-widest">Tutorial</span>
                    <span class="bg-vintage-cream px-6 py-2 rounded-full text-xs font-bold text-dark-wool/50 uppercase tracking-widest">Kisah Nenek</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Actions -->
    <section class="bg-vintage-cream/30 py-32">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h4 class="text-3xl font-serif font-bold text-dark-wool mb-12">Ingin melihat karya tangan lainnya?</h4>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('blog.index') }}" class="btn-secondary">Lihat Cerita Lainnya</a>
                <a href="{{ route('home') }}#produk" class="btn-premium">Belanja Koleksi</a>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("scrollProgress").style.width = scrolled + "%";
    };
</script>
@endpush

<style>
    .vertical-text {
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }
</style>
@endsection
