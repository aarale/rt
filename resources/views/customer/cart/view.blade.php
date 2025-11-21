@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-3xl font-bold text-center mb-8">🛒 Mi carrito</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="space-y-6">
            @foreach(session('cart') as $productId => $item)
                <div class="flex flex-col sm:flex-row sm:justify-between bg-white p-4 rounded shadow items-center">
                    <div class="flex items-center space-x-4 w-full">
                        <img src="{{ asset($item['image'] ?? 'storage/default.png') }}" alt="Imagen del producto" class="w-20 h-20 object-cover rounded border">

                        <div class="flex-1">
                            <h4 class="text-lg font-semibold">{{ $item['name'] }}</h4>
                            <p class="text-sm text-gray-600">Vendedor: {{ $item['seller_name'] ?? 'Desconocido' }}</p>
                            <p class="text-sm text-gray-600">Precio unitario: ${{ number_format($item['price'], 2) }}</p>

                            <div class="mt-2 flex items-center space-x-2">
                                <label for="quantity-{{ $productId }}" class="text-sm text-gray-600">Cantidad:</label>
                                <select
    name="quantity"
    id="quantity-{{ $productId }}"
    data-product-id="{{ $productId }}"
    data-price="{{ $item['price'] }}"
    class="quantity-select appearance-none border border-gray-300 rounded-md px-10 py-1 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
>

    @for($i = 1; $i <= 5; $i++)
        <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
    @endfor
</select>

                            </div>

                            <form method="POST" action="{{ route('cliente.carrito.eliminar') }}" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-0 text-right w-full sm:w-auto">
                        <p class="text-lg font-bold subtotal" id="subtotal-{{ $productId }}">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        @php
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp

        <div class="mt-6 text-right text-xl font-bold">
            Total: <span id="cart-total">${{ number_format($total, 2) }}</span>
        </div>

        <div class="mt-4 text-right">
            <a href="{{ route('cliente.checkout') }}" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                Continuar al pago
            </a>
        </div>
    @else
        <p class="text-center text-gray-600">Tu carrito está vacío.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantitySelectors = document.querySelectorAll('.quantity-select');

        quantitySelectors.forEach(select => {
            select.addEventListener('change', function () {
                const productId = this.dataset.productId;
                const price = parseFloat(this.dataset.price);
                const quantity = parseInt(this.value);
                const subtotalElement = document.getElementById('subtotal-' + productId);

                const subtotal = price * quantity;
                subtotalElement.textContent = `$${subtotal.toFixed(2)}`;

                // Recalcular total
                let total = 0;
                document.querySelectorAll('.quantity-select').forEach(s => {
                    const qty = parseInt(s.value);
                    const prc = parseFloat(s.dataset.price);
                    total += qty * prc;
                });
                document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;

                // Opcional: también puedes enviar una petición al servidor vía AJAX para actualizar la sesión
            });
        });
    });
</script>
@endsection
