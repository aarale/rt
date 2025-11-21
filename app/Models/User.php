<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'USERS';
    protected $fillable = [
        'name', 'lastname', 'bdate', 'ncontrol', 'email', 'phone', 'password'
    ];

    public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'USER_ROLE', 'user_id', 'role_id');
    }
    public function hasRole($roleName)
{
    return $this->roles()->where('name', $roleName)->exists();
}

public function assignRole($roleName)
{
    $role = \App\Models\Role::where('name', $roleName)->first();

    if ($role && !$this->hasRole($roleName)) {
        $this->roles()->attach($role->id);
    }

    return $this;
}
public function business()
{
    return $this->hasOne(Business::class, 'seller_id');
}

   public function conversationsAsBuyer() {
    return $this->hasMany(Conversation::class, 'buyer_id');
}

public function conversationsAsSeller() {
    return $this->hasMany(Conversation::class, 'seller_id');
}


    public function buyerOrders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function sellerOrders()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id');
    }
    public function unreadNotifications()
{
    return $this->notifications()->where('is_read', false);
}
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'seller_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    /*protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /*protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
