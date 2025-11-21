<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function view()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('customer.cart.view', compact('cart', 'total'));
    }

    public function add(Request $request)
{
    $cart = session()->get('cart', []);

    $productId = $request->product_id;

    $cart[$productId] = [
    'name' => $request->product_name,
    'price' => $request->price,
    'quantity' => $request->quantity ?? 1,
    'image' => $request->image ?? 'storage/default.png',
    'seller_id' => $request->seller_id,
    'business_id' => $request->business_id,
    'inventory_id' => $request->inventory_id,
];


    session(['cart' => $cart]);

    return redirect()->route('cliente.carrito.ver')->with('success', 'Producto agregado al carrito.');
}


    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, min(5, (int) $request->input('quantity', 1)));

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;

            session(['cart' => $cart]);

            return redirect()->route('cliente.carrito.ver')->with('success', 'Cantidad actualizada.');
        }

        return redirect()->route('cliente.carrito.ver')->with('error', 'Producto no encontrado.');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            return redirect()->route('cliente.carrito.ver')->with('success', 'Producto eliminado.');
        }

        return redirect()->route('cliente.carrito.ver')->with('error', 'Producto no encontrado.');
    }
}
