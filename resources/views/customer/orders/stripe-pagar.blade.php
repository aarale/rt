@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<div class="max-w-lg mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Pagar con tarjeta</h2>

    <p class="mb-4 text-gray-600 text-center">
        Total a pagar: <strong>${{ $amount }}</strong>
    </p>

    <form id="payment-form">
        @csrf
        <input type="hidden" id="order_id" value="{{ $order_id }}">

        <div id="card-element" class="p-3 border rounded mb-4"></div>

        <button id="submit" class="bg-indigo-600 text-white w-full py-2 rounded">
            Pagar ahora
        </button>

        <div id="error-message" class="text-red-600 mt-4"></div>
    </form>
</div>

<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");

    const elements = stripe.elements();
    const card = elements.create("card");
    card.mount("#card-element");

    const clientSecret = "{{ $clientSecret }}";

    const form = document.getElementById("payment-form");
    const submitBtn = document.getElementById("submit");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        submitBtn.disabled = true;

        const {error, paymentIntent} = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card
            }
        });

        if (error) {
            document.getElementById("error-message").textContent = error.message;
            submitBtn.disabled = false;
        } else {
            // ENVIAR CONFIRMACIÓN AL SERVIDOR
            const orderId = document.getElementById("order_id").value;

            fetch("{{ route('cliente.pago.confirmar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value
                },
                body: JSON.stringify({
                    order_id: orderId,
                    payment_intent: paymentIntent.id
                })
            })
            .then(() => {
                window.location.href = "{{ route('cliente.pedido.confirmado') }}";
            });
        }
    });
</script>

@endsection
