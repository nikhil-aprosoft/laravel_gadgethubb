<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DailyDealsSeeder extends Seeder
{
    public function run()
    {
        // Fetch existing product IDs from the products table
        $productIds = DB::table('products')->pluck('product_id');

        // Insert sample data into daily_deals table
        DB::table('daily_deals')->insert([
            [
                'product_id' => $productIds->random(), // Randomly select a product ID
                'text' => 'Limited time offer: Save 20% on selected items!',
                'discount_amount' => 20.00, // Fixed discount amount
                'discount_type' => 'fixed',
                'start_date' => now()->addDay(), // Start date is tomorrow
                'end_date' => now()->addDays(5), // End date is 5 days from now
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => $productIds->random(), // Randomly select a product ID
                'text' => 'Flash sale: 10% off on all products!',
                'discount_amount' => 10.00, // Fixed discount amount
                'discount_type' => 'fixed',
                'start_date' => now()->addDays(2), // Start date is 2 days from now
                'end_date' => now()->addDays(7), // End date is 7 days from now
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => $productIds->random(), // Randomly select a product ID
                'text' => 'Special Deal: 15% off site-wide!',
                'discount_amount' => 15.00, // Fixed discount amount
                'discount_type' => 'fixed',
                'start_date' => now()->addHours(12), // Start date is 12 hours from now
                'end_date' => now()->addDays(3), // End date is 3 days from now
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more daily deals as needed
        ]);
    }
}
