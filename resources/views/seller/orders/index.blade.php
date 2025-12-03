@extends('layouts.seller')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- Título --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        🧾 Pedidos Recibidos
    </h1>

   
    @if($orders->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            No tienes pedidos aún.
        </div>
    @else

        {{-- Tabla --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-sky-600 text-white">
                        <th class="px-5 py-3 text-left text-sm font-semibold">ID</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Cliente</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Total</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Fecha</th>
                        <th class="px-5 py-3 text-left text-sm font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">

                    @foreach($orders as $order)
                        <tr class="border-t">
                            <td class="px-5 py-4 font-medium">
                                #{{ $order->id }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $order->customer_name ?? 'Cliente' }}
                            </td>

                            <td class="px-5 py-4 font-semibold text-green-600">
                                ${{ number_format($order->total, 2) }}
                            </td>

                            <td class="px-5 py-4 text-sm">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('seller.orders.show', $order->id) }}"
                                   class="px-4 py-2 bg-sky-600 text-white rounded-lg text-sm hover:bg-sky-700">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    @endif

</div>
@endsection
