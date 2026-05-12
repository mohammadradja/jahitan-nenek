<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Jahitan Nenek | Rajutan Kasih Sayang')</title>
    <meta name="description" content="Jahitan Nenek menyajikan rajutan tangan berkualitas tinggi dengan kasih sayang. Temukan cardigan, amigurumi, dan aksesoris rajut terbaik di sini.">
    <meta name="keywords" content="rajutan, handmade, knitting, jahitan nenek, fashion vintage, amigurumi indonesia">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;600&family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-vintage-cream text-dark-wool font-sans antialiased overflow-x-hidden">
    
    <!-- Premium Glass Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect transition-all duration-500 py-4 px-6 lg:px-20" id="main-nav">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-3xl font-serif font-bold tracking-tight">
                🧵 Jahitan<span class="text-soft-rose">Nenek</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-10">
                <a href="{{ route('home') }}" class="font-semibold hover:text-soft-rose transition-colors">Beranda</a>
                <a href="{{ route('about') }}" class="font-semibold hover:text-soft-rose transition-colors">Tentang</a>
                <a href="{{ route('home') }}#produk" class="font-semibold hover:text-soft-rose transition-colors">Koleksi</a>
                <a href="{{ route('blog.index') }}" class="font-semibold hover:text-soft-rose transition-colors">Cerita Nenek</a>
                <a href="{{ route('contact') }}" class="font-semibold hover:text-soft-rose transition-colors">Kontak</a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="relative group">
                    <i class="fa-solid fa-bag-shopping text-2xl group-hover:text-soft-rose transition-colors"></i>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-soft-rose text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 font-bold hover:text-soft-rose transition-colors focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-4 w-56 bg-white rounded-2xl shadow-2xl border border-gray-50 p-2 overflow-hidden">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <i class="fas fa-th-large text-soft-rose"></i>
                                <span class="font-semibold">Dashboard</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-red-50 text-red-500 transition-colors">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="font-semibold">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="font-bold hover:text-soft-rose transition-colors text-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-premium px-6 py-2 text-xs shadow-xl shadow-soft-rose/20">Daftar</a>
                    </div>
                @endauth

                <!-- Mobile Toggle -->
                <button class="lg:hidden text-2xl focus:outline-none" id="mobile-toggle">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Placeholder -->
        <div class="lg:hidden hidden bg-white rounded-[2rem] shadow-2xl mt-4 p-6 animate__animated animate__fadeInDown border border-gray-50" id="mobile-menu">
            <div class="flex flex-col space-y-4 text-center">
                <a href="{{ route('home') }}" class="text-lg font-bold text-dark-wool">Beranda</a>
                <a href="{{ route('about') }}" class="text-lg font-bold text-dark-wool">Tentang</a>
                <a href="{{ route('home') }}#produk" class="text-lg font-bold text-dark-wool">Koleksi</a>
                <a href="{{ route('blog.index') }}" class="text-lg font-bold text-dark-wool">Cerita</a>
                <a href="{{ route('contact') }}" class="text-lg font-bold text-dark-wool">Kontak</a>
                @guest
                    <hr class="border-gray-50">
                    <a href="{{ route('login') }}" class="text-lg font-bold text-dark-wool">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-premium py-3 text-sm">Daftar</a>
                @endguest
                
                <!-- Social Icons for Mobile -->
                <div class="flex justify-center space-x-4 pt-2">
                    <a href="https://instagram.com" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-soft-rose transition-colors"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/628123456789" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-green-500 transition-colors"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </nav>

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
                    <h3 class="text-3xl font-serif font-bold text-white mb-6">🧵 Jahitan Nenek</h3>
                    <p class="leading-relaxed">Warisan tradisi dalam setiap rajutan tangan. Kami percaya setiap barang yang dibuat dengan sabar memiliki jiwa yang berbeda dan kehangatan yang abadi.</p>
                </div>
                <div class="md:text-center">
                    <h5 class="text-xl font-bold text-white mb-6 font-serif">Hubungi Kami</h5>
                    <div class="space-y-4">
                        <p class="flex items-center md:justify-center">
                            <i class="fa-solid fa-location-dot mr-3 text-soft-rose"></i>
                            Jl. Benang No. 123, Bandung
                        </p>
                        <p class="flex items-center md:justify-center">
                            <i class="fa-solid fa-envelope mr-3 text-soft-rose"></i>
                            halo@jahitannenek.com
                        </p>
                        <a href="{{ route('order.track') }}" class="inline-flex items-center mt-4 text-white hover:text-soft-rose transition-colors underline decoration-soft-rose decoration-2 underline-offset-8">
                            <i class="fas fa-search-location mr-2"></i> Lacak Pesanan
                        </a>
                    </div>
                </div>
                <div class="md:text-right">
                    <h5 class="text-xl font-bold text-white mb-6 font-serif">Ikuti Perjalanan Kami</h5>
                    <div class="flex md:justify-end space-x-4">
                        <a href="https://instagram.com" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="https://tiktok.com" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-soft-rose hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-tiktok text-xl"></i>
                        </a>
                        <a href="https://wa.me/628123456789" target="_blank" class="w-12 h-12 bg-white/5 flex items-center justify-center rounded-2xl hover:bg-green-500 hover:text-white transition-all hover:-translate-y-2">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 pt-12 text-center text-sm opacity-50">
                <p>&copy; {{ date('Y') }} Jahitan Nenek. Crafting Heritage with Love.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('shadow-xl', 'py-2');
                nav.classList.remove('py-4');
            } else {
                nav.classList.remove('shadow-xl', 'py-2');
                nav.classList.add('py-4');
            }
        });

        // Mobile Menu Toggle
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
