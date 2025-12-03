@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">💬 Conversación con {{ $conversation->seller_id == auth()->id() ? 'Cliente' : 'Vendedor' }}</h2>

    <div class="bg-white shadow rounded-lg mb-6 p-4 h-[400px] overflow-y-auto border border-gray-200">
        @forelse ($conversation->messages as $message)
            <div class="mb-3 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                <div class="inline-block px-4 py-2 rounded-xl {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                    {{ $message->text }}
                </div>
                <div class="text-xs text-gray-500 mt-1">
                    {{ $message->sent_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">No hay mensajes aún.</p>
        @endforelse
    </div>

    <form method="POST" action="{{ route('chat.send', $conversation->order_id) }}" class="flex items-center gap-2">
        @csrf
        <input type="text" name="message" placeholder="Escribe un mensaje..." class="w-full border rounded-lg px-4 py-2" required>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Enviar
        </button>
    </form>
</div>
@endsection
