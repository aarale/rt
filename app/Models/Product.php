<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'business_id',
        'name',
        'slug',
        'description',
        'price',
        'visible',
        'image',
    ];

    public $timestamps = true;

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function inventory()
    {
        return $this->hasOne(\App\Models\Inventory::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
