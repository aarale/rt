@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-10">
    <div>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full rounded-xl">
        @endif
    </div>

    <div class="space-y-4">
        <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
        <p class="text-gray-500">
            Vendido por <strong>{{ $product->business->name }}</strong>
        </p>
        <p class="text-2xl font-semibold text-sky-600">${{ number_format($product->price, 2) }}</p>

        <p class="text-gray-700">{{ $product->description }}</p>

        <p class="text-sm text-gray-500">
            Stock: {{ optional($product->inventory)->stock ?? 0 }}
        </p>

        <form action="{{ route('cliente.carrito.agregar', $product->id) }}" method="POST">
            @csrf
            <button class="mt-4 px-6 py-2 bg-sky-600 text-white rounded-lg">
                Añadir al carrito
            </button>
        </form>
    </div>
</div>
@endsection
