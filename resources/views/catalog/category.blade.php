@php
    $emojiMap = [
        'comida' => '🍔',
        'electronica' => '💻',
        'bebidas' => '​🍺​',
        'accesorios' => '🛍️',
        'reposteria' => '🧁',
        'servicios' => '🔥',
    ];
    $emoji = $emojiMap[$category->slug] ?? '🧃';
@endphp

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
        Productos en {{ $category->name }} {{ $emoji }}
    </h1>

    @if($products->isEmpty())
        <p class="text-center text-gray-500">No hay productos en esta categoría.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 mt-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-t-xl">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=Sin+imagen" class="w-full h-40 object-cover rounded-t-xl" alt="Sin imagen">
                    @endif

                    <div class="p-4">
                        <h2 class="font-bold text-lg text-gray-800">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $product->business->name ?? 'Negocio desconocido' }}</p>
                        <p class="text-gray-700 mt-2 text-sm">{{ $product->description }}</p>
                        <p class="text-green-600 font-bold text-xl mt-4">${{ number_format($product->price, 2) }}</p>

                        <form action="{{ route('cliente.carrito.agregar') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ 'storage/' . $product->image }}">
                            <input type="hidden" name="seller_id" value="{{ $product->business->seller_id }}">
                            <input type="hidden" name="business_id" value="{{ $product->business_id }}">
                            <input type="hidden" name="inventory_id" value="{{ $product->inventory->id }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" class="w-full bg-blue-600 text-white rounded-full py-2 hover:bg-blue-700">
                                🛒 Comprar ahora
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
