<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Conversation;

class SellerOrderController extends Controller
{
    public function index()
    {
        $business = Auth::user()->business;

        $orders = Order::where('business_id', $business->id)
            ->with(['buyer','orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();
        $user = Auth::user();

    // Si el usuario es vendedor, mostramos conversaciones donde él es el vendedor
    if ($user->hasRole('seller')) {
        $conversations = Conversation::with('buyer', 'order')
            ->where('seller_id', $user->id)
            ->latest()
            ->get();
    } else {
        // Si es comprador, mostramos donde él es el comprador
        $conversations = Conversation::with('seller', 'order')
            ->where('buyer_id', $user->id)
            ->latest()
            ->get();
    }
        return view('seller.orders.index', compact('orders', 'conversations'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeOrder($order);

        return view('seller.orders.show', compact('order'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeOrder($order);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Este pedido ya fue procesado.');
        }

        $order->update(['status' => 'accepted']);

        // Crear conversación si no existe
        Conversation::firstOrCreate([
            'order_id' => $order->id,
            'buyer_id' => $order->buyer_id,
            'seller_id' => $order->seller_id,
        ]);

        return back()->with('success', 'Pedido aceptado.');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeOrder($order);

        if ($order->status !== 'pending') {
            return back()->with('error', 'No puedes rechazar este pedido.');
        }

        $order->update(['status' => 'rejected']);

        return back()->with('success', 'Pedido rechazado.');
    }

    public function ready($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeOrder($order);

        if ($order->status !== 'accepted') {
            return back()->with('error', 'Solo pedidos aceptados se pueden marcar como listos.');
        }

        $order->update(['status' => 'ready_for_pickup']);

        return back()->with('success', 'Pedido marcado como listo.');
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $this->authorizeOrder($order);

        if (!in_array($order->status, ['ready_for_pickup', 'accepted'])) {
            return back()->with('error', 'No se puede completar este pedido.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pedido completado.');
    }

    private function authorizeOrder(Order $order)
    {
        if ($order->seller_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este pedido');
        }
    }
}
