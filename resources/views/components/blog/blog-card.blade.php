@props(['blog', 'delay' => 0])

<article class="group h-full" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-50 h-full flex flex-col">
        <div class="relative aspect-video overflow-hidden">
            <img src="{{ $blog->imageUrl('https://images.unsplash.com/photo-1544967082-d9d25d867d66?q=80&w=1000&auto=format&fit=crop') }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                 alt="{{ $blog->title }}">
            <div class="absolute top-6 left-6">
                <span class="bg-white/90 backdrop-blur-sm text-dark-wool text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                </span>
            </div>
        </div>
        <div class="p-8 flex-1 flex flex-col">
            <div class="flex items-center space-x-4 mb-4">
                <span class="flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <i class="fas fa-eye mr-1.5 text-soft-rose"></i>
                    {{ number_format($blog->views ?? 0) }}
                </span>
                <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    {{ $blog->author->name ?? 'Admin' }}
                </span>
            </div>
            <h3 class="text-2xl font-serif font-bold text-dark-wool mb-4 group-hover:text-soft-rose transition-colors duration-300">
                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed mb-8 flex-1">
                {{ Str::limit(strip_tags($blog->content), 120) }}
            </p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center text-dark-wool font-bold text-sm group-hover:translate-x-2 transition-transform duration-300">
                Baca Selengkapnya <i class="fas fa-arrow-right ml-3 text-soft-rose text-xs"></i>
            </a>
        </div>
    </div>
</article>
