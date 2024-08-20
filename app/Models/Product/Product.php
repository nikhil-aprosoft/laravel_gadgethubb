<?php

namespace App\Models\Product;

use App\Models\Category;
use App\Models\DailyDeal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function dailyDeals()
    {
        return $this->hasMany(DailyDeal::class, 'product_id', 'product_id');
    }
    public function getPriceAttribute($value)
    {
        return '₹' . number_format($value);
    }
    public function getSizeAttribute($value)
    {
        return explode(',', $value);
    }
    public function getImagesAttribute($value)
    {
        return explode(',', $value);
    }
    public function getShortDescAttribute($value)
    {
        // Add pipe symbol after each full stop
        return preg_replace('/\.(?!\s*$)/', '. |', $value);
    }
}
