<aside x-cloak 
       class="bg-white border-r border-gray-100 z-50 transition-all duration-300 flex-shrink-0 overflow-y-auto overflow-x-hidden sticky top-0 h-screen"
       :class="sidebarOpen ? 'w-[260px] p-6' : 'w-0 p-0 border-none overflow-hidden'">
    
    <div class="mb-8 px-2 flex items-center whitespace-nowrap">
        <div class="flex flex-col">
            <h4 class="text-xl font-serif font-bold text-dark-wool tracking-tight">
                🧵 Jahitan<span class="text-soft-rose">Nenek</span>
            </h4>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1 opacity-70">Panel @yield('role_name')</p>
        </div>
    </div>

    <nav class="space-y-0.5 whitespace-nowrap">
        <div class="pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">Utama</span>
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                <i class="fas fa-chart-line w-4 text-[13px]"></i>
                <span class="font-bold text-xs">Dashboard</span>
            </a>
        </div>
        
        @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
            <div class="pt-4 pb-2">
                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">Bisnis</span>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-box w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Katalog Produk</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-shopping-bag w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Kelola Pesanan</span>
                    </a>
                </div>
            </div>

            <div class="pt-4 pb-2">
                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">Laporan</span>
                <div class="space-y-0.5">
                    <a href="{{ route('admin.reports.index', ['type' => 'sales']) }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request('type') === 'sales' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-dollar-sign w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Penjualan</span>
                    </a>
                    <a href="{{ route('admin.reports.index', ['type' => 'stock']) }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request('type') === 'stock' ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-boxes w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Inventaris</span>
                    </a>
                </div>
            </div>
        @endif

        @if(auth()->user()->role === 'superadmin')
            <div class="pt-4 pb-2">
                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">Otoritas</span>
                <div class="space-y-0.5">
                    <a href="{{ route('superadmin.staff.index') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('superadmin.staff.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-users-cog w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Manajemen Staf</span>
                    </a>
                    <a href="{{ route('superadmin.settings.index') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('superadmin.settings.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:pl-5' }}">
                        <i class="fas fa-cog w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">Settings</span>
                    </a>
                </div>
            </div>
        @endif

        <div class="pt-8 mt-8 border-t border-gray-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 rounded-xl text-red-400 hover:bg-red-50 transition-all hover:pl-5 focus:outline-none">
                    <i class="fas fa-sign-out-alt w-4 text-[13px]"></i>
                    <span class="font-bold text-xs">Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
