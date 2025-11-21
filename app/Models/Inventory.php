<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'INVENTORY';
    public $timestamps = false;
    protected $fillable = ['product_id', 'sku', 'stock', 'low_stock_threshold'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
