<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'ORDERS';
    protected $fillable = [
        'buyer_id', 'seller_id', 'business_id', 'status',
        'total', 'payment_status', 'pickup_time', 'place_type','delivery_code',
    ];
    public $timestamps = true;

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'order_id');
    }
    public function orderItems()
{
    return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
}


}
