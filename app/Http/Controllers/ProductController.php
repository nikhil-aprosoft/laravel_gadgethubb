<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\FrequentlyBoughtProduct;

class ProductController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('attributes.color', 'attributes.size')->where('slug', $slug)->firstOrFail();               
        $frequentlyBoughtProduct = FrequentlyBoughtProduct::with('product')->latest()->limit(3)->get();
        $latestProduct =  Product::latest()->limit(9)->get();
        if ($product) {
            return view('website.product-details', compact('product','frequentlyBoughtProduct','latestProduct'));
        }
    }
}
