@extends('layouts.seller')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">

    <h2 class="text-2xl font-bold mb-4">Validar Entrega del Pedido #{{ $order->id }}</h2>

    <p class="text-gray-600 mb-4">
        El cliente debe proporcionarte el código de entrega.
    </p>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('seller.orders.validarCodigo', $order->id) }}" method="POST">
        @csrf

        <label class="block font-medium mb-2">Código de entrega:</label>

        <input type="text"
               name="code"
               class="w-full border px-3 py-2 rounded-lg"
               placeholder="Ingresa el código"
               required>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg mt-4 font-bold">
            Validar Código
        </button>
    </form>

</div>
@endsection
