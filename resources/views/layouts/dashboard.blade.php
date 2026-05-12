<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Jahitan Nenek</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen overflow-hidden">
        @include('dashboards.partials.sidebar')

        <div class="flex-1 flex flex-col min-w-0 bg-gray-50 overflow-y-auto">
            @include('dashboards.partials.topbar')

            <main class="flex-1 p-6 lg:p-12">
                @yield('dashboard_content')
            </main>
        </div>
    </div>

    <!-- Global Toast -->
    <x-ui.toast />

    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('success') }}", type: 'success' } }));
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('error') }}", type: 'error' } }));
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
