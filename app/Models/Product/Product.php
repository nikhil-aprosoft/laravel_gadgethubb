<?php

namespace App\Models\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getPriceAttribute($value)
    {
        return '₹' . number_format($value, 2);
    }
}
