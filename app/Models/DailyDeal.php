<?php

namespace App\Models;

use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyDeal extends Model
{
    use HasFactory;
    protected $table = 'daily_deals';

    // Use UUID for the foreign key
    protected $primaryKey = 'id';
    public $incrementing = true;

    // Define the relationship
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
