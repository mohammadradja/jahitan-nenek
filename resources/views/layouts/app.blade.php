<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    
    <title>@hasSection('title') @yield('title') - {{ \App\Models\SiteSetting::get('site_name', 'Jahitan Nenek') }} @else {{ \App\Models\SiteSetting::get('site_name', 'Jahitan Nenek') }} | {{ \App\Models\SiteSetting::get('site_tagline', 'Jahitan Kasih Sayang') }} @endif</title>
    <meta name="description" content="Jahitan Nenek menyajikan pakaian jahitan dan brukat berkualitas tinggi dengan kasih sayang, karakter, dan detail yang teliti.">
    <meta name="keywords" content="jahitan, jahitan nenek, brukat, baju brukat, fashion vintage, handmade indonesia">
    @stack('meta')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;600&family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-vintage-cream text-dark-wool font-sans antialiased overflow-x-hidden">
    
    <main class="pt-24 min-h-screen">
        @yield('content')
    </main>
 
    <!-- Global Toast -->
    <x-ui.toast />
 
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
                    <h3 class="text-3xl font-serif font-bold text-white mb-6">🧵 {{ \App\Models\SiteSetting::get('site_name', 'Jahitan Nenek') }}</h3>
                    <p class="leading-relaxed mb-6">{{ __('messages.footer_desc') }}</p>
                    <div class="space-y-3 text-sm opacity-80">
                        <p class="flex items-center"><i class="fa-solid fa-location-dot mr-3 text-soft-rose"></i> {{ __('messages.address') }}</p>
                        <p class="flex items-center"><i class="fa-solid fa-envelope mr-3 text-soft-rose"></i> halo@jahitannenek.com</p>
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
                        <a href="{{ \App\Models\SiteSetting::get('cms_instagram_url', 'https://instagram.com') }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="https://tiktok.com" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-tiktok text-xl"></i>
                        </a>
                        <a href="{{ \App\Models\SiteSetting::get('cms_whatsapp_url', 'https://wa.me/628123456789') }}" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-green-500 hover:text-white transition-all hover:-translate-y-2">
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
                    <a href="https://instagram.com" target="_blank" class="text-2xl text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="text-2xl text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/628123456789" target="_blank" class="text-2xl text-gray-400 hover:text-green-500 transition-colors"><i class="fab fa-whatsapp"></i></a>
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
        <a href="https://wa.me/628123456789" target="_blank"
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
</body>
</html>
