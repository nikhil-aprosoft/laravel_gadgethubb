<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FrequentlyBoughtProduct extends Model
{
    // If you're using UUIDs, you might need to set this
    public $incrementing = false;

    // The primary key type should be UUID
    protected $keyType = 'uuid';

    // Define the table name if it's not the plural of the model name
    protected $table = 'frequently_bought_products';

    /**
     * Get the product that owns the frequently bought product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
