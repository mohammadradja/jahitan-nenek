@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-vintage-cream py-20 px-6">
    <div class="max-w-6xl w-full">
        <div class="bg-white rounded-[4rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-gray-100 animate__animated animate__fadeIn">
            <!-- Left Side: Visual -->
            <div class="lg:w-1/2 relative hidden lg:block">
                <img src="https://images.unsplash.com/photo-1591405351990-4726e33df58d?q=80&w=1000&auto=format&fit=crop" 
                     class="absolute inset-0 w-full h-full object-cover grayscale opacity-80" alt="">
                <div class="absolute inset-0 bg-soft-rose/20 backdrop-blur-[2px] flex items-center justify-center p-20">
                    <div class="text-white text-center">
                        <h2 class="text-5xl font-serif font-bold mb-6">Selamat Datang Kembali</h2>
                        <p class="text-xl text-white/90 leading-relaxed font-light">Masuk untuk melanjutkan perjalanan rajutan Anda bersama kehangatan Jahitan Nenek.</p>
                        
                        <div class="mt-12 flex justify-center space-x-2">
                            <div class="w-12 h-1.5 bg-white rounded-full"></div>
                            <div class="w-3 h-1.5 bg-white/40 rounded-full"></div>
                            <div class="w-3 h-1.5 bg-white/40 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="lg:w-1/2 p-12 lg:p-24 flex flex-col justify-center">
                <div class="mb-12">
                    <h3 class="text-4xl font-serif font-bold text-dark-wool mb-3">Masuk ke Akun</h3>
                    <p class="text-gray-400">Gunakan email dan kata sandi Anda untuk mulai berbelanja.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Alamat Email</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                <i class="far fa-envelope"></i>
                            </span>
                            <input type="email" name="email" 
                                   class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-5 pl-14 pr-6 outline-none focus:bg-white focus:border-soft-rose focus:ring-4 focus:ring-soft-rose/10 transition-all" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a class="text-[10px] font-bold text-soft-rose uppercase tracking-widest hover:underline" href="{{ route('password.request') }}">Lupa Sandi?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" 
                                   class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-5 pl-14 pr-6 outline-none focus:bg-white focus:border-soft-rose focus:ring-4 focus:ring-soft-rose/10 transition-all" 
                                   placeholder="••••••••" required>
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-5 h-5 rounded border-gray-200 text-soft-rose focus:ring-soft-rose cursor-pointer">
                        <label for="remember" class="ml-3 text-sm text-gray-400 font-medium cursor-pointer">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="w-full btn-premium py-5 shadow-2xl shadow-soft-rose/30">
                        Masuk Sekarang <i class="fas fa-arrow-right ml-3"></i>
                    </button>

                    <p class="text-center text-sm text-gray-400">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-dark-wool font-bold hover:text-soft-rose transition-colors">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
