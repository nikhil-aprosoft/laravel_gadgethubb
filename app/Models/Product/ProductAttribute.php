<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Define relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Define relationship with Color
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    // Define relationship with Size
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
}
