<?php

namespace App\Models;

use App\Models\Shipping;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'from',
        'cost'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
