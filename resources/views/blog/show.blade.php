@extends('layouts.app')

@php
    $blogUrl = route('blog.show', $blog->slug);
    $blogImage = $blog->imageUrl('https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1200');
    $blogDescription = \Illuminate\Support\Str::limit(strip_tags($blog->content), 160);
    $shareText = $blog->title . ' - ' . $blogUrl;
@endphp

@section('title', $blog->title)

@push('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blogDescription }}">
    <meta property="og:url" content="{{ $blogUrl }}">
    <meta property="og:image" content="{{ $blogImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{{ $blogDescription }}">
    <meta name="twitter:image" content="{{ $blogImage }}">
@endpush

@section('content')
<div class="bg-white">
    <!-- Article Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1.5 z-[110] pointer-events-none">
        <div id="scrollProgress" class="h-full bg-soft-rose transition-all duration-300" style="width: 0%"></div>
    </div>

    <!-- Hero Header -->
    <header class="relative pt-32 pb-20 overflow-hidden bg-vintage-cream/30">
        <div class="max-w-7xl mx-auto px-6 lg:px-20" data-aos="fade-up">
            <nav class="mb-10">
                <ol class="flex items-center space-x-4 text-[10px] font-bold uppercase tracking-[0.3em] text-soft-rose">
                    <li><a href="{{ route('home') }}" class="hover:opacity-70 transition-opacity">{{ __('messages.home') }}</a></li>
                    <li><span class="w-1.5 h-1.5 rounded-full bg-soft-rose/30"></span></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:opacity-70 transition-opacity">{{ __('messages.grandma_notes') }}</a></li>
                </ol>
            </nav>

            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-dark-wool leading-[1.2] mb-8">
                {{ $blog->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 md:gap-10 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-user-edit text-xs"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">{{ __('messages.author') }}</p>
                        <p class="text-dark-wool">{{ $blog->author->name ?? 'Admin Jahitan' }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-calendar-day text-xs"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">{{ __('messages.published') }}</p>
                        <p class="text-dark-wool">{{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-soft-rose shadow-sm">
                        <i class="fas fa-eye text-xs"></i>
                    </div>
                    <div>
                        <p class="text-gray-300 mb-0.5">{{ __('messages.views') }}</p>
                        <p class="text-dark-wool">{{ number_format($blog->views) }} {{ __('messages.times') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto px-6 lg:px-20 py-16">
        <!-- Featured Image -->
        <div class="relative -mt-24 mb-16 rounded-[3rem] overflow-hidden shadow-2xl bg-white p-3" data-aos="zoom-in">
            <img src="{{ $blogImage }}"
                 class="w-full h-auto rounded-[2.5rem] object-cover aspect-[21/9] max-h-[500px]" 
                 alt="{{ $blog->title }}">
        </div>

        <!-- Two Columns Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <!-- Left Pane: Share & Content (col-span-8) -->
            <div class="lg:col-span-8 space-y-12">
                
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Tags Rail -->
                    <div class="md:w-20 shrink-0">
                        <div class="sticky top-40 flex md:flex-col items-start md:items-center gap-3">
                            <p class="hidden md:block text-[8px] font-bold text-gray-300 uppercase vertical-text tracking-[0.4em] mb-2">Tag</p>
                            <span class="bg-vintage-cream px-4 py-1.5 rounded-full text-[9px] font-bold text-dark-wool/50 uppercase tracking-widest md:[writing-mode:vertical-rl] md:[text-orientation:mixed]">Handmade</span>
                            <span class="bg-vintage-cream px-4 py-1.5 rounded-full text-[9px] font-bold text-dark-wool/50 uppercase tracking-widest md:[writing-mode:vertical-rl] md:[text-orientation:mixed]">Premium</span>
                            <span class="bg-vintage-cream px-4 py-1.5 rounded-full text-[9px] font-bold text-dark-wool/50 uppercase tracking-widest md:[writing-mode:vertical-rl] md:[text-orientation:mixed]">{{ __('messages.grandma_notes') }}</span>
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="flex-1 prose prose-stone max-w-none text-dark-wool/85 leading-[1.8] font-sans text-lg space-y-8" data-aos="fade-up">
                        <div class="not-prose mb-10 flex flex-wrap items-center gap-3 border-b border-gray-100 pb-6">
                            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.3em] mr-2">{{ __('messages.share') }}</span>
                            <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($blogUrl) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all text-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ 'https://twitter.com/intent/tweet?text=' . rawurlencode($blog->title) . '&url=' . rawurlencode($blogUrl) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all text-sm">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ 'https://wa.me/?text=' . rawurlencode($shareText) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-green-500 hover:text-white transition-all text-sm">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>

                        {!! nl2br($blog->content) !!}
                    </div>
                </div>

            </div>

            <!-- Right Pane: Other Blogs / Recent Articles (col-span-4) -->
            <aside class="lg:col-span-4 space-y-8">
                <div class="bg-vintage-cream/10 border border-gray-50 p-8 rounded-[2.5rem] sticky top-36">
                    <h3 class="font-serif font-bold text-dark-wool text-xl mb-6 pb-4 border-b border-gray-100">
                        {{ __('messages.other_articles') }}
                    </h3>
                    
                    <div class="space-y-6">
                        @forelse($otherBlogs as $other)
                            <a href="{{ route('blog.show', $other->slug) }}" class="group flex gap-4 items-start transition-all">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden shrink-0 border border-gray-100">
                                    <img src="{{ $other->imageUrl('https://via.placeholder.com/150') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-sm text-dark-wool group-hover:text-soft-rose transition-colors line-clamp-2 leading-snug">
                                        {{ $other->title }}
                                    </h4>
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mt-2">
                                        {{ $other->published_at?->format('d M Y') ?? $other->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-400 italic">Tidak ada artikel lain.</p>
                        @endforelse
                    </div>
                </div>
            </aside>

        </div>
    </main>

    <!-- Footer Actions -->
    <section class="bg-vintage-cream/30 py-24">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h4 class="text-2xl md:text-3xl font-serif font-bold text-dark-wool mb-10">{{ __('messages.see_more_handicrafts') }}</h4>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('blog.index') }}" class="btn-secondary text-xs py-3 px-8">{{ __('messages.see_other_stories') }}</a>
                <a href="{{ route('home') }}#produk" class="btn-premium text-xs py-3 px-8">{{ __('messages.shop_collection') }}</a>
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
