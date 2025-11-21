<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <!-- Navbar -->
        <!-- Navbar -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-lg font-bold text-gray-800">RAPPITEC</a>

        <div class="flex items-center gap-4">

            <!-- Link catálogo (visible siempre) -->
            <a href="{{ route('catalog.index') }}" class="text-gray-700 hover:text-gray-900">
                Catálogo
            </a>

            <!-- Si el usuario es vendedor -->
            @if(auth()->check() && auth()->user()->hasRole('seller'))
                
                <a href="{{ route('seller.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Dashboard Vendedor
                </a>

                <a href="{{ route('seller.products.index') }}" class="text-gray-700 hover:text-gray-900">
                    Mis Productos
                </a>

                <a href="{{ route('seller.orders') }}" class="text-gray-700 hover:text-gray-900">
                    Pedidos
                </a>

                <a href="{{ route('seller.orders') }}" class="text-gray-700 hover:text-gray-900">
                    Chat
                </a>

                
<a href="{{ route('notifications.index') }}" class="relative text-gray-700 hover:text-gray-900">
    🔔<@php
    $unread = auth()->user()->unreadNotifications()->count();
@endphp

    @if($unread > 0)
        <span class="absolute -top-1 -right-2 bg-red-600 text-white text-xs px-1 rounded-full">
            {{ $unread }}
        </span>
    @endif
</a>


            @endif

            <!-- Perfil -->
            <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-gray-900">
                Perfil
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-gray-700 hover:text-red-600">
                    Salir
                </button>
            </form>

        </div>
    </div>
</nav>


        <!-- Contenido principal -->
        <main class="py-10 max-w-7xl mx-auto px-4">
            <main class="py-10 max-w-7xl mx-auto px-4">
    {{ $slot ?? '' }}
    @yield('content')
</main>

        </main>
    </div>
</body>
</html>
