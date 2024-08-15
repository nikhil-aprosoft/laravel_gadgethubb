<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeatureWallpapersSeeder extends Seeder
{
    public function run()
    {
        DB::table('feature_wallpapers')->insert([
            [
                'desc' => 'Elegant floral wallpaper with a classic design',
                'image' => 'https://via.placeholder.com/600x400', // Placeholder image URL
                'sku' => 'FW-001',
                'cost' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'desc' => 'Modern geometric pattern wallpaper for contemporary spaces',
                'image' => 'https://via.placeholder.com/600x400', // Placeholder image URL
                'sku' => 'FW-002',
                'cost' => 34.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'desc' => 'Vintage wallpaper with intricate baroque designs',
                'image' => 'https://via.placeholder.com/600x400', // Placeholder image URL
                'sku' => 'FW-003',
                'cost' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more wallpapers as needed
        ]);
    }
}
