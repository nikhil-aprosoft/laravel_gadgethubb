<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Models\Product\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

// Assuming you use the Intervention Image library for resizing

class ProductController extends Controller
{
    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        $colors = colors();
        $sizes = size();

        return view('admin.products.add-product', compact('categories', 'colors', 'sizes'));
    }
    // Store a newly created product in storage
    public function store(Request $request)
    {
        // return $request->all();

        $product = new Product();

        $this->setProductAttributes($product, $request);

        $this->handleImages($request, $product);

        $this->handleThumbnail($request, $product);

        $product->save();

        $this->handleAttributes($request, $product);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
    protected function setProductAttributes(Product $product, Request $request)
    {
        // Update attributes
        $product->product_name = $request->input('product_name');
        $product->search_product_name = strtolower(str_replace(' ', '', $request->input('product_name')));
        $product->category_id = $request->input('category_id');
        $product->price = $product->convertToDecimal($request->input('price'));
        $product->cost = $product->convertToDecimal($request->input('cost'));
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->short_desc = $request->input('short_desc');
        $product->model = $request->input('model');
        $product->sku = $request->input('sku');
        $product->is_active = $request->input('is_active', true);
        $product->slug = Str::slug($request->input('product_name'));
        if ($request->input('specifications')) {
            \Log::alert("if");
            $specifications = $request->input('specifications');
            $product->specification = json_encode($specifications);
        } else {
            \Log::alert("else");
            $product->specification = null;

        }
        if ($request->hasFile('video')) {
            // Handle new video
            $video = $request->file('video');
            $path = 'products/videos';
            $videoPath = $video->store($path, 'public');
            $product->video = $videoPath;
        }
    }

    protected function handleImages(Request $request, Product $product)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $popImagePaths = [];
            $smallThumbPaths = [];
            $mainImageResizedPaths = [];

            foreach ($images as $image) {
                $mainImagePath = $this->storeImage($image, 'temp');

                // Resize main image to 600x600
                $resizedPath = $this->resizeAndStoreImage($mainImagePath, 600, 600, 'products/resized_images');

                // Create pop and small thumb images from the resized image
                $popImagePath = $this->resizeAndStoreImage($resizedPath, 800, 900, 'products/pop');
                $smallThumbPath = $this->resizeAndStoreImage($resizedPath, 100, 110, 'products/small_thumb');

                // Collect the paths
                $popImagePaths[] = $popImagePath;
                $smallThumbPaths[] = $smallThumbPath;
                $mainImageResizedPaths[] = $resizedPath;

                \File::delete(public_path("storage/{$mainImagePath}"));
            }

            // Update paths in the product model
            $product->pop_images = json_encode($popImagePaths);
            $product->small_thumbs = json_encode($smallThumbPaths);
            $product->images = json_encode($mainImageResizedPaths);
        }
    }

    private function storeImage($image, $folder)
    {
        return $image->store($folder, 'public');
    }

    private function resizeAndStoreImage($path, $width, $height, $folder)
    {
        $this->ensureDirectoryExists($folder);
        $img = Image::make(public_path("storage/{$path}"))->resize($width, $height);
        $filename = basename($path);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);

        $newFilename = "{$filenameWithoutExt}_{$width}x{$height}.{$extension}";
        $newPath = "{$folder}/{$newFilename}";
        $img->save(public_path("storage/{$newPath}"));

        return $newPath;
    }

    private function ensureDirectoryExists($path)
    {
        $fullPath = public_path("storage/{$path}");
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
    }
    protected function handleThumbnail(Request $request, Product $product)
    {
        if ($request->hasFile('thumbnail')) {
            // Store the thumbnail
            $path = $request->file('thumbnail')->store('products/thumbnails', 'public');

            // Resize the thumbnail image
            $img = Image::make(public_path("storage/{$path}"))->resize(400, 400)->save(public_path("storage/{$path}"));

            // Update the product's thumbnail path
            $product->thumbnail = $path;
        }
    }

    protected function handleAttributes(Request $request, Product $product)
    {
        // Clear existing attributes for the product
        ProductAttribute::where('product_id', $product->product_id)->delete();

        $attributes = $request->input('attributes', []);

        foreach ($attributes as $attribute) {
            $ProductAttribute = new ProductAttribute;
            $ProductAttribute->product_id = $product->product_id;
            $ProductAttribute->id = (string) Str::uuid();

            if (isset($attribute['color_id'])) {
                $colorId = $attribute['color_id'];
                if (Color::where('color_id', $colorId)->exists()) {
                    $ProductAttribute->color_id = $colorId;
                } else {
                    \Log::error('Invalid Color ID:', $colorId);
                    continue; // Skip this attribute
                }
            }

            if (isset($attribute['size_id'])) {
                $sizeId = $attribute['size_id'];
                if (Size::where('size_id', $sizeId)->exists()) {
                    $ProductAttribute->size_id = $sizeId;
                } else {
                    \Log::error('Invalid Size ID:', $sizeId);
                    continue; // Skip this attribute
                }
            }

            $ProductAttribute->save();
        }
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
            'quantity' => 'required_if:in_stock,false|integer|min:1', // Validate quantity if stock is being turned off
        ]);

        // Update the stock status
        $stock = $request->input('in_stock') ? 1 : 0;

        // If out of stock, use the provided quantity
        DB::table('products')
            ->where('product_id', $id)
            ->update([
                'stock' => $stock,
                'quantity' => $request->input('quantity', 0), // Update quantity if provided
            ]);

        return response()->json(['success' => true]);
    }
    public function deactivate(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
        ]);

        // Update the stock status
        $stock = $request->input('product_id') ? 1 : 0;

        // If out of stock, use the provided quantity
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
        // $existingAttributes = $product->attributes;
        return view('admin.products.update-product', compact('product'));
    }
    public function update(Request $request, $id)
    {

        // Retrieve the product by ID
        $product = Product::where('product_id', '=', $id)->first();

        // Set or update product attributes
        $this->setProductAttributes($product, $request);

        // Handle images
        $this->handleImages($request, $product);

        // Handle thumbnail
        $this->handleThumbnail($request, $product);

        // Save product details
        $product->save();

        // Handle product attributes
        $this->handleAttributes($request, $product);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
}
