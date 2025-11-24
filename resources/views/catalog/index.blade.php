@extends('layouts.app')

@section('content')
<section class="w-full bg-sky-600 text-white py-16 px-1 text-center">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">
        Con antojo de  <span class="text-black font-extrabold">RAPPITEC</span> hoy?
    </h1>

    <form action="{{ route('catalog.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 mt-6 max-w-2xl mx-auto">
        <input type="text" name="search" placeholder="Busca en alguno de los negocios de gatos negros" value="{{ request('search') }}"
            class="flex-1 px-4 py-2 rounded-full text-black focus:outline-none border">

        

        <button class="bg-sky-400 text-stone-50 px-4 py-2 rounded-full hover:bg-sky-700">Buscar</button>
    </form>
</section>

@php
    $emojiMap = [
        'comida' => '🍔',
        'electronica' => '💻',
        'bebidas' => '​🍺​',
        'accesorios' => '🛍️',
        'reposteria' => '🧁',
        'servicios' => '🔥',
    ];
@endphp

<section class="mt-12 text-center">
    <h2 class="text-2xl font-semibold mb-4">CATEGORÍAS 😸</h2>
    <div class="flex flex-wrap justify-center gap-16">
        @foreach ($categories as $category)
            @php
                $emoji = $emojiMap[$category->slug] ?? '🔥';
            @endphp
            <a href="{{ route('catalog.category', $category->slug) }}" class="bg-white p-9 rounded-xl shadow hover:bg-gray-50 transition block w-55">
                <div class="text-4xl">{{ $emoji }}</div>
                <div class="mt-2 font-bold">{{ $category->name }}</div>
            </a>
        @endforeach
    </div>
</section>



<!-- Catálogo -->
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-gray-800 text-center mb-10">Catálogo de Productos 🛍️</h1>

    @if($products->isEmpty())
        <p class="text-center text-gray-500">No hay productos disponibles 😿</p>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 mt-10">
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
    
@if($topProducts->isNotEmpty())
<div class="max-w-7xl mx-auto px-6 py-10 mt-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🔥 Más Vendidos Esta Semana</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach ($topProducts as $product)
            <div class="bg-white rounded-xl shadow hover:shadow-md transition">
                <img src="{{ asset('storage/' . ($product->image ?? 'placeholder.jpg')) }}" class="w-full h-32 object-cover rounded-t-xl" alt="{{ $product->name }}">
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $product->business->name ?? '' }}</p>
                    <p class="text-green-500 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

</div>
@endsection
