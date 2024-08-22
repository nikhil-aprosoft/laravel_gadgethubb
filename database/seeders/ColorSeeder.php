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
            ['color_id' => (string) Str::uuid(), 'name' => 'Red', 'hex_value' => '#FF0000'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Blue', 'hex_value' => '#0000FF'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Green', 'hex_value' => '#00FF00'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Yellow', 'hex_value' => '#FFFF00'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Purple', 'hex_value' => '#800080'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Orange', 'hex_value' => '#FFA500'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Pink', 'hex_value' => '#FFC0CB'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Cyan', 'hex_value' => '#00FFFF'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Magenta', 'hex_value' => '#FF00FF'],
            ['color_id' => (string) Str::uuid(), 'name' => 'Brown', 'hex_value' => '#A52A2A'],
            ['color_id' => (string) Str::uuid(), 'name' => 'White', 'hex_value' => '#FFFFFF'],
        ];

        DB::table('colors')->insert($colors);
    }
}
