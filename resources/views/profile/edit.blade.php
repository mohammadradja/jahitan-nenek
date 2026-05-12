@extends('layouts.app')

@section('title', 'Pengaturan Profil | Jahitan Nenek')

@section('content')
<div class="bg-vintage-cream min-h-screen py-20 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-12" data-aos="fade-down">
            <span class="text-soft-rose font-bold uppercase tracking-[0.3em] text-[10px]">Akun Saya</span>
            <h2 class="text-4xl font-serif font-bold text-dark-wool mt-4">Pengaturan Profil</h2>
            <p class="text-gray-400 mt-2">Kelola informasi pribadi dan keamanan akun Anda di satu tempat.</p>
        </div>

        <div class="space-y-12">
            <!-- Profile Info Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl p-10 lg:p-16 border border-gray-50" data-aos="fade-up">
                <div class="flex items-center space-x-4 mb-10 pb-6 border-b border-gray-50">
                    <div class="w-12 h-12 bg-soft-rose/10 text-soft-rose rounded-xl flex items-center justify-center">
                        <i class="far fa-user text-xl"></i>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-dark-wool">Informasi Profil</h3>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl p-10 lg:p-16 border border-gray-50" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center space-x-4 mb-10 pb-6 border-b border-gray-50">
                    <div class="w-12 h-12 bg-soft-rose/10 text-soft-rose rounded-xl flex items-center justify-center">
                        <i class="fas fa-lock text-xl"></i>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-dark-wool">Perbarui Kata Sandi</h3>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl p-10 lg:p-16 border border-gray-50" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center space-x-4 mb-10 pb-6 border-b border-gray-50">
                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-minus text-xl"></i>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-dark-wool">Hapus Akun</h3>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
