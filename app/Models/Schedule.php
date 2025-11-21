<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'SCHEDULE';
    public $timestamps = false;
    protected $fillable = [
        'seller_id', 'day_of_week', 'start_time', 'end_time'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
