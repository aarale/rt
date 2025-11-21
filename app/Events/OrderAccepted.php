<?php
namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderAccepted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order->load('buyer','business');
    }

    public function broadcastOn()
    {
        // notificar al comprador y al vendedor - por simplicity enviamos al canal privado del pedido
        return new PrivateChannel('order.'.$this->order->id);
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'buyer' => $this->order->buyer,
            'business' => $this->order->business,
        ];
    }
}
