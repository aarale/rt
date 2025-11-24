@extends('layouts.seller')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Productos</h1>
        <a href="{{ route('seller.products.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
           + Nuevo Producto
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Negocio</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $p->name }}</td>
                    <td class="px-6 py-4 text-sm text-green-600 font-semibold">${{ number_format($p->price, 2) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $p->business->name ?? '-' }}</td>
                    <td class="px-6 py-4 flex justify-center gap-2">
                        <a href="{{ route('seller.products.show', $p->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm shadow-sm transition">
                           Ver
                        </a>
                        <a href="{{ route('seller.products.edit', $p->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm shadow-sm transition">
                           Editar
                        </a>
                        <form action="{{ route('seller.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('¿Eliminar producto?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm shadow-sm transition">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($products->isEmpty())
            <div class="p-6 text-center text-gray-500">
                No hay productos registrados 😢
            </div>
        @endif
    </div>
</div>
@endsection
