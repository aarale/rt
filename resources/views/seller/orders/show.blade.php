@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">

    <h1 class="text-2xl font-bold mb-4">Pedido #{{ $order->id }}</h1>

    <p><strong>Cliente:</strong> {{ $order->buyer->name }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($order->status) }}</p>

    <hr class="my-4">

    <h2 class="text-lg font-bold mb-2">Productos:</h2>

    @foreach($order->items as $item)
    <div class="border p-3 rounded mb-2">
        <p><strong>{{ $item->product->name }}</strong></p>
        <p>Cantidad: {{ $item->quantity }}</p>
        <p>Subtotal: ${{ $item->subtotal }}</p>
    </div>
    @endforeach

    <hr class="my-4">

    <div class="flex gap-3">

        @if($order->status === 'pending')
            <form action="{{ route('seller.orders.accept', $order->id) }}" method="POST">
                @csrf
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Aceptar</button>
            </form>

            <form action="{{ route('seller.orders.reject', $order->id) }}" method="POST">
                @csrf
                <button class="bg-red-600 text-white px-4 py-2 rounded">Rechazar</button>
            </form>
        @endif

        @if($order->status === 'accepted')
            <form action="{{ route('seller.orders.complete', $order->id) }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-4 py-2 rounded">Marcar como completado</button>
            </form>
        @endif

        @if($order->conversation)
            <a href="{{ route('seller.chat.show', $order->id) }}" 
               class="bg-purple-600 text-white px-4 py-2 rounded">
               Abrir chat
            </a>
        @endif

    </div>

</div>

@endsection
