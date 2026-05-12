<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
    <div class="flex items-center gap-6">
        <button @click="sidebarOpen = !sidebarOpen" class="w-12 h-12 rounded-xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-dark-wool hover:text-soft-rose transition-all">
            <i class="fas fa-bars-staggered"></i>
        </button>
        <div>
            <h2 class="text-3xl font-serif font-bold text-dark-wool">@yield('page_title')</h2>
            <p class="text-gray-400 mt-1">Selamat datang kembali, <span class="text-dark-wool font-semibold">{{ auth()->user()->name }}</span>!</p>
        </div>
    </div>
    <div class="flex items-center space-x-4 bg-white p-2 pr-6 rounded-2xl shadow-sm border border-gray-100">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=E8A0BF&color=fff" 
             class="w-12 h-12 rounded-xl shadow-inner border-2 border-white" 
             alt="{{ auth()->user()->name }}">
        <div class="hidden sm:block">
            <p class="text-sm font-bold text-dark-wool leading-tight">{{ auth()->user()->name }}</p>
            <p class="text-[10px] font-bold text-soft-rose uppercase tracking-widest mt-0.5">{{ auth()->user()->role }}</p>
        </div>
    </div>
</header>
