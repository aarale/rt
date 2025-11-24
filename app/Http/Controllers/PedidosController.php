<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PedidosController extends Controller
{
    
public function index()
{
$orders = Order::where('buyer_id', Auth::id())->latest()->get();

    return view('customer.orders.pedidos', compact('orders'));
}


    public function show($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        return view('pedidos.show', compact('order'));
    }
}
