<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run()
    {    
        for ($i = 0; $i <= 100; $i++) {

            $products = [
                [
                    'product_id' => Str::uuid(),
                    'category_id' => DB::table('categories')->inRandomOrder()->first()->category_id,
                    'product_name' => 'Sample Product ' . Str::random(5),
                    'search_product_name' => 'Searchable Name ' . Str::random(5),
                    'slug' => 'running-shoes',
                    'price' => 120.00,
                    'current_value' => null,
                    'images' => 'https://development.gadgethubb.in/public/storage/products/resized_images/Zk5MRixgGE2mem4v1hecmj6tzIxNCpjUeWZoXzOC_600x600.jpg',
                    'specification' => 'Lightweight running shoes',
                    'quantity' => 50,
                    'description' => 'Comfortable running shoes with excellent cushioning.',
                    'short_desc' => 'Running shoes for daily workouts.Running shoes for daily workouts.Running shoes for daily workouts.',
                    'is_active' => true,
                    'model' => 'RS2024',
                    'sku' => Str::upper(Str::random(8)),
                    'cost' => 80.00,
                    'thumbnail' => 'https://development.gadgethubb.in/public/storage/products/resized_images/Zk5MRixgGE2mem4v1hecmj6tzIxNCpjUeWZoXzOC_600x600.jpg',
                    'small_thumbs'=> 'https://development.gadgethubb.in/public/storage/products/resized_images/Zk5MRixgGE2mem4v1hecmj6tzIxNCpjUeWZoXzOC_600x600.jpg',
                    'pop_images'=>'https://development.gadgethubb.in/public/storage/products/resized_images/Zk5MRixgGE2mem4v1hecmj6tzIxNCpjUeWZoXzOC_600x600.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                // Add more products as needed
            ];
            // Add more products as needed
            DB::table('products')->insert($products);
        }

    }
}
