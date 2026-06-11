<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <title>@yield('page_title', 'Dashboard') | {{ \App\Models\SiteSetting::get('site_name', 'Jahitan Nenek') }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: window.innerWidth > 1024, mobileMenuOpen: false }" 
      @resize.window="if (window.innerWidth > 1024) { sidebarOpen = true; mobileMenuOpen = false; } else { sidebarOpen = false; }"
      class="h-screen overflow-hidden bg-gray-50/50 font-outfit antialiased">
    
    <div class="flex h-full overflow-hidden bg-gray-50">
        
        <!-- Sidebar (Desktop Only) - Regular Flex Child -->
        <aside x-cloak 
               id="dashboard-sidebar"
               class="hidden lg:block h-full bg-white border-r border-gray-100 transition-all duration-500 ease-in-out flex-shrink-0 overflow-y-auto overflow-x-hidden shadow-2xl shadow-dark-wool/5"
               :class="sidebarOpen ? 'w-[280px] opacity-100' : 'w-[80px] opacity-100'">
            <div :class="sidebarOpen ? 'w-[280px] p-6' : 'w-full lg:w-[80px] px-3 py-6 transition-all duration-500'">
                @include('dashboards.partials.sidebar')
            </div>
        </aside>
        
        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden relative transition-all duration-500">
            
            <!-- Sticky Glass Topbar -->
            <header class="sticky top-0 z-[100] px-6 md:px-10 py-6 bg-gray-50/80 backdrop-blur-md border-b border-gray-100/50 flex-shrink-0">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-6">
                        <!-- Mobile Hamburger Toggle Button (Mobile Only) -->
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="lg:hidden w-12 h-12 rounded-xl bg-white border border-gray-100 text-dark-wool flex items-center justify-center transition-all shadow-sm hover:bg-soft-rose hover:text-white active:scale-95 group">
                            <i class="fas transition-transform duration-300" :class="mobileMenuOpen ? 'fa-xmark rotate-90 text-soft-rose' : 'fa-bars'"></i>
                        </button>
                        
                        <div>
                            <h2 class="text-2xl md:text-3xl font-serif font-bold text-dark-wool leading-tight">@yield('page_title')</h2>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-1 font-medium">Selamat datang kembali, <span class="text-dark-wool font-bold">{{ auth()->user()->name }}</span>!</p>
                        </div>
                    </div>
                    @include('dashboards.partials.topbar-right')
                </div>
            </header>

            <!-- Scrollable Content Area -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 md:p-8 lg:p-10">
                <div class="animate__animated animate__fadeIn animate__faster">
                    @yield('dashboard_content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Backdrop Overlay -->
    <div x-cloak
         x-show="mobileMenuOpen"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 bg-dark-wool/50 backdrop-blur-md z-[9998] lg:hidden transition-opacity duration-300"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
    </div>

    <!-- Mobile Navigation Left Drawer -->
    <div x-cloak
         x-show="mobileMenuOpen"
         class="fixed inset-y-0 left-0 w-[280px] bg-white z-[9999] lg:hidden flex flex-col shadow-2xl overflow-hidden transition-transform duration-300 ease-in-out"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         style="display: none;">
         
         <!-- Drawer Header -->
         <div class="p-6 border-b border-gray-50 flex items-center justify-between flex-shrink-0 bg-gray-50/50">
             <div class="flex flex-col">
                 <h4 class="text-lg font-serif font-bold text-dark-wool tracking-tight flex items-center gap-2">
                     @if(\App\Models\SiteSetting::get('site_logo'))
                         <img src="{{ asset(\App\Models\SiteSetting::get('site_logo')) }}" class="h-6 w-auto object-contain" alt="Logo">
                     @else
                         🧵 Jahitan<span class="text-soft-rose">Nenek</span>
                     @endif
                 </h4>
                 <p class="text-[8px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1 opacity-70">Panel @yield('role_name')</p>
             </div>
             <button @click="mobileMenuOpen = false" class="w-8 h-8 rounded-lg bg-white border border-gray-155 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm">
                 <i class="fas fa-xmark text-[11px]"></i>
             </button>
         </div>
         
         <!-- Drawer Navigation Links -->
         <div class="flex-1 overflow-y-auto p-6 space-y-6">
             <div class="space-y-1.5">
                 <span class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.2em] block mb-1">Utama</span>
                 <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                     <i class="fas fa-chart-line w-4"></i> Dashboard
                 </a>
             </div>

             @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
                 <div class="space-y-1.5 pt-4 border-t border-gray-50">
                     <span class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.2em] block mb-1">Bisnis & Katalog</span>
                     <a href="{{ route('admin.products.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                         <i class="fas fa-box w-4"></i> Katalog Produk
                     </a>
                     <a href="{{ route('admin.orders.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                         <i class="fas fa-shopping-bag w-4"></i> Kelola Pesanan
                     </a>
                     <a href="{{ route('admin.blogs.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('admin.blogs.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                         <i class="fas fa-newspaper w-4"></i> Artikel & Blog
                     </a>
                 </div>

                 <div class="space-y-1.5 pt-4 border-t border-gray-50">
                     <span class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.2em] block mb-1">Laporan Analitis</span>
                     <div class="grid grid-cols-2 gap-2">
                         <a href="{{ route(auth()->user()->role . '.reports.sales') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-wider transition-all {{ request()->routeIs('*.reports.sales') ? 'bg-soft-rose text-white shadow-sm' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                             <i class="fas fa-chart-line"></i> Penjualan
                         </a>
                         <a href="{{ route(auth()->user()->role . '.reports.stock') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-wider transition-all {{ request()->routeIs('*.reports.stock') ? 'bg-soft-rose text-white shadow-sm' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                             <i class="fas fa-boxes"></i> Inventaris
                         </a>
                         <a href="{{ route(auth()->user()->role . '.reports.customers') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-wider transition-all {{ request()->routeIs('*.reports.customers') ? 'bg-soft-rose text-white shadow-sm' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                             <i class="fas fa-users"></i> Pelanggan
                         </a>
                         <a href="{{ route(auth()->user()->role . '.reports.finance') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2 px-3 py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-wider transition-all {{ request()->routeIs('*.reports.finance') ? 'bg-soft-rose text-white shadow-sm' : 'bg-gray-50 text-dark-wool hover:bg-gray-100' }}">
                             <i class="fas fa-wallet"></i> Keuangan
                         </a>
                     </div>
                 </div>
             @endif

             <div class="space-y-1.5 pt-4 border-t border-gray-50">
                 <span class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.2em] block mb-1">Otoritas & CMS</span>
                 @if(auth()->user()->role === 'superadmin')
                     <a href="{{ route('superadmin.staff.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('superadmin.staff.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                         <i class="fas fa-users-cog w-4"></i> Kelola Staf
                     </a>
                     <a href="{{ route('superadmin.customers.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('superadmin.customers.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                         <i class="fas fa-user-friends w-4"></i> Data Customer
                     </a>
                 @endif
                 <a href="{{ route(auth()->user()->role . '.cms.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('*.cms.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                     <i class="fas fa-sliders w-4"></i> CMS / Konten
                 </a>
                 <a href="{{ route(auth()->user()->role . '.settings.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('*.settings.*') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                     <i class="fas fa-cog w-4"></i> Pengaturan
                 </a>
             </div>

             <div class="space-y-1.5 pt-4 border-t border-gray-50">
                 <span class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.2em] block mb-1">Akun Saya</span>
                 <a href="{{ route('profile.edit') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ request()->routeIs('profile.edit') ? 'bg-soft-rose text-white shadow-md' : 'text-dark-wool hover:bg-gray-50' }}">
                     <i class="fas fa-user-circle w-4"></i> Profil Saya
                 </a>
             </div>
         </div>

         <!-- Mobile Logout -->
         <div class="p-6 border-t border-gray-50 bg-gray-50/50 flex-shrink-0">
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-red-50 text-red-500 font-bold text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all duration-300">
                     <i class="fas fa-sign-out-alt"></i> Keluar Akun
                 </button>
             </form>
         </div>
    </div>

    <!-- Vertical Edge Toggle Button (Desktop Only) -->
    <button @click="sidebarOpen = !sidebarOpen" 
            class="hidden lg:flex fixed top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white border border-gray-150 shadow-lg items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all duration-500 hover:scale-110 active:scale-95 desktop-sidebar-toggle-btn"
            :style="sidebarOpen ? 'left: 264px;' : 'left: 64px;'">
        <i class="fas text-[10px] transition-transform duration-500" :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
    </button>

    <!-- Global Nav/Sidebar Force Top -->
    <style>
        #main-nav, #dashboard-sidebar {
            z-index: 40 !important;
        }
        .desktop-sidebar-toggle-btn {
            z-index: 45 !important;
        }
    </style>

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

    <!-- SweetAlert2 for Premium Modals & Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Modals Stack (Renders at body root to bypass all sidebar/header stacking contexts) -->
    @stack('modals')

    @stack('scripts')
</body>
</html>
