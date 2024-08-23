<?php

namespace App\Http\Controllers;

use App\Models\Banner\Banner;
use App\Models\Banner\Featurewallpaper;
use App\Models\Category;
use App\Models\DailyDeal;
use App\Models\Order\Order;
use App\Models\ParentCategory;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $commonData = app('commonData');
        $categories = $commonData['categories'];
        $parentCategoriesMega = ParentCategory::with('categories')->whereNotNull('rank')->orderBy('rank', 'asc')->get();
        $parentCategoriesNormal = ParentCategory::with('categories')->whereNull('rank')->get();
        $banners = $this->banners();
        $featureBanners = $this->featureBanners();
        $dailyDeals = DailyDeal::With('product')->latest()->get();
        $bestSeller = $this->bestSeller();
        $newArrival = Product::latest()->limit(10)->get();
        $shoesSection = Product::where('category_id', '=', "1449b012-f7d7-4004-a08f-aa227390bed3")->limit(8)->get();
        return view('website.index', compact('categories', 'parentCategoriesMega', 'parentCategoriesNormal', 'banners', 'featureBanners', 'bestSeller', 'dailyDeals', 'newArrival', 'shoesSection'));
    }
    public function banners()
    {
        return Banner::latest()->limit(2)->get();
    }
    public function featureBanners()
    {
        return Featurewallpaper::latest()->get();
    }
    public function bestSeller()
    {
        $buyProductLists = Order::select('orderproduct_id', DB::raw('count(*) as total'))
            ->groupBy('orderproduct_id')
            ->get();
        if ($buyProductLists) {

            return Product::whereIn('product_id', $buyProductLists->pluck('orderproduct_id'))
                ->limit(10)
                ->get();
        }
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
    //showCategoryProducts
    public function showCategoryProducts($slug)
    {
        $category = Category::with(['parentCategory'])->where('slug', $slug)->firstOrFail();

        if ($category) {

                 $products = Product::with('attributes.color', 'attributes.size')
                ->where('category_id', $category->category_id)
                ->limit(1)
                ->get();

            return view('website.category-products', compact('products'));
        }
    }

}
