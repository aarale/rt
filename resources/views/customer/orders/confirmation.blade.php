@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg p-8 text-center rounded-2xl">

    <h2 class="text-3xl font-bold">¡Pedido Confirmado! 🎉</h2>

    <p class="text-gray-600 mt-3">
        Muéstrale este código al vendedor para recoger tu pedido:
    </p>

    {{-- CÓDIGO --}}
    <div class="mt-6 text-5xl font-extrabold tracking-widest text-blue-600 bg-blue-50 py-4 rounded-xl shadow-inner">
        {{ $order->delivery_code }}
    </div>

    <p class="mt-4 text-gray-500">
        El vendedor no podrá liberar tu pedido sin este código.
    </p>

    <a href="{{ url('/') }}"
       class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
        Volver al inicio
    </a>
</div>
@endsection
