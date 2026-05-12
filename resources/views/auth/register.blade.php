@extends('layouts.app')

@section('title', 'Daftar | Jahitan Nenek')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-vintage-cream py-20 px-6">
    <div class="max-w-6xl w-full">
        <div class="bg-white rounded-[4rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row-reverse border border-gray-100 animate__animated animate__fadeIn">
            <!-- Right Side: Visual -->
            <div class="lg:w-1/2 relative hidden lg:block">
                <img src="https://images.unsplash.com/photo-1599408162162-4b4097f4817a?q=80&w=1000&auto=format&fit=crop" 
                     class="absolute inset-0 w-full h-full object-cover grayscale opacity-80" alt="">
                <div class="absolute inset-0 bg-soft-rose/20 backdrop-blur-[2px] flex items-center justify-center p-20">
                    <div class="text-white text-center">
                        <h2 class="text-5xl font-serif font-bold mb-6">Mulai Cerita Anda</h2>
                        <p class="text-xl text-white/90 leading-relaxed font-light">Daftar sekarang untuk mendapatkan akses eksklusif ke koleksi terbaik kami dan mulai perjalanan hangat Anda.</p>
                        
                        <div class="mt-12 flex justify-center space-x-2">
                            <div class="w-12 h-1.5 bg-white rounded-full"></div>
                            <div class="w-3 h-1.5 bg-white/40 rounded-full"></div>
                            <div class="w-3 h-1.5 bg-white/40 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Side: Form -->
            <div class="lg:w-1/2 p-12 lg:p-24 flex flex-col justify-center">
                <div class="mb-12">
                    <h3 class="text-4xl font-serif font-bold text-dark-wool mb-3">Buat Akun Baru</h3>
                    <p class="text-gray-400">Lengkapi data di bawah untuk bergabung dengan komunitas hangat kami.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                <i class="far fa-user"></i>
                            </span>
                            <input type="text" name="name" 
                                   class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-5 pl-14 pr-6 outline-none focus:bg-white focus:border-soft-rose focus:ring-4 focus:ring-soft-rose/10 transition-all" 
                                   placeholder="Nama Anda" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Alamat Email</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                <i class="far fa-envelope"></i>
                            </span>
                            <input type="email" name="email" 
                                   class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-5 pl-14 pr-6 outline-none focus:bg-white focus:border-soft-rose focus:ring-4 focus:ring-soft-rose/10 transition-all" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Kata Sandi</label>
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

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-soft-rose transition-colors">
                                <i class="fas fa-shield-alt"></i>
                            </span>
                            <input type="password" name="password_confirmation" 
                                   class="w-full bg-gray-50 border border-gray-100 rounded-3xl py-5 pl-14 pr-6 outline-none focus:bg-white focus:border-soft-rose focus:ring-4 focus:ring-soft-rose/10 transition-all" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-premium py-5 shadow-2xl shadow-soft-rose/30 mt-4">
                        Daftar Sekarang <i class="fas fa-rocket ml-3"></i>
                    </button>

                    <p class="text-center text-sm text-gray-400 pt-4">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-dark-wool font-bold hover:text-soft-rose transition-colors">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
