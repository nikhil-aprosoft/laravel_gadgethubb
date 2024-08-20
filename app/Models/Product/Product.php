<?php

namespace App\Models\Product;

use App\Models\Category;
use App\Models\DailyDeal;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $appends = ['category'];

    public function getCategoryAttribute()
    {
        return DB::table('categories')->where('category_id', $this->category_id)->first();
    }

    public function dailyDeals()
    {
        return $this->hasMany(DailyDeal::class, 'product_id', 'product_id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id');
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
