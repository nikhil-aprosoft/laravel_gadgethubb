<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Banner\Banner;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\DB;
use App\Models\Banner\Featurewallpaper;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $parentCategoriesMega = ParentCategory::with('categories')->whereNotNull('rank')->orderBy('rank', 'asc')->get();
        $parentCategoriesNormal = ParentCategory::with('categories')->whereNull('rank')->get();
        $banners = $this->banners();
        $featureBanners = $this->featureBanners();
        return view('website.index', compact('categories', 'parentCategoriesMega','parentCategoriesNormal','banners','featureBanners'));
    }
    public function banners(){
        return Banner::latest()->limit(2)->get();
    }
    public function featureBanners(){
        return Featurewallpaper::latest()->get();
    }
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
