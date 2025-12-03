@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">💬 Mis conversaciones</h1>

    @forelse($conversations as $conv)
        <a href="{{ route('chat.show', $conv->id) }}"
           class="block bg-white p-4 shadow rounded mb-3 hover:bg-gray-100">

            <div class="flex justify-between">
                <div>
                    <p class="font-bold">
                        Pedido #{{ $conv->order->id ?? 'N/A' }}
                    </p>
                    <p class="text-gray-600 text-sm">
                        Último mensaje: {{ $conv->messages->last()->text ?? 'Sin mensajes' }}
                    </p>
                </div>

                <span class="text-sky-600 font-semibold">Ver chat →</span>
            </div>

        </a>
    @empty
        <p class="text-gray-600">No tienes conversaciones aún.</p>
    @endforelse

</div>
@endsection
