@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 flex items-center gap-2">
        🧾 <span>MIS PEDIDOS</span>
    </h1>

    @if($orders->count())
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg ring-1 ring-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-sky-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">#ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($orders as $order)
                        <tr class="hover:bg-sky-50 transition-all duration-200">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4 text-sm">
                                @switch($order->status)
                                    @case('pendiente')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            ⏳ Pendiente
                                        </span>
                                        @break
                                    @case('completado')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            ✅ Completado
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            ❌ Cancelado
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('customer.orders.pedidos', $order->id) }}"
                                   class="inline-flex items-center gap-1 text-sky-600 hover:text-sky-800 font-medium transition duration-150">
                                    🔍 Ver detalles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-16">
            <img src="/mnt/data/575240ca-08be-4ab6-93a2-2706d8324254.png" alt="Sin pedidos" class="w-32 h-32 mx-auto mb-4">
            <p class="text-lg text-gray-500">No tienes pedidos aún.</p>
        </div>
    @endif
</div>
@endsection
