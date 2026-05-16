<div class="flex items-center space-x-6">
    <!-- Language Switcher -->
    <div class="flex items-center space-x-1 bg-white/50 p-1 rounded-xl border border-gray-100 shadow-sm">
        <a href="{{ route('lang.switch', 'id') }}" class="px-4 py-2 rounded-lg text-xs font-bold tracking-widest transition-all {{ App::getLocale() == 'id' ? 'bg-soft-rose text-white shadow-md' : 'text-gray-400 hover:text-dark-wool' }}">ID</a>
        <a href="{{ route('lang.switch', 'en') }}" class="px-4 py-2 rounded-lg text-xs font-bold tracking-widest transition-all {{ App::getLocale() == 'en' ? 'bg-soft-rose text-white shadow-md' : 'text-gray-400 hover:text-dark-wool' }}">EN</a>
    </div>

    <div class="flex items-center space-x-4 bg-white p-2 pr-6 rounded-2xl shadow-sm border border-gray-100 group hover:shadow-md transition-all">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=E8A0BF&color=fff" 
             class="w-12 h-12 rounded-xl shadow-inner border-2 border-white group-hover:scale-105 transition-transform" 
             alt="{{ auth()->user()->name }}">
        <div class="hidden sm:block">
            <p class="text-sm font-bold text-dark-wool leading-tight">{{ auth()->user()->name }}</p>
            <p class="text-xs font-bold text-soft-rose uppercase tracking-widest mt-0.5">{{ auth()->user()->role }}</p>
        </div>
    </div>
</div>
