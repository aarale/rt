<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Vendedor</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">Mi Negocio 🏪</h2>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('seller.products.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Productos</a>
                <a href="{{ route('seller.orders.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Pedidos</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600">Cerrar sesión</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
