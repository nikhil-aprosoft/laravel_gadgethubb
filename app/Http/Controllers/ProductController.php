<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;

class ProductController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('attributes')->where('slug', $slug)->firstOrFail();        
        $response = $product->toArray();

        // Customize attributes if necessary
        $response['attributes'] = $product->attributes->map(function($attribute) {
            return [
                'id' => $attribute->id,
                'color' => $attribute->color->name, 
                'size' => $attribute->size->size,   
                'stock' => $attribute->stock,
            ];
        })->toArray();


        if ($product) {
            return view('website.product-details', compact('response'));
        }
    }
}
