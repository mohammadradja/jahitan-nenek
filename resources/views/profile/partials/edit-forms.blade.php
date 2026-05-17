<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
    <div class="flex items-center space-x-3 mb-8 pb-4 border-b border-gray-50">
        <div class="w-8 h-8 bg-soft-rose/10 text-soft-rose rounded-lg flex items-center justify-center">
            <i class="far fa-user text-sm"></i>
        </div>
        <h3 class="text-lg font-serif font-bold text-dark-wool">Informasi Profil</h3>
    </div>
    @include('profile.partials.update-profile-information-form')
</div>

<div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
    <div class="flex items-center space-x-3 mb-8 pb-4 border-b border-gray-50">
        <div class="w-8 h-8 bg-soft-rose/10 text-soft-rose rounded-lg flex items-center justify-center">
            <i class="fas fa-lock text-sm"></i>
        </div>
        <h3 class="text-lg font-serif font-bold text-dark-wool">Kata Sandi</h3>
    </div>
    @include('profile.partials.update-password-form')
</div>

@if(auth()->user()->role === 'user')
<div class="bg-white rounded-2xl p-6 border border-red-50 shadow-sm">
    <div class="flex items-center space-x-3 mb-8 pb-4 border-b border-gray-50">
        <div class="w-8 h-8 bg-red-50 text-red-500 rounded-lg flex items-center justify-center">
            <i class="fas fa-user-minus text-sm"></i>
        </div>
        <h3 class="text-lg font-serif font-bold text-dark-wool">Hapus Akun</h3>
    </div>
    @include('profile.partials.delete-user-form')
</div>
@endif
