<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    public function checkout()
    {
        return view('customer.orders.checkout');
    }

    public function pagar(Request $request)
{
    $request->validate([
        'payment_method' => 'required',
    ]);

    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('cliente.carrito.ver')
            ->with('error', 'El carrito está vacío.');
    }

    // TOTAL REAL
    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

    // Datos del negocio (todos los productos son del mismo)
    $first = reset($cart);

    $order = Order::create([
        'buyer_id'    => auth()->id(),
        'seller_id'   => $first['seller_id'],
        'business_id' => $first['business_id'],
        'status'      => 'pending',
        'total'       => $total,
        'place_type'  => 'pickup'
    ]);

    // GUARDAR ITEMS DEL PEDIDO
    foreach ($cart as $productId => $item) {

        // Buscar inventario real por producto
        $inventory = Inventory::where('product_id', $productId)->first();

        OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $productId,
            'inventory_id' => $inventory->id,
            'quantity'     => $item['quantity'],
            'unit_price'   => $item['price'],
            'subtotal'     => $item['price'] * $item['quantity']
        ]);

        // Reducir inventario
        $inventory->decrement('stock', $item['quantity']);
    }

    // SI ES EFECTIVO → solo crear registro
    if ($request->payment_method === 'cash') {

        Payment::create([
            'order_id'       => $order->id,
            'payment_method' => 'cash',
            'status'         => 'pending',
            'amount'         => $total,
        ]);

        session()->forget('cart');

        return redirect()->route('cliente.pedido.confirmado');
    }

    // SI ES TARJETA → Stripe
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $intent = \Stripe\PaymentIntent::create([
        'amount'   => $total * 100, // centavos
        'currency' => 'mxn',
        'metadata' => [
            'order_id' => $order->id
        ],
    ]);

    return view('customer.orders.stripe-pagar', [
        'clientSecret' => $intent->client_secret,
        'amount'       => $total,
        'order_id'     => $order->id
    ]);
}


    public function confirmarPago(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'card',
            'status' => 'confirmed',
            'amount' => $order->total,
            'paid_at' => now()
        ]);

        $order->update([
            'payment_status' => 'paid',
        ]);

        session()->forget('cart');

        return redirect()->route('cliente.pedido.confirmado');
    }

    public function confirm()
    {
        return view('customer.orders.confirmation');
    }
}
