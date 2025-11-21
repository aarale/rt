@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Tu carrito</h1>

    <div class="bg-white p-4 shadow rounded">
        <p class="mb-2">🧺 Producto: Café Latte - $45.00</p>
        <form method="POST" action="{{ route('cart.remove') }}">
            @csrf
            <button class="text-red-600">Eliminar</button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('checkout') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            Ir a pago
        </a>
    </div>
</div>
@endsection
