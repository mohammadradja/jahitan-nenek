@php
    $layout = auth()->user()->role === 'user' ? 'layouts.app' : 'layouts.dashboard';
    $roleName = ucfirst(auth()->user()->role);
@endphp

@extends($layout)

@section('role_name', $roleName)
@section('page_title', 'Pengaturan Profil')

@section('content')
    @if(auth()->user()->role === 'user')
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Navigation (Left) -->
                <div class="lg:col-span-1">
                    @include('dashboards.user.partials.sidebar')
                </div>
                
                <!-- Main Form Content (Right) -->
                <div class="lg:col-span-3 space-y-8">
                    @include('profile.partials.edit-forms')
                </div>
            </div>
        </div>
    @endif
@endsection

@if(auth()->user()->role !== 'user')
    @section('dashboard_content')
        <div class="max-w-4xl mx-auto space-y-8">
            @include('profile.partials.edit-forms')
        </div>
    @endsection
@endif
