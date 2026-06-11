<section class="py-32 bg-gray-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_title', __('messages.work_gallery')) }}</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold mt-4">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_subtitle', __('messages.knit_masterpiece')) }}</h2>
            <p class="text-gray-400 mt-4">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_desc', __('messages.gallery_desc')) }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[600px] lg:h-[800px]">
            <div class="md:col-span-4 h-64 md:h-full" data-aos="zoom-in">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="{{ \App\Models\SiteSetting::get('cms_gallery_img1') ? (str_starts_with(\App\Models\SiteSetting::get('cms_gallery_img1'), 'http') ? \App\Models\SiteSetting::get('cms_gallery_img1') : asset(\App\Models\SiteSetting::get('cms_gallery_img1'))) : 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=1000' }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Gallery 1">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_title1', __('messages.classic_cardigan')) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-8 h-64 md:h-full" data-aos="zoom-in" data-aos-delay="100">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="{{ \App\Models\SiteSetting::get('cms_gallery_img2') ? (str_starts_with(\App\Models\SiteSetting::get('cms_gallery_img2'), 'http') ? \App\Models\SiteSetting::get('cms_gallery_img2') : asset(\App\Models\SiteSetting::get('cms_gallery_img2'))) : 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&q=80&w=1000' }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Gallery 2">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_title2', __('messages.amigurumi_collection')) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-7 h-64 md:h-full" data-aos="zoom-in" data-aos-delay="200">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="{{ \App\Models\SiteSetting::get('cms_gallery_img3') ? (str_starts_with(\App\Models\SiteSetting::get('cms_gallery_img3'), 'http') ? \App\Models\SiteSetting::get('cms_gallery_img3') : asset(\App\Models\SiteSetting::get('cms_gallery_img3'))) : 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&q=80&w=1000' }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Gallery 3">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_title3', __('messages.home_decor')) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-5 h-64 md:h-full" data-aos="zoom-in" data-aos-delay="300">
                <div class="relative h-full rounded-[2.5rem] overflow-hidden group">
                    <img src="{{ \App\Models\SiteSetting::get('cms_gallery_img4') ? (str_starts_with(\App\Models\SiteSetting::get('cms_gallery_img4'), 'http') ? \App\Models\SiteSetting::get('cms_gallery_img4') : asset(\App\Models\SiteSetting::get('cms_gallery_img4'))) : 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=1000' }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="Gallery 4">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-wool/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                        <p class="text-white font-bold text-xl">{{ \App\Models\SiteSetting::getTranslatabled('cms_gallery_title4', __('messages.vintage_series')) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
