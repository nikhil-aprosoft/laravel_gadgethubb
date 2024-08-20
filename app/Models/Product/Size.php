<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $primaryKey = 'size_id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Define relationship with ProductAttribute
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'size_id', 'size_id');
    }
    
}
