<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'CONVERSATION';
    public $timestamps = false;
    protected $fillable = ['buyer_id', 'seller_id', 'order_id'];

    public function messages() {
    return $this->hasMany(Message::class);
}

public function buyer() {
    return $this->belongsTo(User::class, 'buyer_id');
}

public function seller() {
    return $this->belongsTo(User::class, 'seller_id');
}


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    /*public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }
    */
}
