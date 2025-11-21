@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold mb-4">🎉 Pedido confirmado</h1>
    <p class="text-lg text-gray-600">Gracias por tu compra. En breve recibirás la confirmación.</p>
    <a href="{{ route('catalog.index') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded">
        Volver al catálogo
    </a>
</div>
@endsection
