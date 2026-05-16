<div class="mb-8 px-2 flex items-center whitespace-nowrap">
    <div class="flex flex-col">
        <h4 class="text-xl font-serif font-bold text-dark-wool tracking-tight">
            🧵 Jahitan<span class="text-soft-rose">Nenek</span>
        </h4>
        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1 opacity-70">Panel @yield('role_name')</p>
    </div>
    <a href="{{ route('home') }}" class="ml-auto w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm group" title="Kembali ke Beranda">
        <i class="fas fa-home text-sm group-hover:scale-110 transition-transform"></i>
    </a>
</div>

<nav class="space-y-0.5 whitespace-nowrap">
    <div class="pb-2">
        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">{{ __('dashboard.main') }}</span>
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
            <i class="fas fa-chart-line w-4 text-[13px]"></i>
            <span class="font-bold text-sm">{{ __('dashboard.dashboard') }}</span>
        </a>
    </div>
    
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
        <div class="pt-4 pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">{{ __('dashboard.business') }}</span>
            <div class="space-y-1.5">
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-box w-4 text-[13px]"></i>
                    <span class="font-bold text-sm">{{ __('dashboard.catalog') }}</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-shopping-bag w-4 text-[13px]"></i>
                    <span class="font-bold text-sm">{{ __('dashboard.orders') }}</span>
                </a>
                <a href="{{ route('admin.blogs.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.blogs.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-newspaper w-4 text-[13px]"></i>
                    <span class="font-bold text-sm">{{ __('dashboard.blog') }}</span>
                </a>
            </div>
        </div>

        <div class="pt-4 pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">{{ __('dashboard.reports') }}</span>
            <div class="space-y-1.5">
                    <a href="{{ route(auth()->user()->role . '.reports.sales') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('*.reports.sales') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                        <i class="fas fa-chart-line w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">{{ __('dashboard.sales') }}</span>
                    </a>
                    <a href="{{ route(auth()->user()->role . '.reports.stock') }}" 
                       class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('*.reports.stock') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                        <i class="fas fa-boxes w-4 text-[13px]"></i>
                        <span class="font-bold text-xs">{{ __('dashboard.stock') }}</span>
                    </a>
                    @if(auth()->user()->role === 'superadmin')
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl text-dark-wool hover:bg-gray-50 hover:translate-x-1 transition-all duration-300 group opacity-50 cursor-not-allowed">
                            <i class="fas fa-users w-4 text-[13px]"></i>
                            <span class="font-bold text-xs">{{ __('dashboard.customer_report') }}</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl text-dark-wool hover:bg-gray-50 hover:translate-x-1 transition-all duration-300 group opacity-50 cursor-not-allowed">
                            <i class="fas fa-wallet w-4 text-[13px]"></i>
                            <span class="font-bold text-xs">{{ __('dashboard.financial_report') }}</span>
                        </a>
                    @endif
            </div>
        </div>
    @endif

    @if(auth()->user()->role === 'superadmin')
        <div class="pt-4 pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">{{ __('dashboard.authority') }}</span>
            <div class="space-y-1.5">
                <a href="{{ route('superadmin.staff.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('superadmin.staff.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-users-cog w-4 text-[13px]"></i>
                    <span class="font-bold text-xs">{{ __('dashboard.staff') }}</span>
                </a>
                <a href="{{ route('superadmin.customers.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('superadmin.customers.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-user-friends w-4 text-[13px]"></i>
                    <span class="font-bold text-xs">{{ __('dashboard.customers') }}</span>
                </a>
                <a href="{{ route('superadmin.settings.index') }}" 
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('superadmin.settings.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                    <i class="fas fa-cog w-4 text-[13px]"></i>
                    <span class="font-bold text-xs">{{ __('dashboard.settings') }}</span>
                </a>
            </div>
        </div>
    @endif

    <div class="pt-4 pb-2">
        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2">{{ __('dashboard.account') }}</span>
        <div class="space-y-1.5">
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center space-x-3 px-4 py-2.5 rounded-xl transition-all duration-300 {{ request()->routeIs('profile.edit') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}">
                <i class="fas fa-user-circle w-4 text-[13px]"></i>
                <span class="font-bold text-sm">{{ __('dashboard.profile') }}</span>
            </a>
        </div>
    </div>

    <div class="pt-8 mt-8 border-t border-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 rounded-xl text-red-400 hover:bg-red-50 transition-all hover:pl-5 focus:outline-none">
                <i class="fas fa-sign-out-alt w-4 text-[13px]"></i>
                <span class="font-bold text-sm">{{ __('dashboard.logout') }}</span>
            </button>
        </form>
    </div>
</nav>
