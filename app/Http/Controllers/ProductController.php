<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;

class ProductController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('attributes.color', 'attributes.size')->where('slug', $slug)->firstOrFail();               

        if ($product) {
            return view('website.product-details', compact('product'));
        }
    }
}
