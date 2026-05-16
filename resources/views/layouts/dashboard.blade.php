<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Jahitan Nenek</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: window.innerWidth > 1024 }" 
      @resize.window="if (window.innerWidth > 1024) sidebarOpen = true"
      class="h-screen overflow-hidden bg-gray-50/50 font-outfit antialiased">
    
    <div class="flex h-full overflow-hidden bg-gray-50">
        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden relative z-0 transition-all duration-500"
             :class="sidebarOpen ? 'lg:pl-[280px]' : ''">
            <!-- Sticky Glass Topbar -->
            <header class="sticky top-0 z-[100] px-6 md:px-10 py-6 bg-gray-50/80 backdrop-blur-md border-b border-gray-100/50 flex-shrink-0">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-6">
                        <!-- Sidebar Toggle Button -->
                        <button @click="sidebarOpen = !sidebarOpen" 
                                class="w-14 h-14 rounded-xl bg-dark-wool text-white flex items-center justify-center transition-all shadow-xl hover:bg-soft-rose active:scale-95 group">
                            <i class="fas transition-transform duration-500" :class="sidebarOpen ? 'fa-bars-staggered' : 'fa-bars rotate-180'"></i>
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
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 md:p-8 lg:p-10 animate__animated animate__fadeIn animate__faster">
                @yield('dashboard_content')
            </main>
        </div>
    </div>

    <!-- Sidebar Backdrop (Mobile Only) -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         id="dashboard-backdrop"
         class="fixed inset-0 bg-dark-wool/40 backdrop-blur-sm lg:hidden mobile-overlay"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
    </div>

    <!-- Sidebar -->
    <aside x-cloak 
           id="dashboard-sidebar"
           class="fixed top-0 left-0 h-full bg-white border-r border-gray-100 transition-all duration-500 ease-in-out flex-shrink-0 overflow-y-auto overflow-x-hidden shadow-2xl shadow-dark-wool/5"
           style="transform: translateZ(9999px); -webkit-transform: translateZ(9999px);"
           :class="sidebarOpen ? 'w-[280px] opacity-100 translate-x-0' : 'w-0 opacity-0 -translate-x-full !border-none'">
        <div class="w-[280px]">
            @include('dashboards.partials.sidebar')
        </div>
    </aside>

    <!-- Global Nav/Sidebar Force Top -->
    <style>
        #main-nav, #dashboard-sidebar, #dashboard-backdrop, .mobile-overlay, .mobile-content {
            z-index: 2147483647 !important;
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

    @stack('scripts')
</body>
</html>
