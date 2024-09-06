<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\BannersSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\DailyDealsSeeder;
use Database\Seeders\ParentCategoriesSeeder;
use Database\Seeders\ProductAttributeSeeder;
use Database\Seeders\FeatureWallpapersSeeder;

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
            // BannersSeeder::class,
            // FeatureWallpapersSeeder::class,
            // ParentCategoriesSeeder::class,
            // CategoriesSeeder::class,
            ProductsSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductAttributeSeeder::class,
            DailyDealsSeeder::class,
            UserSeeder::class,
           AddressSeeder::class
        ]);
    }
}
