<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'banner_id' => Str::uuid(), // Generate UUID for the banner
                'banner_text' => 'Welcome to our store! Enjoy the best deals and discounts.',
                'banner_image' => 'https://via.placeholder.com/1200x400', // Placeholder image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'banner_id' => Str::uuid(),
                'banner_text' => 'New Arrivals! Check out our latest products.',
                'banner_image' => 'https://via.placeholder.com/1200x400', // Placeholder image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'banner_id' => Str::uuid(),
                'banner_text' => 'Seasonal Sale! Up to 50% off on selected items.',
                'banner_image' => 'https://via.placeholder.com/1200x400', // Placeholder image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more banners as needed
        ]);
    }
}
