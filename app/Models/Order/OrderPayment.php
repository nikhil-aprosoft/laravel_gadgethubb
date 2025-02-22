<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    // Fillable fields
    protected $fillable = [
        'order_payment_id',
        'order_id',
        'payment_method',
        'amount',
        'payment_status',
        'payment_date',
        'status',
        'txnid',
        'mode',
        'mihpayid',
        'net_amount_debit',
        'addedon',
        'hash',
        'unmappedstatus',
        'payment_source',
        'pg_type',
        'bank_ref_num',
        'bankcode',
        'error',
        'error_message',
    ];

    /**
     * Get the order associated with the payment.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'orderid');
    }
    public function getPaymentStatusAttribute($value)
    {
        switch ($value) {
            case 'success':
                return "Paid";
            default:
                return $value;
        }
    }
}
