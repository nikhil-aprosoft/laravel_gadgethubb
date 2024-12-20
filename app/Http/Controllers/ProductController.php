<?php

namespace App\Http\Controllers;

use App\Models\Product\FrequentlyBoughtProduct;
use App\Models\Product\Product;
use App\Models\RecentView;

class ProductController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('attributes.color', 'attributes.size')->where('slug', $slug)->firstOrFail();
        $frequentlyBoughtProduct = FrequentlyBoughtProduct::with('product')->latest()->limit(3)->get();
        $latestProduct = Product::latest()->limit(9)->get();

        if ($product) {
            $relatedProducts = Product::where('category_id', $product->category_id)
                ->where('product_id', '!=', $product->product_id)
                ->get();
            $this->recentProductView($product);
            return view('website.product-details', compact('product', 'frequentlyBoughtProduct', 'latestProduct', 'relatedProducts'));
        }
    }
    public function recentProductView($product)
    {
        $user = session('user');
        if ($user) {
            RecentView::updateOrCreate(
                ['user_id' => $user->userid, 'product_id' => $product->product_id],
                ['viewed_at' => now()]
            );
        }
    }
    public function quickView($slug)
    {
        $product = Product::with('attributes.color', 'attributes.size')->where('slug', '=', $slug)->first();
        return response()->json($product, 200);
    }
    public function mixProducts()
    {
        $products = Product::latest()->limit(24)->get();
        return view('website.products', compact('products'));
    }
}
