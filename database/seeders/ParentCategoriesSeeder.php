<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentCategoriesSeeder extends Seeder
{
    /**
     * Seed the parent_categories table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parent_categories')->insert([
            // [
            //     'name' => 'Fashion',
            //     'desc' => 'Fashion and apparel for all styles and trends',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Home & Garden',
            //     'desc' => 'Furniture, decor, and gardening supplies for your home',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Electronics',
            //     'desc' => 'Latest gadgets and electronic devices',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Furniture',
            //     'desc' => 'Wide range of furniture for your home and office',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Sports',
            //     'desc' => 'Sports equipment and accessories for all activities',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Accessories',
            //     'desc' => 'accessories for all activities',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'name' => 'Other',
                'desc' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
