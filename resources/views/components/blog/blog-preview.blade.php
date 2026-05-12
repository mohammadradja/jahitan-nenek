<section class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">Cerita Di Balik Jarum</span>
            <h2 class="text-5xl font-serif font-bold mt-4">Catatan Nenek</h2>
            <div class="w-16 h-1 bg-soft-rose mx-auto mt-6 rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach(\App\Models\Blog::latest()->take(3)->get() as $blog)
                <article class="group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-50 h-full flex flex-col">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $blog->image_url ?? 'https://images.unsplash.com/photo-1544967082-d9d25d867d66?q=80&w=1000&auto=format&fit=crop' }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $blog->title }}">
                            <div class="absolute top-6 left-6">
                                <div class="flex items-center justify-between text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-auto pt-6 border-t border-gray-50">
                <div class="flex items-center space-x-4">
                    <span>{{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}</span>
                    <span class="flex items-center">
                        <i class="fas fa-eye mr-1.5 text-soft-rose"></i>
                        {{ number_format($blog->views ?? 0) }}
                    </span>
                </div>
            </div>
                            </div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <h3 class="text-2xl font-serif font-bold text-dark-wool mb-4 group-hover:text-soft-rose transition-colors duration-300">{{ $blog->title }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-8 flex-1">
                                {{ Str::limit(strip_tags($blog->content), 120) }}
                            </p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center text-dark-wool font-bold text-sm group-hover:translate-x-2 transition-transform duration-300">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-3 text-soft-rose text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
        <div class="text-center mt-20">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center px-12 py-4 rounded-full border-2 border-dark-wool font-bold hover:bg-dark-wool hover:text-white transition-all duration-300">
                Lihat Semua Cerita
            </a>
        </div>
    </div>
</section>
