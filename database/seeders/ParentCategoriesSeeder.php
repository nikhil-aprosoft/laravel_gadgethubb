<?php

namespace Database\Seeders;

use App\Models\ParentCategory;
use Illuminate\Database\Seeder;

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
            'Shoes',
        ];

        //  foreach ($parentCategoryNames as $name) {
        ParentCategory::create([
            'name' => "Electronics",
            'rank' => '1',
            'desc' => null,
            'icon' => 'w-icon-electronics',
        ]);
        ParentCategory::create([
            'name' => "Furniture",
            'rank' => '1',
            'desc' => null,
            'icon' => 'w-icon-electronics',
        ]);
        ParentCategory::create([
            'name' => "Furniture",
            'rank' => '1',
            'desc' => null,
            'icon' => 'w-icon-electronics',
        ]);
        // }
    }
}
