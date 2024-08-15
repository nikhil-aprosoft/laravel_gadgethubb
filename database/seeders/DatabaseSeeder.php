<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ParentCategoriesSeeder;

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
           // ParentCategoriesSeeder::class,
           // CategoriesSeeder::class,
           //BannersSeeder::class,
           //FeatureWallpapersSeeder::class,
        ProductsSeeder::class,
           DailyDealsSeeder::class,
        ]);
    }
}
