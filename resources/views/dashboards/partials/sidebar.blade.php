<aside class="fixed left-0 top-0 h-screen w-[280px] bg-white border-r border-gray-100 p-8 z-50 hidden lg:block overflow-y-auto">
    <div class="mb-10 px-2">
        <h4 class="text-2xl font-serif font-bold text-dark-wool">
            🧵 Jahitan<span class="text-soft-rose">Nenek</span>
        </h4>
        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Panel @yield('role_name')</p>
    </div>

    <nav class="space-y-1">
        <div class="pb-2">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4">Utama</span>
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                <i class="fas fa-chart-line w-5"></i>
                <span class="font-semibold">Ikhtisar</span>
            </a>
        </div>
        
        @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
            <div class="pt-4 pb-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4">Katalog & Penjualan</span>
                <div class="space-y-1 mt-1">
                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                        <i class="fas fa-box w-5"></i>
                        <span class="font-semibold">Manajemen Produk</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                        <i class="fas fa-tags w-5"></i>
                        <span class="font-semibold">Kategori</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                        <i class="fas fa-shopping-bag w-5"></i>
                        <span class="font-semibold">Pesanan</span>
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.blogs.*') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                        <i class="fas fa-newspaper w-5"></i>
                        <span class="font-semibold">Catatan Blog</span>
                    </a>
                </div>
            </div>
        @endif

        @if(auth()->user()->role === 'superadmin')
            <div class="pt-4 pb-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4">Sistem & Keamanan</span>
                <div class="space-y-1 mt-1">
                    <a href="{{ route('superadmin.settings.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('superadmin.settings.*') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50' }}">
                        <i class="fas fa-shield-alt w-5"></i>
                        <span class="font-semibold">Pengaturan API</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-2xl text-dark-wool hover:bg-gray-50 transition-all">
                        <i class="fas fa-users-cog w-5"></i>
                        <span class="font-semibold">Staf & Admin</span>
                    </a>
                </div>
            </div>
            
            <div class="pt-4 pb-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] px-4">Kontrol Cepat</span>
                <div class="space-y-1 mt-1">
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-2xl text-blue-500 hover:bg-blue-50 transition-all">
                        <i class="fas fa-database w-5"></i>
                        <span class="font-semibold">Backup Data</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-2xl text-green-500 hover:bg-green-50 transition-all">
                        <i class="fas fa-file-export w-5"></i>
                        <span class="font-semibold">Ekspor Laporan</span>
                    </a>
                </div>
            </div>
        @endif

        <div class="pt-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition-all focus:outline-none">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-semibold">Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
