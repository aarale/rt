@extends('layouts.app')

@section('content')

<div x-data="{ tab: 'usuarios' }" class="py-10 max-w-7xl mx-auto px-4 space-y-10">

    {{-- Encabezado --}}
    <div class="bg-sky-600 text-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold flex items-center gap-2">👑 Panel de Administración</h1>
        <p class="text-blue-200 mt-1">RAPPITEC - Sistema de gestión completo</p>
    </div>

    {{-- Tarjetas métricas interactivas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 cursor-pointer">
        <div @click="tab = 'usuarios'" class="bg-white border-2 border-blue-100 p-4 rounded-xl shadow hover:bg-blue-50">
            <h3 class="text-sm text-gray-600">👥 Usuarios Totales</h3>
            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $stats['users'] }}</p>
        </div>

        <div @click="tab = 'negocios'" class="bg-white border-2 border-purple-100 p-4 rounded-xl shadow hover:bg-purple-50">
            <h3 class="text-sm text-gray-600">🏪 Negocios Activos</h3>
            <p class="text-2xl font-bold text-purple-600 mt-2">{{ $stats['businesses'] }}</p>
        </div>

        <div @click="tab = 'productos'" class="bg-white border-2 border-green-100 p-4 rounded-xl shadow hover:bg-green-50">
            <h3 class="text-sm text-gray-600">📦 Productos</h3>
            <p class="text-2xl font-bold text-green-600 mt-2">{{ $stats['products'] }}</p>
        </div>

        <div @click="tab = 'ventas'" class="bg-white border-2 border-orange-100 p-4 rounded-xl shadow hover:bg-orange-50">
            <h3 class="text-sm text-gray-600">💰 Ventas Totales</h3>
            <p class="text-2xl font-bold text-orange-500 mt-2">${{ number_format($stats['sales'], 2) }}</p>
        </div>
    </div>

    {{-- Contenido dinámico por tab --}}
    <div class="bg-white rounded-xl shadow border overflow-hidden mt-6 p-6">
        {{-- Usuarios --}}
        <div x-show="tab === 'usuarios'">
            <h2 class="text-lg font-semibold text-blue-800 mb-4">Usuarios Registrados</h2>
            @foreach ($users as $user)
                <div class="border-b py-3 flex justify-between items-center">
                    <div>
                        <p class="font-semibold capitalize">{{ $user->name }} {{ $user->lastname }}</p>
                        <p class="text-sm text-gray-600">📧 {{ $user->mail }}</p>
                        <p class="text-xs text-gray-500">🆔 No. Control: {{ $user->ncontrol }}</p>
                    </div>
                    <div class="flex gap-2">
                        @foreach ($user->roles as $role)
                            <span class="text-xs px-2 py-1 rounded-full font-semibold bg-blue-100 text-blue-700">
                                {{ ucfirst($role->name) }}
                            </span>
                        @endforeach
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-semibold">✅ Activo</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Negocios --}}
        <div x-show="tab === 'negocios'">
            <h2 class="text-lg font-semibold text-purple-800 mb-4">Negocios Activos</h2>
            @foreach ($businesses as $business)
                <div class="border-b py-3">
                    <p class="font-semibold capitalize">{{ $business->name }}</p>
                    <p class="text-sm text-gray-600">{{ $business->slug }}</p>
                </div>
            @endforeach
        </div>

        {{-- Productos --}}
        <div x-show="tab === 'productos'">
            <h2 class="text-lg font-semibold text-green-800 mb-4">Productos Registrados</h2>
            @foreach ($products as $product)
                <div class="border-b py-3">
                    <p class="font-semibold">{{ $product->name }}</p>
                    <p class="text-sm text-gray-600">💼 {{ $product->business->name ?? 'Sin negocio' }}</p>
                </div>
            @endforeach
        </div>

        {{-- Ventas --}}
        <div x-show="tab === 'ventas'">
            <h2 class="text-lg font-semibold text-orange-600 mb-4">Historial de Ventas</h2>
            @foreach ($sales as $order)
                <div class="border-b py-3">
                    <p class="font-semibold">🛒 Pedido #{{ $order->id }}</p>
                    <p class="text-sm text-gray-600">Total: ${{ number_format($order->total, 2) }}</p>
                    <p class="text-xs text-gray-500">📅 {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
