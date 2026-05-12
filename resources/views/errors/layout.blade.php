<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Jahitan Nenek</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-vintage-cream text-dark-wool font-sans antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-2xl w-full text-center space-y-12 animate__animated animate__fadeIn">
        <div class="relative inline-block">
            <div class="text-[12rem] font-serif font-bold text-dark-wool/5 leading-none select-none">
                @yield('code')
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <i class="@yield('icon') text-8xl text-soft-rose animate__animated animate__bounceIn"></i>
            </div>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-dark-wool">
                @yield('message')
            </h1>
            <p class="text-lg text-gray-400 max-w-md mx-auto">
                @yield('description')
            </p>
        </div>

        <div class="pt-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="{{ url('/') }}" class="btn-premium px-12 py-5 text-lg shadow-2xl shadow-soft-rose/20">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <button onclick="window.history.back()" class="px-12 py-5 text-lg font-bold text-dark-wool hover:text-soft-rose transition-colors flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
            </button>
        </div>

        <div class="pt-16 opacity-30">
            <p class="text-[10px] font-bold uppercase tracking-[0.5em]">🧵 Jahitan Nenek • Crafting Since 1970</p>
        </div>
    </div>
</body>
</html>
