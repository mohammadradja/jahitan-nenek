@extends('layouts.app')

@section('title', __('contact.title'))

@section('content')
<div class="bg-vintage-cream">
    <!-- Premium Header -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-soft-rose/5 blur-3xl rounded-full translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-20 relative text-center" data-aos="fade-down">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-xs">{{ __('contact.title') }}</span>
            <h1 class="text-6xl md:text-7xl font-serif font-bold text-dark-wool mt-6 mb-8 leading-tight">{!! __('contact.hero_title') !!}</h1>
            <div class="w-32 h-1.5 bg-soft-rose mx-auto mt-12 rounded-full"></div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <!-- Row 1: Info & FAQ -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                <!-- Info Column -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="bg-dark-wool text-white rounded-3xl p-8 shadow-xl h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-soft-rose/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                        
                        <h3 class="text-xl font-serif font-bold mb-6">{{ __('contact.contact_info') }}</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-location-dot text-sm"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-[9px] uppercase tracking-widest text-white/40 mb-1">{{ __('contact.workshop') }}</h6>
                                    <p class="text-sm">{{ __('messages.address') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 text-soft-rose border border-white/10">
                                    <i class="fas fa-envelope text-sm"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-[9px] uppercase tracking-widest text-white/40 mb-1">{{ __('contact.email') }}</h6>
                                    <p class="text-sm">halo@jahitannenek.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white hover:bg-soft-rose transition-all border border-white/10"><i class="fab fa-instagram text-sm"></i></a>
                                <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white hover:bg-green-500 transition-all border border-white/10"><i class="fab fa-whatsapp text-sm"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Column -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-50 h-full">
                        <h3 class="text-xl font-serif font-bold text-dark-wool mb-6">{{ __('contact.faq') }}</h3>
                        <div class="space-y-3" x-data="{ active: 1 }">
                            <div class="group bg-gray-50 rounded-2xl overflow-hidden border border-transparent" :class="active === 1 ? 'border-soft-rose/20 bg-white shadow-sm' : ''">
                                <button @click="active = active === 1 ? null : 1" class="w-full px-6 py-4 flex items-center justify-between text-left">
                                    <span class="text-xs font-bold text-dark-wool">{{ __('contact.faq_1_q') }}</span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform" :class="active === 1 ? 'rotate-180 text-soft-rose' : ''"></i>
                                </button>
                                <div x-show="active === 1" class="px-6 pb-4 text-[11px] text-gray-500 leading-relaxed">
                                    {{ __('contact.faq_1_a') }}
                                </div>
                            </div>
                            <div class="group bg-gray-50 rounded-2xl overflow-hidden border border-transparent" :class="active === 2 ? 'border-soft-rose/20 bg-white shadow-sm' : ''">
                                <button @click="active = active === 2 ? null : 2" class="w-full px-6 py-4 flex items-center justify-between text-left">
                                    <span class="text-xs font-bold text-dark-wool">{{ __('contact.faq_2_q') }}</span>
                                    <i class="fas fa-chevron-down text-[10px] transition-transform" :class="active === 2 ? 'rotate-180 text-soft-rose' : ''"></i>
                                </button>
                                <div x-show="active === 2" class="px-6 pb-4 text-[11px] text-gray-500 leading-relaxed">
                                    {{ __('contact.faq_2_a') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                <p class="text-gray-400 font-medium italic">Punya pertanyaan mendesak? Nenek juga tersedia melalui widget WhatsApp di pojok kanan bawah layar Anda.</p>
            </div>
        </div>
    </section>
</div>
@endsection
