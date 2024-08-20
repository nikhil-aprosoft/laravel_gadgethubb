<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['size_id' => Str::uuid(), 'size' => 'Small'],
            ['size_id' => Str::uuid(), 'size' => 'Medium'],
            ['size_id' => Str::uuid(), 'size' => 'Large'],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
