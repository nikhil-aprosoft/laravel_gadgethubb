<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=100;$i++){
            $productId = DB::table('products')->inRandomOrder()->first()->product_id;
            $colorId = DB::table('colors')->inRandomOrder()->first()->color_id;
            $sizeId = DB::table('sizes')->inRandomOrder()->first()->size_id;
    
            $productAttributes = [
                [
                    'id' => Str::uuid(),
                    'product_id' => $productId,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,                
                ],
            ];
    
            DB::table('product_attributes')->insert($productAttributes);
        }
        
    }
}
