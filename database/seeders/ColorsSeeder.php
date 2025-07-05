<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'hex_code' => '#FF0000'],
            ['name' => 'Blue', 'hex_code' => '#0000FF'],
            ['name' => 'Green', 'hex_code' => '#008000'],
            ['name' => 'Yellow', 'hex_code' => '#FFFF00'],
            ['name' => 'Purple', 'hex_code' => '#800080'],
            ['name' => 'Orange', 'hex_code' => '#FFA500'],
            ['name' => 'Pink', 'hex_code' => '#FFC0CB'],
            ['name' => 'Brown', 'hex_code' => '#A52A2A'],
            ['name' => 'Gray', 'hex_code' => '#808080'],
            ['name' => 'Black', 'hex_code' => '#000000'],
            ['name' => 'White', 'hex_code' => '#FFFFFF'],
            ['name' => 'Cyan', 'hex_code' => '#00FFFF'],
            ['name' => 'Magenta', 'hex_code' => '#FF00FF'],
            ['name' => 'Lime', 'hex_code' => '#00FF00'],
            ['name' => 'Teal', 'hex_code' => '#008080'],
            ['name' => 'Indigo', 'hex_code' => '#4B0082'],
            ['name' => 'Violet', 'hex_code' => '#EE82EE'],
            ['name' => 'Maroon', 'hex_code' => '#800000'],
            ['name' => 'Navy', 'hex_code' => '#000080'],
            ['name' => 'Olive', 'hex_code' => '#808000'],
            ['name' => 'Silver', 'hex_code' => '#C0C0C0'],
            ['name' => 'Gold', 'hex_code' => '#FFD700'],
            ['name' => 'Coral', 'hex_code' => '#FF7F50'],
            ['name' => 'Salmon', 'hex_code' => '#FA8072'],
            ['name' => 'Turquoise', 'hex_code' => '#40E0D0'],
            ['name' => 'Crimson', 'hex_code' => '#DC143C'],
            ['name' => 'Orchid', 'hex_code' => '#DA70D6'],
            ['name' => 'SlateBlue', 'hex_code' => '#6A5ACD'],
            ['name' => 'DarkGreen', 'hex_code' => '#006400'],
            ['name' => 'DarkRed', 'hex_code' => '#8B0000'],
            ['name' => 'DarkBlue', 'hex_code' => '#00008B'],
            ['name' => 'DarkCyan', 'hex_code' => '#008B8B'],
            ['name' => 'DarkMagenta', 'hex_code' => '#8B008B'],
            ['name' => 'DarkOrange', 'hex_code' => '#FF8C00'],
            ['name' => 'DarkViolet', 'hex_code' => '#9400D3'],
            ['name' => 'DeepPink', 'hex_code' => '#FF1493'],
            ['name' => 'DeepSkyBlue', 'hex_code' => '#00B7EB'],
            ['name' => 'ForestGreen', 'hex_code' => '#228B22'],
            ['name' => 'Fuchsia', 'hex_code' => '#FF00FF'],
            ['name' => 'GoldenRod', 'hex_code' => '#DAA520'],
            ['name' => 'HotPink', 'hex_code' => '#FF69B4'],
            ['name' => 'IndianRed', 'hex_code' => '#CD5C5C'],
            ['name' => 'Khaki', 'hex_code' => '#F0E68C'],
            ['name' => 'Lavender', 'hex_code' => '#E6E6FA'],
            ['name' => 'LightBlue', 'hex_code' => '#ADD8E6'],
            ['name' => 'LightGreen', 'hex_code' => '#90EE90'],
            ['name' => 'LightPink', 'hex_code' => '#FFB6C1'],
            ['name' => 'LightYellow', 'hex_code' => '#FFFFE0'],
            ['name' => 'MediumBlue', 'hex_code' => '#0000CD'],
            ['name' => 'MediumPurple', 'hex_code' => '#9370DB'],
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'name' => $color['name'],
                'hex_code' => $color['hex_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}