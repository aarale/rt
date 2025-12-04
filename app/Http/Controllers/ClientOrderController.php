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
use Illuminate\Support\Str;


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

    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

    $commission = 0;

    if ($request->payment_method === 'card') {
        $commission = $total * 0.025; // 2.5%
    }

    $finalTotal = $total + $commission;

    $first = reset($cart);

    $order = Order::create([
        'buyer_id'    => auth()->id(),
        'seller_id'   => $first['seller_id'],
        'business_id' => $first['business_id'],
        'status'      => 'pending',
        'total'       => $finalTotal,
        'place_type'  => 'pickup',
'delivery_code' => rand(100000, 999999),

    ]);

    foreach ($cart as $productId => $item) {
        $inventory = Inventory::where('product_id', $productId)->first();

        OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $productId,
            'inventory_id' => $inventory->id,
            'quantity'     => $item['quantity'],
            'unit_price'   => $item['price'],
            'subtotal'     => $item['price'] * $item['quantity']
        ]);

        $inventory->decrement('stock', $item['quantity']);
    }

    if ($request->payment_method === 'cash') {

        Payment::create([
            'order_id'       => $order->id,
            'payment_method' => 'cash',
            'status'         => 'pending',
            'amount'         => $finalTotal,
        ]);

        session()->forget('cart');

        return redirect()->route('cliente.pedido.confirmado', ['order' => $order->id]);

    }

    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $intent = \Stripe\PaymentIntent::create([
        'amount'   => intval($finalTotal * 100),
        'currency' => 'mxn',
        'metadata' => [
            'order_id' => $order->id
        ],
    ]);

    return view('customer.orders.stripe-pagar', [
        'clientSecret' => $intent->client_secret,
        'amount'       => $finalTotal,
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

return redirect()->route('cliente.pedido.confirmado', ['order' => $order->id]);
    }

    public function confirm(Order $order)
    {
        return view('customer.orders.confirmation',compact('order'));
    }
    public function confirmado(Order $order)
{
    return view('customer.orders.confirmado', compact('order'));
}

}
