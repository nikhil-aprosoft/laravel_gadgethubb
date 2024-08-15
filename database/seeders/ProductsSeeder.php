<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Get some category IDs from the categories table
        $categoryIds = DB::table('categories')->pluck('category_id');

        foreach ($categoryIds as $categoryId) {
            DB::table('products')->insert([
                [
                    'product_id' => Str::uuid(), // Generate UUID for the product
                    'category_id' => $categoryId,
                    'product_name' => 'Sample Product ' . Str::random(5),
                    'search_product_name' => 'Searchable Name ' . Str::random(5),
                    'price' => rand(10, 1000), // Random price between 10 and 1000
                   // 'current_value' => rand(10, 1000),
                    'images' => 'https://via.placeholder.com/150', // Placeholder image URL
                    'specification' => 'Specifications for Sample Product',
                    'quantity' => rand(1, 100), // Random quantity between 1 and 100
                    'description' => 'Description of the sample product',
                    'is_active' => true,
                    'model' => 'Model ' . Str::random(5),
                    'sku' => 'SKU-' . Str::upper(Str::random(8)), // Unique SKU
                    'cost' => rand(5, 500),
                    'size' => 'Size ' . Str::random(2),
                    'thumbnail' => 'https://via.placeholder.com/50', // Placeholder thumbnail URL
                    'slug' => Str::slug('Sample Product ' . Str::random(5)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                // Add more products as needed
            ]);
        }
    }
}
