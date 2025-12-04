@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">💳 Selecciona tu método de pago</h1>

    <form method="POST" action="{{ route('cliente.pagar') }}" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf

        <div class="space-y-4">
            <label class="flex items-center gap-4 p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="card" required class="form-radio text-indigo-600">
                <div>
                    <p class="font-semibold text-gray-800">Tarjeta de crédito/débito</p>
                    <p class="text-sm text-gray-500">Paga con tu tarjeta de forma segura.  <br>Se suma un 2.5% de el total al utilizar este metodo de pago</p>
                </div>
            </label>

            <label class="flex items-center gap-4 p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="cash" required class="form-radio text-indigo-600">
                <div>
                    <p class="font-semibold text-gray-800">Pago en efectivo</p>
                    <p class="text-sm text-gray-500">Paga cuando recibas tu pedido.</p>
                </div>
            </label>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition">
                Confirmar pedido
            </button>
        </div>
    </form>
</div>
@endsection
