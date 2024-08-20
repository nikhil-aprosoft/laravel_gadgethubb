<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['color_id' => Str::uuid(), 'name' => 'Red', 'hex_value' => '#FF0000'],
            ['color_id' => Str::uuid(), 'name' => 'Blue', 'hex_value' => '#0000FF'],
            ['color_id' => Str::uuid(), 'name' => 'Green', 'hex_value' => '#00FF00'],
        ];

        DB::table('colors')->insert($colors);
    }
}
