
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            Panel del Vendedor
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 space-y-10">

        {{-- Bienvenida --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">
                ¡Hola, {{ auth()->user()->name }}! 👋
            </h3>
            <p class="text-gray-600 mt-1">
                Este es el panel de control de tu negocio <strong>{{ auth()->user()->business->name }}</strong>.
            </p>
        </div>

        {{-- Tarjetas estadísticas --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Total productos --}}
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Productos</p>
                    <p class="text-3xl font-bold">{{ $stats['products'] }}</p>
                </div>
                <div class="text-indigo-600 text-4xl">📦</div>
            </div>

            {{-- Total pedidos --}}
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pedidos totales</p>
                    <p class="text-3xl font-bold">{{ $stats['orders'] }}</p>
                </div>
                <div class="text-green-600 text-4xl">🛒</div>
            </div>

            {{-- Pedidos pendientes --}}
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pendientes</p>
                    <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                </div>
                <div class="text-yellow-500 text-4xl">⏳</div>
            </div>

        </div>

        {{-- Accesos rápidos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('seller.products.index') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-semibold">Gestionar Productos</h3>
                <p class="text-sm mt-2">Crea, edita y administra tus productos</p>
            </a>

            <a href="{{ route('seller.orders') }}"
               class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-semibold">Pedidos Recibidos</h3>
                <p class="text-sm mt-2">Administra y responde pedidos</p>
            </a>

            <a href="{{ route('seller.orders') }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-semibold">Chat</h3>
                <p class="text-sm mt-2">Comunícate con compradores</p>
            </a>

        </div>

    </div>
</x-app-layout>

