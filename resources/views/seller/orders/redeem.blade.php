@extends('layouts.seller')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow p-6 rounded-xl">

    <h2 class="text-xl font-bold mb-4">Validar entrega</h2>

    <form action="{{ route('seller.orders.redeem', $order->id) }}" method="POST">
        @csrf

        <label class="block mb-2 font-medium">Código del cliente:</label>
        <input type="text" name="code"
               class="w-full border rounded p-2"
               placeholder="Ingresa el código"
               required>

        <button class="w-full bg-green-600 text-white p-2 rounded mt-4">
            Validar y entregar
        </button>
    </form>

</div>
@endsection
