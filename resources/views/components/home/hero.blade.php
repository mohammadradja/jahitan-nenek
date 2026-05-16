<section class="relative min-h-screen flex items-center bg-vintage-cream overflow-hidden py-32 lg:py-0">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/knitting-2.png');"></div>
    
    <!-- Floating Orbs -->
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-soft-rose/10 rounded-full blur-[100px] animate-pulse"></div>
    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-dark-wool/5 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-20 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-[1px] bg-soft-rose"></div>
                    <span class="uppercase tracking-[0.4em] text-[10px] font-bold text-gray-400">{{ __('messages.handcrafted_excellence') }}</span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-serif font-bold text-dark-wool leading-[1.1] mb-6">
                    {!! __('messages.hero_title') !!}
                </h1>
                
                <p class="text-gray-400 text-sm lg:text-base leading-relaxed mb-8 max-w-lg">
                    {{ __('messages.hero_subtitle') }}
                </p>
                
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="#produk" class="w-full sm:w-auto bg-soft-rose text-white font-bold py-3 px-8 rounded-lg shadow-lg shadow-soft-rose/20 text-xs uppercase tracking-widest flex items-center justify-center">
                        {{ __('messages.explore_collection') }} <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('blog.index') }}" class="w-full sm:w-auto px-8 py-3 rounded-lg border border-dark-wool font-bold hover:bg-dark-wool hover:text-white transition-all text-center text-xs uppercase tracking-widest">
                        {{ __('messages.read_stories') }}
                    </a>
                </div>

                <div class="mt-16 flex items-center space-x-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="flex -space-x-4">
                        @for($i=1; $i<=3; $i++)
                            <img src="https://i.pravatar.cc/150?u={{ $i }}" class="w-12 h-12 rounded-full border-4 border-white shadow-sm object-cover">
                        @endfor
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                        {{ __('messages.trusted_by') }} <span class="text-dark-wool">500+</span> {{ __('messages.knit_lovers') }}
                    </p>
                </div>
            </div>
            
            <div class="relative" data-aos="zoom-in" data-aos-delay="200">
                <!-- Large Decorative Shape -->
                <div class="absolute -inset-10 bg-white/50 rounded-[4rem] rotate-6 -z-10 blur-sm"></div>
                
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-white group">
                    <img src="https://images.unsplash.com/photo-1516573024884-33b8796593d8?q=80&w=1000&auto=format&fit=crop" 
                         class="w-full aspect-[4/5] object-cover transition-transform duration-[2s] group-hover:scale-110" 
                         alt="Jahitan Nenek Collection">
                    
                    <!-- Floating Badge -->
                    <div class="absolute bottom-10 left-10 animate-bounce">
                        <div class="glass-effect p-6 rounded-3xl border border-white/40 shadow-xl flex items-center space-x-4">
                            <div class="w-12 h-12 bg-soft-rose rounded-2xl flex items-center justify-center text-white text-xl shadow-lg shadow-soft-rose/30">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('messages.premium_quality') }}</p>
                                <p class="text-sm font-bold text-dark-wool">{{ __('messages.handmade_100') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Floating Element -->
                <div class="absolute -top-10 -right-10 hidden lg:block animate-pulse">
                    <div class="bg-dark-wool text-white p-8 rounded-[2rem] shadow-2xl border-4 border-white">
                        <i class="fas fa-star text-soft-rose text-3xl mb-4"></i>
                        <p class="text-2xl font-serif font-bold">{!! str_replace(' ', '<br>', __('messages.limited_edition')) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
