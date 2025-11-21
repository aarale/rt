<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ROLE';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function USER()
    {
        return $this->belongsToMany(User::class, 'USER_ROLE', 'role_id', 'user_id');
    }
}
