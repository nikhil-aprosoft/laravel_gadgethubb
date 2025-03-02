<?php

namespace App\Models\Order;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'orderid',
        'user_id',
        'address_id',
        'shipcost',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'orderid');
    }
    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'orderid');
    }
    public function shipping()
    {
        return $this->hasMany(OrderShipping::class, 'order_id', 'orderid');
    }
    public function address()
    {
        return $this->belongsTo(Address::class,'address_id','addressid');
    }
}
