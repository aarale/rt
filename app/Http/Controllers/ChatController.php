<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
public function index()
{
    $userId = auth()->id();

    $conversations = Conversation::where('buyer_id', $userId)
        ->orWhere('seller_id', $userId)
        ->latest()
        ->get();

    return view('chat.index', compact('conversations'));
}

public function show($orderId)
{
    $conversation = Conversation::where('order_id', $orderId)
        ->with('messages.sender')
        ->firstOrFail();

    return view('chat.show', compact('conversation'));
}


    public function sendMessage(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::where('order_id', $orderId)->firstOrFail();

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'text' => $request->message,
        ]);

        return redirect()->route('chat.show', $orderId);
    }
    public function showAll()
{
    $userId = auth()->id();

    $conversations = Conversation::where('buyer_id', $userId)
        ->orWhere('seller_id', $userId)
        ->latest()
        ->get();

    return view('customer.chat.show', compact('conversations')); 
}


}
