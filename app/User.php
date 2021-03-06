<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','password',
        'mobile','email_verfied','mobile-verfied',
        'shipping_address','billing_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function shipments(){
        return $this->hasMany(Shipment::class);
    }

    public function shippingAddress(){
        return $this->hasOne(Address::class, $foreignKey ='id' , $localKey='shipping_address');
    }

    public function billingAddress(){
        return $this->hasOne(Address::class, $foreignKey ='id' , $localKey='billing_address');
    }

    public function wishlist(){
        return $this->hasOne(WishList::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function formatedName(){
        return $this->first_name.' '.$this->last_name;
    }
}
