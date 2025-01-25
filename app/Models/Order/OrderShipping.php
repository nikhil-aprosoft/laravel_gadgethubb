<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderShipping extends Model
{
    use HasFactory;

    protected $table = 'order_shippings';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'shipping_id',  // Ensure this is included
        'order_id',
        'shipment_id',
        'tracking_code',
        'delivery_status'
    ];

    /**
     * Get the order associated with the shipping.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'orderid');
    }
}
