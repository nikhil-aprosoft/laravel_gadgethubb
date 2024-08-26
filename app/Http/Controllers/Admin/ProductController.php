<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Models\Product\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

// Assuming you use the Intervention Image library for resizing

class ProductController extends Controller
{
    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.add-product', compact('categories', 'colors', 'sizes'));
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
        $product->product_name = $request->input('product_name');
        $product->search_product_name = strtolower(str_replace(' ', '', $request->input('product_name')));
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->cost = $request->input('cost');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->short_desc = $request->input('short_desc');
        $product->model = $request->input('model');
        $product->sku = $request->input('sku');
        $product->is_active = $request->input('is_active', true);
        $product->slug = Str::slug($request->input('product_name'));
        $product->product_id = (string) Str::uuid();
        if ($request->has('specifications')) {
            $specifications = $request->input('specifications');
            $product->specification = json_encode($specifications);
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

            // Save paths to the product model
            $product->pop_images = json_encode($popImagePaths); // Store as JSON array
            $product->small_thumbs = json_encode($smallThumbPaths); // Store as JSON array
            $product->images = json_encode($mainImageResizedPaths); // Store as JSON array
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
            // Store the thumbnail in the 'products/thumbnails' directory
            $path = $request->file('thumbnail')->store('products/thumbnails', 'public');

            // Resize the thumbnail image
            $img = Image::make(public_path("storage/{$path}"))->resize(400, 400)->save(public_path("storage/{$path}"));

            // Update the product's thumbnail path
            $product->thumbnail = $path;
        }
    }

    protected function handleAttributes(Request $request, Product $product)
    {
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

            // Check and validate 'size_id'
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

}
