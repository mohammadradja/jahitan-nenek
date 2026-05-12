@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-20">
    <!-- Breadcrumb -->
    <nav class="mb-12" data-aos="fade-down">
        <ol class="flex items-center space-x-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">
            <li><a href="{{ route('home') }}" class="hover:text-soft-rose transition-colors">Beranda</a></li>
            <li><i class="fas fa-chevron-right text-[8px]"></i></li>
            <li><a href="{{ route('blog.index') }}" class="hover:text-soft-rose transition-colors">Cerita Nenek</a></li>
            <li><i class="fas fa-chevron-right text-[8px]"></i></li>
            <li class="text-dark-wool">{{ Str::limit($blog->title, 20) }}</li>
        </ol>
    </nav>

    <!-- Header -->
    <header class="mb-16" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-dark-wool leading-tight mb-8">
            {{ $blog->title }}
        </h1>
        <div class="flex flex-wrap items-center gap-8 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 border-y border-gray-100 py-6">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-full bg-soft-rose/10 flex items-center justify-center text-soft-rose">
                    <i class="fas fa-user text-xs"></i>
                </div>
                <span>Oleh {{ $blog->author->name }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-calendar text-soft-rose"></i>
                <span>{{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-eye text-soft-rose"></i>
                <span>{{ number_format($blog->views) }} Kali Dilihat</span>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl mb-16" data-aos="zoom-in">
        <img src="{{ $blog->image ?? 'https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1200' }}" 
             class="w-full h-auto object-cover" 
             alt="{{ $blog->title }}">
    </div>

    <!-- Content -->
    <div class="prose prose-xl prose-stone max-w-none mb-20" data-aos="fade-up">
        <div class="text-gray-600 leading-relaxed font-sans text-xl space-y-8">
            {!! nl2br(e($blog->content)) !!}
        </div>
    </div>

    <!-- Footer Actions -->
    <footer class="pt-12 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8" data-aos="fade-up">
        <a href="{{ route('blog.index') }}" class="group flex items-center space-x-3 text-sm font-bold text-dark-wool hover:text-soft-rose transition-colors">
            <div class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-soft-rose transition-colors">
                <i class="fas fa-arrow-left"></i>
            </div>
            <span>Kembali ke Cerita Nenek</span>
        </a>

        <div class="flex items-center space-x-6">
            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Bagikan:</span>
            <div class="flex items-center space-x-4">
                <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-[#1877F2] hover:text-white transition-all">
                    <i class="fab fa-facebook-f text-sm"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-[#1DA1F2] hover:text-white transition-all">
                    <i class="fab fa-twitter text-sm"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-[#25D366] hover:text-white transition-all">
                    <i class="fab fa-whatsapp text-sm"></i>
                </a>
            </div>
        </div>
    </footer>
</div>
@endsection
