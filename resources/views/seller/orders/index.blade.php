@extends('layouts.Seller')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">📨 Chat </h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Lista de conversaciones -->
        <div class="md:col-span-1 bg-white rounded-xl shadow">
            <div class="p-4 font-semibold text-gray-700 border-b">Conversaciones</div>
            <ul>
                @foreach ($conversations as $conversation)
                    <li class="border-b hover:bg-gray-50">
                        <a href="{{ route('seller.chat.show', $conversation->id) }}" class="block px-4 py-3">
                            <div class="font-bold text-indigo-700">
                                {{ $conversation->buyer->name }} 
                                <span class="text-sm text-gray-500">({{ $conversation->business->name ?? 'Negocio' }})</span>
                            </div>
                            <div class="text-sm text-gray-600 truncate">
                                {{ $conversation->messages->last()->text ?? 'Sin mensajes' }}
                            </div>
                            <div class="text-xs text-blue-500 mt-1">Pedido #{{ $conversation->order->id ?? 'N/A' }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Panel de conversación general -->
        <div class="md:col-span-3 bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">📋 Todas las Conversaciones</h3>
            @forelse ($conversations as $conversation)
                <div class="mb-6 border-b pb-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-gray-700 font-bold">
                            {{ $conversation->buyer->name }} ({{ $conversation->business->name ?? 'Negocio' }})
                        </div>
                        <div class="text-sm text-gray-500">
                            Pedido #{{ $conversation->order->id ?? 'N/A' }}
                        </div>
                    </div>

                    @foreach ($conversation->messages as $message)
                        <div class="mb-2">
                            <div class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                <span class="inline-block px-4 py-2 rounded-lg 
                                {{ $message->sender_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $message->text }}
                                </span>
                                <div class="text-xs text-gray-400 mt-1">
                                    {{ $message->sent_at->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="text-gray-500">No hay conversaciones aún.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
