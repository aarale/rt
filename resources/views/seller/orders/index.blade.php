@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Pedidos recibidos</h1>

    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="bg-white rounded-lg shadow p-4 flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-500">Pedido #{{ $order->id }} · {{ $order->created_at->diffForHumans() }}</div>
                    <h3 class="text-lg font-semibold">{{ $order->buyer->name ?? 'Cliente' }}</h3>
                    <p class="text-sm text-gray-600">Total: ${{ number_format($order->total,2) }} · Pago: {{ $order->payment_status }}</p>
                    <p class="text-sm text-gray-600">Estado: <span class="font-medium">{{ ucfirst($order->status) }}</span></p>

                    <div class="mt-2">
                        <a href="{{ route('seller.orders.chat', $order->id) }}" class="text-blue-600 hover:underline">Abrir chat</a>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    @if($order->status == 'pending')
                        <form action="{{ route('seller.orders.accept', $order->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-green-600 text-white rounded">Aceptar</button>
                        </form>
                        <form action="{{ route('seller.orders.reject', $order->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-red-600 text-white rounded">Rechazar</button>
                        </form>
                    @elseif($order->status == 'accepted')
                        <form action="{{ route('seller.orders.ready', $order->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-yellow-500 text-white rounded">Listo para recoger</button>
                        </form>
                    @endif

                    @if($order->status != 'completed')
                        <form action="{{ route('seller.orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Marcar completado</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
