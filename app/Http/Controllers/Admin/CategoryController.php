<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function create()
    {
        $parentCategory = ParentCategory::all();
        return view('admin.add-category', compact('parentCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_category_id' => 'nullable|exists:parent_categories,id',
            'category_name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation for image
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
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'parent_category_id' => $request->parent_category_id,
            'category_name' => $request->category_name,
            'slug' => $request->category_name,
            'category_image' => $request->category_image,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
