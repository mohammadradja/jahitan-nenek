<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @php
        $siteName = \App\Models\SiteSetting::get('site_name', 'Jahitan Nenek');
        $siteTagline = \App\Models\SiteSetting::get('site_tagline', 'Jahitan Kasih Sayang');
        $siteDescription = \App\Models\SiteSetting::get('site_description', 'Jahitan Nenek menyajikan pakaian jahitan dan brukat berkualitas tinggi dengan kasih sayang, karakter, dan detail yang teliti.');
        $siteKeywords = \App\Models\SiteSetting::get('site_keywords', 'jahitan, jahitan nenek, brukat, baju brukat, fashion vintage, handmade indonesia');
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon', 'assets/logo.png');
        $canonicalUrl = \App\Models\SiteSetting::get('seo_canonical_url') ?: url()->current();
        $ogTitle = \App\Models\SiteSetting::get('seo_og_title', $siteName);
        $ogDescription = \App\Models\SiteSetting::get('seo_og_description', $siteDescription);
        $ogImage = \App\Models\SiteSetting::get('seo_og_image', 'assets/logo.png');
        $ogImageUrl = $ogImage && str_starts_with($ogImage, 'http') ? $ogImage : asset($ogImage ?: 'assets/logo.png');
        $gtmId = trim((string) \App\Models\SiteSetting::get('google_tag_manager_id', ''));
        $gaId = trim((string) \App\Models\SiteSetting::get('google_analytics_id', ''));
        $googleAdsTagId = trim((string) \App\Models\SiteSetting::get('google_ads_tag_id', ''));
        $gtagPrimaryId = $gaId ?: $googleAdsTagId;
        $cmsInstagramUrl = \App\Models\SiteSetting::get('cms_instagram_url', 'https://instagram.com');
        $cmsWhatsappUrl = \App\Models\SiteSetting::get('cms_whatsapp_url', 'https://wa.me/628123456789');
        $cmsTiktokUrl = \App\Models\SiteSetting::get('cms_tiktok_url', 'https://tiktok.com');
        $cmsShopeeUrl = \App\Models\SiteSetting::get('cms_shopee_url');
        $footerEmail = \App\Models\SiteSetting::get('cms_footer_email', 'halo@jahitannenek.com');
        $footerAddress = \App\Models\SiteSetting::get('cms_footer_address', __('messages.address'));
        $promoEnabled = \App\Models\SiteSetting::get('promo_enabled', '0') == '1';
        $promoPopupEnabled = \App\Models\SiteSetting::get('promo_popup_enabled', '0') == '1';
        $notificationEnabled = \App\Models\SiteSetting::get('notification_enabled', '0') == '1';
        $promoPopupCtaUrl = \App\Models\SiteSetting::get('promo_popup_cta_url') ?: route('home') . '#produk';
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ str_starts_with($siteFavicon, 'http') ? $siteFavicon : asset($siteFavicon) }}" type="image/png">
    
    <title>@hasSection('title') @yield('title') - {{ $siteName }} @else {{ $siteName }} | {{ $siteTagline }} @endif</title>
    <meta name="description" content="{{ $siteDescription }}">
    <meta name="keywords" content="{{ $siteKeywords }}">
    <meta name="author" content="{{ \App\Models\SiteSetting::get('seo_meta_author', $siteName) }}">
    <meta name="robots" content="{{ \App\Models\SiteSetting::get('seo_meta_robots', 'index,follow') }}">
    @if(\App\Models\SiteSetting::get('google_site_verification'))
        <meta name="google-site-verification" content="{{ \App\Models\SiteSetting::get('google_site_verification') }}">
    @endif
    @if(\App\Models\SiteSetting::get('facebook_domain_verification'))
        <meta name="facebook-domain-verification" content="{{ \App\Models\SiteSetting::get('facebook_domain_verification') }}">
    @endif
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:type" content="{{ \App\Models\SiteSetting::get('seo_og_type', 'website') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta name="twitter:card" content="{{ \App\Models\SiteSetting::get('seo_twitter_card', 'summary_large_image') }}">
    @if(\App\Models\SiteSetting::get('seo_twitter_site'))
        <meta name="twitter:site" content="{{ \App\Models\SiteSetting::get('seo_twitter_site') }}">
    @endif
    @stack('meta')

    @if($gtmId)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $gtmId }}');
        </script>
    @endif
    @if($gtagPrimaryId)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtagPrimaryId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            @if($gaId)
                gtag('config', '{{ $gaId }}');
            @endif
            @if($googleAdsTagId)
                gtag('config', '{{ $googleAdsTagId }}');
            @endif
        </script>
    @endif
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;600&family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-vintage-cream text-dark-wool font-sans antialiased overflow-x-hidden">
    @if($gtmId)
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    
    <main class="pt-24 min-h-screen">
        @yield('content')
    </main>
 
    <!-- Global Toast -->
    <x-ui.toast />

    @if(!request()->has('preview_as_guest') && (($promoEnabled && $promoPopupEnabled) || $notificationEnabled))
        <div
            x-data="{
                show: false,
                seenKey: 'jahitan-nenek-storefront-popup',
                init() {
                    if (!sessionStorage.getItem(this.seenKey)) {
                        this.show = true;
                        sessionStorage.setItem(this.seenKey, '1');
                    }
                },
                close() { this.show = false; }
            }"
            x-show="show"
            x-cloak
            class="fixed inset-0 px-4 pt-28 pb-6 sm:pt-32 flex items-start justify-center"
            style="z-index: 2147483646; display: none;"
        >
            <div class="fixed inset-0 bg-dark-wool/55 backdrop-blur-sm" @click="close()"></div>
            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="relative w-full max-w-lg bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-white/70"
            >
                <button type="button" @click="close()" class="absolute top-4 right-4 w-9 h-9 rounded-xl bg-white/80 text-gray-400 hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                    <i class="fas fa-xmark"></i>
                </button>

                @if($promoEnabled && $promoPopupEnabled)
                    <div class="bg-dark-wool text-white px-8 pt-10 pb-8">
                        <p class="text-[10px] font-bold text-soft-rose uppercase tracking-[0.3em] mb-3">{{ \App\Models\SiteSetting::get('promo_label', 'Promo Spesial') }}</p>
                        <h3 class="text-3xl font-serif font-bold pr-10">{{ \App\Models\SiteSetting::get('promo_popup_title', 'Promo Spesial Jahitan Nenek') }}</h3>
                        <p class="mt-4 text-sm leading-relaxed text-white/75">{{ \App\Models\SiteSetting::get('promo_popup_message', \App\Models\SiteSetting::get('promo_description', 'Harga spesial untuk koleksi pilihan Jahitan Nenek.')) }}</p>
                        <div class="mt-6 flex flex-wrap items-end gap-4">
                            @if(\App\Models\SiteSetting::get('promo_original_price'))
                                <span class="text-lg font-bold text-white/35 line-through">Rp{{ number_format((int) \App\Models\SiteSetting::get('promo_original_price'), 0, ',', '.') }}</span>
                            @endif
                            @if(\App\Models\SiteSetting::get('promo_real_price'))
                                <span class="text-3xl font-serif font-bold text-soft-rose">Rp{{ number_format((int) \App\Models\SiteSetting::get('promo_real_price'), 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                @if($notificationEnabled)
                    <div class="px-8 py-6 {{ $promoEnabled && $promoPopupEnabled ? 'border-b border-gray-100' : 'pt-10' }}">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.25em] mb-2">Pemberitahuan</p>
                        <h4 class="text-xl font-serif font-bold text-dark-wool">{{ \App\Models\SiteSetting::get('notification_title', 'Info Jahitan Nenek') }}</h4>
                        <p class="mt-3 text-sm leading-relaxed text-gray-500">{{ \App\Models\SiteSetting::get('notification_message', '') }}</p>
                    </div>
                @endif

                <div class="px-8 py-6 bg-gray-50/80 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-end">
                    <button type="button" @click="close()" class="btn-secondary btn-sm">Nanti Saja</button>
                    @if($promoEnabled && $promoPopupEnabled)
                        <a href="{{ $promoPopupCtaUrl }}" @click="close()" class="btn-primary btn-sm text-center">{{ \App\Models\SiteSetting::get('promo_popup_cta_label', 'Lihat Koleksi') }}</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
 
    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('success') }}", type: 'success' } }));
            });
        </script>
    @endif
 
    @if(session('error'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('error') }}", type: 'error' } }));
            });
        </script>
    @endif
 
    <!-- Footer -->
    <footer class="bg-dark-wool text-white/80 pt-32 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-20">
                <div>
                    <h3 class="text-3xl font-serif font-bold text-white mb-6">🧵 {{ $siteName }}</h3>
                    <p class="leading-relaxed mb-6">{{ __('messages.footer_desc') }}</p>
                    <div class="space-y-3 text-sm opacity-80">
                        <p class="flex items-center"><i class="fa-solid fa-location-dot mr-3 text-soft-rose"></i> {{ $footerAddress }}</p>
                        <p class="flex items-center"><i class="fa-solid fa-envelope mr-3 text-soft-rose"></i> {{ $footerEmail }}</p>
                    </div>
                </div>
                <div class="md:text-center">
                    <h5 class="text-xl font-bold text-white mb-6 font-serif">Quick Links</h5>
                    <div class="flex flex-col space-y-3 items-center text-sm font-semibold">
                        <a href="{{ route('home') }}" class="hover:text-soft-rose transition-colors">{{ __('messages.home') }}</a>
                        <a href="{{ route('about') }}" class="hover:text-soft-rose transition-colors">{{ __('messages.about') }}</a>
                        <a href="{{ route('home') }}#produk" class="hover:text-soft-rose transition-colors">{{ __('messages.collection') }}</a>
                        <a href="{{ route('blog.index') }}" class="hover:text-soft-rose transition-colors">{{ __('messages.blog') }}</a>
                        <a href="{{ route('contact') }}" class="hover:text-soft-rose transition-colors">{{ __('messages.contact') }}</a>
                    </div>
                </div>
                <div class="md:text-right">
                    <h5 class="text-xl font-bold text-white mb-6 font-serif">{{ __('messages.follow_us') }}</h5>
                    <div class="flex md:justify-end space-x-4">
                        <a href="{{ $cmsInstagramUrl }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="{{ $cmsTiktokUrl }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-tiktok text-xl"></i>
                        </a>
                        @if($cmsShopeeUrl)
                            <a href="{{ $cmsShopeeUrl }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-orange-500 hover:text-white transition-all hover:-translate-y-2">
                                <i class="fa-solid fa-store text-xl"></i>
                            </a>
                        @endif
                        <a href="{{ $cmsWhatsappUrl }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-green-500 hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 pt-12 text-center text-sm opacity-50">
                <p>&copy; {{ date('Y') }} {{ __('messages.copyright') }}</p>
            </div>
        </div>
    </footer>
 
    <!-- Premium Glass Navigation -->
    <nav class="fixed top-0 left-0 right-0 glass-effect transition-all duration-500 py-4 px-6 lg:px-20" id="main-nav" style="transform: translateZ(9999px); -webkit-transform: translateZ(9999px);" x-data="{ mobileMenu: false }">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @if(\App\Models\SiteSetting::get('site_logo'))
                    <img src="{{ asset(\App\Models\SiteSetting::get('site_logo')) }}" class="h-10 w-auto object-contain" alt="Logo">
                @else
                    <span class="text-3xl font-serif font-bold tracking-tight">🧵 {{ \App\Models\SiteSetting::get('site_name', 'Jahitan') }}<span class="text-soft-rose">{{ \App\Models\SiteSetting::get('site_name') ? '' : 'Nenek' }}</span></span>
                @endif
            </a>
 
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-10">
                <a href="{{ route('home') }}" class="font-semibold hover:text-soft-rose transition-colors">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="font-semibold hover:text-soft-rose transition-colors">{{ __('messages.about') }}</a>
                <a href="{{ route('home') }}#produk" class="font-semibold hover:text-soft-rose transition-colors">{{ __('messages.collection') }}</a>
                <a href="{{ route('blog.index') }}" class="font-semibold hover:text-soft-rose transition-colors">{{ __('messages.blog') }}</a>
                <a href="{{ route('contact') }}" class="font-semibold hover:text-soft-rose transition-colors">{{ __('messages.contact') }}</a>
            </div>
 
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-1 bg-gray-100/50 rounded-full p-1 border border-gray-100">
                    <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1 rounded-full text-[9px] font-bold tracking-widest transition-all {{ App::getLocale() == 'id' ? 'bg-white text-soft-rose shadow-sm' : 'text-gray-400 hover:text-dark-wool' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full text-[9px] font-bold tracking-widest transition-all {{ App::getLocale() == 'en' ? 'bg-white text-soft-rose shadow-sm' : 'text-gray-400 hover:text-dark-wool' }}">EN</a>
                </div>
 
                <a href="{{ route('cart.index') }}" class="relative group">
                    <i class="fa-solid fa-bag-shopping text-2xl group-hover:text-soft-rose transition-colors"></i>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-soft-rose text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
 
                @if(Auth::check() && !request()->has('preview_as_guest'))
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 font-bold hover:text-soft-rose transition-colors focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-4 w-56 bg-white rounded-2xl shadow-2xl border border-gray-50 p-2 overflow-hidden z-[1000001]">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <i class="fas fa-th-large text-soft-rose"></i>
                                <span class="font-semibold">{{ __('messages.dashboard') }}</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-red-50 text-red-500 transition-colors">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="font-semibold">{{ __('messages.logout') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="font-bold hover:text-soft-rose transition-colors text-sm">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="btn-premium px-6 py-2 text-xs shadow-xl shadow-soft-rose/20">{{ __('messages.register') }}</a>
                    </div>
                @endif
 
                <!-- Mobile Toggle -->
                <button class="lg:hidden text-2xl focus:outline-none relative z-[1000005]" @click="mobileMenu = !mobileMenu">
                    <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars-staggered'"></i>
                </button>
            </div>
        </div>
 
        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-dark-wool/60 backdrop-blur-md mobile-overlay lg:hidden"
             @click="mobileMenu = false"></div>
 
        <!-- Mobile Menu Content -->
        <div x-show="mobileMenu" 
             @click.away="mobileMenu = false"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-full"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-full"
             class="absolute top-0 left-0 right-0 bg-white rounded-b-[3rem] shadow-2xl p-10 pt-24 mobile-content lg:hidden border-b border-gray-100"
             style="display: none;">
            <!-- Close button in drawer header -->
            <div class="flex justify-end -mt-8 mb-6">
                <button @click="mobileMenu = false" class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                    <i class="fas fa-xmark text-lg"></i>
                </button>
            </div>
            <div class="flex flex-col space-y-6 text-center">
                <a href="{{ route('home') }}" @click="mobileMenu = false" class="text-2xl font-serif font-bold text-dark-wool hover:text-soft-rose transition-colors">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" @click="mobileMenu = false" class="text-2xl font-serif font-bold text-dark-wool hover:text-soft-rose transition-colors">{{ __('messages.about') }}</a>
                <a href="{{ route('home') }}#produk" @click="mobileMenu = false" class="text-2xl font-serif font-bold text-dark-wool hover:text-soft-rose transition-colors">{{ __('messages.collection') }}</a>
                <a href="{{ route('blog.index') }}" @click="mobileMenu = false" class="text-2xl font-serif font-bold text-dark-wool hover:text-soft-rose transition-colors">{{ __('messages.blog') }}</a>
                <a href="{{ route('contact') }}" @click="mobileMenu = false" class="text-2xl font-serif font-bold text-dark-wool hover:text-soft-rose transition-colors">{{ __('messages.contact') }}</a>
                @if(Auth::check() && !request()->has('preview_as_guest'))
                    <div class="pt-6 flex flex-col space-y-4 border-t border-gray-50">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Masuk Sebagai: <span class="text-dark-wool">{{ Auth::user()->name }}</span></p>
                        <a href="{{ route('dashboard') }}" @click="mobileMenu = false" class="btn-premium py-3 text-xs uppercase tracking-widest shadow-md">{{ __('messages.dashboard') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-3 rounded-xl bg-red-50 text-red-500 font-bold text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all duration-300">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </div>
                @else
                    <div class="pt-6 flex flex-col space-y-4 border-t border-gray-50">
                        <a href="{{ route('login') }}" @click="mobileMenu = false" class="text-lg font-bold text-dark-wool">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" @click="mobileMenu = false" class="btn-premium py-3 text-xs uppercase tracking-widest shadow-md">{{ __('messages.register') }}</a>
                    </div>
                @endif
                
                <div class="flex justify-center space-x-6 pt-10 border-t border-gray-50">
                    <a href="{{ $cmsInstagramUrl }}" target="_blank" class="text-2xl text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $cmsTiktokUrl }}" target="_blank" class="text-2xl text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-tiktok"></i></a>
                    @if($cmsShopeeUrl)
                        <a href="{{ $cmsShopeeUrl }}" target="_blank" class="text-2xl text-gray-400 hover:text-orange-500 transition-colors"><i class="fa-solid fa-store"></i></a>
                    @endif
                    <a href="{{ $cmsWhatsappUrl }}" target="_blank" class="text-2xl text-gray-400 hover:text-green-500 transition-colors"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Global Nav/Sidebar Force Top -->
    <style>
        #main-nav, #dashboard-sidebar, .mobile-overlay, .mobile-content {
            z-index: 2147483647 !important;
        }
    </style>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 1000, once: true });

            const nav = document.getElementById('main-nav');
            if (nav) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        nav.classList.add('shadow-xl', 'py-2');
                        nav.classList.remove('py-4');
                    } else {
                        nav.classList.remove('shadow-xl', 'py-2');
                        nav.classList.add('py-4');
                    }
                });
            }
        });
    </script>
    <!-- Floating Widgets -->
    <div class="fixed bottom-8 right-8 flex flex-col gap-4" style="z-index: 2147483640;" x-data="{ showScrollTop: false }" @scroll.window="showScrollTop = (window.pageYOffset > 500)">
        <!-- Scroll to Top -->
        <button x-show="showScrollTop" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="w-14 h-14 bg-white text-dark-wool rounded-2xl shadow-2xl flex items-center justify-center hover:bg-soft-rose hover:text-white transition-all duration-500 group border border-gray-100">
            <i class="fas fa-chevron-up transition-transform group-hover:-translate-y-1"></i>
        </button>

        <!-- WhatsApp Floating -->
        <a href="{{ $cmsWhatsappUrl }}" target="_blank"
           class="w-14 h-14 bg-green-500 text-white rounded-2xl shadow-2xl flex items-center justify-center hover:bg-green-600 hover:-translate-y-2 transition-all duration-500 group relative">
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white animate-bounce"></span>
            <i class="fab fa-whatsapp text-2xl"></i>
            
            <!-- Tooltip -->
            <div class="absolute right-full mr-4 bg-dark-wool text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest whitespace-nowrap opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition-all duration-500 pointer-events-none">
                Chat Nenek
            </div>
        </a>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('click', (event) => {
            const target = event.target.closest('a, button');
            if (!target || target.closest('[data-no-analytics]')) {
                return;
            }

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!token) {
                return;
            }

            const payload = new FormData();
            payload.append('_token', token);
            payload.append('path', window.location.pathname.replace(/^\/+/, '') || '/');
            payload.append('target', (target.getAttribute('data-analytics-label') || target.href || target.textContent || '').trim().slice(0, 255));

            if (navigator.sendBeacon) {
                navigator.sendBeacon('{{ route('analytics.click') }}', payload);
                return;
            }

            fetch('{{ route('analytics.click') }}', {
                method: 'POST',
                body: payload,
                keepalive: true,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).catch(() => {});
        }, { capture: true });
    </script>
</body>
</html>
