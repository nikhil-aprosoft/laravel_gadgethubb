<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
   
    protected $primaryKey = 'color_id';
    protected $keyType = 'string';
    public $incrementing = false;
   
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'color_id', 'color_id');
    }
}
