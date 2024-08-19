<?php

namespace Database\Seeders;

use App\Models\ParentCategory;
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
        $parentCategoryNames = [
            'Electronics',
            'Furniture',
            'Clothing',
            'Books',
            'Sports',
            'Beauty & Health',
            'Shoes'
        ];

        foreach ($parentCategoryNames as $name) {
            ParentCategory::create([
                'name' => $name,
                'rank' => '1', 
                'desc' => null, 
            ]);
        }
    }
}
