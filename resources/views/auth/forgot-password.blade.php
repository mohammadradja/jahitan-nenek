@extends('layouts.app')

@section('title', 'Lupa Kata Sandi | Jahitan Nenek')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-vintage-cream py-20 px-6">
    <div class="max-w-xl w-full">
        <div class="bg-white rounded-[3rem] shadow-2xl p-12 lg:p-16 border border-gray-100 animate__animated animate__fadeIn">
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-soft-rose/10 text-soft-rose rounded-2xl flex items-center justify-center mx-auto mb-8 text-3xl">
                    <i class="fas fa-key"></i>
                </div>
                <h3 class="text-3xl font-serif font-bold text-dark-wool mb-4">Lupa Kata Sandi?</h3>
                <p class="text-gray-400 leading-relaxed">Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-sm font-bold mb-8 border border-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
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

                <button type="submit" class="w-full btn-premium py-5 shadow-2xl shadow-soft-rose/30">
                    Kirim Tautan Reset <i class="fas fa-paper-plane ml-3 text-sm"></i>
                </button>

                <p class="text-center text-sm text-gray-400">
                    Ingat kata sandi Anda? 
                    <a href="{{ route('login') }}" class="text-dark-wool font-bold hover:text-soft-rose transition-colors">Masuk Sekarang</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
