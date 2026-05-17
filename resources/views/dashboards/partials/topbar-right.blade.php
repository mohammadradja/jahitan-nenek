<div class="flex items-center space-x-6">


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
