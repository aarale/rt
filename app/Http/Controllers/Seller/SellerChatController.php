<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Conversation;
use App\Models\Message;

class SellerChatController extends Controller
{
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->seller_id !== Auth::id()) abort(403);

        // Obtener o crear conversación
        $conversation = Conversation::firstOrCreate([
            'order_id'  => $order->id,
            'buyer_id'  => $order->buyer_id,
            'seller_id' => $order->seller_id,
        ]);

        $messages = $conversation->messages()->with('sender')->orderBy('sent_at')->get();

        return view('seller.chat.show', compact('order', 'conversation', 'messages'));
        //return view('client.chat.box', compact('conversation'));
    }

    public function send(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'attachment' => 'nullable|image|max:2048'
        ]);

        $order = Order::findOrFail($orderId);

        if ($order->seller_id !== Auth::id()) abort(403);

        $conversation = Conversation::firstOrCreate([
            'order_id'  => $order->id,
            'buyer_id'  => $order->buyer_id,
            'seller_id' => $order->seller_id,
        ]);

        $data = [
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'text' => $request->message
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment_url'] = $request->file('attachment')->store('chat', 'public');
        }

        Message::create($data);

        return back();
    }
}
