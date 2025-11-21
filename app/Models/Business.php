<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'BUSINESS';
    protected $fillable = ['name', 'slug', 'description', 'seller_id'];

    public $timestamps = false;

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'business_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'business_id');
    }
}
