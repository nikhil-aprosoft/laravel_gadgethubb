<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Product;
use App\Models\Product\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $colors = colors();
        $sizes = size();

        return view('admin.products.add-product', compact('categories', 'colors', 'sizes'));
    }
    public function store(Request $request)
    {
        // return $request->all();

        $product = new Product();

        $product->setProductAttributes($request);

        $product->handleImages($request, $product);

        $product->handleThumbnail($request, $product);

        $product->save();

        $product->handleAttributes($request, $product);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
    public function viewProduts()
    {
        $products = Product::paginate(10);
        return view('admin.products.view-products', compact('products'));
    }
    public function updateStockStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'in_stock' => 'required|boolean',
            'quantity' => 'required_if:in_stock,false|integer|min:1',
        ]);

        $stock = $request->input('in_stock') ? 1 : 0;

        DB::table('products')
            ->where('product_id', $id)
            ->update([
                'stock' => $stock,
                'quantity' => $request->input('quantity', 0),
            ]);

        return response()->json(['success' => true]);
    }
    public function deactivate(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
        ]);

        $stock = $request->input('product_id') ? 1 : 0;

        DB::table('products')
            ->where('product_id', $id)
            ->update([
                'is_active' => 0,
            ]);

        return response()->json(['success' => true]);
    }
    public function show(Request $request, $slug)
    {
        $product = Product::with('attributes')->where('slug', $slug)->first();
        return view('admin.products.update-product', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::where('product_id', '=', $id)->first();

        $product->setProductAttributes($product, $request);

        $product->handleImages($request, $product);

        $product->handleThumbnail($request, $product);

        $product->save();

        $product->handleAttributes($request, $product);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
}
