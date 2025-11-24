@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex items-center gap-3 mb-6">
        <img src="/mnt/data/74906bd6-ca84-404b-b03c-c7c252de22ed.jpg" alt="chat" class="w-10 h-10 rounded-full">
        <h1 class="text-2xl font-bold text-gray-800">📨 Chats con Vendedores</h1>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="divide-y divide-gray-100">
            @forelse ($conversations as $chat)
                <a href="{{ route('chat.show', $chat['id']) }}"
                   class="flex items-center justify-between px-6 py-4 hover:bg-blue-50 transition duration-200">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-10 h-10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.656 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $chat['nombre'] }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-1">
                                {{ $chat['ultimo_mensaje'] }}
                            </p>
                            <p class="text-xs text-blue-600 mt-1">🔗 Pedido #{{ $chat['pedido_id'] }}</p>
                        </div>
                    </div>

                    <div class="text-right space-y-1">
                        <p class="text-xs text-gray-400">{{ $chat['hora'] }}</p>
                        @if($chat['no_leidos'] > 0)
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                {{ $chat['no_leidos'] }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="px-6 py-8 text-center text-gray-500">
                    <p>No hay conversaciones activas aún.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
