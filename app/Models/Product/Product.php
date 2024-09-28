<?php

namespace App\Models\Product;

use App\Models\DailyDeal;
use App\Models\Product\FrequentlyBoughtProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        'small_thumbs',
        'pop_images',
        'video',
    ];

    protected $primaryKey = 'product_id';

    protected $keyType = 'string';

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
    public function frequentlyBoughtProducts(): HasMany
    {
        return $this->hasMany(FrequentlyBoughtProduct::class, 'product_id', 'product_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function recentViews()
    {
        return $this->hasMany(RecentView::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
    public static function withInactive()
    {
        return static::withoutGlobalScope(ActiveScope::class)
            ->where('is_active', 0);
    }
    public function getPriceAttribute($value)
    {
        return '₹' . number_format($value);
    }
    public function getCostAttribute($value)
    {
        return '₹' . number_format($value);
    }
    public function getSizeAttribute($value)
    {
        return explode(',', $value);
    }
    public function getImagesAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getPopImagesAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getSmallThumbsAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getThumbnailAttribute($value)
    {
        return Storage::disk('public')->url($value);
    }
    public function getShortDescAttribute($value)
    {
        // Add pipe symbol after each full stop
        return preg_replace('/\.(?!\s*$)/', '. |', $value);
    }
    public function getSpecificationAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
    public function getVideoAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
    }
    public function setSearchProductNameAttribute($value)
    {
        // Remove all spaces, convert to lowercase
        $this->attributes['search_product_name'] = strtolower(str_replace(' ', '', $value));
    }
    public function convertToDecimal($value)
    {
        // Remove currency symbols and commas
        $value = preg_replace('/[^\d.]/', '', $value);

        // Convert to float
        return (float) $value;
    }

    public function colorAndSize($obj)
    {
        $attribute = Product::with('attributes.color', 'attributes.size')->where('slug', '=', $obj->slug)->firstOrFail();
        return $attribute;
    }
}
