<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use App\Models\Product\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

        $productId = Str::uuid();

        $product->product_id = $productId;

        $product->category_id = $request->category_id;

        $this->setProductAttributes($product, $request);

        $this->handleImages($request, $product);

        $this->handleThumbnail($request, $product);

        $product->save();

        $this->handleAttributes($request, $productId);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
    public function setProductAttributes($product, $request)
    {
        $product->product_name = $request->product_name;
        $product->search_product_name = strtolower(str_replace(' ', '', $product->product_name));
        $product->price = $product->convertToDecimal($request->price);
        $product->cost = $product->convertToDecimal($request->cost);
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->short_desc = $request->short_desc;
        $product->model = $request->model;
        $product->sku = $request->sku;
        // $product->is_active = $request->is_active;
        $product->slug = Str::slug($product->product_name);

        $specifications = $request->specifications;
        $this->specification = $specifications ? json_encode($specifications) : null;

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = 'products/videos';
            $product->video = $video->store($path, 'public');
        } else {
            $product->video = null;
        }
    }

    public function handleImages(Request $request, Product $product)
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
    private function storeImage($image, $folder)
    {
        return $image->store($folder, 'public');
    }
    private function ensureDirectoryExists($path)
    {
        $fullPath = public_path("storage/{$path}");
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
    }
    public function handleThumbnail(Request $request, Product $product)
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
    public function handleAttributes($request, $productId)
    {
        $attributes = $request->input('attributes', []);
        foreach ($attributes as $attribute) {
            $ProductAttribute = new ProductAttribute;
            $ProductAttribute->product_id = $productId;
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
    public function deactivate($slug)
    {
        $product = Product::where('slug', '=', $slug)
            ->first();
        if ($product->is_active == 1) {
            $product->is_active = 0;
            $product->save();
        } else {
            $product->is_active = 1;
            $product->save();
        }

        return redirect()->back()->with('success', 'Product deactivated successfully.');
    }
    public function show(Request $request, $slug)
    {
        $product = Product::with('attributes')->where('slug', $slug)->first();
        return view('admin.products.update-product', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::where('product_id', '=', $id)->first();

        $this->setProductAttributes($product, $request);

        $this->handleImages($request, $product);

        $this->handleThumbnail($request, $product);

        $product->save();

        $this->handleAttributes($request, $id);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
}
