<div class="mb-8 px-2 flex items-center whitespace-nowrap transition-all duration-500" :class="sidebarOpen ? 'justify-between' : 'lg:justify-center lg:px-0'">
    <div class="flex flex-col" :class="sidebarOpen ? '' : 'lg:hidden'">
        <h4 class="text-xl font-serif font-bold text-dark-wool tracking-tight flex items-center gap-2">
            @if(\App\Models\SiteSetting::get('site_logo'))
                <img src="{{ asset(\App\Models\SiteSetting::get('site_logo')) }}" class="h-6 w-auto object-contain" alt="Logo">
            @else
                🧵 Jahitan<span class="text-soft-rose">Nenek</span>
            @endif
        </h4>
        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1 opacity-70">Panel @yield('role_name')</p>
    </div>
    <div class="flex items-center gap-1.5" :class="sidebarOpen ? '' : 'lg:hidden'">
        <a href="{{ route('home') }}" class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center text-dark-wool hover:bg-soft-rose hover:text-white transition-all shadow-sm group" title="Kembali ke Beranda">
            <i class="fas fa-home text-[13px] group-hover:scale-110 transition-transform"></i>
        </a>
    </div>
    <div class="hidden" :class="sidebarOpen ? 'hidden' : 'lg:flex lg:justify-center lg:w-full'">
        <span class="text-2xl font-serif transition-transform duration-500 hover:scale-110 active:scale-95 cursor-pointer" @click="sidebarOpen = !sidebarOpen">🧵</span>
    </div>
</div>

<nav class="space-y-0.5 whitespace-nowrap">
    <div class="pb-2">
        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.main') }}</span>
        <a href="{{ route('dashboard') }}" 
           class="flex items-center rounded-xl transition-all duration-300"
           :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
           title="{{ __('dashboard.dashboard') }}">
            <i class="fas fa-chart-line text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
            <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.dashboard') }}</span>
        </a>
    </div>
    
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
        <div class="pt-4 pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.business') }}</span>
            <div class="space-y-1.5">
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('admin.products.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.catalog') }}">
                    <i class="fas fa-box text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.catalog') }}</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.orders') }}">
                    <i class="fas fa-shopping-bag text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.orders') }}</span>
                </a>
                <a href="{{ route('admin.blogs.index') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('admin.blogs.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('admin.blogs.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.blog') }}">
                    <i class="fas fa-newspaper text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.blog') }}</span>
                </a>
            </div>
        </div>

        <div class="pt-4 pb-2">
            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.reports') }}</span>
            <div class="space-y-1.5">
                <a href="{{ route(auth()->user()->role . '.reports.sales') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.reports.sales') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.reports.sales') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.sales') }}">
                    <i class="fas fa-chart-line text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.sales') }}</span>
                </a>
                <a href="{{ route(auth()->user()->role . '.reports.stock') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.reports.stock') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.reports.stock') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.stock') }}">
                    <i class="fas fa-boxes text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.stock') }}</span>
                </a>
                <a href="{{ route(auth()->user()->role . '.reports.customers') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.reports.customers') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.reports.customers') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.customer_report') }}">
                    <i class="fas fa-users text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.customer_report') }}</span>
                </a>
                <a href="{{ route(auth()->user()->role . '.reports.finance') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.reports.finance') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.reports.finance') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.financial_report') }}">
                    <i class="fas fa-wallet text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.financial_report') }}</span>
                </a>
            </div>
        </div>
    @endif

    <div class="pt-4 pb-2">
        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.authority') }}</span>
        <div class="space-y-1.5">
            @if(auth()->user()->role === 'superadmin')
                <a href="{{ route('superadmin.staff.index') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('superadmin.staff.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('superadmin.staff.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.staff') }}">
                    <i class="fas fa-users-cog text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.staff') }}</span>
                </a>
                <a href="{{ route('superadmin.customers.index') }}" 
                   class="flex items-center rounded-xl transition-all duration-300"
                   :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('superadmin.customers.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('superadmin.customers.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
                   title="{{ __('dashboard.customers') }}">
                    <i class="fas fa-user-friends text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                    <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.customers') }}</span>
                </a>
            @endif
            <a href="{{ route(auth()->user()->role . '.cms.index') }}" 
               class="flex items-center rounded-xl transition-all duration-300"
               :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.cms.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.cms.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
               title="Content Management System (CMS)">
                <i class="fas fa-sliders text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">CMS / Kelola Konten</span>
            </a>
            <a href="{{ route(auth()->user()->role . '.settings.index') }}" 
               class="flex items-center rounded-xl transition-all duration-300"
               :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('*.settings.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('*.settings.*') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
               title="{{ __('dashboard.settings') }}">
                <i class="fas fa-cog text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                <span class="font-bold text-xs" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.settings') }}</span>
            </a>
        </div>
    </div>

    <div class="pt-4 pb-2">
        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em] px-4 block mb-2" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.account') }}</span>
        <div class="space-y-1.5">
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center rounded-xl transition-all duration-300"
               :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 {{ request()->routeIs('profile.edit') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 hover:translate-x-1 group' }}' : 'justify-center py-3 {{ request()->routeIs('profile.edit') ? 'bg-soft-rose text-white shadow-md shadow-soft-rose/20' : 'text-dark-wool hover:bg-gray-50 group' }}'"
               title="{{ __('dashboard.profile') }}">
                <i class="fas fa-user-circle text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.profile') }}</span>
            </a>
        </div>
    </div>

    <div class="pt-8 mt-8 border-t border-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center rounded-xl text-red-400 hover:bg-red-50 transition-all focus:outline-none"
                    :class="sidebarOpen ? 'space-x-3 px-4 py-2.5 hover:pl-5' : 'justify-center py-3'">
                <i class="fas fa-sign-out-alt text-[14px]" :class="sidebarOpen ? 'w-4' : ''"></i>
                <span class="font-bold text-sm" :class="sidebarOpen ? '' : 'lg:hidden'">{{ __('dashboard.logout') }}</span>
            </button>
        </form>
    </div>
</nav>
