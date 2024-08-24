<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ParentCategoriesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([       
            BannersSeeder::class,
            FeatureWallpapersSeeder::class,
            ParentCategoriesSeeder::class,
            // CategoriesSeeder::class,
            // ProductsSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            // ProductAttributeSeeder::class,
            // DailyDealsSeeder::class,
        ]);
    }
}
