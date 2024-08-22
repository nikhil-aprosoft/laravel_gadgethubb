<?php

namespace App\Models\Product;

use App\Models\DailyDeal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
        'product_name',
        'slug',
        'search_product_name',
        'price',
        'current_value',
        'cost',
        'quantity',
        'images',
        'thumbnail',
        'specification',
        'description',
        'short_desc',
        'model',
        'sku',
        'is_active',
    ];

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
    public function setSearchProductNameAttribute($value)
    {
        // Remove extra spaces between words, convert to lowercase
        $this->attributes['search_product_name'] = preg_replace('/\s+/', ' ', trim(strtolower($value)));
    }
}
