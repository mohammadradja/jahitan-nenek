<div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col items-center text-center sticky top-24">
    <div class="relative mb-4">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=E8A0BF&color=fff&size=150" 
             class="w-24 h-24 rounded-3xl shadow-lg shadow-soft-rose/10 border-4 border-white" alt="">
        <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 border-4 border-white rounded-full flex items-center justify-center text-white text-[10px]">
            <i class="fas fa-check"></i>
        </div>
    </div>
    
    <h2 class="text-lg font-serif font-bold text-dark-wool">{{ auth()->user()->name }}</h2>
    <p class="text-[8px] font-bold text-gray-300 uppercase tracking-widest mt-1">{{ auth()->user()->email }}</p>

    <nav class="w-full mt-8 space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/10' : 'text-gray-400 hover:bg-gray-50 hover:text-dark-wool' }}">
            <i class="fas fa-shopping-bag text-xs"></i>
            <span class="font-bold text-xs">Pesanan Saya</span>
        </a>
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('profile.edit') ? 'bg-soft-rose text-white shadow-lg shadow-soft-rose/10' : 'text-gray-400 hover:bg-gray-50 hover:text-dark-wool' }}">
            <i class="fas fa-user-edit text-xs"></i>
            <span class="font-bold text-xs">Pengaturan Profil</span>
        </a>
        <div class="pt-4 mt-4 border-t border-gray-50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-xl text-red-400 hover:bg-red-50 transition-all group">
                    <i class="fas fa-sign-out-alt text-xs"></i>
                    <span class="font-bold text-xs">Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</div>
