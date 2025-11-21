<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'PAYMENTS';
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'payment_method', 'payment_reference',
        'status', 'amount', 'paid_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
