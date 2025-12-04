@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6 text-center">
    <h1 class="text-2xl font-bold text-red-500">Pago Cancelado ❌</h1>
    <p class="mt-3">No se procesó tu suscripción.</p>

    <a href="/premium" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded">
        Volver
    </a>
</div>
@endsection
