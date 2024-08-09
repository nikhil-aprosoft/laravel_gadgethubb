<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $appends = ['products'];
    protected $primaryKey = 'category_id'; // Specify the primary key column
    public $incrementing = false; // Set to false if your primary key is not auto-incrementing
    protected $keyType = 'string'; 
    /**
     * Get the parent category that owns the category.
     */
    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'parent_category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function getAllCategory()
    {
        DB::table('categories')->get();
    }
    public function getProductsAttribute()
    {
        return DB::table('products')->whereIn('category_id', [$this->category_id])->get();
    }
}
