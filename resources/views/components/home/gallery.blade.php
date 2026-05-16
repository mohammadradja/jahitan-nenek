<section class="py-32 bg-gray-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">{{ __('messages.work_gallery') }}</span>
            <h2 class="text-5xl font-serif font-bold mt-4">{{ __('messages.knit_masterpiece') }}</h2>
            <p class="text-gray-400 mt-4">{{ __('messages.gallery_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-[800px]">
            <div class="md:col-span-4 h-full" data-aos="zoom-in">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=1000" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Classic Cardigan">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ __('messages.classic_cardigan') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-8 h-full" data-aos="zoom-in" data-aos-delay="100">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1544967082-d9d25d867d66?auto=format&fit=crop&q=80&w=1000" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Amigurumi Collection">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ __('messages.amigurumi_collection') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-7 h-full" data-aos="zoom-in" data-aos-delay="200">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&q=80&w=1000" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Home Decor">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ __('messages.home_decor') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-5 h-full" data-aos="zoom-in" data-aos-delay="300">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1584992236310-6edddc08acff?auto=format&fit=crop&q=80&w=1000" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Vintage Series">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ __('messages.vintage_series') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
