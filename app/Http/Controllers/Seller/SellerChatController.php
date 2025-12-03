<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessage;

class SellerChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $conversations = Conversation::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with('order')
            ->latest()
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show($conversationId)
    {
        $conversation = Conversation::with('messages.sender', 'order')
            ->findOrFail($conversationId);

        $messages = $conversation->messages;

        return view('chat.show', compact('conversation', 'messages'));
    }
public function sendMessage(Request $request, $conversationId)
{
    $request->validate([
        'message' => 'required|string|max:2000'
    ]);

    $conversation = Conversation::findOrFail($conversationId);

    $msg = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => Auth::id(),
        'text' => $request->message,
    ]);

    broadcast(new NewMessage($msg))->toOthers();

    return response()->json(['success' => true]);
}

}
