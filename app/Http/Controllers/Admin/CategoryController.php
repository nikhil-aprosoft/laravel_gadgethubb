<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function create()
    {
        $parentCategory = ParentCategory::all();
        return view('admin.categories.add-category', compact('parentCategory'));
    }

    public function store(Request $request)
    {
     
       try {
        $request->validate([
            'parent_category_id' => 'nullable|exists:parent_categories,id',
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png', // Validation for image
        ]);

        // Handle image upload
          $imagePath = null;
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imagePath = $image->store('categories', 'public'); // Store the image

            // Optionally, resize the image
            $img = Image::make(public_path("storage/{$imagePath}"))->resize(190, 184);
            $img->save(); // Save the resized image
        }
         
        // Create the category
        Category::create([
            'category_id' => (string) Str::uuid(),
            'parent_category_id' => $request->input('parent_category_id'),
            'category_name' => $request->input('category_name'),
            'slug' => Str::slug($request->input('category_name')), // Generate slug from category name
            'category_image' => $imagePath,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category added successfully.');
       } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Category not added');

       }
    }

    public function viewCategory(Category $category)
    {
        $category = Category::paginate(10);
        return view('admin.categories.view-category', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = $request->validate([
            'parent_category_id' => 'nullable|exists:parent_categories,id',
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png', // Validation for image
        ]);
    
        // Get the existing category data
        $category = DB::table('categories')->where('category_id', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
    
        // Handle image upload
        $imagePath = $category->category_image; // Preserve old image path
    
        if ($request->hasFile('category_image')) {
            // Delete the old image if exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
    
            // Store the new image
            $image = $request->file('category_image');
            $imagePath = $image->store('categories', 'public'); // Store the image
    
            // Optionally, resize the image
            $img = Image::make(public_path("storage/{$imagePath}"))->resize(190, 184);
            $img->save(); // Save the resized image
        }
    
        // Update the category in the database
        DB::table('categories')->where('category_id', $id)->update([
            'parent_category_id' => $request->input('parent_category_id'),
            'category_name' => $request->input('category_name'),
            'slug' => Str::slug($request->input('category_name')), // Update slug
            'category_image' => $imagePath, // Update image path
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
