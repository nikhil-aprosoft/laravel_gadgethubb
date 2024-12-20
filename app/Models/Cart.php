<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id'; // Change this to your actual primary key
    public $incrementing = false; // If your primary key is not auto-incrementing
    protected $keyType = 'string'; // If your primary key is a UUID
    
    protected $fillable = ['cart_id', 'user_id', 'product_id', 'quantity', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
