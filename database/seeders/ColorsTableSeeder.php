<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Gray'],
            ['name' => 'Beige'],
            ['name' => 'Red'],
            ['name' => 'Blue'],
            ['name' => 'Green'],
            ['name' => 'Yellow'],
            ['name' => 'Purple'],
            ['name' => 'Pink'],
            ['name' => 'Orange'],
            ['name' => 'Brown'],
            ['name' => 'Navy Blue'],
            ['name' => 'Silver'],
            ['name' => 'Gold'],
            ['name' => 'Multicolor'],
        ];

        foreach ($colors as $colors) {
            Color::create([
                'name' => $colors['name']
            ]);
        }
    }
}
