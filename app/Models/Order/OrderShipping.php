<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    // Fillable fields
    protected $fillable = [
        'shipping_id',
        'order_id',
        'shipment_id',
        'tracking_code',
    ];

    /**
     * Get the order associated with the shipping.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'orderid');
    }
}
