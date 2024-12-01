<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'orderid',
        'user_id',
        'address_id',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'orderid');
    }
    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'orderid');
    }
    public function shippings()
    {
        return $this->hasMany(OrderShipping::class, 'order_id', 'orderid');
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

}
