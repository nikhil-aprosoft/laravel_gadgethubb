<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class DailyDeal extends Model
{
    // Define the table associated with the model
    protected $table = 'daily_deals';

    // The primary key for the model
    protected $primaryKey = 'id';

    // Disable timestamps if not needed
    public $timestamps = true;

    // Specify the fields that are mass assignable
    protected $fillable = [
        'product_id',
        'text',
        'discount_amount',
        'discount_type',
        'start_date',
        'end_date',
        'status'
    ];

    // Cast attributes to native types
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'discount_amount' => 'decimal:2'
    ];

    // Define a relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
