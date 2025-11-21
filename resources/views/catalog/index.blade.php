@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-gray-800 text-center mb-10">
        Catálogo de Productos 🛍️
    </h1>

    @if($products->isEmpty())
        <p class="text-center text-gray-500">No hay productos disponibles 😢</p>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">

            @if($product->image)
                <img 
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover"
                >
            @else
                <img 
                    src="https://via.placeholder.com/400x300?text=Sin+imagen"
                    class="w-full h-48 object-cover"
                    alt="Sin imagen"
                >
            @endif
            @if($product->inventory->stock <= 0)
    <span class="text-red-600 font-bold">Agotado</span>
@else
    <span class="text-green-600 font-bold">Disponible</span>
@endif


            <!-- Contenido -->
            <div class="p-4 flex flex-col flex-1">
                
                <h2 class="text-lg font-semibold text-gray-800 mb-1">
                    {{ $product->name }}
                </h2>

                <p class="text-sm text-gray-500 mb-2">
                    {{ $product->business->name ?? 'Negocio desconocido' }}
                </p>

                <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                    {{ $product->description }}
                </p>

                <p class="text-xl font-bold text-green-600 mt-auto">
                    ${{ number_format($product->price, 2) }}
                </p>

                <!-- Botón -->
                <form action="{{ route('cliente.carrito.agregar') }}" method="POST">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="product_name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="hidden" name="image" value="{{ 'storage/' . $product->image }}">
    <input type="hidden" name="seller_id" value="{{ $product->business->seller_id }}">
    <input type="hidden" name="business_id" value="{{ $product->business_id }}">
    <input type="hidden" name="inventory_id" value="{{ $product->inventory->id }}">

    <input type="hidden" name="quantity" value="1">

    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        🛒 Comprar ahora
    </button>
</form>




            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
