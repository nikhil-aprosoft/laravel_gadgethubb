<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FrequentlyBoughtProductSeeder extends Seeder
{
    public function run()
    {
       

        $products = \App\Models\Product\Product::pluck('product_id')->toArray(); 

        if (empty($products)) {
            $this->command->error('No products found. Please seed the products table first.');
            return;
        }

        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id' => (string) Str::uuid(),
                'product_id' => $products[array_rand($products)], 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('frequently_bought_products')->insert($data);
    }
}
