<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category; // Import the Category model

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Fetch all parent category IDs
        $parentCategoryIds = DB::table('parent_categories')->pluck('id');

        foreach ($parentCategoryIds as $parentCategoryId) {
            Category::create([
                'category_id' => Str::uuid(), // Generate UUID
                'parent_category_id' => $parentCategoryId,
                'category_name' => 'Sample Category ' . Str::random(5),
                'slug' => Str::slug('Sample Category ' . Str::random(5)),
                'category_image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);

            Category::create([
                'category_id' => Str::uuid(),
                'parent_category_id' => $parentCategoryId,
                'category_name' => 'Another Category ' . Str::random(5),
                'slug' => Str::slug('Another Category ' . Str::random(5)),
                'category_image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);
        }
    }
}
