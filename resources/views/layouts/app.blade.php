<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="//unpkg.com/alpinejs" defer></script>

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
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="text-lg font-bold text-gray-800">RAPPITEC</a>

                <div class="flex items-center gap-4">

                    <!-- Link catálogo -->
                    <a href="{{ route('catalog.index') }}" class="text-gray-700 hover:text-gray-900">
                        Catálogo
                    </a>

                    <!-- Si el usuario es vendedor -->
                    @if(auth()->check() && auth()->user()->hasRole('seller'))
                        <a href="{{ route('seller.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Dashboard 
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

                        @php
                            $unread = auth()->user()->unreadNotifications()->count();
                        @endphp
                        <a href="{{ route('notifications.index') }}" class="relative text-gray-700 hover:text-gray-900 flex items-center">
                            🔔
                            @if($unread > 0)
                                <span class="absolute -top-1 -right-2 bg-red-600 text-white text-xs px-1 rounded-full">
                                    {{ $unread }}
                                </span>
                            @endif
                        </a>

                        @php
                            $cartCount = session('cart') ? count(session('cart')) : 0;
                        @endphp
                        <a href="{{ route('cliente.carrito.ver') }}" class="text-gray-700 hover:text-gray-900 relative flex items-center">
                            🛒
                            <span class="ml-1">Carrito</span>
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    @endif
<a 
  href="{{ route('notifications.index') }}" 
  class="relative flex items-center gap-1 text-gray-700 hover:text-gray-900 text-2xl px-2 py-1"
  x-data="{ hasNotifications: false }"
  x-init="setInterval(() => {
      fetch('/api/notificaciones')
        .then(r => r.json())
        .then(data => hasNotifications = data.has);
  }, 10000)"
>
    <template x-if="hasNotifications">
        <span class="relative flex h-3 w-3">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-sky-400 opacity-75"></span>
            <span class="relative inline-flex h-3 w-3 rounded-full bg-sky-500"></span>
        </span>
    </template>
    🔔
</a>



<a href="{{ route('customer.orders.pedidos') }}" class="text-gray-700 hover:text-gray-900 text-2xl">
    📝​
</a>
<a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-gray-900 text-2xl">
    👤
</a>
<a href="{{ route('cliente.carrito.ver') }}" class="text-gray-700 hover:text-gray-900 text-2xl">
    🛒
</a>
<a href="{{ route('chat.index') }}" class="text-gray-700 hover:text-gray-900 text-2xl">
    ​​✉️​
</a>
<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="text-2xl text-gray-700 hover:text-gray-900">
        🔒​
    </button>
</form>

                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>
</body>
</html>
