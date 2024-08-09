<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $parentCategoriesMega = ParentCategory::with('categories')->whereNotNull('rank')->orderBy('rank', 'asc')->get();
        $parentCategoriesNormal = ParentCategory::with('categories')->whereNull('rank')->get();
        return view('website.index', compact('categories', 'parentCategoriesMega','parentCategoriesNormal'));
    }
    // Category product Page Showing Data Code Start Heres
    public function getData()
    {
        $categories = Category::all();
        $parentCategoriesMega = ParentCategory::with('categories')->whereNotNull('rank')->orderBy('rank', 'asc')->get();
        $parentCategoriesNormal = ParentCategory::with('categories')->whereNull('rank')->get();
        return view('website.cat_product', compact('categories', 'parentCategoriesMega','parentCategoriesNormal'));
    }
    // Category product Page Showing Data Code End Here
    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->limit(10)->get();

        $formattedProducts = $products->map(function ($product) {
            return [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'images' => json_decode($product->images),
                'description' => $product->description,
            ];
        });
        return response()->json([
            'data' => $formattedProducts,
        ], 200);
    }

}
