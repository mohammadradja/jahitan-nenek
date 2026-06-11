@extends('layouts.app')

@section('title', __('about.title'))

@section('content')
<div class="bg-vintage-cream">
    <!-- Premium Header -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-soft-rose/5 blur-3xl rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-20 relative text-center" data-aos="fade-down">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">{{ __('about.heritage') }}</span>
            <h1 class="text-6xl md:text-7xl font-serif font-bold text-dark-wool mt-6 mb-8 leading-tight">{!! __('about.hero_title') !!}</h1>
            <div class="w-32 h-1.5 bg-soft-rose mx-auto mt-12 rounded-full"></div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative" data-aos="fade-right">
                    <div class="relative z-10 rounded-[4rem] overflow-hidden shadow-2xl">
                        <img src="{{ \App\Models\SiteSetting::get('cms_about_image') ? asset(\App\Models\SiteSetting::get('cms_about_image')) : 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?q=80&w=1000&auto=format&fit=crop' }}" 
                             class="w-full aspect-[4/5] object-cover hover:scale-105 transition-transform duration-700" alt="Nenek Menjahit">
                    </div>
                    <!-- Accents -->
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-soft-rose/10 rounded-full blur-3xl -z-10"></div>
                    <div class="absolute -top-10 -left-10 w-64 h-64 border-2 border-soft-rose/20 rounded-[4rem] -z-10"></div>
                    
                    <div class="absolute bottom-12 -right-8 bg-dark-wool text-white p-8 rounded-[2rem] shadow-2xl z-20 hidden md:block">
                        <p class="text-xs font-bold uppercase tracking-widest text-soft-rose mb-1">{{ __('about.since') }}</p>
                        <h4 class="text-3xl font-serif font-bold">1978</h4>
                    </div>
                </div>

                <div class="space-y-10" data-aos="fade-left">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-dark-wool leading-tight">{!! \App\Models\SiteSetting::getTranslatabled('cms_about_title', __('about.love_in_every_knot')) !!}</h2>
                    <p class="text-lg text-gray-500 leading-relaxed italic">
                        {{ __('about.quote') }}
                    </p>
                    @if(\App\Models\SiteSetting::getTranslatabled('cms_about_text'))
                        <p class="text-gray-400 leading-relaxed">
                            {{ \App\Models\SiteSetting::getTranslatabled('cms_about_text') }}
                        </p>
                    @else
                        <p class="text-gray-400 leading-relaxed">
                            {{ __('about.desc_1') }}
                        </p>
                        <p class="text-gray-400 leading-relaxed">
                            {{ __('about.desc_2') }}
                        </p>
                    @endif
                    
                    <div class="grid grid-cols-3 gap-8 pt-10 border-t border-gray-100">
                        <div>
                            <h3 class="text-3xl font-serif font-bold text-soft-rose mb-2">100%</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('about.handmade') }}</p>
                        </div>
                        <div class="border-l border-gray-100 pl-8">
                            <h3 class="text-3xl font-serif font-bold text-soft-rose mb-2">Premium</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('about.premium_materials') }}</p>
                        </div>
                        <div class="border-l border-gray-100 pl-8">
                            <h3 class="text-3xl font-serif font-bold text-soft-rose mb-2">Local</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('about.local_artisans') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-32 bg-white/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
            <h2 class="text-4xl font-serif font-bold text-dark-wool mb-20" data-aos="fade-up">{{ __('about.vision_mission') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="stat-card group" data-aos="zoom-in" data-aos-delay="100">
                    <div class="w-16 h-16 rounded-2xl bg-soft-rose/10 text-soft-rose flex items-center justify-center text-2xl mx-auto mb-8 group-hover:bg-soft-rose group-hover:text-white transition-all duration-500">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="text-xl font-bold text-dark-wool mb-4">{{ __('about.quality_heart') }}</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">{{ __('about.quality_heart_desc') }}</p>
                </div>

                <div class="stat-card group" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-16 h-16 rounded-2xl bg-soft-rose/10 text-soft-rose flex items-center justify-center text-2xl mx-auto mb-8 group-hover:bg-soft-rose group-hover:text-white transition-all duration-500">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-dark-wool mb-4">{{ __('about.empower') }}</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">{{ __('about.empower_desc') }}</p>
                </div>

                <div class="stat-card group" data-aos="zoom-in" data-aos-delay="300">
                    <div class="w-16 h-16 rounded-2xl bg-soft-rose/10 text-soft-rose flex items-center justify-center text-2xl mx-auto mb-8 group-hover:bg-soft-rose group-hover:text-white transition-all duration-500">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4 class="text-xl font-bold text-dark-wool mb-4">{{ __('about.sustainable') }}</h4>
                    <p class="text-sm text-gray-400 leading-relaxed">{{ __('about.sustainable_desc') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
