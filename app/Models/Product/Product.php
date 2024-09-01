<?php

namespace App\Models\Product;

use App\Models\DailyDeal;
use App\Models\Product\FrequentlyBoughtProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
        'product_name',
        'slug',
        'search_product_name',
        'price',
        'current_value',
        'cost',
        'quantity',
        'images',
        'thumbnail',
        'specification',
        'description',
        'short_desc',
        'model',
        'sku',
        'is_active',
        'small_thumbs',
        'pop_images',
        'video',
    ];
    protected $primaryKey = 'product_id';

    protected $keyType = 'string';

    protected $table = 'products';

    protected $appends = ['category'];

    public function getCategoryAttribute()
    {
        return DB::table('categories')->where('category_id', $this->category_id)->first();
    }
    public function dailyDeals()
    {
        return $this->hasMany(DailyDeal::class, 'product_id', 'product_id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id');
    }
    public function frequentlyBoughtProducts(): HasMany
    {
        return $this->hasMany(FrequentlyBoughtProduct::class, 'product_id', 'product_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }
    public function getPriceAttribute($value)
    {
        return '₹' . number_format($value);
    }
    public function getCostAttribute($value)
    {
        return '₹' . number_format($value);
    }
    public function getSizeAttribute($value)
    {
        return explode(',', $value);
    }
    public function getImagesAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getPopImagesAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getSmallThumbsAttribute($value)
    {
        $imagePaths = json_decode($value, true);

        if (!is_array($imagePaths)) {
            return [];
        }
        return array_map(function ($path) {
            return Storage::disk('public')->url($path);
        }, $imagePaths);
    }
    public function getThumbnailAttribute($value)
    {
        return Storage::disk('public')->url($value);
    }
    public function getShortDescAttribute($value)
    {
        // Add pipe symbol after each full stop
        return preg_replace('/\.(?!\s*$)/', '. |', $value);
    }
    public function getSpecificationAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
    public function getVideoAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
    }
    public function setSearchProductNameAttribute($value)
    {
        // Remove all spaces, convert to lowercase
        $this->attributes['search_product_name'] = strtolower(str_replace(' ', '', $value));
    }
    public function convertToDecimal($value)
    {
        // Remove currency symbols and commas
        $value = preg_replace('/[^\d.]/', '', $value);

        // Convert to float
        return (float) $value;
    }
    public function setProductAttributes(Request $request)
    {
        $this->product_id = Str::uuid();
        $this->product_name = $request->input('product_name');
        $this->search_product_name = strtolower(str_replace(' ', '', $this->product_name));
        $this->category_id = $request->input('category_id');
        $this->price = $this->convertToDecimal($request->input('price'));
        $this->cost = $this->convertToDecimal($request->input('cost'));
        $this->quantity = $request->input('quantity');
        $this->description = $request->input('description');
        $this->short_desc = $request->input('short_desc');
        $this->model = $request->input('model');
        $this->sku = $request->input('sku');
        $this->is_active = $request->input('is_active', true);
        $this->slug = Str::slug($this->product_name);

        $specifications = $request->input('specifications');
        $this->specification = $specifications ? json_encode($specifications) : null;

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = 'products/videos';
            $this->video = $video->store($path, 'public');
        } else {
            $this->video = null;
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
    public function handleAttributes(Request $request, Product $product)
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
    public function colorAndSize($obj)
    {
        $attribute = Product::with('attributes.color', 'attributes.size')->where('slug', '=', $obj->slug)->firstOrFail();
        return $attribute;
    }
}
