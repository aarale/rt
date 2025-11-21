@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Detalles del producto</h1>

    <div class="bg-white rounded-lg shadow p-8">

        <!-- Imagen del producto -->
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full max-h-80 object-cover rounded-lg mb-6 shadow">
        @else
            <img src="https://via.placeholder.com/400x300?text=Sin+imagen"
                 class="w-full max-h-80 object-cover rounded-lg mb-6 shadow"
                 alt="Sin imagen">
        @endif

        <!-- Info principal -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            {{ $product->name }}
        </h2>

        <p class="text-gray-500 mb-6">
            Slug: <span class="text-gray-700 font-medium">{{ $product->slug }}</span>
        </p>

        <!-- Descripción -->
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
            {{ $product->description ?? 'Sin descripción disponible.' }}
        </p>

        <!-- Datos del producto -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Precio</p>
                <p class="text-xl font-bold text-green-600">
                    ${{ number_format($product->price, 2) }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Visible</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $product->visible ? 'Sí' : 'No' }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <p class="text-sm text-gray-500">Negocio</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $product->business->name ?? 'No asignado' }}
                </p>
            </div>

        </div>

        <!-- Botones -->
        <div class="flex flex-wrap gap-3">

            <a href="{{ route('seller.products.edit', $product->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow transition">
               Editar
            </a>

            <form action="{{ route('seller.products.destroy', $product->id) }}" 
                  method="POST"
                  onsubmit="return confirm('¿Eliminar producto?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg shadow transition">
                    Eliminar
                </button>
            </form>

            <a href="{{ route('seller.products.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg shadow transition">
               Volver al listado
            </a>

        </div>

    </div>

</div>
@endsection
